@extends('user.layouts.app')

@section('title', 'Registration Form - Kejuaraan Kota tahun 2025 ')

@section('content')
<div class="container py-5" style="padding-top: 20px !important;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="card shadow-lg border-0" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1 text-white">Unggah Bukti Bayar</h4>
                            <p class="mb-0 opacity-75">Kejuaraan Kota tahun 2025</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    
                    <form action="{{ route('registrasi.store_bukti', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-5">
                                Atas Nama: {{ $data['participant_data']['name'] }}
                                <br>
                                Alamat: {{ $data['participant_data']['address'] ?? '-' }}
                                <br>
                                No Hp: {{ $data['participant_data']['phone'] ?? '-' }}
                            </div>
                            <div class="col-12 mb-2">
                                <label for="">Bukti Bayar</label>
                                <input type="file" name="bukti" id="" required class="form-control">
                                <small>
                                    Allowed formats: jpg,jpeg,png,pdf (Max: 2048KB) 
                                </small>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            {{-- <a href="{{ route('registrasi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Events
                            </a> --}}
                            <button type="submit" class="btn btn-primary w-50 mt-4">
                                <i class="fas fa-paper-plane"></i> Unggah Bukti Bayar
                            </button>
                        </div>
                    </form>
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
