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
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

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
    @include('user.navbar')

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-end">

            <button type="button" class="logo openbtn" onclick="openNav()">
                <img src="{{ asset('assets_user/img/mogmain_white_transparent.png')}}" alt="">
            </button>

        </div>
    </header>

    <main class="main">

        <!-- events Section -->
        <section id="events_detail" class="events_detail section dark-background">
            <div class="detail_of_event">
                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>Events</h2>
                    <p>Event musik yang spektakuler ini akan menggebrak kota dengan penampilan dari artis-artis
                        terkemuka</p>
                </div><!-- End Section Title -->

                <div class="container">

                    <div class="row gy-4 align-items-center features-item">
                        <div class="col-lg-7 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200"
                            style="text-align: justify">
                            <span class="event_description">
                                Bersiaplah untuk pengalaman musik yang tak terlupakan di Soundwave Festival 2024!
                                Menghadirkan penampilan dari artis-artis terkemuka, acara ini akan menjadi pusat
                                pertemuan para pecinta musik dari berbagai genre. Dari rock hingga pop, EDM hingga jazz,
                                festival ini menawarkan sesuatu untuk semua orang. Selain musik yang menggugah semangat,
                                pengunjung juga dapat menikmati berbagai aktivitas seru seperti pameran seni, bazaar
                                makanan, dan zona interaktif yang memungkinkan penggemar berinteraksi langsung dengan
                                artis favorit mereka. Dengan tata panggung yang megah dan pencahayaan yang memukau,
                                Soundwave Festival 2024 akan menjadi puncak hiburan tahun ini. Jangan lewatkan
                                kesempatan untuk menjadi bagian dari kemeriahan ini!
                            </span>
                        </div>
                        <div class="col-lg-4 offset-lg-1 order-1 order-lg-2 d-flex align-items-center" data-aos="zoom-out"
                            data-aos-delay="100">
                            <div class="row gy-4">

                                <div class="col-lg-12 " data-aos="fade-up" data-aos-delay="100">
                                    <div class="service-item d-flex">
                                        <div>
                                            <h4 class="title">Lorem Ipsum</h4>
                                            <p class="description">Voluptatum deleniti atque corrupti quos dolores et
                                                quas molestias
                                                excepturi sint occaecati cupiditate non provident</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Service Item -->

                                <div class="col-lg-12 " data-aos="fade-up" data-aos-delay="200">
                                    <div class="service-item d-flex">
                                        <div>
                                            <h4 class="title">Dolor</h4>
                                            <p class="description">Minim veniam, quis nostrud exercitation ullamco
                                                laboris nisi ut
                                                aliquip ex ea commodo consequat tarad limino ata</p>
                                        </div>
                                    </div>
                                </div><!-- End Service Item -->

                                <div class="col-lg-12 " data-aos="fade-up" data-aos-delay="300">
                                    <div class="service-item d-flex">
                                        <div>
                                            <h4 class="title">Sed ut perspiciatis</h4>
                                            <p class="description">Duis aute irure dolor in reprehenderit in voluptate
                                                velit esse
                                                cillum dolore eu fugiat nulla pariatur</p>
                                        </div>
                                    </div>
                                </div><!-- End Service Item -->

                            </div>
                        </div>
                    </div><!-- Features Item -->

                </div>
            </div>
            <img src="{{ asset('img/' . $slug)}}" alt="">
        </section>

        @include('user.footer')

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
        function openNav() {
            var overlay = document.getElementById("myNav");
            overlay.style.visibility = "visible";
            overlay.style.opacity = "1";
        }

        function closeNav() {
            var overlay = document.getElementById("myNav");
            overlay.style.opacity = "0";
            overlay.style.visibility = "hidden";
        }

    </script>

</body>

</html>
