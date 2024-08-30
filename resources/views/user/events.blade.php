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

    <style>
        .overlay {
            height: 100%;
            width: 100%;
            position: fixed;
            z-index: 999999;
            top: 0;
            left: 0;
            background-color: #000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .overlay-content {
            position: relative;
            top: 10%;
            left: 15%;
            width: 70%;
            text-align: left;
            margin-top: 30px;
        }

        .overlay span {
            font-family: "Fugaz One", sans-serif;
            padding: 8px;
            font-size: 94px;
            color: #fff;
            transition: 0.3s;
        }

        .overlay a {
            font-family: "Fugaz One", sans-serif;
            font-weight: 500;
            text-transform: uppercase;
            padding: 8px;
            text-decoration: none;
            font-size: 94px;
            color: #fff;
            transition: 0.3s;
        }

        .overlay a:hover,
        .overlay a:focus {
            color: #000;
            -webkit-text-stroke: 2px #0c724c;
        }

        .overlay .closebtn {
            position: absolute;
            top: 20px;
            right: 45px;
            font-size: 60px;
        }

        @media screen and (max-height: 450px) {
            .overlay a {
                font-size: 20px;
            }

            .overlay .closebtn {
                font-size: 40px;
                top: 15px;
                right: 35px;
            }
        }

    </style>
</head>

<body class="index-page">
    <div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa-solid fa-x"></i></a>
        <div class="overlay-content">
            <a href="#">Events</a>
            <span>/</span>
            <a href="#">Services</a>
            <span>/</span>
            <a href="#">News</a>
            <span>/</span>
            <a href="#">Clients</a>
            <span>/</span>
            <a href="#">Meet The Teams</a>
            <span>/</span>
            <a href="#">Contact</a>
        </div>
    </div>

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-end">

            <button type="button" class="logo openbtn" onclick="openNav()">
                <img src="{{ asset('assets_user/img/mogmain_white_transparent.png')}}" alt="">
            </button>

        </div>
    </header>

    <main class="main">

        <!-- events Section -->
        <section id="events" class="events section main-background">
            <div class="media-grid">
    @php
        $widths = [
            [12], // 100%
            [4, 4, 4],
            [4, 8],
            [6, 6],
            [3, 3, 3, 3],
            [5, 7],
            [8, 4],
        ];

        $totalMedia = 10; // Total media items
        $totalPatterns = count($widths);
        $usedMedia = 0;
    @endphp

    @foreach ($widths as $pattern)
        @if ($usedMedia < $totalMedia)
            @php
                // Calculate the number of items for the current row
                $itemsToUse = min(count($pattern), $totalMedia - $usedMedia);
                $currentPatternWidth = array_slice($pattern, 0, $itemsToUse);
                $rowSum = array_sum($currentPatternWidth);

                // If there's a need to fill the remaining space to reach 100%
                if ($rowSum < 12 && ($usedMedia + $itemsToUse) >= $totalMedia) {
                    $currentPatternWidth = array_slice($pattern, 0, $itemsToUse);
                    $remainingSum = array_sum($currentPatternWidth);
                    $remainingPercent = 12 - $remainingSum; // Fill remaining space to 100%
                    if ($remainingPercent > 0) {
                        $currentPatternWidth[] = $remainingPercent; // Add remaining width to fill 100%
                    }
                }

                $usedMedia += $itemsToUse;
            @endphp

            <div class="media-row">
                @foreach ($currentPatternWidth as $width)
                    @php
                        $media = 'https://statik.tempo.co/data/2020/07/15/id_953010/953010_720.jpg'; // Placeholder media
                    @endphp
                    <div class="media-item" style="grid-column: span {{ $width }};">
                        <img src="{{ $media }}" alt="Foto {{ $loop->iteration }}">
                    </div>
                @endforeach
            </div>
        @endif

        @if ($usedMedia >= $totalMedia)
            @break
        @endif
    @endforeach

    @php
        $remainingData = $totalMedia - $usedMedia;
    @endphp

    @if ($remainingData > 0)
        @php
            // Handle remaining data manually
            $remainingPattern = [];
            if ($remainingData === 1) {
                $remainingPattern = [12]; // 100%
            } elseif ($remainingData === 2) {
                $remainingPattern = [6, 6]; // 50% + 50%
            } elseif ($remainingData === 3) {
                $remainingPattern = [4, 4, 4]; // 33% + 33% + 33%
            } elseif ($remainingData === 4) {
                $remainingPattern = [3, 3, 3, 3]; // 25% + 25% + 25% + 25%
            }
        @endphp

        @if (count($remainingPattern) > 0)
            <div class="media-row">
                @foreach ($remainingPattern as $width)
                    @php
                        $media = 'https://statik.tempo.co/data/2020/07/15/id_953010/953010_720.jpg'; // Placeholder media
                    @endphp
                    <div class="media-item" style="grid-column: span {{ $width }};">
                        <img src="{{ $media }}" alt="Foto {{ $loop->iteration }}">
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>


        </section>


                        {{-- <div class="media-row">
                            @foreach ($currentPatternWidth as $width)
                                @php
                                    $media = 'https://statik.tempo.co/data/2020/07/15/id_953010/953010_720.jpg'; // Placeholder media
                                @endphp
                                <div class="media-item" style="grid-column: span {{ $width }};">
                                    <img src="{{ $media }}" alt="Foto {{ $loop->iteration }}">
                                </div>
                            @endforeach
                        </div> --}}


        <div class="logo_footers">
            <img src="{{ asset('assets_user/img/mogmain_horisontal_white.png')}}" alt="">
        </div>

        <!-- Clients Section -->
        <section id="clients" class="clients section_footer">
            <div class="container">
                <div class="nav-text">
                    <ul>
                        <li><a href="#link1">Instagram</a></li>
                        <li><a href="#link2">Youtube</a></li>
                        <li><a href="#link3">Behance</a></li>
                        <li><a href="#link4">Contact</a></li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- /Clients Section -->

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
