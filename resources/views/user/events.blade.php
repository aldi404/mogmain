<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Events Gallery - MOGMAIN</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets_user/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets_user/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets_user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Font Awesome Kits -->
    <script src="https://kit.fontawesome.com/8444d5e836.js" crossorigin="anonymous"></script>

    <!-- Main CSS File -->
    <link href="{{ asset('assets_user/css/main.css') }}" rel="stylesheet">
</head>

<body class="events-page">
    @include('user.header')

    <main class="main">
        <!-- Page Title -->
        <section class="page-title main-background">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 data-aos="fade-up">Our Events</h1>
                        <p data-aos="fade-up" data-aos-delay="100">Discover the variety of events we organize
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Events Gallery Section -->
        <section class="events-gallery section main-background">
            <div class="container">

                @php
                    $groupedEvents = $events->groupBy('category.name');
                @endphp

                @foreach ($groupedEvents as $categoryName => $categoryEvents)
                    <!-- {{ strtoupper($categoryName) }} -->
                    <div class="event-category text-center" data-aos="fade-up"
                        data-aos-delay="{{ 100 + $loop->index * 100 }}">
                        <h2 class="category-title">{{ strtoupper($categoryName) }}</h2>
                        <div class="row gallery-grid justify-content-center">
                            @foreach ($categoryEvents as $event)
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                    <div class="gallery-item"
                                        onclick="window.location.href='{{ route('user::event.detail', $event->id) }}'">
                                        @if ($event->images->isNotEmpty())
                                            <img src="{{ Storage::url($event->images->first()->image_path) }}"
                                                alt="{{ $event->event_name }}">
                                        @else
                                            <img src="{{ asset('assets_user/img/placeholder.png') }}"
                                                alt="Placeholder">
                                        @endif
                                        <div class="gallery-overlay">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                        <h4>{{ $event->event_name }}</h4>
                                        <p>{{ $event->description ?? 'Professional event management' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </section>

        <!-- CTA Section -->
        {{-- <section class="cta-section">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h2 class="cta-title" data-aos="fade-up">Ready to Create Your Event?</h2>
                        <p class="cta-description" data-aos="fade-up" data-aos-delay="100">
                            Let us help you create memorable experiences for your audience
                        </p>
                        <div class="cta-buttons" data-aos="fade-up" data-aos-delay="200">
                            <a href="{{ route('registrasi.index') }}" class="btn btn-primary btn-lg me-3">
                                <i class="fas fa-calendar-plus"></i> Register for Events
                            </a>
                            <a href="{{ route('user::contact') }}" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-phone"></i> Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    </main>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets_user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets_user/js/main.js') }}"></script>

    <script>
        // ...existing code...
    </script>

</body>

</html>
