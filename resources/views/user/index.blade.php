<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>MOGMAIN</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets_user/img/favicon.png')}}" rel="icon">
    <link href="{{ asset('assets_user/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets_user/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">

    <!-- Font Awesome Kits -->
    <script src="https://kit.fontawesome.com/8444d5e836.js" crossorigin="anonymous"></script>

    <!-- Main CSS File -->
    <link href="{{ asset('assets_user/css/main.css')}}" rel="stylesheet">




</head>

<body class="index-page">
    @include('user.header')

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section main-background">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <video style="width: 80%; margin: 0 10% 20%" autoplay muted loop id="video_mogmain">
                            <source src="{{ asset('assets_user/video/mogmain_video.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="col-lg-10">
                        <h2 data-aos="fade-up" data-aos-delay="100">MOGMAIN: Dynamic Event Organizers</h2>
                        <p data-aos="fade-up" data-aos-delay="200">Mogmain specializes in organizing diverse events and festivals, 
                            catering to various interests and age groups with flexible and engaging solutions
                        </p>
                    </div>
                    <div class="col-lg-5" data-aos="fade-up" data-aos-delay="300">
                        <form action="forms/newsletter.php" method="post" class="php-email-form">
                            <div class="sign-up-form"><input type="email" name="email" placeholder="Type your email"><input type="submit"
                                    value="Subscribe"></div>
                            {{-- <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your subscription request has been sent. Thank you!</div> --}}
                        </form>
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Highlight Videos Section -->
        <section id="highlight-videos" class="highlight-videos section main-background">
            <div class="container">
                <div class="row justify-content-center g-4">
                    <div class="col-lg-6 col-md-12 mb-4 d-flex justify-content-center">
                        <div class="ratio ratio-16x9 w-100" style="max-width: 600px;">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/169TRgWK5ro" title="Recap Jatim Warrior 3x3 Basketball Competition 2024 - Bank Jatim" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-4 d-flex justify-content-center">
                        <div class="ratio ratio-16x9 w-100" style="max-width: 600px;">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/SNMbnqVa-vE" title="Final Jatim Warrior 3x3 Basketball Competition" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Highlight Videos Section -->

        <!-- About Section -->
        <section id="about" class="about section main-background">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center" data-aos="fade-up" data-aos-delay="50">
                            <h2>About Us</h2>
                        </div>
                        
                        <div class="about-item text-center" data-aos="fade-up" data-aos-delay="100">
                            <div class="icon">
                                <img src="{{ asset('assets_user/img/about_us_1.png') }}" alt="Introduction">
                            </div>
                            <h3>Introduction:</h3>
                            <p>EBMA is a dynamic and creative event planning company, committed to delivering unique and impactful events</p>
                        </div>
                        
                        <div class="about-item text-center" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon">
                                <img src="{{ asset('assets_user/img/about_us_2.png') }}" alt="Values">
                            </div>
                            <h3>Values:</h3>
                            <p>We prioritize client satisfaction, meticulous planning, and seamless execution.</p>
                        </div>
                        
                        <div class="about-item text-center" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon">
                                <img src="{{ asset('assets_user/img/about_us_3.png') }}" alt="Services">
                            </div>
                            <h3>Services:</h3>
                            <p>We offer a wide array of event services, from concept development to full event management (all in one). Corporate events, Festivals, Sports, Exhibitions, Gatherings. We also rent event equipments & production.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /About Section -->

        <!-- Services Section -->
        <section id="services" class="services section main-background">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="section-title text-center" data-aos="fade-up" data-aos-delay="50">
                            <h2>Services</h2>
                        </div>
                        
                        <div class="services-diagram" data-aos="fade-up" data-aos-delay="100">
                            <img src="{{ asset('assets_user/img/services_main.png') }}" alt="EBMA Services Diagram" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Services Section -->

        <!-- Benefits Section -->
        <section id="benefits" class="benefits section main-background">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center" data-aos="fade-up" data-aos-delay="50">
                            <div class="benefits-icon-main mb-2">
                                <img src="{{ asset('assets_user/img/services_1.png') }}" alt="Benefits Icon">
                            </div>
                            <h2>Benefits of using Our Services</h2>
                        </div>
                        
                        <div class="benefits-grid">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="benefit-item">
                                    <div class="benefit-icon">
                                        <img src="{{ asset('assets_user/img/services_2.png') }}" alt="Time Savings">
                                    </div>
                                    <h4>Time Savings:</h4>
                                    <p>Handle the planning and execution, saving clients valuable time.</p>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-md-3 col-sm-6 col-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="benefit-item">
                                    <div class="benefit-icon">
                                        <img src="{{ asset('assets_user/img/services_3.png') }}" alt="Cost Savings">
                                    </div>
                                    <h4>Cost Savings:</h4>
                                    <p>Can negotiate better deals with vendors and manage budgets effectively.</p>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-md-3 col-sm-6 col-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="benefit-item">
                                    <div class="benefit-icon">
                                        <img src="{{ asset('assets_user/img/services_4.png') }}" alt="Expertise and Creativity">
                                    </div>
                                    <h4>Expertise and Creativity:</h4>
                                    <p>Bring expertise and creativity to the event, ensuring a memorable experience.</p>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-md-3 col-sm-6 col-6" data-aos="fade-up" data-aos-delay="400">
                                <div class="benefit-item">
                                    <div class="benefit-icon">
                                        <img src="{{ asset('assets_user/img/services_5.png') }}" alt="Reduced Stress">
                                    </div>
                                    <h4>Reduced Stress:</h4>
                                    <p>Clients can relax and enjoy the event without worrying about the logistic</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Benefits Section -->

        <!-- Clients Section -->
        <section id="clients" class="clients section main-background">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center" data-aos="fade-up" data-aos-delay="50">
                            <h2>Our Clients</h2>
                            {{-- <p>Trusted by leading companies and organizations</p> --}}
                        </div>
                        
                        <div class="clients-container" data-aos="fade-up" data-aos-delay="100">
                            <!-- First Row - Moving Left -->
                            <div class="clients-row">
                                <!-- Original logos -->
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_1.png') }}" alt="Client 1">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_2.png') }}" alt="Client 2">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_3.png') }}" alt="Client 3">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_4.png') }}" alt="Client 4">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_5.png') }}" alt="Client 5">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_6.jpg') }}" alt="Client 6">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_7.png') }}" alt="Client 7">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_8.png') }}" alt="Client 8">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_9.jpg') }}" alt="Client 9">
                                </div>
                                <!-- Duplicate for seamless loop -->
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_1.png') }}" alt="Client 1">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_2.png') }}" alt="Client 2">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_3.png') }}" alt="Client 3">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_4.png') }}" alt="Client 4">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_5.png') }}" alt="Client 5">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_6.jpg') }}" alt="Client 6">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_7.png') }}" alt="Client 7">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_8.png') }}" alt="Client 8">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_9.jpg') }}" alt="Client 9">
                                </div>
                            </div>
                            
                            <!-- Second Row - Moving Right -->
                            <div class="clients-row">
                                <!-- Original logos -->
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_10.png') }}" alt="Client 10">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_11.jpg') }}" alt="Client 11">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_12.png') }}" alt="Client 12">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_13.jpg') }}" alt="Client 13">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_14.jpg') }}" alt="Client 14">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_15.png') }}" alt="Client 15">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_16.png') }}" alt="Client 16">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_17.png') }}" alt="Client 17">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_18.png') }}" alt="Client 18">
                                </div>
                                <!-- Duplicate for seamless loop -->
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_10.png') }}" alt="Client 10">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_11.jpg') }}" alt="Client 11">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_12.png') }}" alt="Client 12">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_13.jpg') }}" alt="Client 13">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_14.jpg') }}" alt="Client 14">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_15.png') }}" alt="Client 15">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_16.png') }}" alt="Client 16">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_17.png') }}" alt="Client 17">
                                </div>
                                <div class="client-item">
                                    <img src="{{ asset('assets_user/img/client_18.png') }}" alt="Client 18">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Clients Section -->

        <!-- Events Section -->
        <section id="events" class="events section main-background">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center" data-aos="fade-up" data-aos-delay="50">
                            <h2>Our Events</h2>
                            <p>Discover the variety of events we organize</p>
                        </div>
                        
                        <div class="row events-grid justify-content-center">
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="event-item" onclick="window.location.href='{{ route('user::events::index_events') }}'">
                                    <div class="event-image">
                                        <img src="{{ asset('assets_user/img/event/exhibition_1.png') }}" alt="Exhibition">
                                        <div class="event-overlay">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                    <div class="event-content text-center">
                                        <h4>EXHIBITION</h4>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="event-item" onclick="window.location.href='{{ route('user::events::index_events') }}'">
                                    <div class="event-image">
                                        <img src="{{ asset('assets_user/img/event/festival_1.png') }}" alt="Festival">
                                        <div class="event-overlay">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                    <div class="event-content text-center">
                                        <h4>FESTIVAL</h4>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="event-item" onclick="window.location.href='{{ route('user::events::index_events') }}'">
                                    <div class="event-image">
                                        <img src="{{ asset('assets_user/img/event/running_1.png') }}" alt="Running">
                                        <div class="event-overlay">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                    <div class="event-content text-center">
                                        <h4>RUNNING</h4>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                                <div class="event-item" onclick="window.location.href='{{ route('user::events::index_events') }}'">
                                    <div class="event-image">
                                        <img src="{{ asset('assets_user/img/event/basketball_1.png') }}" alt="Basketball">
                                        <div class="event-overlay">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                    <div class="event-content text-center">
                                        <h4>BASKETBALL</h4>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                                <div class="event-item" onclick="window.location.href='{{ route('user::events::index_events') }}'">
                                    <div class="event-image">
                                        <img src="{{ asset('assets_user/img/event/combat_sport_1.png') }}" alt="Combat Sport">
                                        <div class="event-overlay">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                    <div class="event-content text-center">
                                        <h4>COMBAT SPORT</h4>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                                <div class="event-item" onclick="window.location.href='{{ route('user::events::index_events') }}'">
                                    <div class="event-image">
                                        <img src="{{ asset('assets_user/img/event/meetings_1.png') }}" alt="MICE">
                                        <div class="event-overlay">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                    <div class="event-content text-center">
                                        <h4>MICE</h4>
                                        <p>Meetings, Incentives, Conventions, and Exhibitions</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Events Section -->
        
        <!-- Service Portfolio Section -->
        <section id="service-portfolio" class="service-portfolio section main-background">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center" data-aos="fade-up" data-aos-delay="50">
                            <h2>Service Portfolio</h2>
                            <p>Comprehensive solutions for all your event needs</p>
                        </div>
                        
                        <div class="row services-grid">
                            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="service-item" onclick="window.location.href='{{ route('user::services') }}'">
                                    <div class="service-image">
                                        <img src="{{ asset('assets_user/img/event/manpower_service_1.png') }}" alt="Manpower Service">
                                        <div class="service-overlay">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                    <div class="service-content">
                                        <h4>MANPOWER SERVICE</h4>
                                        <p>Event Selling and Sampling</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="service-item" onclick="window.location.href='{{ route('user::services') }}'">
                                    <div class="service-image">
                                        <img src="{{ asset('assets_user/img/event/special_booth_1.png') }}" alt="Special Booth">
                                        <div class="service-overlay">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                    <div class="service-content">
                                        <h4>SPECIAL BOOTH</h4>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="service-item" onclick="window.location.href='{{ route('user::services') }}'">
                                    <div class="service-image">
                                        <img src="{{ asset('assets_user/img/event/event_equipment_1.png') }}" alt="Event Equipment">
                                        <div class="service-overlay">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                    <div class="service-content">
                                        <h4>EVENT EQUIPMENT</h4>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                                <div class="service-item" onclick="window.location.href='{{ route('user::services') }}'">
                                    <div class="service-image">
                                        <img src="{{ asset('assets_user/img/event/advertising_1.png') }}" alt="Advertising">
                                        <div class="service-overlay">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                    <div class="service-content">
                                        <h4>ADVERTISING</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Service Portfolio Section -->

        <!-- Organizational Structure Section -->
        <section id="organizational-structure" class="organizational-structure section main-background">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center" data-aos="fade-up" data-aos-delay="50">
                            <h2>ORGANIZATIONAL STRUCTURE</h2>
                        </div>
                        
                        <div class="structure-diagram" data-aos="fade-up" data-aos-delay="100">
                            <img src="{{ asset('assets_user/img/organizational_structure.png') }}" alt="Organizational Structure" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Organizational Structure Section -->

        <!-- Footer Section -->
        <section id="footer" class="footer section main-background">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="footer-content" data-aos="fade-up" data-aos-delay="100">
                            
                            <!-- Office Info -->
                            <div class="footer-item office-info">
                                <div>
                                    {{-- <i class="fas fa-map-marker-alt"></i> --}}
                                </div>
                                <h4>OFFICE :</h4>
                                <p>Perum Gunung Sari Indah, Blok V No 16,<br>
                                   Kelurahan Kedurus, Kecamatan Karang Pilang,<br>
                                   Kota Surabaya, Prov Jawa Timur. 60223</p>
                            </div>

                            <!-- Social Media -->
                            <div class="footer-item social-info">
                                <h4>Follow us on</h4>
                                <div class="social-links">
                                    <div class="social-item">
                                        <img src="{{ asset('assets_user/img/ig_icon.png') }}" alt="Instagram" class="social-icon">
                                        <span>@mogmainindonesia | Mogmain Indonesia</span>
                                    </div>
                                    <div class="social-item">
                                        <img src="{{ asset('assets_user/img/web_icon.png') }}" alt="Website" class="social-icon">
                                        <a href="https://www.mogmain.com" target="_blank">www.mogmain.com</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <div class="footer-item contact-info">
                                <h4>Contact us on</h4>
                                <div class="contact-links">
                                    <div class="contact-item">
                                        <img src="{{ asset('assets_user/img/wa_icon.png') }}" alt="WhatsApp" class="contact-icon">
                                        <span>0823 1638 2299 | General Manager</span>
                                    </div>
                                    <div class="contact-item">
                                        <img src="{{ asset('assets_user/img/wa_icon.png') }}" alt="WhatsApp" class="contact-icon">
                                        <span>0857 9995 8899 | Business Admin</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Footer Section -->

        {{-- @include('user.footer') --}}

    </main>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets_user/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets_user/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{ asset('assets_user/vendor/aos/aos.js')}}"></script>
    <script src="{{ asset('assets_user/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{ asset('assets_user/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{ asset('assets_user/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ asset('assets_user/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{ asset('assets_user/vendor/swiper/swiper-bundle.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets_user/js/main.js')}}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById('video_mogmain').playbackRate = 3;
            
            // Header scroll effect
            const header = document.getElementById('header');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 100) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
            
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
                    
                    // Prevent dropdown from closing when hovering over dropdown menu
                    dropdownMenu.addEventListener('mouseenter', () => {
                        dropdownMenu.style.setProperty('opacity', '1', 'important');
                        dropdownMenu.style.setProperty('visibility', 'visible', 'important');
                        dropdownMenu.style.setProperty('transform', 'translateX(-50%) translateY(0)', 'important');
                    });
                }
            });
            
            // Close mobile menu when clicking anchor links
            const mobileNavLinks = document.querySelectorAll('.mobile-nav-link[href^="#"]');
            mobileNavLinks.forEach(link => {
                link.addEventListener('click', () => {
                    toggleMobileNav();
                });
            });
            
            // Close mobile menu when clicking outside
            document.addEventListener('click', (e) => {
                const mobileNav = document.getElementById('mobileNav');
                const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
                
                if (mobileNav && mobileMenuBtn && !mobileNav.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                    if (mobileNav.classList.contains('active')) {
                        toggleMobileNav();
                    }
                }
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
