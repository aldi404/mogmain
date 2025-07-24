@extends('admin.layouts.app')

@section('title', 'Registration Details')
@section('page-title', 'Registration Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Registration #{{ $registration->id }}</h5>
                <span class="badge bg-{{ 
                    $registration->status === 'pending' ? 'warning' : 
                    ($registration->status === 'approved' ? 'success' : 
                    ($registration->status === 'rejected' ? 'danger' : 'secondary')) 
                }} fs-6">
                    {{ ucfirst($registration->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6><strong>Event Information</strong></h6>
                        <p class="mb-1"><strong>Event:</strong> {{ $registration->registrationForm->event->title }}</p>
                        <p class="mb-1"><strong>Form:</strong> {{ $registration->registrationForm->form_title }}</p>
                        <p class="mb-1"><strong>Event Date:</strong> {{ $registration->registrationForm->event->event_date->format('F d, Y') }}</p>
                        <p class="mb-1"><strong>Location:</strong> {{ $registration->registrationForm->event->location }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6><strong>Registration Information</strong></h6>
                        <p class="mb-1"><strong>Submitted:</strong> {{ $registration->created_at->format('F d, Y H:i') }}</p>
                        @if($registration->processed_at)
                            <p class="mb-1"><strong>Processed:</strong> {{ $registration->processed_at->format('F d, Y H:i') }}</p>
                            @if($registration->processor)
                                <p class="mb-1"><strong>Processed by:</strong> {{ $registration->processor->name }}</p>
                            @endif
                        @endif
                    </div>
                </div>

                <h6><strong>Participant Data</strong></h6>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            @foreach($registration->registrationForm->formFields as $formField)
                                @php
                                    $fieldName = $formField->formField->field_name;
                                    $fieldLabel = $formField->getDisplayLabel();
                                    $fieldValue = $registration->participant_data[$fieldName] ?? null;
                                @endphp
                                
                                @if($fieldValue)
                                    <tr>
                                        <td width="30%" class="fw-bold">{{ $fieldLabel }}:</td>
                                        <td>
                                            @if($formField->formField->field_type === 'file' && $fieldValue)
                                                <a href="{{ Storage::url($fieldValue) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-download"></i> View File
                                                </a>
                                            @else
                                                {{ $fieldValue }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($registration->admin_notes)
                    <div class="mt-4">
                        <h6><strong>Admin Notes</strong></h6>
                        <div class="alert alert-info">
                            {{ $registration->admin_notes }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="card shadow mt-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Receipt File</h5>
                <span class="badge bg-{{ 
                    $registration->approved === 0 ? 'warning' : 
                    ($registration->approved === 1 ? 'success' : 
                    ($registration->approved === 2 ? 'danger' : 'secondary')) 
                }} fs-6">
                @if (is_null($registration->approved))
                    Not Uploaded Yet
                @else
                    {{ ucfirst($registration->approved == 0 ? 'Waiting Approval' : ($registration->approved == 1 ? 'Approved' : ($registration->approved === 2 ? 'Reject' : null))) }}
                @endif
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <a href="{{ asset('storage/bukti_transfer/' . $registration->transfer_receipt) }}" target="_blank">
                        {{ $registration->transfer_receipt }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="mb-0">Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    @if($registration->status === 'pending')
                        <button type="button" class="btn btn-success" onclick="updateStatus({{ $registration->id }}, 'approved')">
                            <i class="fas fa-check"></i> Approve
                        </button>
                        <button type="button" class="btn btn-danger" onclick="updateStatus({{ $registration->id }}, 'rejected')">
                            <i class="fas fa-times"></i> Reject
                        </button>
                    @else
                        <button type="button" class="btn btn-primary" onclick="updateStatus({{ $registration->id }}, '{{ $registration->status }}')">
                            <i class="fas fa-edit"></i> Update Status
                        </button>
                    @endif
                    
                    <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                    
                    <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{ $registration->id }}, '{{ $registration->getParticipantName() }}')">
                        <i class="fas fa-trash"></i> Delete Registration
                    </button>
                </div>
            </div>
        </div>
        
        <div class="card shadow">
            <div class="card-header">
                <h6 class="mb-0">Event Details</h6>
            </div>
            <div class="card-body">
                <p class="mb-2"><strong>Type:</strong> {{ ucfirst(str_replace('_', ' ', $registration->registrationForm->event->event_type)) }}</p>
                @if($registration->registrationForm->event->max_participants)
                    <p class="mb-2"><strong>Max Participants:</strong> {{ $registration->registrationForm->event->max_participants }}</p>
                @endif
                @if($registration->registrationForm->event->registration_fee)
                    <p class="mb-2"><strong>Fee:</strong> Rp {{ number_format($registration->registrationForm->event->registration_fee, 0, ',', '.') }}</p>
                @endif
                <p class="mb-0"><strong>Status:</strong> {{ ucfirst($registration->registrationForm->event->status) }}</p>
            </div>
        </div>
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
                                  placeholder="Optional notes...">{{ $registration->admin_notes }}</textarea>
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
function updateStatus(registrationId, currentStatus) {
    document.getElementById('status_select').value = currentStatus;
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
