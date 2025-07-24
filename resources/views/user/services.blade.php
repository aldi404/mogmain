<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Services - MOGMAIN</title>
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
                    <div class="col-lg-12 text-center">
                        <h1 data-aos="fade-up">Service Portfolio</h1>
                        <p data-aos="fade-up" data-aos-delay="100">Comprehensive solutions for all your event needs
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Gallery Section -->
        <section class="events-gallery section main-background">
            <div class="container">

                <!-- MANPOWER SERVICE -->
                <div class="event-category text-center" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="category-title">MANPOWER SERVICE (EVENT SELLING AND SAMPLING)</h2>
                    <div class="row gallery-grid justify-content-center">
                        @for($i = 1; $i <= 4; $i++)
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                            <div class="gallery-item">
                                <a href="{{ asset('assets_user/img/event/manpower_service_'.$i.'.png') }}" class="glightbox">
                                    <img src="{{ asset('assets_user/img/event/manpower_service_'.$i.'.png') }}" alt="Manpower Service {{ $i }}">
                                    <div class="gallery-overlay">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- SPECIAL BOOTH -->
                <div class="event-category text-center" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="category-title">SPECIAL BOOTH</h2>
                    <div class="row gallery-grid justify-content-center">
                        @for($i = 1; $i <= 6; $i++)
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                            <div class="gallery-item">
                                <a href="{{ asset('assets_user/img/event/special_booth_'.$i.'.png') }}" class="glightbox">
                                    <img src="{{ asset('assets_user/img/event/special_booth_'.$i.'.png') }}" alt="Special Booth {{ $i }}">
                                    <div class="gallery-overlay">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- EVENT EQUIPMENT -->
                <div class="event-category text-center" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="category-title">EVENT EQUIPMENT</h2>
                    <div class="row gallery-grid justify-content-center">
                        @for($i = 1; $i <= 7; $i++)
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                            <div class="gallery-item">
                                <a href="{{ asset('assets_user/img/event/event_equipment_'.$i.'.png') }}" class="glightbox">
                                    <img src="{{ asset('assets_user/img/event/event_equipment_'.$i.'.png') }}" alt="Event Equipment {{ $i }}">
                                    <div class="gallery-overlay">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- ADVERTISING -->
                <div class="event-category text-center" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="category-title">ADVERTISING</h2>
                    <div class="row gallery-grid justify-content-center">
                        @for($i = 1; $i <= 3; $i++)
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                            <div class="gallery-item">
                                <a href="{{ asset('assets_user/img/event/advertising_'.$i.'.png') }}" class="glightbox">
                                    <img src="{{ asset('assets_user/img/event/advertising_'.$i.'.png') }}" alt="Advertising {{ $i }}">
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
                        <h2 class="cta-title" data-aos="fade-up">Need Our Services?</h2>
                        <p class="cta-description" data-aos="fade-up" data-aos-delay="100">
                            Let us help you create memorable experiences with our comprehensive event services
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

            // Dropdown functionality
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach((dropdown, index) => {
                const dropdownToggle = dropdown.querySelector('.dropdown-toggle');
                const dropdownMenu = dropdown.querySelector('.dropdown-menu');
                
                if (dropdownMenu) {
                    dropdown.addEventListener('mouseenter', () => {
                        dropdownMenu.style.setProperty('opacity', '1', 'important');
                        dropdownMenu.style.setProperty('visibility', 'visible', 'important');
                        dropdownMenu.style.setProperty('transform', 'translateX(-50%) translateY(0)', 'important');
                    });
                    
                    dropdown.addEventListener('mouseleave', () => {
                        dropdownMenu.style.setProperty('opacity', '0', 'important');
                        dropdownMenu.style.setProperty('visibility', 'hidden', 'important');
                        dropdownMenu.style.setProperty('transform', 'translateX(-50%) translateY(-10px)', 'important');
                    });
                    
                    dropdownMenu.addEventListener('mouseenter', () => {
                        dropdownMenu.style.setProperty('opacity', '1', 'important');
                        dropdownMenu.style.setProperty('visibility', 'visible', 'important');
                        dropdownMenu.style.setProperty('transform', 'translateX(-50%) translateY(0)', 'important');
                    });
                }
            });

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
