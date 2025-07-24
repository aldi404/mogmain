@extends('admin.layouts.app')

@section('title', 'Registration Forms')
@section('page-title', 'Registration Forms Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Registration Forms</h4>
    <a href="{{ route('admin.registration-forms.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Create New Form
    </a>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Form Title</th>
                        <th>Event</th>
                        <th>Registration Period</th>
                        <th>Status</th>
                        <th>Registrations</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($forms as $form)
                    <tr>
                        <td>
                            <h6 class="mb-1">{{ $form->form_title }}</h6>
                            @if($form->form_description)
                                <small class="text-muted">{{ Str::limit($form->form_description, 50) }}</small>
                            @endif
                        </td>
                        <td>
                            <div>
                                <strong>{{ $form->event->title }}</strong>
                                <br>
                                <small class="text-muted">{{ $form->event->event_date->format('M d, Y') }}</small>
                            </div>
                        </td>
                        <td>
                            <small>
                                {{ $form->registration_start->format('M d, Y H:i') }}
                                <br>
                                to {{ $form->registration_end->format('M d, Y H:i') }}
                            </small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-{{ $form->is_active ? 'success' : 'secondary' }} me-2">
                                    {{ $form->is_active ? 'Active' : 'Inactive' }}
                                </span>
                                @if($form->isRegistrationOpen())
                                    <span class="badge bg-info">Open</span>
                                @else
                                    <span class="badge bg-warning">Closed</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $form->registrations->count() }}</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.registration-forms.show', $form) }}" class="btn btn-sm btn-outline-info" title="View Form">
                                    <i class="fas fa-eye"></i>
                                    <span class="d-none d-md-inline ms-1">View</span>
                                </a>
                                <a href="{{ route('admin.registration-forms.edit', $form) }}" class="btn btn-sm btn-outline-primary" title="Edit Form">
                                    <i class="fas fa-edit"></i>
                                    <span class="d-none d-md-inline ms-1">Edit</span>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-{{ $form->is_active ? 'warning' : 'success' }}" title="{{ $form->is_active ? 'Deactivate' : 'Activate' }} Form"
                                        onclick="toggleStatus({{ $form->id }})">
                                    <i class="fas fa-{{ $form->is_active ? 'pause' : 'play' }}"></i>
                                    <span class="d-none d-md-inline ms-1">{{ $form->is_active ? 'Pause' : 'Play' }}</span>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" title="Delete Form"
                                        onclick="confirmDelete({{ $form->id }}, '{{ $form->form_title }}')">
                                    <i class="fas fa-trash"></i>
                                    <span class="d-none d-md-inline ms-1">Delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-wpforms fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No registration forms found</p>
                            <a href="{{ route('admin.registration-forms.create') }}" class="btn btn-primary">
                                Create Your First Form
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $forms->links() }}
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
</script>
@endpush
