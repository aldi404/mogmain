@extends('admin.layouts.app')

@section('title', 'Create Event')
@section('page-title', 'Create New Event')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Event Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="title" class="form-label">Event Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="event_date" class="form-label">Event Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('event_date') is-invalid @enderror"
                                    id="event_date" name="event_date" value="{{ old('event_date') }}" required>
                                @error('event_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="event_type" class="form-label">Event Type <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('event_type') is-invalid @enderror" id="event_type"
                                    name="event_type" required>
                                    <option value="">Select Event Type</option>
                                    <option value="exhibition" {{ old('event_type') === 'exhibition' ? 'selected' : '' }}>
                                        Exhibition</option>
                                    <option value="festival" {{ old('event_type') === 'festival' ? 'selected' : '' }}>
                                        Festival</option>
                                    <option value="running" {{ old('event_type') === 'running' ? 'selected' : '' }}>Running
                                    </option>
                                    <option value="basketball" {{ old('event_type') === 'basketball' ? 'selected' : '' }}>
                                        Basketball</option>
                                    <option value="combat_sport"
                                        {{ old('event_type') === 'combat_sport' ? 'selected' : '' }}>Combat Sport</option>
                                    <option value="mice" {{ old('event_type') === 'mice' ? 'selected' : '' }}>MICE
                                    </option>
                                    <option value="other" {{ old('event_type') === 'other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                @error('event_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                id="location" name="location" value="{{ old('location') }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="max_participants" class="form-label">Max Participants</label>
                                <input type="number" class="form-control @error('max_participants') is-invalid @enderror"
                                    id="max_participants" name="max_participants" value="{{ old('max_participants') }}"
                                    min="1">
                                @error('max_participants')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="registration_fee" class="form-label">Registration Fee (Rp)</label>
                                <input type="number" class="form-control @error('registration_fee') is-invalid @enderror"
                                    id="registration_fee" name="registration_fee" value="{{ old('registration_fee') }}"
                                    min="0" step="0.01">
                                @error('registration_fee')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="banner_image" class="form-label">Banner Image</label>
                                <input type="file" class="form-control @error('banner_image') is-invalid @enderror"
                                    id="banner_image" name="banner_image" accept="image/*">
                                @error('banner_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Max size: 2MB. Formats: JPEG, PNG, JPG, GIF</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft
                                    </option>
                                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>
                                        Published</option>
                                    <option value="closed" {{ old('status') === 'closed' ? 'selected' : '' }}>Closed
                                    </option>
                                    <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
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
                                <i class="fas fa-save"></i> Create Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
