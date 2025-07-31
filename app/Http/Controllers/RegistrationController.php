<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\RegistrationForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\ConfirmedRegistrationMail;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    public function index()
    {
        // Debug: Log semua events dan forms untuk debugging
        $allEvents = Event::with('registrationForms')->get();
        Log::info('All events data:', ['events' => $allEvents->toArray()]);

        $allForms = RegistrationForm::with('event')->get();
        Log::info('All registration forms data:', ['forms' => $allForms->toArray()]);

        // Original query with debugging
        $events = Event::whereHas('registrationForms', function ($query) {
            $query->where('is_active', true)
                ->where('registration_start', '<=', now())
                ->where('registration_end', '>=', now());
        })
            ->where('status', 'published')
            ->where('event_date', '>=', now())
            ->with('activeRegistrationForm')
            ->orderBy('event_date')
            ->get();

        Log::info('Filtered events for registration:', ['events' => $events->toArray()]);
        Log::info('Current time:', ['time' => now()->toDateTimeString()]);

        return view('registration.index', compact('events'));
    }

    public function show(RegistrationForm $form)
    {
        if (!$form->isRegistrationOpen()) {
            return redirect()->route('registrasi.index')
                ->with('error', 'Registrasi untuk event ini sudah ditutup atau belum dibuka.');
        }

        $form->load(['event', 'formFields.formField']);
        return view('registration.form', compact('form'));
    }

    public function store(Request $request, RegistrationForm $form)
    {
        if (!$form->isRegistrationOpen()) {
            return back()->with('error', 'Registrasi untuk event ini sudah ditutup atau belum dibuka.');
        }

        // Add detailed logging for debugging - FIX: proper array format
        Log::info('=== Registration Store Debug ===');
        Log::info('Request all data:', ['data' => $request->all()]);
        Log::info('Form has repeatable section:', ['has_repeatable' => $form->hasRepeatableSection()]);

        // Debug repeatable sections config
        if ($form->hasRepeatableSection()) {
            Log::info('Repeatable sections config:', ['sections' => $form->getRepeatableSections()]);
        }

        // Build validation rules dynamically
        $rules = [];
        $participantData = [];

        // Validate regular fields
        foreach ($form->formFields as $formField) {
            $fieldName = $formField->formField->field_name;
            $validationRules = $formField->getValidationRules();

            if ($formField->is_required) {
                $rules[$fieldName] = 'required';
            }

            // Add specific validation rules
            if (isset($validationRules['email'])) {
                $rules[$fieldName] = ($rules[$fieldName] ?? '') . '|email';
            }

            if (isset($validationRules['mimes'])) {
                $rules[$fieldName] = ($rules[$fieldName] ?? '') . '|file|mimes:' . $validationRules['mimes'] . '|max:' . ($validationRules['max'] ?? 2048);
            }

            if (isset($validationRules['max']) && $formField->formField->field_type !== 'file') {
                $rules[$fieldName] = ($rules[$fieldName] ?? '') . '|max:' . $validationRules['max'];
            }

            if (isset($validationRules['min'])) {
                $rules[$fieldName] = ($rules[$fieldName] ?? '') . '|min:' . $validationRules['min'];
            }
        }

        // Debug validation rules
        Log::info('Validation rules:', ['rules' => $rules]);

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info('Validation failed:', ['errors' => $validator->errors()]);
            return back()->withErrors($validator)->withInput();
        }

        $participantData = [];

        // Process regular fields
        foreach ($form->formFields as $formField) {
            $fieldName = $formField->formField->field_name;
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $path = $file->store('registrations/' . $form->id, 'public');
                $participantData[$fieldName] = $path;
            } else {
                $participantData[$fieldName] = $request->input($fieldName);
            }
        }

        // --- REPEATABLE SECTION: HANDLE BOTH SPACE AND UNDERSCORE FORMAT ---
        if ($form->hasRepeatableSection()) {
            Log::info('=== PROCESSING REPEATABLE SECTIONS ===');

            foreach ($form->getRepeatableSections() as $section) {
                $sectionName = $section['name'];
                $sectionData = [];
                $max = $section['max_count'] ?? 20;
                $fields = [];

                // Convert space to underscore for input matching
                $sectionNameForInput = str_replace(' ', '_', $sectionName);

                Log::info('Processing section:', [
                    'original_name' => $sectionName,
                    'input_name' => $sectionNameForInput,
                    'max_count' => $max,
                    'field_ids' => $section['fields']
                ]);

                foreach ($section['fields'] as $fieldId) {
                    $field = \App\Models\FormField::find($fieldId);
                    if ($field) {
                        $fields[] = $field;
                        Log::info('Field found:', ['id' => $field->id, 'name' => $field->field_name]);
                    } else {
                        Log::warning('Field not found:', ['field_id' => $fieldId]);
                    }
                }

                Log::info('Fields to process:', ['count' => count($fields)]);

                for ($i = 1; $i <= $max; $i++) {
                    $item = [];
                    $hasValue = false;

                    Log::info('Processing index:', ['index' => $i]);

                    foreach ($fields as $field) {
                        // Use section name with underscore for input matching
                        $inputName = "{$sectionNameForInput}_{$i}_{$field->field_name}";

                        Log::info('Checking input:', [
                            'input_name' => $inputName,
                            'has_file' => $request->hasFile($inputName),
                            'has_input' => $request->has($inputName),
                            'input_value' => $request->input($inputName)
                        ]);

                        if ($request->hasFile($inputName)) {
                            $file = $request->file($inputName);
                            $path = $file->store("registrations/{$form->id}/{$sectionName}", 'public');
                            $item[$field->field_name] = $path;
                            $hasValue = true;
                            Log::info('File processed:', ['field' => $field->field_name, 'path' => $path]);
                        } else {
                            $val = $request->input($inputName);
                            if (!is_null($val) && $val !== '') {
                                $item[$field->field_name] = $val;
                                $hasValue = true;
                                Log::info('Value processed:', ['field' => $field->field_name, 'value' => $val]);
                            }
                        }
                    }

                    Log::info('Item result:', [
                        'index' => $i,
                        'has_value' => $hasValue,
                        'item_data' => $item
                    ]);

                    if ($hasValue) {
                        $sectionData[] = $item;
                    }
                }

                Log::info('Section final data:', [
                    'section_name' => $sectionName,
                    'data_count' => count($sectionData),
                    'section_data' => $sectionData
                ]);

                if (!empty($sectionData)) {
                    $participantData[$sectionName] = $sectionData;
                }
            }
        }

        Log::info('=== FINAL PARTICIPANT DATA BEFORE SAVE ===', ['data' => $participantData]);

        // Save to database
        $data = EventRegistration::create([
            'registration_form_id' => $form->id,
            'participant_data' => $participantData,
            'status' => 'pending'
        ]);

        Log::info('=== REGISTRATION SAVED ===', ['id' => $data->id]);

        // Verify what was actually saved
        $savedData = EventRegistration::find($data->id);
        Log::info('=== VERIFICATION - DATA FROM DATABASE ===', ['saved_data' => $savedData->participant_data]);

        // Send confirmation email
        try {
            $email = $data->participant_data['name'] ?? null;
            if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Mail::to($email)->send(new ConfirmedRegistrationMail($data));
                Log::info('Confirmation email sent to: ' . $email);
            } else {
                Log::warning('Invalid email or email not found in participant data', ['email' => $email]);
            }
        } catch (\Exception $e) {
            Log::error('Failed to send confirmation email: ' . $e->getMessage());
            // Continue anyway, don't block registration
        }

        return redirect()->route('registrasi.upload_invoice', $data->id);
    }

    public function success()
    {
        return view('registration.success');
    }

    public function upload_invoice($id)
    {
        $data = EventRegistration::with(['registrationForm.event', 'dataApprovedBy'])
            ->whereId($id)
            ->first();

        if (!$data) {
            return view('registration.invoice_not_found');
        }

        // Check if data is approved
        if (!$data->data_approved) {
            return view('registration.waiting_approval', compact('data'));
        }

        return view('registration.upload_invoice', compact('data'));
    }

    public function store_bukti(Request $request, $id)
    {
        $request->validate([
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $data = EventRegistration::findOrFail($id);

        if (!$data->data_approved) {
            return back()->with('error', 'Data belum disetujui admin.');
        }

        $bukti = null;
        if ($request->file('bukti')) {
            $file = $request->file('bukti');
            $bukti = 'bukti-transfer-' . md5(mt_rand(10000, 99999)) . '.' . $file->getClientOriginalExtension();
            $request->file('bukti')->storeAs('public/bukti_transfer/', $bukti);
        }

        $data->update([
            'transfer_receipt' => $bukti,
            'status' => 'payment_pending'
        ]);

        return redirect()->route('registrasi.status', $data->id);
    }

    public function check_status($id)
    {
        $data = EventRegistration::with(['registrationForm.event', 'dataApprovedBy', 'paymentApprovedBy'])
            ->findOrFail($id);

        return view('registration.status', compact('data'));
    }

    public function streamInvoice($id)
    {
        $registration = EventRegistration::with(['registrationForm.event', 'dataApprovedBy'])
            ->findOrFail($id);

        // Check if data is approved and has invoice number
        if (!$registration->data_approved || !$registration->invoice_number) {
            abort(404, 'Invoice not found or data not approved yet.');
        }

        $data = [
            'registration' => $registration,
            'invoice_number' => $registration->invoice_number,
            'created_date' => $registration->data_approved_at,
            'amount' => 500000 // Default amount, bisa disesuaikan
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.invoices.template', $data);

        return $pdf->stream('invoice-' . $registration->invoice_number . '.pdf');
    }
}
