<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;
use App\Models\RegistrationForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EventRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = EventRegistration::with(['registrationForm.event']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('event_id')) {
            $query->whereHas('registrationForm', function ($q) use ($request) {
                $q->where('event_id', $request->event_id);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereRaw('JSON_EXTRACT(participant_data, "$.name") LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('JSON_EXTRACT(participant_data, "$.email") LIKE ?', ["%{$search}%"]);
            });
        }

        $registrations = $query->orderBy('created_at', 'desc')->paginate(15);
        $registrationForms = RegistrationForm::with('event')->get();

        return view('admin.registrations.index', compact('registrations', 'registrationForms'));
    }

    public function show(EventRegistration $registration)
    {
        $registration->load(['registrationForm.event', 'registrationForm.formFields.formField', 'processor']);
        return view('admin.registrations.show', compact('registration'));
    }

    public function updateStatus(Request $request, EventRegistration $registration)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,cancelled',
            'admin_notes' => 'nullable|string|max:1000'
        ]);
        $registration->update([
            'status' => $request->status,
            // 'data_approved' => 1,
            // 'data_approved_at' => now(),
            'admin_notes' => $request->admin_notes,
            'processed_by' => Auth::id(),
            'processed_at' => now()
        ]);

        if ($request->status == 'approved') {
            $registration->update([
                'approved' => 1,
            ]);
        } elseif ($request->status == 'rejected') {
            $registration->update([
                'approved' => 2,
            ]);
        } elseif ($request->status == 'pending') {
            $registration->update([
                'approved' => 0,
            ]);
        }

        return back()->with('success', 'Status registrasi berhasil diupdate!');
    }

    public function destroy(EventRegistration $registration)
    {
        // Delete uploaded files if any
        foreach ($registration->participant_data as $key => $value) {
            if (is_string($value) && Storage::disk('public')->exists($value)) {
                Storage::disk('public')->delete($value);
            }
        }

        $registration->delete();

        return redirect()->route('admin.registrations.index')->with('success', 'Registrasi berhasil dihapus!');
    }

    public function export(Request $request)
    {
        $query = EventRegistration::with(['registrationForm.event']);

        if ($request->filled('event_id')) {
            $query->whereHas('registrationForm', function ($q) use ($request) {
                $q->where('event_id', $request->event_id);
            });
        }

        $registrations = $query->get();

        $filename = 'registrations_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($registrations) {
            $file = fopen('php://output', 'w');

            // CSV Header
            fputcsv($file, [
                'ID',
                'Event',
                'Nama',
                'Email',
                'Phone',
                'Company',
                'Status',
                'Tanggal Daftar',
                'Admin Notes'
            ]);

            foreach ($registrations as $registration) {
                fputcsv($file, [
                    $registration->id,
                    $registration->registrationForm->event->title,
                    $registration->participant_data['name'] ?? '',
                    $registration->participant_data['email'] ?? '',
                    $registration->participant_data['phone'] ?? '',
                    $registration->participant_data['company'] ?? '',
                    ucfirst($registration->status),
                    $registration->created_at->format('Y-m-d H:i:s'),
                    $registration->admin_notes
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function approve(Request $request, EventRegistration $registration)
    {
        try {
            // Generate invoice number
            $invoiceNumber = 'INV-' . date('Ymd') . '-' . str_pad($registration->id, 4, '0', STR_PAD_LEFT);

            // Update registration
            $registration->update([
                'data_approved' => true,
                'data_approved_at' => now(),
                'data_approved_by' => auth()->id(),
                'invoice_number' => $invoiceNumber,
                'status' => $registration->registrationForm->event->registration_fee > 0 ? 'payment_pending' : 'completed'
            ]);

            // Send WhatsApp notification for data approval
            try {
                $whatsappService = new \App\Services\WhatsAppNotificationService();
                $whatsappService->sendDataApprovedNotification($registration);
                Log::info('WhatsApp notification sent for data approval', ['id' => $registration->id]);
            } catch (\Exception $e) {
                Log::error('Failed to send WhatsApp notification for data approval', [
                    'id' => $registration->id,
                    'error' => $e->getMessage()
                ]);
            }

            return back()->with('success', 'Registration data approved successfully');
        } catch (\Exception $e) {
            Log::error('Error approving registration data: ' . $e->getMessage());
            return back()->with('error', 'Failed to approve registration data');
        }
    }

    public function reject(EventRegistration $registration)
    {
        $registration->update([
            'data_approved' => false,  // Bukan 'approved'
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Registrasi berhasil ditolak.');
    }

    public function approvePayment(Request $request, EventRegistration $registration)
    {
        try {
            $registration->update([
                'payment_approved' => true,
                'payment_approved_at' => now(),
                'payment_approved_by' => auth()->id(),
                'status' => 'completed'
            ]);

            // Send WhatsApp notification for completed registration
            try {
                $whatsappService = new \App\Services\WhatsAppNotificationService();
                $whatsappService->sendRegistrationCompletedNotification($registration);
                Log::info('WhatsApp notification sent for completed registration', ['id' => $registration->id]);
            } catch (\Exception $e) {
                Log::error('Failed to send WhatsApp notification for completed registration', [
                    'id' => $registration->id,
                    'error' => $e->getMessage()
                ]);
            }

            return back()->with('success', 'Payment approved successfully');
        } catch (\Exception $e) {
            Log::error('Error approving payment: ' . $e->getMessage());
            return back()->with('error', 'Failed to approve payment');
        }
    }

    public function rejectPayment(EventRegistration $registration)
    {
        $registration->update([
            'payment_approved' => false,
            'transfer_receipt' => null,
            'status' => 'payment_rejected'
        ]);

        return back()->with('success', 'Pembayaran ditolak. User harus upload ulang bukti transfer.');
    }
}
