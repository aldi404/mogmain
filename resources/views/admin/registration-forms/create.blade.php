@extends('admin.layouts.app')

@section('title', 'Create Registration Form')
@section('page-title', 'Create Registration Form')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">Form Information</h5>
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

                <form action="{{ route('admin.registration-forms.store') }}" method="POST" id="registrationForm">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="event_id" class="form-label">Event <span class="text-danger">*</span></label>
                        <select class="form-select @error('event_id') is-invalid @enderror" 
                                id="event_id" name="event_id" required>
                            <option value="">Select Event</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}" 
                                        {{ old('event_id', $selectedEventId) == $event->id ? 'selected' : '' }}>
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
                               id="form_title" name="form_title" value="{{ old('form_title') }}" required>
                        @error('form_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="form_description" class="form-label">Form Description</label>
                        <textarea class="form-control @error('form_description') is-invalid @enderror" 
                                  id="form_description" name="form_description" rows="3">{{ old('form_description') }}</textarea>
                        @error('form_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="registration_start" class="form-label">Registration Start <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control @error('registration_start') is-invalid @enderror" 
                                   id="registration_start" name="registration_start" value="{{ old('registration_start') }}" required>
                            @error('registration_start')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="registration_end" class="form-label">Registration End <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control @error('registration_end') is-invalid @enderror" 
                                   id="registration_end" name="registration_end" value="{{ old('registration_end') }}" required>
                            @error('registration_end')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Hidden inputs for system fields -->
                    @foreach($formFields->where('is_system_field', true) as $field)
                        <input type="hidden" name="selected_fields[]" value="{{ $field->id }}">
                        <input type="hidden" name="field_required[]" value="{{ $field->id }}">
                        <input type="hidden" name="field_order[{{ $field->id }}]" value="{{ $loop->iteration }}">
                    @endforeach
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.registration-forms.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i> Create Form
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">Form Fields</h5>
            </div>
            <div class="card-body">
                <p class="text-muted mb-3">Select fields to include in your registration form:</p>
                
                <!-- Repeatable Section Configuration -->
                <div class="repeatable-config mb-4 p-3 border rounded bg-light">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-copy"></i> Repeatable Section
                    </h6>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="enable_repeatable" name="enable_repeatable">
                        <label class="form-check-label fw-bold" for="enable_repeatable">
                            Enable Repeatable Section
                        </label>
                    </div>
                    
                    <div id="repeatable_settings" style="display: none;">
                        <div class="mb-2">
                            <label class="form-label">Section Name</label>
                            <input type="text" class="form-control form-control-sm" name="repeatable_section_name" placeholder="e.g., pemain, peserta">
                        </div>
                        
                        <div class="mb-2">
                            <label class="form-label">Section Label</label>
                            <input type="text" class="form-control form-control-sm" name="repeatable_section_label" placeholder="e.g., Data Pemain">
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">Min Count</label>
                                <input type="number" class="form-control form-control-sm" name="repeatable_min_count" value="1" min="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Max Count</label>
                                <input type="number" class="form-control form-control-sm" name="repeatable_max_count" value="12" min="1">
                            </div>
                        </div>
                        
                        <small class="text-muted">Fields selected below will be repeated for each item in this section.</small>
                    </div>
                </div>
                
                <div class="form-check-container">
                    @foreach($formFields as $field)
                    <div class="field-item mb-3 p-3 border rounded {{ $field->is_system_field ? 'bg-light' : '' }}">
                        <div class="form-check">
                            <input class="form-check-input field-checkbox" type="checkbox" name="selected_fields[]" 
                                   value="{{ $field->id }}" id="field_{{ $field->id }}"
                                   {{ $field->is_system_field ? 'checked disabled' : '' }}
                                   {{ in_array($field->id, old('selected_fields', [])) ? 'checked' : '' }}>
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
                        
                        <div class="field-options mt-2" style="display: none;">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="field_required[]" 
                                       value="{{ $field->id }}" id="req_{{ $field->id }}"
                                       {{ $field->is_system_field ? 'checked disabled' : '' }}>
                                <label class="form-check-label" for="req_{{ $field->id }}">
                                    Required field
                                </label>
                            </div>
                            
                            <div class="form-check mt-2">
                                <input class="form-check-input repeatable-field-checkbox" type="checkbox" 
                                       name="repeatable_fields[]" value="{{ $field->id }}" 
                                       id="rep_{{ $field->id }}" disabled>
                                <label class="form-check-label" for="rep_{{ $field->id }}">
                                    <small class="text-info">Include in repeatable section</small>
                                </label>
                            </div>
                            
                            <div class="mt-2">
                                <input type="text" class="form-control form-control-sm" 
                                       name="custom_labels[{{ $field->id }}]" 
                                       placeholder="Custom label (optional)"
                                       value="{{ old('custom_labels.' . $field->id) }}">
                            </div>
                            
                            <div class="mt-2">
                                <input type="number" class="form-control form-control-sm" 
                                       name="field_order[{{ $field->id }}]" 
                                       placeholder="Order"
                                       value="{{ old('field_order.' . $field->id, $loop->iteration) }}">
                            </div>
                        </div>
                    </div>
                    
                    @if($field->is_system_field)
                        <input type="hidden" name="selected_fields[]" value="{{ $field->id }}">
                        <input type="hidden" name="field_required[]" value="{{ $field->id }}">
                        <input type="hidden" name="field_order[{{ $field->id }}]" value="{{ $loop->iteration }}">
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Create form loaded');
    
    // Toggle repeatable section settings
    const enableRepeatable = document.getElementById('enable_repeatable');
    const repeatableSettings = document.getElementById('repeatable_settings');
    const repeatableFieldCheckboxes = document.querySelectorAll('.repeatable-field-checkbox');
    
    enableRepeatable.addEventListener('change', function() {
        console.log('Enable repeatable changed:', this.checked);
        if (this.checked) {
            repeatableSettings.style.display = 'block';
            // Enable repeatable field checkboxes
            repeatableFieldCheckboxes.forEach(checkbox => {
                checkbox.disabled = false;
            });
        } else {
            repeatableSettings.style.display = 'none';
            // Disable and uncheck repeatable field checkboxes
            repeatableFieldCheckboxes.forEach(checkbox => {
                checkbox.disabled = true;
                checkbox.checked = false;
            });
        }
    });
    
    // Show/hide field options when checkbox is checked
    const fieldCheckboxes = document.querySelectorAll('.field-checkbox:not([disabled])');
    
    fieldCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const fieldId = this.getAttribute('data-field-id') || this.value;
            const fieldItem = this.closest('.field-item');
            const fieldOptions = fieldItem.querySelector('.field-options');
            
            if (this.checked) {
                fieldOptions.style.display = 'block';
            } else {
                fieldOptions.style.display = 'none';
                // Clear the required checkbox when field is unchecked
                const requiredCheckbox = fieldOptions.querySelector('input[name="field_required[]"]');
                if (requiredCheckbox && !requiredCheckbox.disabled) {
                    requiredCheckbox.checked = false;
                }
                // Clear repeatable checkbox
                const repeatableCheckbox = fieldOptions.querySelector('.repeatable-field-checkbox');
                if (repeatableCheckbox) {
                    repeatableCheckbox.checked = false;
                }
            }
        });
        
        // Show options for initially checked fields
        if (checkbox.checked) {
            const fieldItem = checkbox.closest('.field-item');
            const fieldOptions = fieldItem.querySelector('.field-options');
            fieldOptions.style.display = 'block';
        }
    });

    // Form submission
    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        console.log('=== Create Form submission started ===');
        
        // Debug repeatable section data
        const enableRepeatableChecked = document.getElementById('enable_repeatable').checked;
        const selectedRepeatableFields = document.querySelectorAll('.repeatable-field-checkbox:checked');
        
        console.log('Enable repeatable:', enableRepeatableChecked);
        console.log('Selected repeatable fields:', Array.from(selectedRepeatableFields).map(cb => cb.value));
        
        const selectedFields = document.querySelectorAll('input[name="selected_fields[]"]:checked');
        
        if (selectedFields.length === 0) {
            e.preventDefault();
            alert('Please select at least one form field');
            return false;
        }

        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating...';
        
        // Debug: Log form data
        const formData = new FormData(this);
        console.log('=== Form data ===');
        for (let [key, value] of formData.entries()) {
            console.log(key + ':', value);
        }
    });
});
</script>
@endpush
