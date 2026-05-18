@extends('admin.layouts.app')

@section('title', 'Events Management')
@section('page-title', 'Events Management')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Events List</h4>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Event
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Registrations</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($event->banner_image)
                                            <img src="{{ Storage::url($event->banner_image) }}" class="rounded me-2"
                                                width="40" height="40" style="object-fit: cover;">
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $event->title }}</h6>
                                            <small class="text-muted">by {{ $event->creator->name }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $event->event_date->format('M d, Y') }}</td>
                                <td>{{ $event->location }}</td>
                                <td>
                                    <span
                                        class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $event->event_type)) }}</span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $event->status === 'published' ? 'success' : ($event->status === 'draft' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $registrationCount = $event->registrationForms->sum(function ($form) {
                                            return $form->registrations->count();
                                        });
                                    @endphp
                                    <span class="badge bg-info">{{ $registrationCount }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.events.show', $event) }}"
                                            class="btn btn-sm btn-outline-info" title="View Details">
                                            <i class="fas fa-eye"></i>
                                            <span class="d-none d-md-inline ms-1">View</span>
                                        </a>
                                        <a href="{{ route('admin.events.edit', $event) }}"
                                            class="btn btn-sm btn-outline-primary" title="Edit Event">
                                            <i class="fas fa-edit"></i>
                                            <span class="d-none d-md-inline ms-1">Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Delete Event"
                                            onclick="confirmDelete({{ $event->id }}, '{{ $event->title }}')">
                                            <i class="fas fa-trash"></i>
                                            <span class="d-none d-md-inline ms-1">Delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-calendar fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">No events found</p>
                                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                                        Create Your First Event
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $events->links() }}
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the event <strong id="eventTitle"></strong>?</p>
                    <p class="text-muted">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(eventId, eventTitle) {
            document.getElementById('eventTitle').textContent = eventTitle;
            document.getElementById('deleteForm').action = `/admin/events/${eventId}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
@endpush
