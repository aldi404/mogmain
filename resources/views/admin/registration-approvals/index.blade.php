@extends('admin.layouts.app')

@section('title', 'Persetujuan Registrasi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Registrasi</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Event</th>
                                    <th>Peserta</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Status Data</th>
                                    <th>Status Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($registrations as $registration)
                                <tr>
                                    <td>{{ $registration->id }}</td>
                                    <td>{{ $registration->registrationForm->event->title }}</td>
                                    <td>{{ $registration->participant_data['name'] ?? 'N/A' }}</td>
                                    <td>{{ $registration->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        @if($registration->data_approved)
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-warning">Menunggu</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($registration->payment_approved)
                                            <span class="badge bg-success">Disetujui</span>
                                        @elseif($registration->transfer_receipt)
                                            <span class="badge bg-info">Ada Bukti Transfer</span>
                                        @else
                                            <span class="badge bg-secondary">Belum Upload</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.registration-approvals.show', $registration) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data registrasi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $registrations->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
