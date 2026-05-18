<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Event Detail - MOGMAIN</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets_user/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets_user/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets_user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_user/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Font Awesome Kits -->
    <script src="https://kit.fontawesome.com/8444d5e836.js" crossorigin="anonymous"></script>

    <!-- Main CSS File -->
    <link href="{{ asset('assets_user/css/main.css') }}" rel="stylesheet">
</head>

<body class="event-detail-page">
    @include('user.header')

    <!-- Page Title -->
    <main class="main">
        <section class="page-title main-background" style="padding-top: 8%">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 data-aos="fade-up" style="font-weight: 700">{{ $event->client_name }}</h5>
                        <h4 data-aos="fade-up" style="font-weight: 700">{{ $event->event_name }}</h4>
                        <p data-aos="fade-up" data-aos-delay="100" style="font-weight: 500">{{ $event->description }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Event Detail Section -->
        <section class="event-detail section main-background">
            {{-- <div class="container"> --}}

            <!-- Full Width Images Section -->
            <div class="event-images" data-aos="fade-up" data-aos-delay="200">
                @if ($event->images->isNotEmpty())
                    @foreach ($event->images->sortBy('sort_order') as $image)
                        <div class="full-width-image">
                            <img src="{{ Storage::url($image->image_path) }}" alt="{{ $event->event_name }} Image">
                        </div>
                    @endforeach
                @else
                    <div class="full-width-image">
                        <img src="{{ asset('assets_user/img/placeholder.png') }}" alt="Placeholder">
                    </div>
                @endif
            </div>
            {{-- </div> --}}
        </section>
    </main>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets_user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets_user/js/main.js') }}"></script>

</body>

</html>
