@extends('admin.layouts.app')

@section('title', 'WhatsApp QR Code (HTTP Method)')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">WhatsApp QR Code (HTTP Method)</h3>
                        <a href="{{ route('admin.whatsapp.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Management
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="mb-4">QR Code WhatsApp (HTTP API)</h4>
                                    
                                    <!-- QR Code Display -->
                                    <div class="qr-container mb-4">
                                        <div id="qrcode-display">
                                            <!-- Generate QR Code from server data -->
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-info">
                                        <p>Scan QR code di atas dengan WhatsApp untuk menambahkan nomor pengirim.</p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const qrData = @json($qrCode);
    const container = document.getElementById('qrcode-display');
    
    QRCode.toCanvas(qrData, { width: 300, margin: 2 }, function (error, canvas) {
        if (error) {
            container.innerHTML = '<div class="alert alert-danger">Error generating QR code</div>';
        } else {
            container.appendChild(canvas);
        }
    });
});
</script>

@push('styles')
<style>
.qr-container {
    border: 2px dashed #dee2e6;
    border-radius: 10px;
    padding: 20px;
    background-color: #f8f9fa;
    min-height: 350px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
@endpush
@endsection
