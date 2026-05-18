@extends('admin.layouts.app')

@section('title', 'Edit Service Portfolio')
@section('page-title', 'Edit Service Portfolio')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.service-portfolios.update', $servicePortfolio) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $servicePortfolio->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $servicePortfolio->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload More Photos (you can add more, total max 50)</label>
                    <input type="file" name="images[]" class="form-control @error('images.*') is-invalid @enderror"
                        multiple accept="image/*">
                    <small class="text-muted">Max 5MB per file. Current:
                        {{ $servicePortfolio->images()->count() }}/50</small>
                    @error('images.*')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Existing Images with Thumbnail Selection and Delete -->
                @if ($servicePortfolio->images->count())
                    <div class="mb-4">
                        <strong>Existing Images:</strong>
                        <p class="text-muted small">Select thumbnail and check boxes to delete images</p>
                        <div class="row">
                            @foreach ($servicePortfolio->images as $img)
                                <div class="col-md-3 mb-3">
                                    <div
                                        style="border: 2px solid #ccc; border-radius: 5px; padding: 10px; position: relative;">
                                        <img src="{{ Storage::url($img->image_path) }}" width="100%" height="150px"
                                            style="object-fit: cover; border-radius: 3px; margin-bottom: 8px;">

                                        <!-- Thumbnail Radio Button -->
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="thumbnail_id"
                                                value="{{ $img->id }}"
                                                {{ $servicePortfolio->thumbnail_image_path === $img->image_path ? 'checked' : '' }}>
                                            <label class="form-check-label" style="font-size: 12px;">
                                                Set as thumbnail
                                            </label>
                                        </div>

                                        <!-- Delete Checkbox -->
                                        <label
                                            style="display: flex; align-items: center; font-size: 12px; background: #f8f9fa; padding: 5px; border-radius: 3px;">
                                            <input type="checkbox" name="delete_images[]" value="{{ $img->id }}"
                                                style="margin-right: 5px;">
                                            <span style="color: #dc3545;">Delete</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <button class="btn btn-primary" type="submit">Update</button>
                <a href="{{ route('admin.service-portfolios.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
