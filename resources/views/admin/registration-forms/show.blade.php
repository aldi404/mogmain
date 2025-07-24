@extends('admin.layouts.app')

@section('title', 'Registration Form Details')
@section('page-title', 'Registration Form Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $registrationForm->form_title }}</h5>
                <div>
                    <a href="{{ route('admin.registration-forms.edit', $registrationForm) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button type="button" class="btn btn-sm btn-{{ $registrationForm->is_active ? 'warning' : 'success' }}"
                            onclick="toggleStatus({{ $registrationForm->id }})">
                        <i class="fas fa-{{ $registrationForm->is_active ? 'pause' : 'play' }}"></i> 
                        {{ $registrationForm->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Event:</strong> {{ $registrationForm->event->title }}
                    </div>
                    <div class="col-md-6">
                        <strong>Event Date:</strong> {{ $registrationForm->event->event_date->format('F d, Y') }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Registration Period:</strong>
                        <br>
                        <small>{{ $registrationForm->registration_start->format('M d, Y H:i') }} - {{ $registrationForm->registration_end->format('M d, Y H:i') }}</small>
                    </div>
                    <div class="col-md-6">
                        <strong>Status:</strong>
                        <div>
                            <span class="badge bg-{{ $registrationForm->is_active ? 'success' : 'secondary' }} me-2">
                                {{ $registrationForm->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            @if($registrationForm->isRegistrationOpen())
                                <span class="badge bg-info">Open</span>
                            @else
                                <span class="badge bg-warning">Closed</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($registrationForm->form_description)
                    <div class="mb-3">
                        <strong>Description:</strong>
                        <p class="mt-2">{{ $registrationForm->form_description }}</p>
                    </div>
                @endif
                
                <div class="mb-3">
                    <strong>Form Fields ({{ $registrationForm->formFields->count() }} fields):</strong>
                    <div class="table-responsive mt-2">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Field Name</th>
                                    <th>Type</th>
                                    <th>Required</th>
                                    <th>Custom Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registrationForm->formFields as $formField)
                                    <tr>
                                        <td>{{ $formField->field_order }}</td>
                                        <td>{{ $formField->formField->field_label }}</td>
                                        <td><span class="badge bg-secondary">{{ ucfirst($formField->formField->field_type) }}</span></td>
                                        <td>
                                            @if($formField->is_required)
                                                <i class="fas fa-check text-success"></i>
                                            @else
                                                <i class="fas fa-times text-muted"></i>
                                            @endif
                                        </td>
                                        <td>{{ $formField->custom_label ?: '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="mb-3">
                    <strong>Public Registration URL:</strong>
                    <div class="input-group mt-2">
                        <input type="text" class="form-control" value="{{ route('registrasi.show', $registrationForm) }}" readonly>
                        <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i> Copy
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="mb-0">Registration Statistics</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <h4 class="text-primary">{{ $registrationForm->registrations->count() }}</h4>
                        <small class="text-muted">Total Registrations</small>
                    </div>
                    <div class="col-6">
                        <h4 class="text-success">{{ $registrationForm->registrations->where('status', 'approved')->count() }}</h4>
                        <small class="text-muted">Approved</small>
                    </div>
                </div>
                <div class="row text-center mt-3">
                    <div class="col-6">
                        <h4 class="text-warning">{{ $registrationForm->registrations->where('status', 'pending')->count() }}</h4>
                        <small class="text-muted">Pending</small>
                    </div>
                    <div class="col-6">
                        <h4 class="text-danger">{{ $registrationForm->registrations->where('status', 'rejected')->count() }}</h4>
                        <small class="text-muted">Rejected</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow">
            <div class="card-header">
                <h6 class="mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.registration-forms.edit', $registrationForm) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Form
                    </a>
                    <a href="{{ route('admin.registrations.index', ['event_id' => $registrationForm->event_id]) }}" class="btn btn-info">
                        <i class="fas fa-users"></i> View Registrations
                    </a>
                    <a href="{{ route('registrasi.show', $registrationForm) }}" class="btn btn-success" target="_blank">
                        <i class="fas fa-external-link-alt"></i> Preview Form
                    </a>
                    <button type="button" class="btn btn-{{ $registrationForm->is_active ? 'warning' : 'success' }}"
                            onclick="toggleStatus({{ $registrationForm->id }})">
                        <i class="fas fa-{{ $registrationForm->is_active ? 'pause' : 'play' }}"></i> 
                        {{ $registrationForm->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $registrationForm->id }}, '{{ $registrationForm->form_title }}')">
                        <i class="fas fa-trash"></i> Delete Form
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
                <p>Are you sure you want to delete the form <strong id="formTitle"></strong>?</p>
                <p class="text-muted">This action cannot be undone and will also delete all registrations.</p>
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
function confirmDelete(formId, formTitle) {
    document.getElementById('formTitle').textContent = formTitle;
    document.getElementById('deleteForm').action = `/admin/registration-forms/${formId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

function toggleStatus(formId) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/admin/registration-forms/${formId}/toggle-status`;
    
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    
    const methodField = document.createElement('input');
    methodField.type = 'hidden';
    methodField.name = '_method';
    methodField.value = 'PATCH';
    
    form.appendChild(csrfToken);
    form.appendChild(methodField);
    document.body.appendChild(form);
    form.submit();
}

function copyToClipboard(button) {
    const input = button.parentElement.previousElementSibling;
    input.select();
    document.execCommand('copy');
    
    const icon = button.querySelector('i');
    const originalClass = icon.className;
    icon.className = 'fas fa-check';
    button.classList.add('btn-success');
    button.classList.remove('btn-outline-secondary');
    
    setTimeout(() => {
        icon.className = originalClass;
        button.classList.remove('btn-success');
        button.classList.add('btn-outline-secondary');
    }, 2000);
}
</script>
@endpush
