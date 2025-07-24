<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Events Gallery - MOGMAIN</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets_user/img/favicon.png')}}" rel="icon">
    <link href="{{ asset('assets_user/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets_user/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Font Awesome Kits -->
    <script src="https://kit.fontawesome.com/8444d5e836.js" crossorigin="anonymous"></script>

    <!-- Main CSS File -->
    <link href="{{ asset('assets_user/css/main.css')}}" rel="stylesheet">
</head>

<body class="events-page">
    @include('user.header')

    <main class="main">
        <!-- Page Title -->
        <section class="page-title main-background">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 data-aos="fade-up">Events Gallery</h1>
                        <p data-aos="fade-up" data-aos-delay="100">Discover our amazing events and memorable experiences
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Events Gallery Section -->
        <section class="events-gallery section main-background">
            <div class="container">

                <!-- EXHIBITION -->
                <div class="event-category text-center" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="category-title">EXHIBITION</h2>
                    <div class="row gallery-grid justify-content-center">
                        @for($i = 1; $i <= 6; $i++)
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="gallery-item">
                                <a href="{{ asset('assets_user/img/event/exhibition_'.$i.'.png') }}" class="glightbox">
                                    <img src="{{ asset('assets_user/img/event/exhibition_'.$i.'.png') }}" alt="Exhibition {{ $i }}">
                                    <div class="gallery-overlay">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- FESTIVAL -->
                <div class="event-category text-center" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="category-title">FESTIVAL</h2>
                    <div class="row gallery-grid justify-content-center">
                        @for($i = 1; $i <= 4; $i++)
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="gallery-item">
                                <a href="{{ asset('assets_user/img/event/festival_'.$i.'.png') }}" class="glightbox">
                                    <img src="{{ asset('assets_user/img/event/festival_'.$i.'.png') }}" alt="Festival {{ $i }}">
                                    <div class="gallery-overlay">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- RUNNING -->
                <div class="event-category text-center" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="category-title">RUNNING</h2>
                    <div class="row gallery-grid justify-content-center">
                        @for($i = 1; $i <= 3; $i++)
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="gallery-item">
                                <a href="{{ asset('assets_user/img/event/running_'.$i.'.png') }}" class="glightbox">
                                    <img src="{{ asset('assets_user/img/event/running_'.$i.'.png') }}" alt="Running {{ $i }}">
                                    <div class="gallery-overlay">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- BASKETBALL -->
                <div class="event-category text-center" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="category-title">BASKETBALL</h2>
                    <div class="row gallery-grid justify-content-center">
                        @for($i = 1; $i <= 3; $i++)
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="gallery-item">
                                <a href="{{ asset('assets_user/img/event/basketball_'.$i.'.png') }}" class="glightbox">
                                    <img src="{{ asset('assets_user/img/event/basketball_'.$i.'.png') }}" alt="Basketball {{ $i }}">
                                    <div class="gallery-overlay">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- COMBAT SPORT -->
                <div class="event-category text-center" data-aos="fade-up" data-aos-delay="500">
                    <h2 class="category-title">COMBAT SPORT</h2>
                    <div class="row gallery-grid justify-content-center">
                        @for($i = 1; $i <= 4; $i++)
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="gallery-item">
                                <a href="{{ asset('assets_user/img/event/combat_sport_'.$i.'.png') }}" class="glightbox">
                                    <img src="{{ asset('assets_user/img/event/combat_sport_'.$i.'.png') }}" alt="Combat Sport {{ $i }}">
                                    <div class="gallery-overlay">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- MICE -->
                <div class="event-category text-center" data-aos="fade-up" data-aos-delay="600">
                    <h2 class="category-title">MICE (Meetings, Incentives, Conferences & Exhibitions)</h2>
                    <div class="row gallery-grid justify-content-center">
                        @for($i = 1; $i <= 3; $i++)
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="gallery-item">
                                <a href="{{ asset('assets_user/img/event/meetings_'.$i.'.png') }}" class="glightbox">
                                    <img src="{{ asset('assets_user/img/event/meetings_'.$i.'.png') }}" alt="MICE {{ $i }}">
                                    <div class="gallery-overlay">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

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
    <script src="{{ asset('assets_user/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets_user/vendor/aos/aos.js')}}"></script>
    <script src="{{ asset('assets_user/vendor/glightbox/js/glightbox.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets_user/js/main.js')}}"></script>

    <script>
        // ...existing code...
    </script>

</body>
</html>
