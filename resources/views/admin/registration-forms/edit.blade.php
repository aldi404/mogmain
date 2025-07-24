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
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">Form Fields</h5>
            </div>
            <div class="card-body">
                <p class="text-muted mb-3">Select fields to include in your registration form:</p>
                
                <div class="form-check-container" id="fieldContainer">
                    @foreach($formFields as $field)
                        @php
                            $isSelected = $registrationForm->formFields->contains('form_field_id', $field->id);
                            $fieldData = $registrationForm->formFields->where('form_field_id', $field->id)->first();
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
                                       {{ $isSelected ? 'checked' : '' }}>
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
                            
                            <div class="field-options mt-2" style="{{ $field->is_system_field || $isSelected ? 'display: block;' : 'display: none;' }}">
                                <div class="form-check">
                                    <input class="form-check-input required-checkbox" 
                                           type="checkbox" 
                                           name="field_required[]" 
                                           value="{{ $field->id }}" 
                                           id="req_{{ $field->id }}"
                                           data-field-id="{{ $field->id }}"
                                           form="registrationForm"
                                           {{ $field->is_system_field ? 'checked disabled' : '' }}
                                           {{ $fieldData && $fieldData->is_required ? 'checked' : '' }}>
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
                                           value="{{ old('custom_labels.' . $field->id, $fieldData ? $fieldData->custom_label : '') }}">
                                </div>
                                
                                <div class="mt-2">
                                    <input type="number" 
                                           class="form-control form-control-sm order-input" 
                                           name="field_order[{{ $field->id }}]" 
                                           placeholder="Order"
                                           data-field-id="{{ $field->id }}"
                                           form="registrationForm"
                                           value="{{ old('field_order.' . $field->id, $fieldData ? $fieldData->field_order : $loop->iteration) }}">
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
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Edit form loaded');
    
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
        
        // Check all selected fields (including disabled ones)
        const allSelectedFields = document.querySelectorAll('input[name="selected_fields[]"]:checked, input[name="selected_fields[]"][type="hidden"]');
        console.log('All selected fields count:', allSelectedFields.length);
        console.log('All selected field IDs:', Array.from(allSelectedFields).map(field => field.value));
        
        // Check only visible checkboxes
        const visibleSelectedFields = document.querySelectorAll('.field-checkbox:checked:not([disabled])');
        console.log('Visible selected fields count:', visibleSelectedFields.length);
        console.log('Visible selected field IDs:', Array.from(visibleSelectedFields).map(cb => cb.value));
        
        // Check required fields
        const allRequiredFields = document.querySelectorAll('input[name="field_required[]"]:checked, input[name="field_required[]"][type="hidden"]');
        console.log('All required fields count:', allRequiredFields.length);
        console.log('All required field IDs:', Array.from(allRequiredFields).map(field => field.value));
        
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
        const formData = new FormData(this);
        console.log('=== Complete form data ===');
        for (let [key, value] of formData.entries()) {
            console.log(key + ':', value);
        }
        console.log('=== Form submission debug complete ===');
    });
    
    // Add debug button for testing
    // const debugBtn = document.createElement('button');
    // debugBtn.type = 'button';
    // debugBtn.className = 'btn btn-info btn-sm mt-2';
    // debugBtn.innerHTML = '<i class="fas fa-bug"></i> Debug Selected Fields';
    // debugBtn.onclick = function() {
    //     const allSelected = document.querySelectorAll('input[name="selected_fields[]"]:checked, input[name="selected_fields[]"][type="hidden"]');
    //     console.log('Debug - All selected fields:', Array.from(allSelected).map(field => ({
    //         value: field.value,
    //         type: field.type,
    //         disabled: field.disabled,
    //         checked: field.checked
    //     })));
    // };
    document.querySelector('.card-body .form-check-container').appendChild(debugBtn);
});
</script>
@endpush
