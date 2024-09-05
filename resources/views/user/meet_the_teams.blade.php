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



        <!-- Team Section -->
        <section id="team" class="team section main-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Team</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-5">

                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="{{ asset('assets_user/img/team/team-1.jpg') }}" class="img-fluid" alt="">
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter-x"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4>Walter White</h4>
                            <span>Chief Executive Officer</span>
                            <p>Aliquam iure quaerat voluptatem praesentium possimus unde laudantium vel dolorum
                                distinctio dire flow</p>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="{{ asset('assets_user/img/team/team-2.jpg') }}" class="img-fluid" alt="">
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter-x"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4>Sarah Jhonson</h4>
                            <span>Product Manager</span>
                            <p>Labore ipsam sit consequatur exercitationem rerum laboriosam laudantium aut quod dolores
                                exercitationem ut</p>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="300">
                        <div class="member-img">
                            <img src="{{ asset('assets_user/img/team/team-3.jpg') }}" class="img-fluid" alt="">
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter-x"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4>William Anderson</h4>
                            <span>CTO</span>
                            <p>Illum minima ea autem doloremque ipsum quidem quas aspernatur modi ut praesentium vel
                                tque sed facilis at qui</p>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="400">
                        <div class="member-img">
                            <img src="{{ asset('assets_user/img/team/team-4.jpg') }}" class="img-fluid" alt="">
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter-x"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4>Amanda Jepson</h4>
                            <span>Accountant</span>
                            <p>Magni voluptatem accusamus assumenda cum nisi aut qui dolorem voluptate sed et veniam
                                quasi quam consectetur</p>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="500">
                        <div class="member-img">
                            <img src="{{ asset('assets_user/img/team/team-5.jpg') }}" class="img-fluid" alt="">
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter-x"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4>Brian Doe</h4>
                            <span>Marketing</span>
                            <p>Qui consequuntur quos accusamus magnam quo est molestiae eius laboriosam sunt doloribus
                                quia impedit laborum velit</p>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="600">
                        <div class="member-img">
                            <img src="{{ asset('assets_user/img/team/team-6.jpg') }}" class="img-fluid" alt="">
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter-x"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4>Josepha Palas</h4>
                            <span>Operation</span>
                            <p>Sint sint eveniet explicabo amet consequatur nesciunt error enim rerum earum et omnis
                                fugit eligendi cupiditate vel</p>
                        </div>
                    </div><!-- End Team Member -->

                </div>

            </div>

        </section><!-- /Team Section -->

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
