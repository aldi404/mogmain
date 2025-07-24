<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\FormField;
use App\Models\RegistrationForm;
use App\Models\RegistrationFormField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegistrationFormController extends Controller
{
    public function index()
    {
        $forms = RegistrationForm::with('event')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.registration-forms.index', compact('forms'));
    }

    public function create(Request $request)
    {
        $events = Event::where('status', '!=', 'cancelled')->get();
        $formFields = FormField::orderBy('is_system_field', 'desc')->orderBy('field_label')->get();
        $selectedEventId = $request->get('event_id');

        return view('admin.registration-forms.create', compact('events', 'formFields', 'selectedEventId'));
    }

    public function store(Request $request)
    {
        try {
            // Add logging for debugging
            Log::info('Registration form store request:', $request->all());

            $request->validate([
                'event_id' => 'required|exists:events,id',
                'form_title' => 'required|string|max:255',
                'form_description' => 'nullable|string',
                'registration_start' => 'required|date',
                'registration_end' => 'required|date|after:registration_start',
                'selected_fields' => 'required|array|min:1',
                'selected_fields.*' => 'exists:form_fields,id',
                'field_required' => 'nullable|array',
                'field_order' => 'nullable|array',
                'custom_labels' => 'nullable|array'
            ]);

            DB::transaction(function () use ($request) {
                // Create registration form
                $form = RegistrationForm::create([
                    'event_id' => $request->event_id,
                    'form_title' => $request->form_title,
                    'form_description' => $request->form_description,
                    'registration_start' => $request->registration_start,
                    'registration_end' => $request->registration_end,
                    'is_active' => true
                ]);

                Log::info('Created registration form:', ['form_id' => $form->id]);

                // Add selected fields
                foreach ($request->selected_fields as $index => $fieldId) {
                    $formField = RegistrationFormField::create([
                        'registration_form_id' => $form->id,
                        'form_field_id' => $fieldId,
                        'is_required' => in_array($fieldId, $request->field_required ?? []),
                        'field_order' => $request->field_order[$fieldId] ?? $index + 1,
                        'custom_label' => $request->custom_labels[$fieldId] ?? null
                    ]);

                    Log::info('Created form field:', ['form_field_id' => $formField->id]);
                }
            });

            return redirect()->route('admin.registration-forms.index')
                ->with('success', 'Form registrasi berhasil dibuat!');
        } catch (\Exception $e) {
            Log::error('Error creating registration form:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'request' => $request->all()
            ]);

            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function show(RegistrationForm $registrationForm)
    {
        $registrationForm->load(['event', 'formFields.formField', 'registrations']);
        return view('admin.registration-forms.show', compact('registrationForm'));
    }

    public function edit(RegistrationForm $registrationForm)
    {
        $events = Event::where('status', '!=', 'cancelled')->get();
        $formFields = FormField::orderBy('is_system_field', 'desc')->orderBy('field_label')->get();
        $registrationForm->load('formFields.formField');

        return view('admin.registration-forms.edit', compact('registrationForm', 'events', 'formFields'));
    }

    public function update(Request $request, RegistrationForm $registrationForm)
    {
        try {
            // Add logging for debugging
            Log::info('Registration form update request:', $request->all());

            $request->validate([
                'event_id' => 'required|exists:events,id',
                'form_title' => 'required|string|max:255',
                'form_description' => 'nullable|string',
                'registration_start' => 'required|date',
                'registration_end' => 'required|date|after:registration_start',
                'selected_fields' => 'required|array|min:1',
                'selected_fields.*' => 'exists:form_fields,id',
                'field_required' => 'nullable|array',
                'field_order' => 'nullable|array',
                'custom_labels' => 'nullable|array'
            ]);

            DB::transaction(function () use ($request, $registrationForm) {
                // Update registration form
                $registrationForm->update([
                    'event_id' => $request->event_id,
                    'form_title' => $request->form_title,
                    'form_description' => $request->form_description,
                    'registration_start' => $request->registration_start,
                    'registration_end' => $request->registration_end
                ]);

                Log::info('Updated registration form:', ['form_id' => $registrationForm->id]);

                // Delete existing form fields
                $registrationForm->formFields()->delete();
                Log::info('Deleted existing form fields');

                // Add selected fields
                foreach ($request->selected_fields as $index => $fieldId) {
                    $formField = RegistrationFormField::create([
                        'registration_form_id' => $registrationForm->id,
                        'form_field_id' => $fieldId,
                        'is_required' => in_array($fieldId, $request->field_required ?? []),
                        'field_order' => $request->field_order[$fieldId] ?? $index + 1,
                        'custom_label' => $request->custom_labels[$fieldId] ?? null
                    ]);

                    Log::info('Created form field:', [
                        'form_field_id' => $formField->id,
                        'field_id' => $fieldId,
                        'is_required' => in_array($fieldId, $request->field_required ?? []),
                        'field_order' => $request->field_order[$fieldId] ?? $index + 1
                    ]);
                }
            });

            return redirect()->route('admin.registration-forms.index')
                ->with('success', 'Form registrasi berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Error updating registration form:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'request' => $request->all()
            ]);

            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(RegistrationForm $registrationForm)
    {
        $registrationForm->delete();
        return redirect()->route('admin.registration-forms.index')->with('success', 'Form registrasi berhasil dihapus!');
    }

    public function toggleStatus(RegistrationForm $registrationForm)
    {
        $registrationForm->update(['is_active' => !$registrationForm->is_active]);

        $status = $registrationForm->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Form registrasi berhasil {$status}!");
    }
}
