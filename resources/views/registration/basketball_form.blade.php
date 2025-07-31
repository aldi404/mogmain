@extends('user.layouts.app')

@section('title', 'Basketball Registration - ' . $form->event->title)

@section('content')
<div class="container py-5" style="padding-top: 120px !important;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3>{{ $form->event->title }}</h3>
                    <p class="mb-0">{{ $form->form_title }}</p>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('registrasi.store', $form) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- INFORMASI SEKOLAH -->
                        <div class="section-header">
                            <h4><i class="fas fa-school"></i> Informasi Sekolah</h4>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_sekolah" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Logo Sekolah <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="logo_sekolah" accept="image/*" required>
                            </div>
                        </div>

                        <!-- OFFICIAL TEAM -->
                        <div class="section-header">
                            <h4><i class="fas fa-users"></i> Official Team</h4>
                        </div>

                        <!-- Manager -->
                        <div class="official-section">
                            <h5>Manager</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="manager_nama" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tempat Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="manager_ttl" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Foto KTP/Identitas <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="manager_ktp" accept="image/*,application/pdf" required>
                                </div>
                            </div>
                        </div>

                        <!-- Head Coach -->
                        <div class="official-section">
                            <h5>Head Coach</h5>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="head_coach_nama" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Tempat Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="head_coach_ttl" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Foto KTP/Identitas <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="head_coach_ktp" accept="image/*,application/pdf" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Lisensi Pelatih (Min. C) <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="head_coach_lisensi" accept="image/*,application/pdf" required>
                                </div>
                            </div>
                        </div>

                        <!-- FORM PEMAIN -->
                        <div class="section-header">
                            <h4><i class="fas fa-basketball-ball"></i> Data Pemain (1-12)</h4>
                        </div>

                        <div id="players-container">
                            @for($i = 1; $i <= 12; $i++)
                            <div class="player-section" data-player="{{ $i }}">
                                <h5>Pemain {{ $i }}</h5>
                                <div class="row">
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">Nama Pemain <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="pemain_{{ $i }}_nama" required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">Tempat Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="pemain_{{ $i }}_ttl" required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">Nomor Jersey <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control jersey-input" name="pemain_{{ $i }}_jersey" min="1" max="99" required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">Posisi <span class="text-danger">*</span></label>
                                        <select class="form-select" name="pemain_{{ $i }}_posisi" required>
                                            <option value="">Pilih Posisi</option>
                                            <option value="Point Guard">Point Guard</option>
                                            <option value="Shooting Guard">Shooting Guard</option>
                                            <option value="Small Forward">Small Forward</option>
                                            <option value="Power Forward">Power Forward</option>
                                            <option value="Center">Center</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">Akte (Foto Asli) <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="pemain_{{ $i }}_akte" accept="image/*,application/pdf" required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">NISN/Sampul Raport <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="pemain_{{ $i }}_nisn" accept="image/*,application/pdf" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Foto Pemain <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="pemain_{{ $i }}_foto" accept="image/*" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">BPJS-TK (Atlet) <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="pemain_{{ $i }}_bpjs" accept="image/*,application/pdf" required>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane"></i> Submit Registrasi Tim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.section-header {
    background: linear-gradient(135deg, #0c724c, #0f5132);
    color: white;
    padding: 15px;
    margin: 30px 0 20px 0;
    border-radius: 8px;
}

.section-header h4 {
    margin: 0;
    font-weight: 600;
}

.official-section, .player-section {
    background: #f8f9fa;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    border-left: 4px solid #0c724c;
}

.official-section h5, .player-section h5 {
    color: #0c724c;
    font-weight: 600;
    margin-bottom: 15px;
}

.jersey-input {
    text-align: center;
    font-weight: bold;
}
</style>
@endpush

@push('scripts')
<script>
// Validasi nomor jersey unik
document.addEventListener('DOMContentLoaded', function() {
    const jerseyInputs = document.querySelectorAll('.jersey-input');
    
    jerseyInputs.forEach(input => {
        input.addEventListener('change', function() {
            const currentValue = this.value;
            const currentInput = this;
            
            jerseyInputs.forEach(otherInput => {
                if (otherInput !== currentInput && otherInput.value === currentValue) {
                    alert('Nomor jersey harus unik! Nomor ' + currentValue + ' sudah digunakan.');
                    currentInput.value = '';
                    currentInput.focus();
                }
            });
        });
    });
});
</script>
@endpush
@endsection
