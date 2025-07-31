<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class RegistrationApprovalController extends Controller
{
    public function index()
    {
        $registrations = EventRegistration::with(['registrationForm.event', 'dataApprovedBy', 'paymentApprovedBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.registration-approvals.index', compact('registrations'));
    }

    public function show(EventRegistration $registration)
    {
        $registration->load(['registrationForm.event', 'dataApprovedBy', 'paymentApprovedBy']);
        return view('admin.registration-approvals.show', compact('registration'));
    }

    public function approveData(EventRegistration $registration)
    {
        // Add logging untuk debug
        \Log::info('ApproveData called for registration ID: ' . $registration->id);
        \Log::info('Current data_approved value: ' . $registration->data_approved);

        if ($registration->data_approved) {
            return back()->with('warning', 'Data sudah disetujui sebelumnya.');
        }

        $result = $registration->update([
            'data_approved' => true,
            'data_approved_at' => now(),
            'data_approved_by' => auth()->id(),
            'status' => 'data_approved'
        ]);

        \Log::info('Update result: ' . ($result ? 'success' : 'failed'));
        \Log::info('After update data_approved: ' . $registration->fresh()->data_approved);

        // Generate invoice
        $invoiceNumber = $registration->generateInvoiceNumber();

        return back()->with('success', 'Data berhasil disetujui dan invoice telah dibuat: ' . $invoiceNumber);
    }

    public function approvePayment(EventRegistration $registration)
    {
        if (!$registration->data_approved) {
            return back()->with('error', 'Data harus disetujui terlebih dahulu.');
        }

        if (!$registration->transfer_receipt) {
            return back()->with('error', 'Bukti transfer belum di-upload.');
        }

        if ($registration->payment_approved) {
            return back()->with('warning', 'Pembayaran sudah disetujui sebelumnya.');
        }

        $registration->update([
            'payment_approved' => true,
            'payment_approved_at' => now(),
            'payment_approved_by' => Auth::id(),
            'status' => 'completed'
        ]);

        return back()->with('success', 'Pembayaran berhasil disetujui. Registrasi telah selesai.');
    }

    public function rejectData(Request $request, EventRegistration $registration)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $registration->update([
            'data_approved' => false,
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason
        ]);

        return back()->with('success', 'Data registrasi telah ditolak.');
    }

    public function rejectPayment(Request $request, EventRegistration $registration)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $registration->update([
            'payment_approved' => false,
            'transfer_receipt' => null,
            'status' => 'payment_rejected',
            'payment_rejection_reason' => $request->rejection_reason
        ]);

        return back()->with('success', 'Pembayaran telah ditolak.');
    }

    private function generateInvoicePDF(EventRegistration $registration)
    {
        $data = [
            'registration' => $registration,
            'invoice_number' => $registration->invoice_number,
            'created_date' => $registration->data_approved_at,
            'amount' => 500000 // Default amount, bisa disesuaikan
        ];

        $pdf = Pdf::loadView('admin.invoices.template', $data);
        $filename = 'invoice-' . $registration->invoice_number . '.pdf';
        $path = 'invoices/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());

        $registration->update([
            'invoice_path' => $path
        ]);

        return $path;
    }
}
