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
</style>
@endpush
