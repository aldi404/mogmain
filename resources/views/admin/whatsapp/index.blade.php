@extends('admin.layouts.app')

@section('title', 'WhatsApp Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">WhatsApp API Management (Redis)</h3>
                </div>
                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Connection Status -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Connection Status</h5>
                                </div>
                                <div class="card-body">
                                    @if($status['connected'])
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success me-2">Connected</span>
                                            <span class="text-success">WhatsApp API is connected (Redis)</span>
                                        </div>
                                        <small class="text-muted">Cache Driver: {{ $status['cache_driver'] }}</small>
                                        <div class="mt-3">
                                            <form action="{{ route('admin.whatsapp.disconnect') }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Disconnect</button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-danger me-2">Disconnected</span>
                                            <span class="text-danger">WhatsApp API is not connected</span>
                                        </div>
                                        <small class="text-muted">Cache Driver: {{ $status['cache_driver'] }}</small>
                                        <div class="mt-3">
                                            <form action="{{ route('admin.whatsapp.test-connection') }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">Connect</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Sender Numbers -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Sender Numbers ({{ count($noWas) }})</h5>
                                </div>
                                <div class="card-body">
                                    @if(!empty($noWas))
                                        @foreach($noWas as $index => $number)
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="badge bg-info">{{ $number }}</span>
                                                <form action="{{ route('admin.whatsapp.delete') }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="index" value="{{ $index }}">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">Remove</button>
                                                </form>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted">No sender numbers configured</p>
                                    @endif

                                    <!-- Add Sender Number Form -->
                                    <hr>
                                    <div class="mb-3">
                                        <h6>Tambah Nomor Manual:</h6>
                                        <form action="{{ route('admin.whatsapp.store') }}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="no_wa" 
                                                       placeholder="08123456789" required>
                                                <button type="submit" class="btn btn-primary">Add Number</button>
                                            </div>
                                            <small class="text-muted">Format: 08123456789 atau 628123456789</small>
                                        </form>
                                    </div>
                                    
                                    <div class="text-center">
                                        <p class="text-muted mb-2">atau</p>
                                        <div class="btn-group d-block">
                                            <a href="{{ route('admin.whatsapp.qrcode') }}" class="btn btn-info me-2">
                                                <i class="fas fa-qrcode"></i> Scan QR Code
                                            </a>
                                            <form action="{{ route('admin.whatsapp.test-manual-add') }}" method="POST" style="display: inline;">
                                                @csrf
                                                {{-- <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-plus"></i> Add Test Number
                                                </button> --}}
                                            </form>
                                        </div>
                                        {{-- <small class="d-block text-muted mt-1">
                                            QR Code untuk production, Test Number untuk local development
                                        </small> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Test Messages -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Test Messages</h5>
                                </div>
                                <div class="card-body">
                                    
                                    <!-- Quick Test Dummy -->
                                    {{-- <div class="mb-4">
                                        <h6>Quick Test (Dummy Number):</h6>
                                        <p class="text-muted">Send test messages to dummy number (628123456789)</p>
                                        
                                        <div class="btn-group" role="group">
                                            <form action="{{ route('admin.whatsapp.test-send') }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success me-2" 
                                                        {{ !$status['connected'] || empty($noWas) ? 'disabled' : '' }}>
                                                    <i class="fas fa-paper-plane"></i> Send Test Message
                                                </button>
                                            </form>
                                        </div>
                                    </div> --}}

                                    <hr>

                                    <!-- Custom Message Form -->
                                    <div class="mb-4">
                                        <h6>Send Custom Message:</h6>
                                        <form action="{{ route('admin.whatsapp.send-custom') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="phone_number" class="form-label">Phone Number</label>
                                                        <input type="text" class="form-control" id="phone_number" name="phone_number" 
                                                               placeholder="08123456789 atau 628123456789" required
                                                               {{ !$status['connected'] || empty($noWas) ? 'disabled' : '' }}>
                                                        <small class="text-muted">Format: 08123456789 atau 628123456789</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="message" class="form-label">Message</label>
                                                        <textarea class="form-control" id="message" name="message" rows="3" 
                                                                  placeholder="Type your message here..." required
                                                                  {{ !$status['connected'] || empty($noWas) ? 'disabled' : '' }}>Test pesan custom dari {{ config('app.name') }} - {{ now()->format('Y-m-d H:i:s') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="mb-3">
                                                        <label class="form-label">&nbsp;</label>
                                                        <button type="submit" class="btn btn-primary w-100" 
                                                                {{ !$status['connected'] || empty($noWas) ? 'disabled' : '' }}>
                                                            <i class="fas fa-paper-plane"></i> Send Custom
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    @if(!$status['connected'])
                                        <div class="alert alert-warning mt-3">
                                            <small>Please connect to WhatsApp API first.</small>
                                        </div>
                                    @elseif(empty($noWas))
                                        <div class="alert alert-warning mt-3">
                                            <small>Please add sender number first.</small>
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
@endsection
