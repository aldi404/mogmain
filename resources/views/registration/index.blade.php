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
                                    $form = $event->registrationForms->first();
                                    $registrationCount = $form ? $form->registrations->count() : 0;
                                    $isComingSoon = $form && $form->registration_start > now();
                                    $isOpen = $form && $form->isRegistrationOpen();
                                    $isClosed = $form && $form->registration_end < now();
                                @endphp
                                
                                @if($form)
                                    <div class="registration-info mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-white-50">
                                                Registration: {{ $form->registration_start->format('M d') }} - {{ $form->registration_end->format('M d, Y') }}
                                            </small>
                                            @if($isComingSoon)
                                                <span class="badge bg-info">Coming Soon</span>
                                            @elseif($isOpen)
                                                <span class="badge bg-success">Open</span>
                                            @else
                                                <span class="badge bg-warning">Closed</span>
                                            @endif
                                        </div>
                                        
                                        @if($isComingSoon)
                                            <div class="mt-2">
                                                <small class="text-info">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Registration opens on {{ $form->registration_start->format('F d, Y \a\t H:i') }}
                                                </small>
                                                <div class="countdown-timer mt-2" data-target="{{ $form->registration_start->toISOString() }}">
                                                    <div class="countdown-display">
                                                        <div class="countdown-item">
                                                            <span class="countdown-number days">00</span>
                                                            <span class="countdown-label">Days</span>
                                                        </div>
                                                        <div class="countdown-item">
                                                            <span class="countdown-number hours">00</span>
                                                            <span class="countdown-label">Hours</span>
                                                        </div>
                                                        <div class="countdown-item">
                                                            <span class="countdown-number minutes">00</span>
                                                            <span class="countdown-label">Minutes</span>
                                                        </div>
                                                        <div class="countdown-item">
                                                            <span class="countdown-number seconds">00</span>
                                                            <span class="countdown-label">Seconds</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if($event->max_participants)
                                            <div class="progress mt-2" style="height: 6px;">
                                                <div class="progress-bar" role="progressbar" 
                                                     style="width: {{ ($registrationCount / $event->max_participants) * 100 }}%"></div>
                                            </div>
                                            <small class="text-white-50">{{ $registrationCount }} / {{ $event->max_participants }} registered</small>
                                        @else
                                            {{-- <small class="text-white-50">{{ $registrationCount }} registered</small> --}}
                                        @endif
                                    </div>
                                @endif
                            </div>
                            
                            <div class="card-footer bg-transparent border-0">
                                @if($isComingSoon)
                                    <button class="btn btn-info w-100" disabled>
                                        <i class="fas fa-clock"></i> Coming Soon
                                    </button>
                                @elseif($form && $isOpen)
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

.btn-info {
    background-color: #17a2b8;
    border-color: #17a2b8;
    color: #fff;
}

.btn-info:disabled {
    background-color: #17a2b8;
    border-color: #17a2b8;
    opacity: 0.8;
}

.badge.bg-info {
    background-color: #17a2b8 !important;
}

.text-info {
    color: #17a2b8 !important;
}

/* Fix for header overlap */
.main {
    padding-top: 100px;
}

/* Additional spacing for registration page */
.container {
    margin-top: 20px;
}

/* Countdown timer styles */
.countdown-timer {
    display: flex;
    justify-content: space-between;
    font-size: 0.875rem;
}

.countdown-item {
    text-align: center;
    display: flex;
    flex-direction: column; /* angka di atas label */
    align-items: center;
}

.countdown-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: #17a2b8;
}
.countdown-display {
    display: flex;
    justify-content: center; /* agar di tengah */
    gap: 15px; /* jarak antar item */
}

/* .countdown-item {
    display: flex;
    flex-direction: column;
    align-items: center;
} */

</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Countdown timer initialization
    document.querySelectorAll('.countdown-timer').forEach(function (timer) {
        var targetDate = new Date(timer.getAttribute('data-target'));
        var daysElem = timer.querySelector('.days');
        var hoursElem = timer.querySelector('.hours');
        var minutesElem = timer.querySelector('.minutes');
        var secondsElem = timer.querySelector('.seconds');

        function updateCountdown() {
            var now = new Date();
            var diff = Math.max(0, targetDate - now);

            var days = Math.floor(diff / (1000 * 60 * 60 * 24));
            var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((diff % (1000 * 60)) / 1000);

            daysElem.textContent = String(days).padStart(2, '0');
            hoursElem.textContent = String(hours).padStart(2, '0');
            minutesElem.textContent = String(minutes).padStart(2, '0');
            secondsElem.textContent = String(seconds).padStart(2, '0');

            if (diff <= 0) {
                clearInterval(interval);
            }
        }

        var interval = setInterval(updateCountdown, 1000);
        updateCountdown();
    });
});
</script>
@endpush
