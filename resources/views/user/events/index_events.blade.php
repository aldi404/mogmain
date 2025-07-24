<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Events - MOGMAIN</title>
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
                        <h1 data-aos="fade-up">Our Events</h1>
                        <p data-aos="fade-up" data-aos-delay="100">Explore our diverse portfolio of successful events</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Events Gallery Section -->
        <section class="events-gallery section main-background">
            <div class="container">
                
                <!-- EXHIBITION -->
                <div class="event-category" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="category-title">EXHIBITION</h2>
                    <div class="row gallery-grid">
                        @for($i = 1; $i <= 6; $i++)
                        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
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
                <div class="event-category" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="category-title">FESTIVAL</h2>
                    <div class="row gallery-grid">
                        @for($i = 1; $i <= 7; $i++)
                        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
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
                <div class="event-category" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="category-title">RUNNING</h2>
                    <div class="row gallery-grid">
                        @for($i = 1; $i <= 3; $i++)
                        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
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
                <div class="event-category" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="category-title">BASKETBALL</h2>
                    <div class="row gallery-grid">
                        @for($i = 1; $i <= 5; $i++)
                        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
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
                <div class="event-category" data-aos="fade-up" data-aos-delay="500">
                    <h2 class="category-title">COMBAT SPORT</h2>
                    <div class="row gallery-grid">
                        @for($i = 1; $i <= 5; $i++)
                        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
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
                <div class="event-category" data-aos="fade-up" data-aos-delay="600">
                    <h2 class="category-title">MEETINGS, INCENTIVES, CONVENTIONS, AND EXHIBITIONS</h2>
                    <div class="row gallery-grid">
                        @for($i = 1; $i <= 5; $i++)
                        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
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
    </main>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets_user/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets_user/vendor/aos/aos.js')}}"></script>
    <script src="{{ asset('assets_user/vendor/glightbox/js/glightbox.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets_user/js/main.js')}}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Initialize GLightbox
            const lightbox = GLightbox({
                selector: '.glightbox'
            });

            // Initialize AOS
            AOS.init();

            // Header scroll effect
            const header = document.getElementById('header');
            if (header) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 100) {
                        header.classList.add('scrolled');
                    } else {
                        header.classList.remove('scrolled');
                    }
                });
            }

            // Mobile nav functionality
            const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
            mobileNavLinks.forEach(link => {
                link.addEventListener('click', () => {
                    const mobileNav = document.getElementById('mobileNav');
                    if (mobileNav && mobileNav.classList.contains('active')) {
                        toggleMobileNav();
                    }
                });
            });
        });

        function toggleMobileNav() {
            const mobileNav = document.getElementById("mobileNav");
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            
            if (mobileNav && mobileMenuBtn) {
                mobileNav.classList.toggle("active");
                mobileMenuBtn.classList.toggle("active");
                document.body.classList.toggle("mobile-nav-active");
            }
        }
    </script>

</body>
</html>
