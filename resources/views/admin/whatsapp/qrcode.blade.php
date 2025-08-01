@extends('admin.layouts.app')

@section('title', 'WhatsApp QR Scan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">WhatsApp QR Scanner</h3>
                        <a href="{{ route('admin.whatsapp.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Management
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">Whatsapp QR</h4>
                        </div>
                        <div class="col-6">

                        </div>
                    </div>
                    <!-- Filter Section -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body row">
                                        <div class="col-md-12">
                                            <center>
                                                <div id="qrcode"></div>
                                            </center>
                                        </div>
                                        <form action="{{ route('admin.whatsapp.store-qr') }}" method="post" id="form_submit">
                                            @csrf
                                            <input id="no_wa" type="hidden" name="no_wa">
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Try different QR Code library -->
<script src="https://unpkg.com/qrcode@1.5.3/build/qrcode.min.js"></script>

<script>
// Use vanilla JavaScript instead of jQuery
document.addEventListener('DOMContentLoaded', function() {
    console.log('QR Code page loaded');
    console.log('Token available:', '{{ $token ? "Yes" : "No" }}');
    console.log('WebSocket URL:', "{{ config('whatsapp.ws') }}/ws/48?token={{ substr($token, 0, 50) }}...");
    
    var qrCodeContainer = document.getElementById("qrcode");
    
    // Check if QRCode library is available
    console.log('QRCode available:', typeof QRCode !== 'undefined');
    console.log('window.QRCode:', typeof window.QRCode !== 'undefined');
    
    function makeCode(val) {
        try {
            console.log('Generating QR code with data:', val.substring(0, 50) + '...');
            
            // Clear existing content
            qrCodeContainer.innerHTML = '';
            
            // Try using QRCode library
            if (typeof QRCode !== 'undefined') {
                var qr = new QRCode(qrCodeContainer, {
                    text: val,
                    width: 500,
                    height: 500,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.M
                });
                console.log('QR code generated with QRCode library');
            } else {
                // Fallback: use canvas-based approach
                generateQRWithCanvas(val);
            }
        } catch (error) {
            console.error('QR code generation error:', error);
            generateQRFallback(val);
        }
    }
    
    function generateQRWithCanvas(val) {
        try {
            // Use online QR generator as image
            const img = document.createElement('img');
            img.src = `https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=${encodeURIComponent(val)}`;
            img.style.border = '1px solid #ddd';
            img.style.borderRadius = '8px';
            img.onload = function() {
                console.log('QR code generated with online service');
            };
            img.onerror = function() {
                console.error('Online QR service failed');
                generateQRFallback(val);
            };
            qrCodeContainer.appendChild(img);
        } catch (error) {
            console.error('Canvas QR generation error:', error);
            generateQRFallback(val);
        }
    }
    
    function generateQRFallback(val) {
        qrCodeContainer.innerHTML = `
            <div class="alert alert-warning text-center">
                <h6>QR Code Generation Failed</h6>
                <p>Data: ${val.substring(0, 100)}...</p>
                <small>Please try refreshing the page or contact support</small>
            </div>
        `;
    }
    
    // Test QR generation first with a simple string
    setTimeout(function() {
        console.log('Testing QR code generation...');
        makeCode('TEST_QR_CODE_' + Date.now());
    }, 1000);

    // WebSocket connection
    try {
        const wsUrl = "{{ config('whatsapp.ws') }}/ws/48?token={{ $token }}";
        console.log('Attempting WebSocket connection to:', wsUrl);
        
        const socket = new WebSocket(wsUrl);

        socket.addEventListener("open", (event) => {
            console.log("✅ Connected to WebSocket server");
            // Clear test QR and show connecting message
            qrCodeContainer.innerHTML = '<div class="alert alert-info text-center">📡 Connected! Requesting QR code...</div>';
            
            socket.send(JSON.stringify({
                content: "ok",
                route: "get_code"
            }));
            console.log("📤 Sent get_code request");
        });

        socket.addEventListener("message", (event) => {
            console.log('📥 Message from server:', event.data);
            let data = {};
            try {
                data = JSON.parse(event.data);
                console.log('📊 Parsed data:', data);
            } catch (error) {
                console.error('❌ JSON parse error:', error);
                data = {};
            }
            
            if (data?.code) {
                console.log('🎯 QR Code received, length:', data.code.length);
                makeCode(data.code);
            }
            
            if (data?.jid) {
                console.log('📱 WhatsApp JID received:', data.jid);
                document.getElementById('no_wa').value = data.jid;
                qrCodeContainer.innerHTML = '<div class="alert alert-success text-center">✅ WhatsApp Connected! Saving...</div>';
                setTimeout(() => {
                    document.getElementById('form_submit').submit();
                }, 1500);
            }
            
            if (data?.error) {
                console.error('❌ Server error:', data.error);
                qrCodeContainer.innerHTML = '<div class="alert alert-danger text-center">❌ Server Error: ' + data.error + '</div>';
            }
        });

        socket.addEventListener("error", (event) => {
            console.error("❌ WebSocket error:", event);
            qrCodeContainer.innerHTML = '<div class="alert alert-warning text-center">❌ WebSocket connection failed. Check network connection.</div>';
        });

        socket.addEventListener("close", (event) => {
            console.log("🔌 WebSocket connection closed:", event.code, event.reason);
            if (event.code !== 1000) {
                qrCodeContainer.innerHTML = '<div class="alert alert-warning text-center">🔌 Connection closed. Code: ' + event.code + '</div>';
            }
        });
        
    } catch (wsError) {
        console.error('❌ WebSocket initialization error:', wsError);
        qrCodeContainer.innerHTML = '<div class="alert alert-danger text-center">❌ WebSocket failed: ' + wsError.message + '</div>';
    }
});
</script>
@endpush

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

#qrcode {
    min-height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #f8f9fa;
}

#qrcode .alert {
    margin: 0;
    max-width: 400px;
    text-align: center;
}

#qrcode canvas,
#qrcode img {
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.spinner-border-sm {
    width: 1rem;
    height: 1rem;
}

#qr-loading {
    display: block;
}

.collapse .card-body {
    font-size: 12px;
    text-align: left;
}

code {
    word-break: break-all;
}
</style>
@endpush