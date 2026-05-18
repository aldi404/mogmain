@extends('admin.layouts.app')

@section('title', 'Event Items')
@section('page-title', 'Event Items')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Event Items List</h4>
        <a href="{{ route('admin.event-items.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Event Item
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Event Name</th>
                            <th>Category</th>
                            <th>Images</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>{{ $item->client_name }}</td>
                                <td>{{ $item->event_name }}</td>
                                <td>{{ $item->category->name ?? '-' }}</td>
                                <td>{{ $item->images->count() }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.event-items.edit', $item) }}"
                                            class="btn btn-sm btn-outline-primary" title="Edit Event Item">
                                            <i class="fas fa-edit"></i>
                                            <span class="d-none d-md-inline ms-1">Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            title="Delete Event Item"
                                            onclick="confirmDelete({{ $item->id }}, '{{ $item->event_name }}')">
                                            <i class="fas fa-trash"></i>
                                            <span class="d-none d-md-inline ms-1">Delete</span>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $item->id }}"
                                        action="{{ route('admin.event-items.destroy', $item) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No event items found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $items->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(id, name) {
            if (confirm(`Delete event item "${name}"? This action cannot be undone.`)) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        }
    </script>
@endpush
