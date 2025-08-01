@extends('user.layouts.app')

@section('title', 'Menunggu Persetujuan')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0"><i class="fas fa-hourglass-half"></i> Menunggu Persetujuan Admin</h4>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-clock fa-5x text-warning mb-3"></i>
                        <h5>Data Anda Sedang Diverifikasi</h5>
                        <p class="text-muted">Admin sedang memeriksa data registrasi Anda. Mohon menunggu konfirmasi lebih lanjut.</p>
                    </div>
                    
                    <div class="alert alert-info">
                        <strong>Status:</strong> {{ $data->status_label }}
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted">Registrasi ID: {{ $data->id }}</small><br>
                        <small class="text-muted">Event: {{ $data->registrationForm->event->title }}</small><br>
                        <small class="text-muted">Tanggal Registrasi: {{ $data->created_at->format('d M Y H:i') }}</small>
                    </div>
                    
                    <a href="{{ route('registrasi.status', $data->token) }}" class="btn btn-primary">
                        <i class="fas fa-search"></i> Cek Status Pendaftaran
                    </a>

                    @if($data->data_approved && $data->invoice_number)
                        <a href="{{ route('registrasi.invoice', $data->token) }}" class="btn btn-primary" target="_blank">
                            <i class="fas fa-file-pdf"></i> Download Invoice
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
