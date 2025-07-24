@extends('user.layouts.app')

@section('title', 'Event Registration')

@section('content')
<div class="container py-5" style="padding-top: 20px !important;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-5">
                <h2 class="display-4 text-white mb-3">Event Registration</h2>
                <p class="lead text-white-50">Register for our upcoming events and be part of amazing experiences</p>
            </div>
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Debug Information (remove this in production) --}}
            {{-- @if(config('app.debug'))
                <div class="alert alert-info">
                    <strong>Debug Info:</strong>
                    <ul class="mb-0">
                        <li>Total Events in Database: {{ \App\Models\Event::count() }}</li>
                        <li>Published Events: {{ \App\Models\Event::where('status', 'published')->count() }}</li>
                        <li>Future Events: {{ \App\Models\Event::where('event_date', '>=', now())->count() }}</li>
                        <li>Active Registration Forms: {{ \App\Models\RegistrationForm::where('is_active', true)->count() }}</li>
                        <li>Open Registration Forms: {{ \App\Models\RegistrationForm::where('is_active', true)->where('registration_start', '<=', now())->where('registration_end', '>=', now())->count() }}</li>
                        <li>Current Time: {{ now()->format('Y-m-d H:i:s') }}</li>
                    </ul>
                </div>
            @endif --}}
            
            @if($events->count() > 0)
                <div class="row">
                    @foreach($events as $event)
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 shadow-lg border-0" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);">
                            @if($event->banner_image)
                                <img src="{{ Storage::url($event->banner_image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            @endif
                            
                            <div class="card-body text-white">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title">{{ $event->title }}</h5>
                                    <span class="badge bg-primary">{{ ucfirst(str_replace('_', ' ', $event->event_type)) }}</span>
                                </div>
                                
                                <p class="card-text">{{ Str::limit($event->description, 150) }}</p>
                                
                                <div class="event-details mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-calendar text-primary me-2"></i>
                                        <span>{{ $event->event_date->format('F d, Y') }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <span>{{ $event->location }}</span>
                                    </div>
                                    @if($event->registration_fee)
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-money-bill text-primary me-2"></i>
                                            <span>Rp {{ number_format($event->registration_fee, 0, ',', '.') }}</span>
                                        </div>
                                    @endif
                                    @if($event->max_participants)
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-users text-primary me-2"></i>
                                            <span>Max {{ $event->max_participants }} participants</span>
                                        </div>
                                    @endif
                                </div>
                                
                                @php
                                    $form = $event->activeRegistrationForm;
                                    $registrationCount = $form ? $form->registrations->count() : 0;
                                @endphp
                                
                                @if($form)
                                    <div class="registration-info mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-white-50">
                                                Registration: {{ $form->registration_start->format('M d') }} - {{ $form->registration_end->format('M d, Y') }}
                                            </small>
                                            @if($form->isRegistrationOpen())
                                                <span class="badge bg-success">Open</span>
                                            @else
                                                <span class="badge bg-warning">Closed</span>
                                            @endif
                                        </div>
                                        
                                        @if($event->max_participants)
                                            <div class="progress mt-2" style="height: 6px;">
                                                <div class="progress-bar" role="progressbar" 
                                                     style="width: {{ ($registrationCount / $event->max_participants) * 100 }}%"></div>
                                            </div>
                                            <small class="text-white-50">{{ $registrationCount }} / {{ $event->max_participants }} registered</small>
                                        @else
                                            <small class="text-white-50">{{ $registrationCount }} registered</small>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            
                            <div class="card-footer bg-transparent border-0">
                                @if($form && $form->isRegistrationOpen())
                                    @if(!$event->max_participants || $registrationCount < $event->max_participants)
                                        <a href="{{ route('registrasi.show', $form) }}" class="btn btn-primary w-100">
                                            <i class="fas fa-user-plus"></i> Register Now
                                        </a>
                                    @else
                                        <button class="btn btn-secondary w-100" disabled>
                                            <i class="fas fa-times"></i> Event Full
                                        </button>
                                    @endif
                                @else
                                    <button class="btn btn-secondary w-100" disabled>
                                        <i class="fas fa-clock"></i> Registration Closed
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-4x text-white-50 mb-4"></i>
                    <h4 class="text-white mb-3">No Events Available</h4>
                    <p class="text-white-50 mb-4">There are currently no events open for registration.</p>
                    <a href="{{ route('user::index') }}" class="btn btn-primary">
                        <i class="fas fa-home"></i> Back to Home
                    </a>
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

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.3) !important;
}

.progress {
    background-color: rgba(255,255,255,0.2);
}

.progress-bar {
    background-color: #28a745;
}

.btn-primary {
    background-color: #0c724c;
    border-color: #0c724c;
}

.btn-primary:hover {
    background-color: #0f5132;
    border-color: #0f5132;
}

/* Fix for header overlap */
.main {
    padding-top: 100px;
}

/* Additional spacing for registration page */
.container {
    margin-top: 20px;
}
</style>
@endpush
