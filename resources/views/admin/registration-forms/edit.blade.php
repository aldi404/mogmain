@extends('admin.layouts.app')

@section('title', 'Edit Registration Form')
@section('page-title', 'Edit Registration Form')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">Edit Form Information</h5>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.registration-forms.update', $registrationForm) }}" method="POST" id="registrationForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="event_id" class="form-label">Event <span class="text-danger">*</span></label>
                        <select class="form-select @error('event_id') is-invalid @enderror" 
                                id="event_id" name="event_id" required>
                            <option value="">Select Event</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}" 
                                        {{ old('event_id', $registrationForm->event_id) == $event->id ? 'selected' : '' }}>
                                    {{ $event->title }} - {{ $event->event_date->format('M d, Y') }}
                                </option>
                            @endforeach
                        </select>
                        @error('event_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="form_title" class="form-label">Form Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('form_title') is-invalid @enderror" 
                               id="form_title" name="form_title" value="{{ old('form_title', $registrationForm->form_title) }}" required>
                        @error('form_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="form_description" class="form-label">Form Description</label>
                        <textarea class="form-control @error('form_description') is-invalid @enderror" 
                                  id="form_description" name="form_description" rows="3">{{ old('form_description', $registrationForm->form_description) }}</textarea>
                        @error('form_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="registration_start" class="form-label">Registration Start <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control @error('registration_start') is-invalid @enderror" 
                                   id="registration_start" name="registration_start" 
                                   value="{{ old('registration_start', $registrationForm->registration_start->format('Y-m-d\TH:i')) }}" required>
                            @error('registration_start')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="registration_end" class="form-label">Registration End <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control @error('registration_end') is-invalid @enderror" 
                                   id="registration_end" name="registration_end" 
                                   value="{{ old('registration_end', $registrationForm->registration_end->format('Y-m-d\TH:i')) }}" required>
                            @error('registration_end')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Repeatable Section Configuration -->
                    <div class="repeatable-config mb-4 p-3 border rounded bg-light">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-copy"></i> Repeatable Section
                        </h6>
                        
                        @php
                            $hasRepeatable = $registrationForm->hasRepeatableSection();
                            $currentSection = $hasRepeatable ? $registrationForm->getRepeatableSections()[0] : null;
                            $repeatableFieldIds = $hasRepeatable && isset($currentSection['fields']) ? $currentSection['fields'] : [];
                            
                            // Debug output
                            if (config('app.debug')) {
                                \Log::info('Edit form debug:', [
                                    'hasRepeatable' => $hasRepeatable,
                                    'currentSection' => $currentSection,
                                    'repeatableFieldIds' => $repeatableFieldIds,
                                    'registrationForm_id' => $registrationForm->id
                                ]);
                            }
                        @endphp
                        
                        @if(config('app.debug'))
                            <div class="alert alert-warning mb-3">
                                <strong>Debug Info:</strong><br>
                                Has Repeatable: {{ $hasRepeatable ? 'Yes' : 'No' }}<br>
                                @if($hasRepeatable)
                                    Section Name: {{ $currentSection['name'] ?? 'N/A' }}<br>
                                    Section Fields: {{ implode(', ', $repeatableFieldIds) }}<br>
                                @endif
                                Raw Config: {{ json_encode($registrationForm->repeatable_config) }}
                            </div>
                        @endif
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="enable_repeatable" name="enable_repeatable" {{ $hasRepeatable ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="enable_repeatable">
                                Enable Repeatable Section
                            </label>
                        </div>
                        
                        <div id="repeatable_settings" style="{{ $hasRepeatable ? 'display: block;' : 'display: none;' }}">
                            <div class="mb-2">
                                <label class="form-label">Section Name</label>
                                <input type="text" class="form-control form-control-sm" name="repeatable_section_name" 
                                       placeholder="e.g., pemain, peserta" value="{{ $currentSection['name'] ?? '' }}">
                            </div>
                            
                            <div class="mb-2">
                                <label class="form-label">Section Label</label>
                                <input type="text" class="form-control form-control-sm" name="repeatable_section_label" 
                                       placeholder="e.g., Data Pemain" value="{{ $currentSection['label'] ?? '' }}">
                            </div>
                            
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Min Count</label>
                                    <input type="number" class="form-control form-control-sm" name="repeatable_min_count" 
                                           value="{{ $currentSection['min_count'] ?? 1 }}" min="1">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Max Count</label>
                                    <input type="number" class="form-control form-control-sm" name="repeatable_max_count" 
                                           value="{{ $currentSection['max_count'] ?? 12 }}" min="1">
                                </div>
                            </div>
                            
                            <small class="text-muted">Fields selected below will be repeated for each item in this section.</small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.registration-forms.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i> Update Form
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="mb-0">Regular Form Fields</h5>
            </div>
            <div class="card-body">
                <p class="text-muted mb-3">Select fields for general information:</p>
                
                <div class="form-check-container" id="fieldContainer">
                    @foreach($formFields as $field)
                        @php
                            $isSelected = $registrationForm->formFields->contains('form_field_id', $field->id);
                            $fieldData = $registrationForm->formFields->where('form_field_id', $field->id)->first();
                            $isInRepeatable = $hasRepeatable && in_array((int)$field->id, array_map('intval', $repeatableFieldIds));
                        @endphp
                        
                        <div class="field-item mb-3 p-3 border rounded {{ $field->is_system_field ? 'bg-light' : '' }}" data-field-id="{{ $field->id }}">
                            <div class="form-check">
                                <input class="form-check-input field-checkbox" 
                                       type="checkbox" 
                                       name="selected_fields[]" 
                                       value="{{ $field->id }}" 
                                       id="field_{{ $field->id }}"
                                       data-field-id="{{ $field->id }}"
                                       form="registrationForm"
                                       {{ $field->is_system_field ? 'checked disabled' : '' }}
                                       {{ ($isSelected && !$isInRepeatable) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="field_{{ $field->id }}">
                                    {{ $field->field_label }}
                                    @if($field->is_system_field)
                                        <span class="badge bg-primary ms-1">Required</span>
                                    @endif
                                </label>
                            </div>
                            
                            <small class="text-muted d-block mt-1">
                                Type: {{ ucfirst($field->field_type) }}
                            </small>
                            
                            <div class="field-options mt-2" style="{{ ($field->is_system_field || ($isSelected && !$isInRepeatable)) ? 'display: block;' : 'display: none;' }}">
                                <div class="form-check">
                                    <input class="form-check-input required-checkbox" 
                                           type="checkbox" 
                                           name="field_required[]" 
                                           value="{{ $field->id }}" 
                                           id="req_{{ $field->id }}"
                                           data-field-id="{{ $field->id }}"
                                           form="registrationForm"
                                           {{ $field->is_system_field ? 'checked disabled' : '' }}
                                           {{ ($fieldData && $fieldData->is_required && !$isInRepeatable) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="req_{{ $field->id }}">
                                        Required field
                                    </label>
                                </div>
                                
                                <div class="mt-2">
                                    <input type="text" 
                                           class="form-control form-control-sm custom-label-input" 
                                           name="custom_labels[{{ $field->id }}]" 
                                           placeholder="Custom label (optional)"
                                           data-field-id="{{ $field->id }}"
                                           form="registrationForm"
                                           value="{{ old('custom_labels.' . $field->id, ($fieldData && !$isInRepeatable) ? $fieldData->custom_label : '') }}">
                                </div>
                                
                                <div class="mt-2">
                                    <input type="number" 
                                           class="form-control form-control-sm order-input" 
                                           name="field_order[{{ $field->id }}]" 
                                           placeholder="Order"
                                           data-field-id="{{ $field->id }}"
                                           form="registrationForm"
                                           value="{{ old('field_order.' . $field->id, ($fieldData && !$isInRepeatable) ? $fieldData->field_order : $loop->iteration) }}">
                                </div>
                            </div>
                            
                            @if($field->is_system_field)
                                <!-- Hidden inputs for system fields that are always included -->
                                <input type="hidden" name="selected_fields[]" value="{{ $field->id }}" form="registrationForm">
                                <input type="hidden" name="field_required[]" value="{{ $field->id }}" form="registrationForm">
                                <input type="hidden" name="field_order[{{ $field->id }}]" value="{{ $loop->iteration }}" form="registrationForm">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Repeatable Section Fields -->
        <div class="card shadow" id="repeatableFieldsCard" style="{{ $hasRepeatable ? 'display: block;' : 'display: none;' }}">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Repeatable Section Fields</h5>
            </div>
            <div class="card-body">
                <p class="text-muted mb-3">Select fields to be repeated for each item:</p>
                
                <div class="repeatable-fields-container">
                    @foreach($formFields->where('is_system_field', false) as $field)
                        <div class="field-item mb-3 p-3 border rounded" data-field-id="{{ $field->id }}">
                            <div class="form-check">
                                <input class="form-check-input repeatable-field-checkbox" 
                                       type="checkbox" 
                                       name="repeatable_fields[]" 
                                       value="{{ $field->id }}" 
                                       id="rep_field_{{ $field->id }}"
                                       form="registrationForm"
                                       {{ !$hasRepeatable ? 'disabled' : '' }}
                                       {{ $hasRepeatable && in_array((int)$field->id, array_map('intval', $repeatableFieldIds)) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="rep_field_{{ $field->id }}">
                                    {{ $field->field_label }}
                                </label>
                            </div>
                            
                            <small class="text-muted d-block mt-1">
                                Type: {{ ucfirst($field->field_type) }}
                            </small>
                        </div>
                    @endforeach
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <strong>Note:</strong> Fields selected here will be automatically required in the repeatable section.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Edit form loaded');
    
    // Toggle repeatable section settings
    const enableRepeatable = document.getElementById('enable_repeatable');
    const repeatableSettings = document.getElementById('repeatable_settings');
    const repeatableFieldsCard = document.getElementById('repeatableFieldsCard');
    
    enableRepeatable.addEventListener('change', function() {
        const repeatableFieldCheckboxes = document.querySelectorAll('.repeatable-field-checkbox');
        
        if (this.checked) {
            repeatableSettings.style.display = 'block';
            repeatableFieldsCard.style.display = 'block';
            // Enable repeatable field checkboxes
            repeatableFieldCheckboxes.forEach(checkbox => {
                checkbox.disabled = false;
            });
        } else {
            repeatableSettings.style.display = 'none';
            repeatableFieldsCard.style.display = 'none';
            // Disable and uncheck repeatable field checkboxes
            repeatableFieldCheckboxes.forEach(checkbox => {
                checkbox.disabled = true;
                checkbox.checked = false;
            });
        }
    });
    
    // Show current selected fields
    const currentSelectedFields = document.querySelectorAll('.field-checkbox:checked');
    console.log('Currently selected fields:', Array.from(currentSelectedFields).map(cb => cb.value));
    
    // Show/hide field options when checkbox is checked
    const fieldCheckboxes = document.querySelectorAll('.field-checkbox:not([disabled])');
    
    fieldCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const fieldId = this.getAttribute('data-field-id');
            console.log('Field checkbox changed:', fieldId, this.checked);
            
            const fieldItem = this.closest('.field-item');
            const fieldOptions = fieldItem.querySelector('.field-options');
            
            if (this.checked) {
                fieldOptions.style.display = 'block';
            } else {
                fieldOptions.style.display = 'none';
                // Clear the required checkbox when field is unchecked
                const requiredCheckbox = fieldOptions.querySelector('.required-checkbox');
                if (requiredCheckbox && !requiredCheckbox.disabled) {
                    requiredCheckbox.checked = false;
                }
            }
        });
        
        // Show options for initially checked fields
        if (checkbox.checked) {
            const fieldItem = checkbox.closest('.field-item');
            const fieldOptions = fieldItem.querySelector('.field-options');
            if (fieldOptions) {
                fieldOptions.style.display = 'block';
            }
        }
    });

    // Form submission with detailed debugging
    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        console.log('=== Form submission started ===');
        
        // Debug repeatable section data
        const enableRepeatableChecked = document.getElementById('enable_repeatable').checked;
        const selectedRepeatableFields = document.querySelectorAll('.repeatable-field-checkbox:checked:not([disabled])');
        const repeatableSectionName = document.querySelector('input[name="repeatable_section_name"]').value;
        
        console.log('Enable repeatable:', enableRepeatableChecked);
        console.log('Repeatable section name:', repeatableSectionName);
        console.log('Selected repeatable fields count:', selectedRepeatableFields.length);
        console.log('Selected repeatable field IDs:', Array.from(selectedRepeatableFields).map(cb => cb.value));
        
        // IMPORTANT: Check if checkboxes are actually part of the form
        const formData = new FormData(this);
        const repeatableFieldsFromForm = formData.getAll('repeatable_fields[]');
        console.log('Repeatable fields from FormData:', repeatableFieldsFromForm);
        
        // Check if repeatable section is properly configured
        if (enableRepeatableChecked) {
            if (!repeatableSectionName) {
                alert('Please enter a section name for the repeatable section');
                e.preventDefault();
                return false;
            }
            if (selectedRepeatableFields.length === 0) {
                alert('Please select at least one field for the repeatable section');
                e.preventDefault();
                return false;
            }
        }
        
        // Check all selected fields (including disabled ones)
        const allSelectedFields = document.querySelectorAll('input[name="selected_fields[]"]:checked, input[name="selected_fields[]"][type="hidden"]');
        console.log('All selected fields count:', allSelectedFields.length);
        console.log('All selected field IDs:', Array.from(allSelectedFields).map(field => field.value));
        
        // Check if we have at least system fields
        if (allSelectedFields.length === 0) {
            e.preventDefault();
            alert('Please select at least one form field');
            return false;
        }

        // Show loading state
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
        
        // Debug: Log complete form data
        console.log('=== Complete form data ===');
        for (let [key, value] of formData.entries()) {
            console.log(key + ':', value);
        }
        console.log('=== Form submission debug complete ===');
    });
});
</script>
@endpush