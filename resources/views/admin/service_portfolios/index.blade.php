@extends('admin.layouts.app')

@section('title', 'Service Portfolios')
@section('page-title', 'Service Portfolios')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Service Portfolios List</h4>
        <a href="{{ route('admin.service-portfolios.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Service Portfolio
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Images</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($portfolios as $portfolio)
                            <tr>
                                <td>{{ $portfolio->name }}</td>
                                <td>{{ Str::limit($portfolio->description, 50) ?? '-' }}</td>
                                <td>{{ $portfolio->images()->count() }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.service-portfolios.edit', $portfolio) }}"
                                            class="btn btn-sm btn-outline-primary" title="Edit Service Portfolio">
                                            <i class="fas fa-edit"></i>
                                            <span class="d-none d-md-inline ms-1">Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            title="Delete Service Portfolio"
                                            onclick="confirmDelete({{ $portfolio->id }}, '{{ $portfolio->name }}')">
                                            <i class="fas fa-trash"></i>
                                            <span class="d-none d-md-inline ms-1">Delete</span>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $portfolio->id }}"
                                        action="{{ route('admin.service-portfolios.destroy', $portfolio) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No service portfolios found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $portfolios->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(id, name) {
            if (confirm(`Delete service portfolio "${name}"? This action cannot be undone.`)) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        }
    </script>
@endpush
