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
        <section id="events" class="events section dark-background">
            <div class="media-grid">
                @php
                    $widths = [
                        [6, 6],
                        [5, 4, 3],
                        [4, 8],
                        [12],
                        [4, 4, 4],
                        [5, 7],
                        [6, 6],
                        [3, 3, 3, 3],
                        [12],
                        [8, 4],
                    ];
                    $media = [                        
                        asset('img/1.jpg'),
                        asset('img/2.jpg'),
                        asset('img/3.jpg'),
                        asset('img/4.jpg'),
                        asset('img/5.jpg'),
                        asset('img/6.jpg'),
                        asset('img/7.jpg'),
                        asset('img/8.jpg'),
                        asset('img/9.jpg'),
                        asset('img/10.jpg'),
                        asset('img/11.jpg'),
                        asset('img/12.jpg'),
                        asset('img/13.jpg'),
                        asset('img/14.jpg'),
                        asset('img/15.jpg'),
                        asset('img/16.jpg'),
                        asset('img/17.jpg'),
                        asset('img/18.jpg'),
                        asset('img/19.jpg'),
                        asset('img/20.jpg'),
                        asset('img/21.jpg'),
                        asset('img/22.jpg'),
                        asset('img/23.jpg'),
                    ];

                    $totalMedia = count($media);
                    $mediaCount = 0;
                    $patternsCount = count($widths);

                    // Calculate stopping index
                    $totalCount = $totalMedia;
                    $currentIndex = 0;
                    $remainingMedia = $totalMedia;
                    while ($totalCount > 0) {
                        foreach ($widths as $index => $row) {
                            $count = count($row);
                            if ($totalCount > $count) {
                                $totalCount -= $count;
                            } else {
                                $stoppingIndex = $index;
                                break 2;
                            }
                        }
                    }
                    $stoppingIndex = $currentIndex % $patternsCount;
                    $remainingMedia = ($totalMedia - $totalCount);
                @endphp

                @if ($totalCount > 0)
                <div class="media-row">
                    @php
                    if ($totalCount == 1) {
                        $span_class = 'height_100';
                        $span_style = 12;
                    } elseif ($totalCount == 2) {
                        $span_class = 'height_80';
                        $span_style = 6;
                    } elseif ($totalCount == 3) {
                        $span_class = 'height_80';
                        $span_style = 4;
                    } elseif ($totalCount == 4) {
                        $span_class = 'height_80';
                        $span_style = 3;
                    } 
                    @endphp
                    @for ($i = 0; $i < $totalCount; $i++)
                        @php
                            $currentMediaUrl = $media[$mediaCount];
                            $mediaName = basename($currentMediaUrl);
                        @endphp
                        <div class="media-item {{ $span_class }}" style="grid-column: span {{ $span_style }};">
                            <a href="{{ route('user::events::detail_events', $mediaName) }}" class="link_event">
                                <img src="{{ $media[$mediaCount] }}" alt="Foto {{ $mediaCount + 1 }}">
                            </a>
                        </div>
                        @php $mediaCount++; @endphp
                    @endfor
                </div>
                @endif

                @while ($remainingMedia > 0)
                    @php
                        $pattern = $widths[$currentIndex % $patternsCount];
                        $currentIndex++;
                    @endphp

                    <div class="media-row">
                        @foreach ($pattern as $width)
                            @if ($remainingMedia > 0)
                                @php
                                if ($width == 12) {
                                    $span_class = 'height_100';
                                } else {
                                    $span_class = 'height_80';
                                }
                                $currentMediaUrl = $media[$totalMedia - $remainingMedia];
                                $mediaName = basename($currentMediaUrl);
                                @endphp
                                    <div class="media-item" style="grid-column: span {{ $width }};">
                                        <a href="{{ route('user::events::detail_events', $mediaName) }}" class="link_event">
                                            <img src="{{ $currentMediaUrl }}" class="{{ $span_class }}" alt="Foto {{ $totalMedia - $remainingMedia + 1 }}">
                                        </a>
                                </div>
                                @php $remainingMedia--; @endphp
                            @else
                                @break
                            @endif
                        @endforeach
                    </div>

                    @if ($currentIndex > $stoppingIndex && $remainingMedia <= 0)
                        @break
                    @endif
                @endwhile
            </div>
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
