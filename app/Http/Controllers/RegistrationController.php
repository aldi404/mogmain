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

        // Build validation rules dynamically
        $rules = [];
        $participantData = [];

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

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

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

        $data = EventRegistration::create([
            'registration_form_id' => $form->id,
            'participant_data' => $participantData,
            'status' => 'pending'
        ]);

        return redirect()->route('registrasi.upload_invoice', $data->id);
        // return redirect()->route('registrasi.success');
    }

    public function success()
    {
        return view('registration.success');
    }

    public function upload_invoice($id)
    {
        $data = EventRegistration::whereId($id)
            // ->whereNotNull('invoice')
            ->first();

        if ($data) {
            return view('registration.upload_invoice', compact('data'));
        } else {
            return view('registration.invoice_not_found');
        }
    }

    public function store_bukti(Request $request, $id)
    {
        $bukti = null;
        if ($request->file('bukti')) {
            $file = $request->file('bukti');
            $bukti = 'bukti-transfer-' . md5(mt_rand(10000, 99999)) . '.' . $file->getClientOriginalExtension();
            $request->file('bukti')->storeAs('public/bukti_transfer/', $bukti);
        }

        $data = EventRegistration::whereId($id)
            ->update([
                'approved' => 0,
                'transfer_receipt' => $bukti,
            ]);

        return redirect()->route('registrasi.success_store');
    }

    public function success_store()
    {
        return view('registration.success_store');
    }
}
