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
                                @endphp
                                
                                <div class="mb-3">
                                    <label for="{{ $fieldName }}" class="form-label">
                                        {{ $fieldLabel }}
                                        @if($isRequired)
                                            <span class="text-danger">*</span>
                                        @endif
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
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show minimum required items on load
    @if($form->hasRepeatableSection())
        @foreach($form->getRepeatableSections() as $section)
            (function() {
                var section = document.querySelector('[data-section="{{ $section['name'] }}"]');
                if (!section) return;
                for (let i = 1; i <= {{ $section['min_count'] }}; i++) {
                    var item = section.querySelector('.repeat-item[data-index="' + i + '"]');
                    if (item) {
                        item.style.display = 'block';
                        item.classList.remove('optional-item');
                        item.querySelectorAll('input, select, textarea').forEach(input => input.disabled = false);
                    }
                }
            })();
        @endforeach
    @endif

    // Add item functionality
    document.querySelectorAll('.add-item').forEach(button => {
        button.addEventListener('click', function() {
            const sectionName = this.dataset.section;
            const maxCount = parseInt(this.dataset.max);
            const section = document.querySelector(`[data-section="${sectionName}"]`);
            if (!section) return;

            // Find next hidden item to show
            const allItems = Array.from(section.querySelectorAll('.repeat-item'));
            const nextItem = allItems.find(item => item.style.display === 'none' || getComputedStyle(item).display === 'none');
            if (nextItem) {
                nextItem.style.display = 'block';
                nextItem.classList.remove('optional-item');
                nextItem.querySelectorAll('input, select, textarea').forEach(input => input.disabled = false);

                // Hide add button if max reached
                const visibleCount = allItems.filter(item => item.style.display !== 'none' && getComputedStyle(item).display !== 'none').length;
                if (visibleCount >= maxCount) {
                    this.style.display = 'none';
                }
            }
        });
    });

    // Remove item functionality
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            const item = this.closest('.repeat-item');
            const section = item.closest('.repeatable-section');
            const sectionName = section.dataset.section;
            const addButton = document.querySelector(`[data-section="${sectionName}"] ~ .text-center .add-item`);
            item.style.display = 'none';
            item.classList.add('optional-item');
            item.querySelectorAll('input, select, textarea').forEach(input => {
                input.value = '';
                input.disabled = true;
            });
            // Show add button again if hidden
            if (addButton) addButton.style.display = 'inline-block';
        });
    });

    // Form validation before submit
    document.querySelector('form').addEventListener('submit', function(e) {
        let isValid = true;
        let errorMessages = [];

        // Validate regular fields (exclude disabled repeatable fields)
        const requiredFields = this.querySelectorAll('input[required]:not([disabled]), select[required]:not([disabled]), textarea[required]:not([disabled])');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                const label = this.querySelector(`label[for="${field.id}"]`)?.textContent || field.name;
                errorMessages.push(`${label} is required`);
                field.classList.add('is-invalid');
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
