@extends('user.layouts.app')

@section('title', 'Registration Form - Kejuaraan Kota tahun 2025 ')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if($data->registrationForm->event->registration_fee && $data->registrationForm->event->registration_fee > 0)
                <!-- Paid Event Content -->
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-upload"></i> Upload Bukti Transfer</h4>
                    </div>
                    <div class="card-body">
                        <!-- Invoice Information -->
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle"></i> Informasi Pembayaran</h6>
                            <p><strong>Event:</strong> {{ $data->registrationForm->event->title }}</p>
                            <p><strong>Biaya:</strong> Rp {{ number_format($data->registrationForm->event->registration_fee, 0, ',', '.') }}</p>
                            @if($data->invoice_number)
                                <p><strong>Invoice:</strong> {{ $data->invoice_number }}</p>
                            @endif
                        </div>

                        <!-- Upload Form -->
                        <form action="{{ route('registrasi.store_bukti', $data->token) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="bukti" class="form-label">Upload Bukti Transfer</label>
                                <input type="file" class="form-control" id="bukti" name="bukti" 
                                       accept=".jpg,.jpeg,.png,.pdf" required>
                                <small class="text-muted">Format: JPG, PNG, PDF (Max: 2MB)</small>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-upload"></i> Upload Bukti Transfer
                                </button>
                            </div>
                        </form>

                        <!-- Links -->
                        <div class="text-center mt-4">
                            @if($data->invoice_number)
                                <a href="{{ route('registrasi.invoice', $data->token) }}" class="btn btn-info me-2" target="_blank">
                                    <i class="fas fa-file-pdf"></i> Download Invoice
                                </a>
                            @endif
                            <a href="{{ route('registrasi.status', $data->token) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i> Cek Status
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Free Event Content -->
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-check-circle"></i> Event Gratis</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="alert alert-success">
                            <h5><i class="fas fa-gift"></i> Selamat!</h5>
                            <p>Event <strong>{{ $data->registrationForm->event->title }}</strong> adalah event gratis.</p>
                            <p>Registrasi Anda sudah lengkap dan tidak memerlukan pembayaran.</p>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('registrasi.status', $data->token) }}" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Lihat Status Registrasi
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
body {
    background: linear-gradient(135deg, #0c724c, #0f5132);
    min-height: 100vh;
}

.btn-primary {
    background-color: #0c724c;
    border-color: #0c724c;
}

.btn-primary:hover {
    background-color: #0f5132;
    border-color: #0f5132;
}

.bg-primary {
    background-color: #0c724c !important;
}

/* Fix for header overlap */
.main {
    padding-top: 100px;
}

/* Additional spacing for form page */
.container {
    margin-top: 20px;
}

/* Banner image styling */
.event-banner img {
    border: 3px solid rgba(255, 255, 255, 0.3);
    transition: transform 0.3s ease;
}

.event-banner img:hover {
    transform: scale(1.02);
}
</style>
@endpush
