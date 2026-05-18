@extends('admin.layouts.app')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.event-categories.update', $eventCategory) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $eventCategory->name) }}"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    @if ($eventCategory->image_path)
                        <div class="mb-2">
                            <img src="{{ Storage::url($eventCategory->image_path) }}" width="100" height="60"
                                style="object-fit: cover;">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
                <a href="{{ route('admin.event-categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
