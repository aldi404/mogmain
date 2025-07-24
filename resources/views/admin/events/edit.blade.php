@extends('admin.layouts.app')

@section('title', 'Edit Event')
@section('page-title', 'Edit Event')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">Edit Event Information</h5>
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

                <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="title" class="form-label">Event Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $event->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" required>{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="event_date" class="form-label">Event Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('event_date') is-invalid @enderror" 
                                   id="event_date" name="event_date" value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}" required>
                            @error('event_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="event_type" class="form-label">Event Type <span class="text-danger">*</span></label>
                            <select class="form-select @error('event_type') is-invalid @enderror" 
                                    id="event_type" name="event_type" required>
                                <option value="">Select Event Type</option>
                                <option value="exhibition" {{ old('event_type', $event->event_type) === 'exhibition' ? 'selected' : '' }}>Exhibition</option>
                                <option value="festival" {{ old('event_type', $event->event_type) === 'festival' ? 'selected' : '' }}>Festival</option>
                                <option value="running" {{ old('event_type', $event->event_type) === 'running' ? 'selected' : '' }}>Running</option>
                                <option value="basketball" {{ old('event_type', $event->event_type) === 'basketball' ? 'selected' : '' }}>Basketball</option>
                                <option value="combat_sport" {{ old('event_type', $event->event_type) === 'combat_sport' ? 'selected' : '' }}>Combat Sport</option>
                                <option value="mice" {{ old('event_type', $event->event_type) === 'mice' ? 'selected' : '' }}>MICE</option>
                                <option value="other" {{ old('event_type', $event->event_type) === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('event_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" 
                               id="location" name="location" value="{{ old('location', $event->location) }}" required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="max_participants" class="form-label">Max Participants</label>
                            <input type="number" class="form-control @error('max_participants') is-invalid @enderror" 
                                   id="max_participants" name="max_participants" value="{{ old('max_participants', $event->max_participants) }}" min="1">
                            @error('max_participants')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="registration_fee" class="form-label">Registration Fee (Rp)</label>
                            <input type="number" class="form-control @error('registration_fee') is-invalid @enderror" 
                                   id="registration_fee" name="registration_fee" value="{{ old('registration_fee', $event->registration_fee) }}" min="0" step="0.01">
                            @error('registration_fee')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="banner_image" class="form-label">Banner Image</label>
                            @if($event->banner_image)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($event->banner_image) }}" alt="Current Banner" class="img-thumbnail" style="max-height: 100px;">
                                    <small class="text-muted d-block">Current banner image</small>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('banner_image') is-invalid @enderror" 
                                   id="banner_image" name="banner_image" accept="image/*">
                            @error('banner_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Max size: 2MB. Formats: JPEG, PNG, JPG, GIF. Leave empty to keep current image.</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="draft" {{ old('status', $event->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $event->status) === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="closed" {{ old('status', $event->status) === 'closed' ? 'selected' : '' }}>Closed</option>
                                <option value="cancelled" {{ old('status', $event->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
