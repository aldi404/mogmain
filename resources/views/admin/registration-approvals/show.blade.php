@extends('admin.layouts.app')

@section('title', 'Detail Registrasi #' . $registration->id)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning">{{ session('warning') }}</div>
            @endif
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Registrasi #{{ $registration->id }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.registration-approvals.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Info Event -->
                        <div class="col-md-6">
                            <h5>Informasi Event</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Event:</td>
                                    <td><strong>{{ $registration->registrationForm->event->title }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Event:</td>
                                    <td>{{ $registration->registrationForm->event->event_date->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Lokasi:</td>
                                    <td>{{ $registration->registrationForm->event->location }}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <!-- Status -->
                        <div class="col-md-6">
                            <h5>Status Persetujuan</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Status Data:</td>
                                    <td>
                                        @if($registration->data_approved)
                                            <span class="badge bg-success">Disetujui</span>
                                            <br><small>oleh {{ $registration->dataApprovedBy->name ?? 'N/A' }}</small>
                                            <br><small>{{ $registration->data_approved_at?->format('d M Y H:i') }}</small>
                                        @else
                                            <span class="badge bg-warning">Menunggu Persetujuan</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status Pembayaran:</td>
                                    <td>
                                        @if($registration->payment_approved)
                                            <span class="badge bg-success">Disetujui</span>
                                            <br><small>oleh {{ $registration->paymentApprovedBy->name ?? 'N/A' }}</small>
                                            <br><small>{{ $registration->payment_approved_at?->format('d M Y H:i') }}</small>
                                        @elseif($registration->transfer_receipt)
                                            <span class="badge bg-info">Menunggu Verifikasi</span>
                                        @else
                                            <span class="badge bg-secondary">Belum Upload Bukti</span>
                                        @endif
                                    </td>
                                </tr>
                                @if($registration->invoice_number)
                                <tr>
                                    <td>Invoice:</td>
                                    <td>
                                        <strong>{{ $registration->invoice_number }}</strong>
                                        @if($registration->invoice_path)
                                            <br><a href="{{ Storage::url($registration->invoice_path) }}" 
                                                   target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                    
                    <!-- Data Peserta -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Data Peserta</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    @foreach($registration->participant_data as $key => $value)
                                        @if(!is_array($value))
                                        <tr>
                                            <td width="30%"><strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong></td>
                                            <td>
                                                @if(str_contains($value, 'registrations/'))
                                                    <a href="{{ Storage::url($value) }}" target="_blank" class="btn btn-sm btn-info">
                                                        <i class="fas fa-file"></i> Lihat File
                                                    </a>
                                                @else
                                                    {{ $value }}
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Data Repeatable (Pemain) -->
                    @foreach($registration->participant_data as $sectionName => $sectionData)
                        @if(is_array($sectionData) && count($sectionData) > 0 && is_array($sectionData[0]))
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>{{ ucwords(str_replace('_', ' ', $sectionName)) }}</h5>
                                @foreach($sectionData as $index => $item)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h6>{{ ucwords(str_replace('_', ' ', $sectionName)) }} {{ $index + 1 }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                @foreach($item as $key => $value)
                                                <tr>
                                                    <td width="30%"><strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong></td>
                                                    <td>
                                                        @if(str_contains($value, 'registrations/'))
                                                            <a href="{{ Storage::url($value) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-file"></i> Lihat File
                                                            </a>
                                                        @else
                                                            {{ $value }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    @endforeach
                    
                    <!-- Bukti Transfer -->
                    @if($registration->transfer_receipt)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Bukti Transfer</h5>
                            <div class="card">
                                <div class="card-body text-center">
                                    <a href="{{ Storage::url('bukti_transfer/' . $registration->transfer_receipt) }}" 
                                       target="_blank" class="btn btn-info">
                                        <i class="fas fa-image"></i> Lihat Bukti Transfer
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5>Aksi</h5>
                                    
                                    @if(!$registration->data_approved)
                                    <!-- Approve/Reject Data -->
                                    <div class="mb-3">
                                        <h6>Persetujuan Data:</h6>
                                        <form method="POST" action="{{ route('admin.registration-approvals.approve-data', $registration) }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success" onclick="return confirm('Setujui data registrasi ini?')">
                                                <i class="fas fa-check"></i> Setujui Data
                                            </button>
                                        </form>
                                        
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectDataModal">
                                            <i class="fas fa-times"></i> Tolak Data
                                        </button>
                                    </div>
                                    @endif
                                    
                                    @if($registration->data_approved && $registration->transfer_receipt && !$registration->payment_approved)
                                    <!-- Approve/Reject Payment -->
                                    <div class="mb-3">
                                        <h6>Persetujuan Pembayaran:</h6>
                                        <form method="POST" action="{{ route('admin.registration-approvals.approve-payment', $registration) }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success" onclick="return confirm('Setujui pembayaran ini?')">
                                                <i class="fas fa-check"></i> Setujui Pembayaran
                                            </button>
                                        </form>
                                        
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectPaymentModal">
                                            <i class="fas fa-times"></i> Tolak Pembayaran
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Data Modal -->
<div class="modal fade" id="rejectDataModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.registration-approvals.reject-data', $registration) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Data Registrasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rejection_reason" class="form-label">Alasan Penolakan:</label>
                        <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Payment Modal -->
<div class="modal fade" id="rejectPaymentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.registration-approvals.reject-payment', $registration) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rejection_reason" class="form-label">Alasan Penolakan:</label>
                        <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
