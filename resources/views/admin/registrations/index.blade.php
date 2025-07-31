@extends('admin.layouts.app')

@section('title', 'Event Registrations')
@section('page-title', 'Event Registrations')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Event Registrations</h4>
    <div>
        <a href="{{ route('admin.registrations.export', request()->query()) }}" class="btn btn-success">
            <i class="fas fa-download"></i> Export CSV
        </a>
    </div>
</div>

<!-- Filters -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.registrations.index') }}">
            <div class="row">
                <div class="col-md-3">
                    <label for="event_id" class="form-label">Filter by Event</label>
                    <select class="form-select" id="event_id" name="event_id">
                        <option value="">All Events</option>
                        @foreach($registrationForms as $form)
                            <option value="{{ $form->event_id }}" {{ request('event_id') == $form->event_id ? 'selected' : '' }}>
                                {{ $form->event->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label for="status" class="form-label">Filter by Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           placeholder="Search by name or email..." value="{{ request('search') }}">
                </div>
                
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Filter
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Registrations Table -->
<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Event</th>
                        <th>Participant</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Registration Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $registration)
                    <tr>
                        <td>#{{ $registration->id }}</td>
                        <td>
                            <div>
                                <strong>{{ $registration->registrationForm->event->title }}</strong>
                                <br>
                                <small class="text-muted">{{ $registration->registrationForm->form_title }}</small>
                            </div>
                        </td>
                        <td>
                            <div>
                                <strong>{{ $registration->getParticipantName() }}</strong>
                                @if(isset($registration->participant_data['company']) && $registration->participant_data['company'])
                                    <br>
                                    <small class="text-muted">{{ $registration->participant_data['company'] }}</small>
                                @endif
                                
                                <!-- Show repeatable section count -->
                                @if($registration->registrationForm->hasRepeatableSection())
                                    @foreach($registration->registrationForm->getRepeatableSections() as $section)
                                        @php
                                            $sectionData = $registration->participant_data[$section['name']] ?? [];
                                        @endphp
                                        @if(!empty($sectionData))
                                            <br>
                                            <small class="badge bg-info">{{ count($sectionData) }} {{ $section['label'] }}</small>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </td>
                        <td>
                            <div>
                                <small>
                                    <i class="fas fa-envelope"></i> {{ $registration->getParticipantEmail() }}
                                </small>
                                @if(isset($registration->participant_data['phone']) && $registration->participant_data['phone'])
                                    <br>
                                    <small>
                                        <i class="fas fa-phone"></i> {{ $registration->participant_data['phone'] }}
                                    </small>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-{{ 
                                $registration->status === 'pending' ? 'warning' : 
                                ($registration->status === 'approved' ? 'success' : 
                                ($registration->status === 'rejected' ? 'danger' : 'secondary')) 
                            }}">
                                {{ ucfirst($registration->status) }}
                            </span>
                        </td>
                        <td>
                            <small>{{ $registration->created_at->format('M d, Y H:i') }}</small>
                            @if($registration->processed_at)
                                <br>
                                <small class="text-muted">
                                    Processed: {{ $registration->processed_at->format('M d, Y') }}
                                    @if($registration->processor)
                                        by {{ $registration->processor->name }}
                                    @endif
                                </small>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.registrations.show', $registration) }}" class="btn btn-sm btn-outline-info" title="View Registration">
                                    <i class="fas fa-eye"></i>
                                    <span class="d-none d-md-inline ms-1">View</span>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" title="Delete Registration"
                                        onclick="confirmDelete({{ $registration->id }}, '{{ $registration->getParticipantName() }}')">
                                    <i class="fas fa-trash"></i>
                                    <span class="d-none d-md-inline ms-1">Delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No registrations found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $registrations->links() }}
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="statusForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title">Update Registration Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status_select" class="form-label">Status</label>
                        <select class="form-select" id="status_select" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="admin_notes" class="form-label">Admin Notes</label>
                        <textarea class="form-control" id="admin_notes" name="admin_notes" rows="3" 
                                  placeholder="Optional notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
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
                <p>Are you sure you want to delete the registration for <strong id="participantName"></strong>?</p>
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
function updateStatus(registrationId, status) {
    document.getElementById('status_select').value = status;
    document.getElementById('statusForm').action = `/admin/registrations/${registrationId}/status`;
    new bootstrap.Modal(document.getElementById('statusModal')).show();
}

function confirmDelete(registrationId, participantName) {
    document.getElementById('participantName').textContent = participantName;
    document.getElementById('deleteForm').action = `/admin/registrations/${registrationId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush
