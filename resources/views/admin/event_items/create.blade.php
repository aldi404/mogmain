@extends('admin.layouts.app')

@section('title', 'Create Event Item')
@section('page-title', 'Create Event Item')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.event-items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- choose --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-control" value="{{ old('client_name') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Event Name</label>
                    <input type="text" name="event_name" class="form-control" value="{{ old('event_name') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Images (max 50)</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                </div>
                <button class="btn btn-primary" type="submit">Save</button>
                <a href="{{ route('admin.event-items.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
