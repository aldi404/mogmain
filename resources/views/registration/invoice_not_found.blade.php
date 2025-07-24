@extends('user.layouts.app')

@section('title', 'Upss, Invoice Not Found')

@section('content')
<div class="container py-5" style="padding-top: 120px !important;">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 text-center" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                <div class="card-body py-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle fa-5x text-success"></i>
                    </div>
                    
                    <h2 class="text-warning mb-3">Invoice Not Available Yet</h2>
                    <p class="lead text-muted mb-4">
                        We're sorry, your invoice hasn't been created yet. Please contact our customer service for further assistance.
                    </p>
                    
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('registrasi.index') }}" class="btn btn-primary">
                            <i class="fas fa-calendar"></i> View More Events
                        </a>
                        <a href="{{ route('user::index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
                    </div>
                </div>
            </div>
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

.btn-outline-primary {
    color: #0c724c;
    border-color: #0c724c;
}

.btn-outline-primary:hover {
    background-color: #0c724c;
    border-color: #0c724c;
}

/* Fix for header overlap */
.main {
    padding-top: 100px;
}

/* Additional spacing for success page */
.container {
    margin-top: 20px;
}
</style>
@endpush
