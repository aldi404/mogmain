@extends('user.layouts.app')

@section('title', 'Registration Form - ' . $form->event->title)

@section('content')
<div class="container py-5" style="padding-top: 20px !important;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if($form->event->banner_image)
                <div class="event-banner mb-4">
                    <img src="{{ Storage::url($form->event->banner_image) }}" 
                         alt="{{ $form->event->title }}" 
                         class="img-fluid rounded shadow-lg"
                         style="width: 100%; height: 250px; object-fit: cover;">
                </div>
            @endif
            
            <div class="card shadow-lg border-0" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1">{{ $form->form_title }}</h4>
                            <p class="mb-0 opacity-75">{{ $form->event->title }}</p>
                        </div>
                        <div class="text-end">
                            <small>{{ $form->event->event_date->format('M d, Y') }}</small>
                            <br>
                            <small>{{ $form->event->location }}</small>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($form->form_description)
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            {{ $form->form_description }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Please correct the following errors:</h6>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('registrasi.store', $form) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Regular Form Fields -->
                        @if($form->formFields->count() > 0)
                            <div class="section-header">
                                <h5><i class="fas fa-info-circle"></i> Informasi Umum</h5>
                            </div>
                            
                            @foreach($form->formFields as $formField)
                                @php
                                    $field = $formField->formField;
                                    $fieldName = $field->field_name;
                                    $fieldLabel = $formField->getDisplayLabel();
                                    $isRequired = $formField->is_required;
                                    
                                    // Override label for name field (phone number)
                                    if ($fieldName === 'name') {
                                        $fieldLabel = 'Nomor WhatsApp/HP';
                                    }
                                @endphp
                                
                                <div class="mb-3">
                                    <label for="{{ $fieldName }}" class="form-label">
                                        {{ $fieldLabel }}
                                        @if($isRequired)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>
                                    
                                    @if($fieldName === 'name')
                                        <!-- Special handling for phone number field -->
                                        <input type="tel" 
                                               class="form-control @error($fieldName) is-invalid @enderror" 
                                               id="{{ $fieldName }}" 
                                               name="{{ $fieldName }}" 
                                               value="{{ old($fieldName) }}"
                                               placeholder="08123456789 atau 628123456789"
                                               pattern="[0-9]{8,14}"
                                               minlength="8"
                                               maxlength="14"
                                               {{ $isRequired ? 'required' : '' }}>
                                        <small class="form-text text-muted">
                                            Masukkan nomor HP/WhatsApp aktif (8-14 digit). Contoh: 08123456789 atau 628123456789
                                        </small>
                                    @else
                                        @switch($field->field_type)
                                            @case('text')
                                            @case('email')
                                            @case('tel')
                                                <input type="{{ $field->field_type }}" 
                                                       class="form-control @error($fieldName) is-invalid @enderror" 
                                                       id="{{ $fieldName }}" 
                                                       name="{{ $fieldName }}" 
                                                       value="{{ old($fieldName) }}"
                                                       {{ $isRequired ? 'required' : '' }}>
                                                @break
                                            
                                            @case('textarea')
                                                <textarea class="form-control @error($fieldName) is-invalid @enderror" 
                                                          id="{{ $fieldName }}" 
                                                          name="{{ $fieldName }}" 
                                                          rows="3"
                                                          {{ $isRequired ? 'required' : '' }}>{{ old($fieldName) }}</textarea>
                                                @break
                                            
                                            @case('date')
                                                <input type="date" 
                                                       class="form-control @error($fieldName) is-invalid @enderror" 
                                                       id="{{ $fieldName }}" 
                                                       name="{{ $fieldName }}" 
                                                       value="{{ old($fieldName) }}"
                                                       {{ $isRequired ? 'required' : '' }}>
                                                @break
                                            
                                            @case('number')
                                                <input type="number" 
                                                       class="form-control @error($fieldName) is-invalid @enderror" 
                                                       id="{{ $fieldName }}" 
                                                       name="{{ $fieldName }}" 
                                                       value="{{ old($fieldName) }}"
                                                       {{ $isRequired ? 'required' : '' }}>
                                                @break
                                            
                                            @case('select')
                                                <select class="form-select @error($fieldName) is-invalid @enderror" 
                                                        id="{{ $fieldName }}" 
                                                        name="{{ $fieldName }}"
                                                        {{ $isRequired ? 'required' : '' }}>
                                                    <option value="">Select {{ $fieldLabel }}</option>
                                                    @if($field->field_options)
                                                        @foreach($field->field_options as $option)
                                                            <option value="{{ $option }}" {{ old($fieldName) === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @break
                                            
                                            @case('file')
                                                <input type="file" 
                                                       class="form-control @error($fieldName) is-invalid @enderror" 
                                                       id="{{ $fieldName }}" 
                                                       name="{{ $fieldName }}"
                                                       {{ $isRequired ? 'required' : '' }}>
                                                @if($field->validation_rules && isset($field->validation_rules['mimes']))
                                                    <small class="form-text text-muted">
                                                        Allowed formats: {{ $field->validation_rules['mimes'] }}
                                                        @if(isset($field->validation_rules['max']))
                                                            (Max: {{ $field->validation_rules['max'] }}KB)
                                                        @endif
                                                    </small>
                                                @endif
                                                @break
                                        @endswitch
                                    @endif
                                    
                                    @error($fieldName)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        @endif
                        
                        <!-- Repeatable Sections -->
                        @if($form->hasRepeatableSection())
                            @foreach($form->getRepeatableSections() as $section)
                                <div class="section-header">
                                    <h5><i class="fas fa-users"></i> {{ $section['label'] }}</h5>
                                    <small class="text-muted">
                                        Minimum: {{ $section['min_count'] }} | Maximum: {{ $section['max_count'] }}
                                    </small>
                                </div>
                                
                                <div class="repeatable-section" data-section="{{ $section['name'] }}">
                                    @for($i = 1; $i <= $section['max_count']; $i++)
                                        <div class="repeat-item {{ $i > $section['min_count'] ? 'optional-item' : '' }}" data-index="{{ $i }}" style="{{ $i <= $section['min_count'] ? 'display: block;' : 'display: none;' }}">
                                            <div class="item-header">
                                                <h6>{{ $section['label'] }} {{ $i }}</h6>
                                                @if($i > $section['min_count'])
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-item">
                                                        <i class="fas fa-times"></i> Remove
                                                    </button>
                                                @endif
                                            </div>
                                            
                                            <div class="row">
                                                @foreach($section['fields'] as $fieldId)
                                                    @php
                                                        $field = \App\Models\FormField::find($fieldId);
                                                        if (!$field) continue;
                                                        // PENTING: gunakan format name="pemain_1_nama" (underscore)
                                                        $fieldName = "{$section['name']}_{$i}_{$field->field_name}";
                                                        $isOptional = $i > $section['min_count'];
                                                    @endphp
                                                    <div class="col-md-6 mb-3">
                                                        <label for="{{ $fieldName }}" class="form-label">
                                                            {{ $field->field_label }} <span class="text-danger">*</span>
                                                        </label>
                                                        @switch($field->field_type)
                                                            @case('text')
                                                            @case('email')
                                                            @case('tel')
                                                                <input type="{{ $field->field_type }}" 
                                                                       class="form-control @error($fieldName) is-invalid @enderror" 
                                                                       id="{{ $fieldName }}" 
                                                                       name="{{ $fieldName }}" 
                                                                       value="{{ old($fieldName) }}"
                                                                       {{ $isOptional ? 'disabled' : '' }}
                                                                       required>
                                                                @break
                                                            @case('number')
                                                                <input type="number" 
                                                                       class="form-control @error($fieldName) is-invalid @enderror" 
                                                                       id="{{ $fieldName }}" 
                                                                       name="{{ $fieldName }}" 
                                                                       value="{{ old($fieldName) }}"
                                                                       {{ $isOptional ? 'disabled' : '' }}
                                                                       required>
                                                                @break
                                                            @case('select')
                                                                <select class="form-select @error($fieldName) is-invalid @enderror" 
                                                                        id="{{ $fieldName }}" 
                                                                        name="{{ $fieldName }}" 
                                                                        {{ $isOptional ? 'disabled' : '' }}
                                                                        required>
                                                                    <option value="">Select {{ $field->field_label }}</option>
                                                                    @if($field->field_options)
                                                                        @foreach($field->field_options as $option)
                                                                            <option value="{{ $option }}" {{ old($fieldName) === $option ? 'selected' : '' }}>
                                                                                {{ $option }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                @break
                                                            @case('file')
                                                                <input type="file" 
                                                                       class="form-control @error($fieldName) is-invalid @enderror" 
                                                                       id="{{ $fieldName }}" 
                                                                       name="{{ $fieldName }}" 
                                                                       {{ $isOptional ? 'disabled' : '' }}
                                                                       required>
                                                                @break
                                                        @endswitch
                                                        @error($fieldName)
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                @if($section['max_count'] > $section['min_count'])
                                    <div class="text-center mb-4">
                                        <button type="button" class="btn btn-outline-primary add-item" 
                                                data-section="{{ $section['name'] }}" 
                                                data-max="{{ $section['max_count'] }}"
                                                data-min="{{ $section['min_count'] }}">
                                            <i class="fas fa-plus"></i> Add {{ $section['label'] }}
                                        </button>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('registrasi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Events
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Submit Registration
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
body {
    background: linear-gradient(135deg, #0c724c, #0f5132);
    min-height: 100vh;
}

.btn-primary {
    background-color: #0c724c;
    border-color: #0c724c;
}

.btn-primary:hover {
    background-color: #0f5132;
    border-color: #0f5132;
}

.bg-primary {
    background-color: #0c724c !important;
}

/* Fix for header overlap */
.main {
    padding-top: 100px;
}

/* Additional spacing for form page */
.container {
    margin-top: 20px;
}

/* Banner image styling */
.event-banner img {
    border: 3px solid rgba(255, 255, 255, 0.3);
    transition: transform 0.3s ease;
}

.event-banner img:hover {
    transform: scale(1.02);
}

.section-header {
    background: linear-gradient(135deg, #0c724c, #0f5132);
    color: white;
    padding: 15px;
    margin: 30px 0 20px 0;
    border-radius: 8px;
}

.section-header h5 {
    margin: 0;
    font-weight: 600;
}

.repeatable-section .repeat-item {
    background: #f8f9fa;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    border-left: 4px solid #0c724c;
    position: relative;
}

.repeatable-section .repeat-item.optional-item {
    border-left-color: #6c757d;
}

.item-header {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 15px;
}

.item-header h6 {
    color: #0c724c;
    font-weight: 600;
    margin: 0;
    flex-grow: 1;
}

.optional-item {
    display: none;
}

.validation-feedback {
    font-size: 0.875em;
    margin-top: 0.25rem;
}

.is-valid {
    border-color: #28a745;
}

.is-invalid {
    border-color: #dc3545;
}

input[type="tel"] {
    font-family: 'Courier New', monospace;
    letter-spacing: 1px;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Phone number validation for 'name' field
    const phoneInput = document.querySelector('input[name="name"]');
    
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            // Remove non-numeric characters
            let value = e.target.value.replace(/[^0-9]/g, '');
            
            // Limit to 14 digits
            if (value.length > 14) {
                value = value.slice(0, 14);
            }
            
            e.target.value = value;
            
            // Real-time validation feedback
            const feedback = e.target.parentNode.querySelector('.validation-feedback');
            if (feedback) {
                feedback.remove();
            }
            
            if (value.length < 8) {
                e.target.classList.add('is-invalid');
                e.target.classList.remove('is-valid');
                
                const feedbackDiv = document.createElement('div');
                feedbackDiv.className = 'validation-feedback text-warning';
                feedbackDiv.textContent = 'Minimal 8 digit';
                e.target.parentNode.appendChild(feedbackDiv);
            } else if (value.length >= 8 && value.length <= 14) {
                e.target.classList.remove('is-invalid');
                e.target.classList.add('is-valid');
                
                const feedbackDiv = document.createElement('div');
                feedbackDiv.className = 'validation-feedback text-success';
                feedbackDiv.textContent = '✓ Format nomor valid';
                e.target.parentNode.appendChild(feedbackDiv);
            }
        });
        
        // Format display on blur
        phoneInput.addEventListener('blur', function(e) {
            let value = e.target.value;
            
            // Auto-format to international if starts with 0
            if (value.startsWith('0') && value.length >= 8) {
                // Show formatted version in placeholder or help text
                const helpText = e.target.parentNode.querySelector('.form-text');
                if (helpText) {
                    const formatted = '62' + value.slice(1);
                    helpText.innerHTML = `Format internasional: ${formatted}<br>Masukkan nomor HP/WhatsApp aktif (8-14 digit)`;
                }
            }
        });
    }

    // Repeatable sections management
    @if($form->hasRepeatableSection())
        // Add item functionality
        document.querySelectorAll('.add-item').forEach(function(button) {
            button.addEventListener('click', function() {
                const section = this.getAttribute('data-section');
                const max = parseInt(this.getAttribute('data-max'));
                const container = document.querySelector(`[data-section="${section}"]`);
                const items = container.querySelectorAll('.repeat-item');
                
                let nextIndex = 1;
                for (let i = 1; i <= max; i++) {
                    const item = container.querySelector(`[data-index="${i}"]`);
                    if (item && item.style.display === 'none') {
                        nextIndex = i;
                        break;
                    }
                }
                
                const visibleCount = Array.from(items).filter(item => 
                    item.style.display !== 'none' && getComputedStyle(item).display !== 'none'
                ).length;
                
                if (visibleCount < max) {
                    const itemToShow = container.querySelector(`[data-index="${nextIndex}"]`);
                    if (itemToShow) {
                        itemToShow.style.display = 'block';
                        // Enable fields in this item
                        itemToShow.querySelectorAll('input, select, textarea').forEach(field => {
                            field.disabled = false;
                            field.required = true;
                        });
                        
                        // Hide add button if max reached
                        if (visibleCount + 1 >= max) {
                            this.style.display = 'none';
                        }
                    }
                }
            });
        });

        // Remove item functionality
        document.querySelectorAll('.remove-item').forEach(function(button) {
            button.addEventListener('click', function() {
                const item = this.closest('.repeat-item');
                const section = item.closest('.repeatable-section').getAttribute('data-section');
                const addButton = document.querySelector(`[data-section="${section}"].add-item`);
                
                // Hide item and disable fields
                item.style.display = 'none';
                item.querySelectorAll('input, select, textarea').forEach(field => {
                    field.disabled = true;
                    field.required = false;
                    field.value = '';
                    field.classList.remove('is-invalid', 'is-valid');
                });
                
                // Show add button
                if (addButton) {
                    addButton.style.display = 'inline-block';
                }
            });
        });
    @endif

    // Form validation before submit
    document.querySelector('form').addEventListener('submit', function(e) {
        let isValid = true;
        let errorMessages = [];

        // Validate required fields
        const requiredFields = this.querySelectorAll('input[required]:not([disabled]), select[required]:not([disabled]), textarea[required]:not([disabled])');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
                const label = field.parentNode.querySelector('label');
                const fieldName = label ? label.textContent.replace('*', '').trim() : field.name;
                errorMessages.push(`${fieldName} is required`);
            } else {
                field.classList.remove('is-invalid');
            }
        });

        // Validate repeatable sections
        @if($form->hasRepeatableSection())
            @foreach($form->getRepeatableSections() as $section)
                (function() {
                    var section = document.querySelector('[data-section="{{ $section['name'] }}"]');
                    if (!section) return;
                    var allItems = Array.from(section.querySelectorAll('.repeat-item'));
                    var visibleItems = allItems.filter(item => item.style.display !== 'none' && getComputedStyle(item).display !== 'none');
                    if (visibleItems.length < {{ $section['min_count'] }}) {
                        isValid = false;
                        errorMessages.push('{{ $section['label'] }}: Minimum {{ $section['min_count'] }} items required (currently: ' + visibleItems.length + ')');
                    }
                    visibleItems.forEach((item, index) => {
                        const itemRequiredFields = item.querySelectorAll('input[required]:not([disabled]), select[required]:not([disabled]), textarea[required]:not([disabled])');
                        itemRequiredFields.forEach(field => {
                            if (!field.value.trim()) {
                                isValid = false;
                                const fieldName = field.name.split('_').pop();
                                errorMessages.push(`{{ $section['label'] }} ${index + 1}: ${fieldName} is required`);
                                field.classList.add('is-invalid');
                            } else {
                                field.classList.remove('is-invalid');
                            }
                        });
                    });
                })();
            @endforeach
        @endif

        if (!isValid) {
            e.preventDefault();
            alert('Please fix the following errors:\n\n' + errorMessages.join('\n'));
            return false;
        }

        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
        }
    });
});
</script>
@endpush
