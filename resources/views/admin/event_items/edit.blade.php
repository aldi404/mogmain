@extends('admin.layouts.app')

@section('title', 'Edit Event Item')
@section('page-title', 'Edit Event Item')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.event-items.update', $eventItem) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-control" required>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $eventItem->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-control"
                        value="{{ old('client_name', $eventItem->client_name) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Event Name</label>
                    <input type="text" name="event_name" class="form-control"
                        value="{{ old('event_name', $eventItem->event_name) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $eventItem->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Images (you can add more, total max 50)</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                    @if ($eventItem->images->count())
                        <div class="mt-2">
                            <strong>Existing Images:</strong>
                            <div class="d-flex flex-wrap gap-3 mt-1">
                                @foreach ($eventItem->images as $img)
                                    <div style="position: relative; display: inline-block;">
                                        <img src="{{ Storage::url($img->image_path) }}" width="80" height="60"
                                            style="object-fit: cover;">
                                        <label
                                            style="position: absolute; top: 2px; right: 2px; background: rgba(255,0,0,0.7); color: white; padding: 2px 5px; border-radius: 3px; cursor: pointer; font-size: 12px; margin: 0;">
                                            <input type="checkbox" name="delete_images[]" value="{{ $img->id }}"
                                                style="margin-right: 3px;">
                                            Delete
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
                <a href="{{ route('admin.event-items.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
