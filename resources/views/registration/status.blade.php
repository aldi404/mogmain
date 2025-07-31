@extends('user.layouts.app')

@section('title', 'Status Registrasi')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-chart-line"></i> Status Registrasi</h4>
                </div>
                <div class="card-body">
                    <!-- Info Registrasi -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Informasi Registrasi</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td>ID Registrasi:</td>
                                    <td><strong>#{{ $data->id }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Event:</td>
                                    <td><strong>{{ $data->registrationForm->event->title }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Daftar:</td>
                                    <td>{{ $data->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Status Saat Ini</h6>
                            <div class="alert alert-info">
                                <strong>{{ $data->status_label }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Timeline -->
                    <div class="row">
                        <div class="col-12">
                            <h6>Timeline Progress</h6>
                            <div class="timeline">
                                <!-- Step 1: Data Submitted -->
                                <div class="timeline-item completed">
                                    <div class="timeline-marker">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6>Data Berhasil Dikirim</h6>
                                        <p class="text-muted">{{ $data->created_at->format('d M Y H:i') }}</p>
                                    </div>
                                </div>

                                <!-- Step 2: Data Approved -->
                                <div class="timeline-item {{ $data->data_approved ? 'completed' : 'pending' }}">
                                    <div class="timeline-marker">
                                        @if($data->data_approved)
                                            <i class="fas fa-check"></i>
                                        @else
                                            <i class="fas fa-clock"></i>
                                        @endif
                                    </div>
                                    <div class="timeline-content">
                                        <h6>Verifikasi Data</h6>
                                        @if($data->data_approved)
                                            <p class="text-success">Disetujui oleh {{ $data->dataApprovedBy->name ?? 'Admin' }}</p>
                                            <p class="text-muted">{{ $data->data_approved_at->format('d M Y H:i') }}</p>
                                        @else
                                            <p class="text-warning">Menunggu verifikasi admin</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Step 3: Invoice Generated -->
                                @if($data->data_approved)
                                <div class="timeline-item completed">
                                    <div class="timeline-marker">
                                        <i class="fas fa-file-invoice"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6>Invoice Dibuat</h6>
                                        <p class="text-success">Invoice: {{ $data->invoice_number }}</p>
                                        @if($data->invoice_number)
                                            <a href="{{ route('registrasi.invoice', $data->id) }}" 
                                               target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-download"></i> Download Invoice PDF
                                            </a>
                                        @else
                                            <span class="text-muted">Invoice sedang diproses...</span>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                <!-- Step 4: Payment Upload -->
                                <div class="timeline-item {{ $data->transfer_receipt ? 'completed' : ($data->data_approved ? 'pending' : 'disabled') }}">
                                    <div class="timeline-marker">
                                        @if($data->transfer_receipt)
                                            <i class="fas fa-check"></i>
                                        @elseif($data->data_approved)
                                            <i class="fas fa-clock"></i>
                                        @else
                                            <i class="fas fa-times"></i>
                                        @endif
                                    </div>
                                    <div class="timeline-content">
                                        <h6>Upload Bukti Transfer</h6>
                                        @if($data->transfer_receipt)
                                            <p class="text-success">Bukti transfer berhasil di-upload</p>
                                            <a href="{{ Storage::url('bukti_transfer/' . $data->transfer_receipt) }}" 
                                               target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-image"></i> Lihat Bukti
                                            </a>
                                        @elseif($data->data_approved)
                                            <p class="text-warning">Silakan upload bukti transfer</p>
                                            <a href="{{ route('registrasi.upload_invoice', $data->id) }}" 
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-upload"></i> Upload Sekarang
                                            </a>
                                        @else
                                            <p class="text-muted">Menunggu verifikasi data terlebih dahulu</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Step 5: Payment Approved -->
                                <div class="timeline-item {{ $data->payment_approved ? 'completed' : ($data->transfer_receipt ? 'pending' : 'disabled') }}">
                                    <div class="timeline-marker">
                                        @if($data->payment_approved)
                                            <i class="fas fa-check"></i>
                                        @elseif($data->transfer_receipt)
                                            <i class="fas fa-clock"></i>
                                        @else
                                            <i class="fas fa-times"></i>
                                        @endif
                                    </div>
                                    <div class="timeline-content">
                                        <h6>Verifikasi Pembayaran</h6>
                                        @if($data->payment_approved)
                                            <p class="text-success">Pembayaran disetujui oleh {{ $data->paymentApprovedBy->name ?? 'Admin' }}</p>
                                            <p class="text-muted">{{ $data->payment_approved_at->format('d M Y H:i') }}</p>
                                        @elseif($data->transfer_receipt)
                                            <p class="text-warning">Menunggu verifikasi pembayaran</p>
                                        @else
                                            <p class="text-muted">Upload bukti transfer terlebih dahulu</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Step 6: Registration Complete -->
                                @if($data->payment_approved)
                                <div class="timeline-item completed">
                                    <div class="timeline-marker">
                                        <i class="fas fa-trophy"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6>Registrasi Selesai</h6>
                                        <p class="text-success">Selamat! Registrasi Anda telah selesai dan berhasil.</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            @if($data->data_approved && !$data->transfer_receipt)
                                <a href="{{ route('registrasi.upload_invoice', $data->id) }}" 
                                   class="btn btn-primary">
                                    <i class="fas fa-upload"></i> Upload Bukti Transfer
                                </a>
                            @endif
                            
                            @if($data->data_approved && $data->invoice_number)
                                <a href="{{ route('registrasi.invoice', $data->id) }}" 
                                   target="_blank" class="btn btn-success">
                                    <i class="fas fa-file-pdf"></i> Download Invoice PDF
                                </a>
                            @endif
                            
                            <button onclick="window.print()" class="btn btn-secondary">
                                <i class="fas fa-print"></i> Print Status
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 30px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    padding-left: 70px;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: 20px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    border: 2px solid #e9ecef;
    background: white;
}

.timeline-item.completed .timeline-marker {
    background: #28a745;
    border-color: #28a745;
    color: white;
}

.timeline-item.pending .timeline-marker {
    background: #ffc107;
    border-color: #ffc107;
    color: white;
}

.timeline-item.disabled .timeline-marker {
    background: #6c757d;
    border-color: #6c757d;
    color: white;
}

.timeline-content h6 {
    margin-bottom: 5px;
    font-weight: 600;
}

.timeline-item.completed .timeline-content h6 {
    color: #28a745;
}

.timeline-item.pending .timeline-content h6 {
    color: #ffc107;
}

.timeline-item.disabled .timeline-content h6 {
    color: #6c757d;
}
</style>
@endpush
