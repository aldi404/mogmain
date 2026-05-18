@extends('admin.layouts.app')

@section('title', 'Create Service Portfolio')
@section('page-title', 'Create Service Portfolio')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.service-portfolios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Photos (max 50 files)</label>
                    <input type="file" name="images[]" class="form-control @error('images.*') is-invalid @enderror"
                        multiple accept="image/*" required>
                    <small class="text-muted">Max 5MB per file</small>
                    @error('images.*')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary" type="submit">Create</button>
                <a href="{{ route('admin.service-portfolios.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
