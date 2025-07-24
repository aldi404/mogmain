@extends('admin.layouts.app')

@section('title', 'Event Details')
@section('page-title', 'Event Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $event->title }}</h5>
                <div>
                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.registration-forms.create', ['event_id' => $event->id]) }}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i> Add Registration Form
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($event->banner_image)
                    <div class="mb-3">
                        <img src="{{ Storage::url($event->banner_image) }}" alt="{{ $event->title }}" class="img-fluid rounded">
                    </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Event Date:</strong> {{ $event->event_date->format('F d, Y') }}
                    </div>
                    <div class="col-md-6">
                        <strong>Type:</strong> {{ ucfirst(str_replace('_', ' ', $event->event_type)) }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Location:</strong> {{ $event->location }}
                    </div>
                    <div class="col-md-6">
                        <strong>Status:</strong> 
                        <span class="badge bg-{{ $event->status === 'published' ? 'success' : ($event->status === 'draft' ? 'warning' : 'danger') }}">
                            {{ ucfirst($event->status) }}
                        </span>
                    </div>
                </div>
                
                @if($event->max_participants)
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Max Participants:</strong> {{ number_format($event->max_participants) }}
                        </div>
                        @if($event->registration_fee)
                            <div class="col-md-6">
                                <strong>Registration Fee:</strong> Rp {{ number_format($event->registration_fee, 0, ',', '.') }}
                            </div>
                        @endif
                    </div>
                @endif
                
                <div class="mb-3">
                    <strong>Description:</strong>
                    <p class="mt-2">{{ $event->description }}</p>
                </div>
                
                <div class="mb-3">
                    <strong>Created by:</strong> {{ $event->creator->name }}
                    <br>
                    <small class="text-muted">Created on {{ $event->created_at->format('F d, Y H:i') }}</small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="mb-0">Registration Forms</h6>
            </div>
            <div class="card-body">
                @if($event->registrationForms->count() > 0)
                    @foreach($event->registrationForms as $form)
                        <div class="border rounded p-3 mb-3">
                            <h6>{{ $form->form_title }}</h6>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-{{ $form->is_active ? 'success' : 'secondary' }}">
                                    {{ $form->is_active ? 'Active' : 'Inactive' }}
                                </span>
                                @if($form->isRegistrationOpen())
                                    <span class="badge bg-info">Open</span>
                                @else
                                    <span class="badge bg-warning">Closed</span>
                                @endif
                            </div>
                            <small class="text-muted">
                                {{ $form->registration_start->format('M d') }} - {{ $form->registration_end->format('M d, Y') }}
                                <br>
                                Registrations: {{ $form->registrations->count() }}
                            </small>
                            <div class="mt-2">
                                <a href="{{ route('admin.registration-forms.show', $form) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.registration-forms.edit', $form) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted text-center">No registration forms created yet.</p>
                    <a href="{{ route('admin.registration-forms.create', ['event_id' => $event->id]) }}" class="btn btn-primary w-100">
                        <i class="fas fa-plus"></i> Create Registration Form
                    </a>
                @endif
            </div>
        </div>
        
        <div class="card shadow">
            <div class="card-header">
                <h6 class="mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Event
                    </a>
                    <a href="{{ route('admin.registration-forms.create', ['event_id' => $event->id]) }}" class="btn btn-success">
                        <i class="fas fa-wpforms"></i> Add Registration Form
                    </a>
                    @if($event->registrationForms->count() > 0)
                        <a href="{{ route('admin.registrations.index', ['event_id' => $event->id]) }}" class="btn btn-info">
                            <i class="fas fa-users"></i> View Registrations
                        </a>
                    @endif
                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $event->id }}, '{{ $event->title }}')">
                        <i class="fas fa-trash"></i> Delete Event
                    </button>
                </div>
            </div>
        </div>
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
                <p class="text-muted">This action cannot be undone and will also delete all registration forms and registrations.</p>
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
