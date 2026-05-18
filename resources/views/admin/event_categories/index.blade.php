@extends('admin.layouts.app')

@section('title', 'Event Categories')
@section('page-title', 'Event Categories')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Categories List</h4>
        <a href="{{ route('admin.event-categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Category
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $cat)
                            <tr>
                                <td>{{ $cat->name }}</td>
                                <td>
                                    @if ($cat->image_path)
                                        <img src="{{ Storage::url($cat->image_path) }}" width="60" height="40"
                                            style="object-fit: cover;" />
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.event-categories.edit', $cat) }}"
                                            class="btn btn-sm btn-outline-primary" title="Edit Category">
                                            <i class="fas fa-edit"></i>
                                            <span class="d-none d-md-inline ms-1">Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Delete Category"
                                            onclick="confirmDelete({{ $cat->id }}, '{{ $cat->name }}')">
                                            <i class="fas fa-trash"></i>
                                            <span class="d-none d-md-inline ms-1">Delete</span>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $cat->id }}"
                                        action="{{ route('admin.event-categories.destroy', $cat) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    No categories yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $categories->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(id, name) {
            if (confirm(`Delete category "${name}"? This action cannot be undone.`)) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        }
    </script>
@endpush
