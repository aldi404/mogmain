@extends('admin.layouts.app')

@section('title', 'Registration Details')
@section('page-title', 'Registration Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Registration #{{ $registration->id }}</h5>
                <div>
                    <span class="badge badge-{{ $registration->status === 'approved' ? 'success' : ($registration->status === 'rejected' ? 'danger' : 'warning') }}">
                        {{ ucfirst($registration->status) }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <!-- Event Information -->
                <div class="mb-4">
                    <h6 class="text-primary"><i class="fas fa-calendar"></i> Event Information</h6>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td width="20%" class="fw-bold">Event:</td>
                                    <td>{{ $registration->registrationForm->event->title }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Date:</td>
                                    <td>{{ $registration->registrationForm->event->event_date->format('M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Location:</td>
                                    <td>{{ $registration->registrationForm->event->location }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Registration Date:</td>
                                    <td>{{ $registration->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Registration Data -->
                <h6 class="text-primary"><i class="fas fa-user"></i> Registration Data</h6>
                
                <!-- Regular Fields -->
                @if($registration->registrationForm->formFields->count() > 0)
                    <div class="mb-4">
                        <h6 class="text-secondary"><i class="fas fa-info-circle"></i> General Information</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    @foreach($registration->registrationForm->formFields as $formField)
                                        @php
                                            $fieldName = $formField->formField->field_name;
                                            $fieldLabel = $formField->getDisplayLabel();
                                            $fieldValue = $registration->participant_data[$fieldName] ?? null;
                                        @endphp
                                        
                                        @if($fieldValue)
                                            <tr>
                                                <td width="30%" class="fw-bold bg-light">{{ $fieldLabel }}</td>
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
                    </div>
                @endif

                <!-- Repeatable Sections -->
                @if($registration->registrationForm->hasRepeatableSection())
                    @foreach($registration->registrationForm->getRepeatableSections() as $section)
                        @php
                            $sectionData = $registration->participant_data[$section['name']] ?? [];
                        @endphp
                        
                        @if(!empty($sectionData))
                            <div class="mb-4">
                                <h6 class="text-secondary">
                                    <i class="fas fa-users"></i> {{ $section['label'] }} 
                                    <span class="badge bg-secondary">{{ count($sectionData) }} items</span>
                                </h6>
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th width="5%" class="text-center">#</th>
                                                @foreach($section['fields'] as $fieldId)
                                                    @php
                                                        $field = \App\Models\FormField::find($fieldId);
                                                    @endphp
                                                    @if($field)
                                                        <th>{{ $field->field_label }}</th>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sectionData as $index => $itemData)
                                                <tr>
                                                    <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                                    @foreach($section['fields'] as $fieldId)
                                                        @php
                                                            $field = \App\Models\FormField::find($fieldId);
                                                            $fieldValue = $itemData[$field->field_name ?? ''] ?? null;
                                                        @endphp
                                                        <td>
                                                            @if($field && $fieldValue)
                                                                @if($field->field_type === 'file')
                                                                    <a href="{{ Storage::url($fieldValue) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                                        <i class="fas fa-eye"></i> View
                                                                    </a>
                                                                @else
                                                                    {{ $fieldValue }}
                                                                @endif
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No repeatable sections configured for this form.
                    </div>
                @endif

                <!-- Status Management -->
                {{-- <div class="mb-4">
                    <h6 class="text-primary"><i class="fas fa-cog"></i> Status Management</h6>
                    <form action="{{ route('admin.registrations.update-status', $registration) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <select name="status" class="form-select">
                                    <option value="pending" {{ $registration->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $registration->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $registration->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="cancelled" {{ $registration->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="admin_notes" class="form-control" placeholder="Admin notes (optional)" value="{{ $registration->admin_notes }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div> --}}

                <!-- Transfer Receipt -->
                @if($registration->transfer_receipt)
                    <div class="mb-4">
                        <h6 class="text-primary"><i class="fas fa-receipt"></i> Transfer Receipt</h6>
                        <a href="{{ Storage::url('bukti_transfer/' . $registration->transfer_receipt) }}" target="_blank" class="btn btn-outline-success">
                            <i class="fas fa-eye"></i> View Transfer Receipt
                        </a>
                    </div>
                @endif

                <!-- Approve Data Button -->
                @if(!$registration->data_approved)
                <div class="card mt-3">
                    <div class="card-header bg-warning">
                        <h5>Verifikasi Data</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.registrations.approve', $registration) }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success" onclick="return confirm('Setujui data registrasi ini?')">
                                <i class="fas fa-check"></i> Approve Data
                            </button>
                        </form>
                        
                        <form method="POST" action="{{ route('admin.registrations.reject', $registration) }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak registrasi ini?')">
                                <i class="fas fa-times"></i> Reject
                            </button>
                        </form>
                    </div>
                </div>
                @endif

                <!-- Approve Payment Button (jika data sudah approved dan ada bukti transfer) -->
                @if($registration->data_approved && $registration->transfer_receipt && !$registration->payment_approved)
                <div class="card mt-3">
                    <div class="card-header bg-info">
                        <h5>Verifikasi Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Bukti Transfer:</strong></p>
                        <a href="{{ Storage::url('bukti_transfer/' . $registration->transfer_receipt) }}" 
                           target="_blank" class="btn btn-info mb-3">
                            <i class="fas fa-image"></i> Lihat Bukti Transfer
                        </a>
                        
                        <div>
                            <form method="POST" action="{{ route('admin.registrations.approve-payment', $registration) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success" onclick="return confirm('Setujui pembayaran ini?')">
                                    <i class="fas fa-check"></i> Approve Payment
                                </button>
                            </form>
                            
                            <form method="POST" action="{{ route('admin.registrations.reject-payment', $registration) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak pembayaran ini?')">
                                    <i class="fas fa-times"></i> Reject Payment
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Actions -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                    
                    <div>
                        <button onclick="window.print()" class="btn btn-info">
                            <i class="fas fa-print"></i> Print
                        </button>
                        
                        <form action="{{ route('admin.registrations.destroy', $registration) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this registration?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
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

@push('styles')
<style>
@media print {
    .btn, .card-header .badge, .d-flex.justify-content-between {
        display: none !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
@endpush

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
@endsection
