<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/themify-icon/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/icomoon/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/slick/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/animation/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">

    <title>MRS - Platform Ekspor Impor Terpercaya</title>
</head>

<body data-scroll-animation="true">

    <div class="body_wrapper">
        <!-- Preloader Start -->
        <div id="preloader" class="preloader">
            <div class="animation-preloader">
                <div class="spinner">
                </div>
                <div class="txt-loading">
                    <span data-text-preloader="M" class="letters-loading">M</span>
                    <span data-text-preloader="R" class="letters-loading">R</span>
                    <span data-text-preloader="S" class="letters-loading">S</span>
                </div>
                <p class="text-center">Loading</p>
            </div>
            <div class="loader">
                <div class="row">
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- start header  -->
        <nav class="navbar navbar-expand-lg sticky_nav menu_white">
            <div class="container-fluid">
                <a class="navbar-brand sticky_logo" href="index.html">
                    <img src="{{ asset('assets/img/logo-white.png') }}" alt="logo">
                    <img src="{{ asset('assets/img/logo_dark.png') }}" alt="logo">
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav menu me-lg-auto ms-lg-auto">
                        <li class="nav-item dropdown submenu active">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ __('messages.home') }}
                            </a>
                            {{-- <i class="fa fa-angle-down mobile_dropdown_icon"></i>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a href="#" class="nav-link">{{ __('messages.main_home') }}</a></li>
                                <li class="nav-item active"><a href="#" class="nav-link">{{ __('messages.export_service') }}</a></li>
                                <li class="nav-item"><a href="#" class="nav-link">{{ __('messages.import_service') }}</a></li>
                                <li class="nav-item"><a href="#" class="nav-link">{{ __('messages.tracking') }}</a></li>
                                <li class="nav-item"><a href="#" class="nav-link">{{ __('messages.documentation') }}</a></li>
                            </ul> --}}
                        </li>
                        <li class="nav-item dropdown submenu">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Layanan
                            </a>
                            {{-- <i class="fa fa-angle-down mobile_dropdown_icon"></i>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a href="#" class="nav-link">Ekspor</a></li>
                                <li class="nav-item"><a href="#" class="nav-link">Impor</a></li>
                                <li class="nav-item"><a href="#" class="nav-link">Konsultasi</a></li>
                                <li class="nav-item"><a href="#" class="nav-link">Dokumentasi</a></li>
                            </ul> --}}
                        </li>
                        <li class="nav-item"><a href="#" class="nav-link">Tentang Kami</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Kontak</a></li>
                    </ul>
                    <div class="nav_right">
                        <div class="language-switcher me-3">
                            <select class="form-select" id="languageSelector" onchange="changeLanguage(this.value)">
                                <option value="id" {{ session('locale') == 'id' ? 'selected' : '' }}>ID</option>
                                <option value="en" {{ session('locale') == 'en' ? 'selected' : '' }}>EN</option>
                            </select>
                        </div>
                        <a href="#" class="login_btn">
                            <div class="btn_text"><span>{{ __('messages.login') }}</span><span>{{ __('messages.login') }}</span></div>
                        </a>
                        <a href="#" class="signup_btn hover_effect">
                            <div class="btn_text"><span>{{ __('messages.register') }}</span><span>{{ __('messages.register') }}</span></div>
                        </a>
                    </div>
                </div>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="menu_toggle">
                        <span class="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <span class="hamburger-cross">
                            <span></span>
                            <span></span>
                        </span>
                    </span>
                </button>
            </div>
        </nav>
        <!-- End header  -->
        <section class="saas_banner_area_two text-center" data-bg-color="#17171C">
            <div class="container">
                <div class="saas_banner_content_two">
                    <h2 class="title-animation">
                        <span data-parallax='{"x": -180}'>{{ __('messages.export_import_solution') }}</span>
                        <span data-parallax='{"x": 120}'>{{ __('messages.for_your_global_business') }}</span>
                    </h2>
                    <p class="wow fadeInUp" data-wow-delay="0.3s">
                        {{ __('messages.optimize_business') }}
                    </p>
                    <a href="#" class="saas_btn wow fadeInUp" data-wow-delay="0.4s">
                        <div class="btn_text">
                            <span>{{ __('messages.get_started') }}</span>
                            <span>{{ __('messages.get_started') }}</span>
                        </div>
                    </a>
                    <div class="banner_img">
                        <img class="line_shap" src="{{ asset('assets/img/home-two/dot-line.png') }}" alt="">
                        <img class="wow fadeInUp" data-wow-delay="0.6s" src="{{ asset('assets/img/home-two/Graphic.png') }}" alt="">
                    </div>

                </div>
            </div>
        </section>
        <section class="saas_client_logo_two">
            <div class="container">
                <h2 class="client_title_two text-center title-animation" data-wow-delay="0.1s">
                    Lebih dari <span>500+</span> perusahaan <br> telah mempercayai layanan MRS
                </h2>
                <div class="min_client_area">
                    <a href="#" class="item wow fadeInLeft" data-wow-delay="0.3s">
                        <img src="{{ asset('assets/img/home-one/1.png') }}" alt="">
                    </a>
                    <a href="#" class="item wow fadeInLeft" data-wow-delay="0.5s"><img src="{{ asset('assets/img/home-one/2.png') }}"
                            alt=""></a>
                    <a href="#" class="item wow fadeInLeft" data-wow-delay="0.7s"><img src="{{ asset('assets/img/home-one/3.png') }}"
                            alt=""></a>
                    <a href="#" class="item wow fadeInLeft" data-wow-delay="0.9s"><img src="{{ asset('assets/img/home-one/4.png') }}"
                            alt=""></a>
                    <a href="#" class="item wow fadeInLeft" data-wow-delay="1.1s"><img src="{{ asset('assets/img/home-one/5.png') }}"
                            alt=""></a>
                </div>
            </div>
        </section>
        <section class="promo_area sec_padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="tab-content promo_tab_image wow fadeInLeft" data-wow-delay="0.3s"
                            id="pills-tabContent-one">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab" tabindex="0">
                                <img src="assets/img/home-two/spendings.png" alt="">
                            </div>
                            <div class="tab-pane fade service_tab_image" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab" tabindex="0">
                                <img src="assets/img/home-two/spendings.png" alt="">
                            </div>
                            <div class="tab-pane fade service_tab_image" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab" tabindex="0">
                                <img src="assets/img/home-two/spendings.png" alt="">
                            </div>
                            <div class="tab-pane fade service_tab_image" id="pills-disabled" role="tabpanel"
                                aria-labelledby="pills-disabled-tab" tabindex="0">
                                <img src="assets/img/home-two/spendings.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="promo_tab_box">
                            <div class="section_title_two wow fadeInUp" data-wow-delay="0.2s">
                                <h2>Mengapa Memilih MRS</h2>
                                <p>Platform ekspor-impor terpercaya dengan solusi lengkap untuk kebutuhan perdagangan internasional Anda.</p>
                            </div>
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item wow fadeInUp" data-wow-delay="0.3s" role="presentation">
                                    <div class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" role="tab" aria-controls="pills-home"
                                        aria-selected="true">
                                        <img src="assets/img/home-two/r_1.png" alt="">
                                        <div class="content">
                                            <h5>Transaksi Aman</h5>
                                            <p>Sistem keamanan berlapis dan teknologi canggih untuk melindungi setiap transaksi bisnis Anda</p>
                                        </div>
                                        <div class="tab_progress">
                                            <div class="progress-bar"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item wow fadeInUp" data-wow-delay="0.4s" role="presentation">
                                    <div class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile"
                                        aria-selected="false">
                                        <img src="assets/img/home-two/f_2.png" alt="">
                                        <div class="content">
                                            <h5>Jaringan Global</h5>
                                            <p>Akses ke jaringan mitra dagang internasional yang luas dan terpercaya</p>
                                        </div>
                                        <div class="tab_progress">
                                            <div class="progress-bar"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item wow fadeInUp" data-wow-delay="0.5s" role="presentation">
                                    <div class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" role="tab" aria-controls="pills-contact"
                                        aria-selected="false">
                                        <img src="assets/img/home-two/r_3.png" alt="">
                                        <div class="content">
                                            <h5>Dukungan 24/7</h5>
                                            <p>Tim ahli kami siap membantu Anda 24/7 dalam menangani setiap kebutuhan ekspor-impor</p>
                                        </div>
                                        <div class="tab_progress">
                                            <div class="progress-bar"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item wow fadeInUp" data-wow-delay="0.6s" role="presentation">
                                    <div class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-disabled" role="tab" aria-controls="pills-disabled"
                                        aria-selected="false">
                                        <img src="assets/img/home-two/r_4.png" alt="">
                                        <div class="content">
                                            <h5>Teknologi Mutakhir</h5>
                                            <p>Platform digital canggih yang menyederhanakan proses perdagangan internasional Anda</p>
                                        </div>
                                        <div class="tab_progress">
                                            <div class="progress-bar"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="features_area_two sec_padding">
            <div class="container">
                <div class="section_title text-center wow fadeInUp" data-wow-delay="0.2s">
                    <h2>Percepat Alur Kerja Perdagangan Anda</h2>
                    <p>Manajer bisnis, eksportir, dan importir menggunakan MRS untuk mengoptimalkan transaksi perdagangan internasional</p>
                </div>
                <div class="features_tab_inner wow fadeInUp" data-wow-delay="0.3s">
                    <ul class="nav nav-pills" id="pills-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-one-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-one" type="button" role="tab" aria-controls="pills-one"
                                aria-selected="true">
                                <span class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.2"
                                            d="M8.25 15C10.9424 15 13.125 12.8174 13.125 10.125C13.125 7.43261 10.9424 5.25 8.25 5.25C5.55761 5.25 3.375 7.43261 3.375 10.125C3.375 12.8174 5.55761 15 8.25 15Z"
                                            fill="#FF4998" />
                                        <path
                                            d="M8.25 15C10.9424 15 13.125 12.8174 13.125 10.125C13.125 7.43261 10.9424 5.25 8.25 5.25C5.55761 5.25 3.375 7.43261 3.375 10.125C3.375 12.8174 5.55761 15 8.25 15Z"
                                            stroke="#FF4998" stroke-width="2" stroke-miterlimit="10" />
                                        <path
                                            d="M14.5703 5.42813C15.0013 5.31124 15.4457 5.25136 15.8922 5.25C17.1851 5.25 18.4251 5.76361 19.3393 6.67785C20.2536 7.59209 20.7672 8.83207 20.7672 10.125C20.7672 11.4179 20.2536 12.6579 19.3393 13.5721C18.4251 14.4864 17.1851 15 15.8922 15"
                                            stroke="#FF4998" stroke-width="2" stroke-linejoin="round" />
                                        <path
                                            d="M1.5 18.5066C2.2612 17.4234 3.27191 16.5393 4.44676 15.9289C5.6216 15.3186 6.92608 15 8.25 15C9.57392 15 10.8784 15.3186 12.0532 15.9289C13.2281 16.5393 14.2388 17.4234 15 18.5066"
                                            stroke="#FF4998" stroke-width="2" stroke-linejoin="round" />
                                        <path
                                            d="M15.8906 15C17.2147 14.9992 18.5194 15.3174 19.6944 15.9277C20.8693 16.5381 21.8799 17.4225 22.6406 18.5063"
                                            stroke="#FF4998" stroke-width="2" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                Tenants
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-two-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-two" type="button" role="tab" aria-controls="pills-two"
                                aria-selected="false">
                                <span class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.2"
                                            d="M12.0007 3C10.1796 2.99947 8.40115 3.55141 6.90034 4.5829C5.39953 5.6144 4.24694 7.07692 3.59484 8.77726C2.94273 10.4776 2.82179 12.3358 3.24799 14.1063C3.67419 15.8768 4.62748 17.4764 5.98193 18.6938C6.5463 17.5824 7.40738 16.649 8.46973 15.997C9.53208 15.345 10.7542 14.9999 12.0007 15C11.259 15 10.534 14.7801 9.91729 14.368C9.30061 13.956 8.81996 13.3703 8.53613 12.6851C8.2523 11.9998 8.17804 11.2458 8.32273 10.5184C8.46743 9.79098 8.82458 9.1228 9.34903 8.59835C9.87347 8.0739 10.5417 7.71675 11.2691 7.57206C11.9965 7.42736 12.7505 7.50162 13.4357 7.78545C14.121 8.06928 14.7066 8.54993 15.1187 9.16661C15.5307 9.7833 15.7507 10.5083 15.7507 11.25C15.7507 12.2446 15.3556 13.1984 14.6523 13.9017C13.9491 14.6049 12.9952 15 12.0007 15C13.2471 14.9999 14.4693 15.345 15.5316 15.997C16.594 16.649 17.4551 17.5824 18.0194 18.6938C19.3739 17.4764 20.3272 15.8768 20.7534 14.1063C21.1796 12.3358 21.0586 10.4776 20.4065 8.77726C19.7544 7.07692 18.6018 5.6144 17.101 4.5829C15.6002 3.55141 13.8218 2.99947 12.0007 3Z"
                                            fill="white" />
                                        <path
                                            d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 15C14.0711 15 15.75 13.3211 15.75 11.25C15.75 9.17893 14.0711 7.5 12 7.5C9.92893 7.5 8.25 9.17893 8.25 11.25C8.25 13.3211 9.92893 15 12 15Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M5.98145 18.6938C6.54574 17.5824 7.40678 16.6488 8.46914 15.9968C9.5315 15.3447 10.7537 14.9995 12.0002 14.9995C13.2467 14.9995 14.4689 15.3447 15.5313 15.9968C16.5936 16.6488 17.4547 17.5824 18.0189 18.6938"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                Active Users
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-three-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-three" type="button" role="tab" aria-controls="pills-three"
                                aria-selected="false">
                                <span class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.2" d="M16.5 6H7.5V10.5H16.5V6Z" fill="#F29A16" />
                                        <path d="M16.5 6H7.5V10.5H16.5V6Z" stroke="#F29A16" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M19.5 20.25V3.75C19.5 3.33579 19.1642 3 18.75 3L5.25 3C4.83579 3 4.5 3.33579 4.5 3.75L4.5 20.25C4.5 20.6642 4.83579 21 5.25 21H18.75C19.1642 21 19.5 20.6642 19.5 20.25Z"
                                            stroke="#F29A16" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M8.25 15C8.87132 15 9.375 14.4963 9.375 13.875C9.375 13.2537 8.87132 12.75 8.25 12.75C7.62868 12.75 7.125 13.2537 7.125 13.875C7.125 14.4963 7.62868 15 8.25 15Z"
                                            fill="#F29A16" />
                                        <path
                                            d="M12 15C12.6213 15 13.125 14.4963 13.125 13.875C13.125 13.2537 12.6213 12.75 12 12.75C11.3787 12.75 10.875 13.2537 10.875 13.875C10.875 14.4963 11.3787 15 12 15Z"
                                            fill="#F29A16" />
                                        <path
                                            d="M15.75 15C16.3713 15 16.875 14.4963 16.875 13.875C16.875 13.2537 16.3713 12.75 15.75 12.75C15.1287 12.75 14.625 13.2537 14.625 13.875C14.625 14.4963 15.1287 15 15.75 15Z"
                                            fill="#F29A16" />
                                        <path
                                            d="M8.25 18.75C8.87132 18.75 9.375 18.2463 9.375 17.625C9.375 17.0037 8.87132 16.5 8.25 16.5C7.62868 16.5 7.125 17.0037 7.125 17.625C7.125 18.2463 7.62868 18.75 8.25 18.75Z"
                                            fill="#F29A16" />
                                        <path
                                            d="M12 18.75C12.6213 18.75 13.125 18.2463 13.125 17.625C13.125 17.0037 12.6213 16.5 12 16.5C11.3787 16.5 10.875 17.0037 10.875 17.625C10.875 18.2463 11.3787 18.75 12 18.75Z"
                                            fill="#F29A16" />
                                        <path
                                            d="M15.75 18.75C16.3713 18.75 16.875 18.2463 16.875 17.625C16.875 17.0037 16.3713 16.5 15.75 16.5C15.1287 16.5 14.625 17.0037 14.625 17.625C14.625 18.2463 15.1287 18.75 15.75 18.75Z"
                                            fill="#F29A16" />
                                    </svg>
                                </span>
                                Finance
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-four-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-four" type="button" role="tab" aria-controls="pills-four"
                                aria-selected="false">
                                <span class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.2"
                                            d="M19.8547 12.4785C19.8828 12.1598 19.8547 11.5223 19.8547 11.5223L21.4109 9.45039C21.1931 8.64357 20.8717 7.86836 20.4547 7.14414L17.8953 6.77852C17.6766 6.54727 17.4516 6.32227 17.2203 6.10352L16.8547 3.54414C16.1309 3.12617 15.3556 2.80469 14.5484 2.58789L12.4766 4.14414C12.1584 4.11601 11.8384 4.11601 11.5203 4.14414L9.44844 2.58789C8.64161 2.8057 7.86641 3.12712 7.14219 3.54414L6.77656 6.10352C6.54531 6.32227 6.32031 6.54727 6.10156 6.77852L3.54219 7.14414C3.12421 7.86789 2.80274 8.64322 2.58594 9.45039L4.14219 11.5223C4.12344 11.841 4.14219 12.4785 4.14219 12.4785L2.58594 14.5504C2.80375 15.3572 3.12517 16.1324 3.54219 16.8566L6.10156 17.2223C6.32031 17.4598 6.54531 17.6848 6.77656 17.8973L7.14219 20.4566C7.86594 20.8746 8.64127 21.1961 9.44844 21.4129L11.5203 19.8566C11.8384 19.8848 12.1584 19.8848 12.4766 19.8566L14.5484 21.4129C15.3553 21.1951 16.1305 20.8737 16.8547 20.4566L17.2203 17.8973C17.4547 17.6816 17.8953 17.2223 17.8953 17.2223L20.4547 16.8566C20.8727 16.1329 21.1941 15.3576 21.4109 14.5504L19.8547 12.4785ZM11.9984 16.5004C11.1084 16.5004 10.2384 16.2365 9.49837 15.742C8.75835 15.2475 8.18157 14.5447 7.84098 13.7225C7.50039 12.9002 7.41127 11.9954 7.5849 11.1225C7.75854 10.2496 8.18712 9.44775 8.81646 8.81841C9.44579 8.18907 10.2476 7.76049 11.1205 7.58686C11.9934 7.41322 12.8982 7.50234 13.7205 7.84293C14.5428 8.18353 15.2456 8.7603 15.74 9.50032C16.2345 10.2403 16.4984 11.1104 16.4984 12.0004C16.4984 13.1939 16.0243 14.3385 15.1804 15.1824C14.3365 16.0263 13.1919 16.5004 11.9984 16.5004Z"
                                            fill="#1665D8" />
                                        <path
                                            d="M12 16.5C14.4853 16.5 16.5 14.4853 16.5 12C16.5 9.51472 14.4853 7.5 12 7.5C9.51472 7.5 7.5 9.51472 7.5 12C7.5 14.4853 9.51472 16.5 12 16.5Z"
                                            stroke="#1665D8" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M17.2203 6.10352C17.4578 6.32227 17.6828 6.54727 17.8953 6.77852L20.4547 7.14414C20.8717 7.86836 21.1931 8.64357 21.4109 9.45039L19.8547 11.5223C19.8547 11.5223 19.8828 12.1598 19.8547 12.4785L21.4109 14.5504C21.1941 15.3576 20.8727 16.1329 20.4547 16.8566L17.8953 17.2223C17.8953 17.2223 17.4547 17.6816 17.2203 17.8973L16.8547 20.4566C16.1305 20.8737 15.3553 21.1951 14.5484 21.4129L12.4766 19.8566C12.1584 19.8848 11.8384 19.8848 11.5203 19.8566L9.44844 21.4129C8.64127 21.1961 7.86594 20.8746 7.14219 20.4566L6.77656 17.8973C6.54531 17.6785 6.32031 17.4535 6.10156 17.2223L3.54219 16.8566C3.12517 16.1324 2.80375 15.3572 2.58594 14.5504L4.14219 12.4785C4.14219 12.4785 4.12344 11.841 4.14219 11.5223L2.58594 9.45039C2.80274 8.64322 3.12421 7.86789 3.54219 7.14414L6.10156 6.77852C6.32031 6.54727 6.54531 6.32227 6.77656 6.10352L7.14219 3.54414C7.86641 3.12712 8.64161 2.8057 9.44844 2.58789L11.5203 4.14414C11.8384 4.11601 12.1584 4.11601 12.4766 4.14414L14.5484 2.58789C15.3556 2.80469 16.1309 3.12617 16.8547 3.54414L17.2203 6.10352Z"
                                            stroke="#1665D8" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                Maintance
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-five-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-five" type="button" role="tab" aria-controls="pills-five"
                                aria-selected="false">
                                <span class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.2" d="M19.875 3.75H14.625V19.5H19.875V3.75Z" fill="#EA6126" />
                                        <path d="M21.375 19.5H2.625" stroke="#EA6126" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.375 19.5V8.25H14.625" stroke="#EA6126" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M19.875 3.75H14.625V19.5H19.875V3.75Z" stroke="#EA6126"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M4.125 19.5V12.75H9.375" stroke="#EA6126" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                Marketing
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-six-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-six" type="button" role="tab" aria-controls="pills-six"
                                aria-selected="false">
                                <span class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.2"
                                            d="M9.375 5.25C9.375 6.28553 10.2145 7.125 11.25 7.125C12.2855 7.125 13.125 6.28553 13.125 5.25C13.125 4.21447 12.2855 3.375 11.25 3.375C10.2145 3.375 9.375 4.21447 9.375 5.25Z"
                                            fill="#21CEE5" />
                                        <path d="M13.875 12L3.75 12" stroke="#21CEE5" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M20.25 12L17.625 12" stroke="#21CEE5" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M13.875 12C13.875 13.0355 14.7145 13.875 15.75 13.875C16.7855 13.875 17.625 13.0355 17.625 12C17.625 10.9645 16.7855 10.125 15.75 10.125C14.7145 10.125 13.875 10.9645 13.875 12Z"
                                            stroke="#21CEE5" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M6.375 18.75L3.75 18.75" stroke="#21CEE5" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M20.25 18.75L10.125 18.75" stroke="#21CEE5" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M6.375 18.75C6.375 19.7855 7.21447 20.625 8.25 20.625C9.28553 20.625 10.125 19.7855 10.125 18.75C10.125 17.7145 9.28553 16.875 8.25 16.875C7.21447 16.875 6.375 17.7145 6.375 18.75Z"
                                            stroke="#21CEE5" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9.375 5.25L3.75 5.25" stroke="#21CEE5" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M20.25 5.25L13.125 5.25" stroke="#21CEE5" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M9.375 5.25C9.375 6.28553 10.2145 7.125 11.25 7.125C12.2855 7.125 13.125 6.28553 13.125 5.25C13.125 4.21447 12.2855 3.375 11.25 3.375C10.2145 3.375 9.375 4.21447 9.375 5.25Z"
                                            stroke="#21CEE5" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                Integrations
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-one" role="tabpanel"
                            aria-labelledby="pills-one-tab" tabindex="0">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="saas_features_img">
                                        <img src="assets/img/home-two/Chart.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="saas_features_content ps-5">
                                        <h2>Active Users</h2>
                                        <p>Built by owners and property managers just like you. Deliver a better owner
                                            experience, more value, transparency, and trust.</p>
                                        <ul class="list-unstyled saas_list">
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Owner portal with
                                                financials</li>
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Print checks for
                                                owners</li>
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Keep owners happier
                                                for longer</li>
                                        </ul>
                                        <a href="#" class="saas_btn theme_btn">
                                            <div class="btn_text">
                                                <span>Request Demo</span>
                                                <span>Request Demo</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab"
                            tabindex="0">
                            <div class="row align-items-center flex-row-reverse">
                                <div class="col-lg-6">
                                    <div class="saas_features_img">
                                        <img src="assets/img/home-two/Chart.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="saas_features_content ps-5">
                                        <h2>Active Users</h2>
                                        <p>Built by owners and property managers just like you. Deliver a better owner
                                            experience, more value, transparency, and trust.</p>
                                        <ul class="list-unstyled saas_list">
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Owner portal with
                                                financials</li>
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Print checks for
                                                owners</li>
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Keep owners happier
                                                for longer</li>
                                        </ul>
                                        <a href="#" class="saas_btn theme_btn">
                                            <div class="btn_text">
                                                <span>Request Demo</span>
                                                <span>Request Demo</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-three" role="tabpanel" aria-labelledby="pills-three-tab"
                            tabindex="0">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="saas_features_img">
                                        <img src="assets/img/home-two/Chart.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="saas_features_content ps-5">
                                        <h2>Active Users</h2>
                                        <p>Built by owners and property managers just like you. Deliver a better owner
                                            experience, more value, transparency, and trust.</p>
                                        <ul class="list-unstyled saas_list">
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Owner portal with
                                                financials</li>
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Print checks for
                                                owners</li>
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Keep owners happier
                                                for longer</li>
                                        </ul>
                                        <a href="#" class="saas_btn theme_btn">
                                            <div class="btn_text">
                                                <span>Request Demo</span>
                                                <span>Request Demo</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-four" role="tabpanel" aria-labelledby="pills-four-tab"
                            tabindex="0">
                            <div class="row align-items-center flex-row-reverse">
                                <div class="col-lg-6">
                                    <div class="saas_features_img">
                                        <img src="assets/img/home-two/Chart.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="saas_features_content ps-5">
                                        <h2>Active Users</h2>
                                        <p>Built by owners and property managers just like you. Deliver a better owner
                                            experience, more value, transparency, and trust.</p>
                                        <ul class="list-unstyled saas_list">
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Owner portal with
                                                financials</li>
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Print checks for
                                                owners</li>
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Keep owners happier
                                                for longer</li>
                                        </ul>
                                        <a href="#" class="saas_btn theme_btn">
                                            <div class="btn_text">
                                                <span>Request Demo</span>
                                                <span>Request Demo</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-five" role="tabpanel" aria-labelledby="pills-five-tab"
                            tabindex="0">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="saas_features_img">
                                        <img src="assets/img/home-two/Chart.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="saas_features_content ps-5">
                                        <h2>Active Users</h2>
                                        <p>Built by owners and property managers just like you. Deliver a better owner
                                            experience, more value, transparency, and trust.</p>
                                        <ul class="list-unstyled saas_list">
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Owner portal with
                                                financials</li>
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Print checks for
                                                owners</li>
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Keep owners happier
                                                for longer</li>
                                        </ul>
                                        <a href="#" class="saas_btn theme_btn">
                                            <div class="btn_text">
                                                <span>Request Demo</span>
                                                <span>Request Demo</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-six" role="tabpanel" aria-labelledby="pills-six-tab"
                            tabindex="0">
                            <div class="row align-items-center flex-row-reverse">
                                <div class="col-lg-6">
                                    <div class="saas_features_img">
                                        <img src="assets/img/home-two/Chart.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="saas_features_content ps-5">
                                        <h2>Active Users</h2>
                                        <p>Built by owners and property managers just like you. Deliver a better owner
                                            experience, more value, transparency, and trust.</p>
                                        <ul class="list-unstyled saas_list">
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Owner portal with
                                                financials</li>
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Print checks for
                                                owners</li>
                                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>Keep owners happier
                                                for longer</li>
                                        </ul>
                                        <a href="#" class="saas_btn theme_btn">
                                            <div class="btn_text">
                                                <span>Request Demo</span>
                                                <span>Request Demo</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="service_category_area">
                <div class="container">
                    <div class="section_title text-center wow fadeInUp" data-wow-delay="0.2s">
                        <h2>Not just for creative individuals, but also for businesses.</h2>
                        <p>Property managers, owners, and accountants worldwide use Picmaticweb
                            to manage any combination of properties.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="service_item wow fadeInUp" data-wow-delay="0.2s">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/home-two/secure.png') }}" alt="">
                                </div>
                                <h4>Transaksi Aman</h4>
                                <p>Sistem keamanan berlapis dan teknologi canggih untuk melindungi setiap transaksi bisnis Anda</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="service_item wow fadeInUp" data-wow-delay="0.3s">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/home-two/global.png') }}" alt="">
                                </div>
                                <h4>Jaringan Global</h4>
                                <p>Akses ke jaringan mitra dagang internasional yang luas dan terpercaya</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="service_item wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/home-two/support.png') }}" alt="">
                                </div>
                                <h4>Dukungan 24/7</h4>
                                <p>Tim ahli kami siap membantu Anda 24/7 dalam menangani setiap kebutuhan ekspor-impor</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="service_item wow fadeInUp" data-wow-delay="0.5s">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/home-two/lock.png') }}" alt="">
                                </div>
                                <h4>Dokumentasi Digital</h4>
                                <p>Pengelolaan dokumen ekspor-impor secara digital yang aman dan efisien untuk memudahkan proses administrasi</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="service_item wow fadeInUp" data-wow-delay="0.6s">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/home-two/album.png') }}" alt="">
                                </div>
                                <h4>Tracking Real-time</h4>
                                <p>Pantau status pengiriman dan dokumen Anda secara real-time melalui platform digital kami</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="service_item wow fadeInUp" data-wow-delay="0.7s">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/home-two/deskphone.png') }}" alt="">
                                </div>
                                <h4>Konsultasi Ekspor-Impor</h4>
                                <p>Tim ahli kami siap memberikan konsultasi untuk membantu mengoptimalkan proses perdagangan internasional Anda</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonial_area_two sec_padding">
            <div class="container">
                <div class="section_title text-center wow fadeInUp" data-wow-delay="0.2s">
                    <h2>Dipercaya oleh Pelaku Bisnis Global</h2>
                    <p>Ribuan perusahaan telah mempercayakan transaksi ekspor-impor mereka kepada MRS</p>
                </div>
                <div class="testimonial_slider_one">
                    <div class="item">
                        <div class="ratting">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <p>"MRS telah membantu kami mengoptimalkan proses ekspor dengan sistem yang efisien dan aman. Dukungan tim yang responsif membuat setiap transaksi berjalan lancar."</p>
                        <div class="quote_icon d-flex align-items-center justify-content-between">
                            <div class="icon">
                                <img src="{{ asset('assets/img/home-two/quote.png') }}" alt="">
                            </div>
                        </div>
                        <div class="client_info">
                            <img src="{{ asset('assets/img/home-two/author_img_1.png') }}" alt="">
                            <div class="text">
                                <h5>Ahmad Sulaiman</h5>
                                <h6>CEO, PT Global Trading Indonesia</h6>
                            </div>
                                                    </div>
                    </div>
                    <div class="item">
                        <div class="ratting">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <p>"MRS telah membantu kami mengoptimalkan proses ekspor dengan sistem yang efisien dan aman. Dukungan tim yang responsif membuat setiap transaksi berjalan lancar."</p>

                        <div class="quote_icon d-flex align-items-center justify-content-between">
                            <div class="icon">
                                <img src="{{ asset('assets/img/home-two/quote.png') }}" alt="">
                            </div>
                        </div>
                        <div class="client_info">
                            <img src="{{ asset('assets/img/home-two/author_img_2.png') }}" alt="">
                            <div class="text">
                                <h5>Syahrul Falah</h5>
                                <h6>Co-founder & COO, Litteweb Ltd.</h6>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="ratting">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <p>PicmaticWeb is our go-to tool to manage our team. With new features with every update,
                            PicmaticWeb is helping us catalog our day-to-day operating needs in managing loads of
                            projects. PicmaticWeb has become a game-changer for us. From helping us organize every kind
                            of work to improving efficiency and productivity overall has been amazing</p>
                        <div class="quote_icon d-flex align-items-center justify-content-between">
                            <div class="icon">
                                <img src="{{ asset('assets/img/home-two/quote.png') }}" alt="">
                            </div>
                        </div>
                        <div class="client_info">
                            <img src="{{ asset('assets/img/home-two/author_img_2.png') }}" alt="">
                            <div class="text">
                                <h5>Marina Nikiforova</h5>
                                <h6>Co-founder & COO, Litteweb Ltd.</h6>
                            </div>
                            <p>"MRS telah membantu kami mengoptimalkan proses ekspor dengan sistem yang efisien dan aman. Dukungan tim yang responsif membuat setiap transaksi berjalan lancar."</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="ratting">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <p>"MRS telah membantu kami mengoptimalkan proses ekspor dengan sistem yang efisien dan aman. Dukungan tim yang responsif membuat setiap transaksi berjalan lancar."</p>
                        <div class="quote_icon d-flex align-items-center justify-content-between">
                            <div class="icon">
                                <img src="{{ asset('assets/img/home-two/quote.png') }}" alt="">
                            </div>
                        </div>
                        <div class="client_info">
                            <img src="{{ asset('assets/img/home-two/author_img_2.png') }}" alt="">
                            <div class="text">
                                <h5>Syahrul Falah</h5>
                                <h6>Co-founder & COO, Litteweb Ltd.</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom_nav">
                    <button class="prev"><i class="icon-arrow-left2" aria-hidden="true"></i></button>
                    <button class="next"><i class="icon-arrow-right2" aria-hidden="true"></i></button>
                </div>
            </div>
        </section>
        <section class="saas_faq_area_two sec_padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="section_title_two pe-5">
                            <h2 class="wow fadeInUp" data-wow-delay="0.1s">Pertanyaan yang Sering Diajukan</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Temukan jawaban untuk pertanyaan umum tentang layanan kami:</p>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="accordion faq_inner ps-4" id="accordionExample">
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.5s">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Bagaimana cara memulai menggunakan layanan MRS?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Anda dapat mendaftar melalui website kami dan tim kami akan menghubungi Anda untuk konsultasi awal. Kami akan membantu menyesuaikan layanan sesuai kebutuhan bisnis Anda.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.6s">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Apakah MRS menyediakan layanan konsultasi?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Ya, kami menyediakan layanan konsultasi ekspor-impor dengan tim ahli yang berpengalaman. Kami akan membantu Anda memahami regulasi dan optimalisasi proses perdagangan internasional.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.7s">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Bagaimana sistem keamanan transaksi di MRS?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        MRS menggunakan teknologi keamanan terkini dengan enkripsi end-to-end untuk melindungi setiap transaksi. Kami juga memiliki tim keamanan yang memantau aktivitas 24/7.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.8s">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Apakah ada biaya berlangganan bulanan?
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Ya, kami menyediakan berbagai paket berlangganan yang dapat disesuaikan dengan kebutuhan bisnis Anda. Hubungi tim kami untuk informasi lebih lanjut.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.9s">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Bagaimana dengan dukungan pelanggan?
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Tim dukungan pelanggan kami tersedia 24/7 melalui berbagai kanal komunikasi. Kami berkomitmen memberikan respons cepat untuk setiap pertanyaan dan bantuan yang Anda butuhkan.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="subscribe_area">
            <div class="container">
                <div class="subscribe_inner">
                    <div class="section_title_two">
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s">Mari Mulai dengan MRS</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.3s">
                            MRS membantu Anda mengoptimalkan proses ekspor-impor, memastikan efisiensi dan keamanan dalam setiap transaksi internasional.
                        </p>
                    </div>
                    <form action="#" class="subscribe_form wow fadeInUp" data-wow-delay="0.4s">
                        <input class="form-control" type="text" placeholder="Masukkan email Anda">
                        <button type="submit" class="theme_btn">Berlangganan</button>
                    </form>
                    <p class="note wow fadeInUp" data-wow-delay="0.5s">Dengan berlangganan, Anda menyetujui <a href="#">Kebijakan Privasi</a> kami.</p>
                </div>
            </div>
        </section>
        <footer class="footer_area_two footer_shap" data-bg-color="#0F172A">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="f_widget f_about_widget wow fadeInUp" data-wow-delay="0.1s">
                            <a href="#" class="f_logo">
                                <img src="{{ asset('assets/img/mrs_logo_white.png') }}" alt="MRS Logo">
                            </a>
                            <p>Multi Resource Solutions (MRS) adalah platform ekspor-impor terpercaya yang membantu bisnis Anda berkembang di pasar global.</p>
                            <ul class="list-unstyled f_social_icon">
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                                <li><a href="#"><i class="ti-vimeo-alt"></i></a></li>
                                <li><a href="#"><i class="ti-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6">
                        <div class="f_widget f_link_widget wow fadeInUp" data-wow-delay="0.2s">
                            <h3 class="f_title">PERUSAHAAN</h3>
                            <ul class="list-unstyled link_widget">
                                <li><a href="#">Tentang Kami</a></li>
                                <li><a href="#">Layanan</a></li>
                                <li><a href="#">Tim Kami</a></li>
                                <li><a href="#">Karir</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="f_widget f_link_widget wow fadeInUp" data-wow-delay="0.3s">
                            <h3 class="f_title">BANTUAN</h3>
                            <ul class="list-unstyled link_widget">
                                <li><a href="#">Pusat Bantuan</a></li>
                                <li><a href="#">Tracking</a></li>
                                <li><a href="#">Syarat & Ketentuan</a></li>
                                <li><a href="#">Kebijakan Privasi</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="f_widget f_newsletter_widget wow fadeInUp" data-wow-delay="0.4s">
                            <h3 class="f_title">BERLANGGANAN NEWSLETTER</h3>
                            <form action="#" class="newsletter_form newsletter_form_two">
                                <input class="form-control" type="text" placeholder="Masukkan email Anda">
                                <button type="submit" class="theme_btn">Berlangganan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="footer_bottom text-center">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="mb-0 wow fadeInUp" data-wow-delay="0.3s">
                                © 2024 Multi Resource Solutions. All Rights Reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="{{ asset('assets/vendors/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/parallax/jquery.parallax-scroll.js') }}"></script>
    <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/js/SplitText.js') }}"></script>
    <script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('assets/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('assets/vendors/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Tambahkan script berikut sebelum closing body tag -->
    <script>
    function changeLanguage(lang) {
        window.location.href = `/language/${lang}`;
    }
    </script>

    <style>
    .language-switcher {
        display: inline-block;
    }

    .language-switcher .form-select {
        background-color: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        padding: 5px 25px 5px 10px;
        font-size: 14px;
        cursor: pointer;
        border-radius: 4px;
    }

    .language-switcher .form-select:focus {
        box-shadow: none;
        border-color: rgba(255, 255, 255, 0.4);
    }

    .language-switcher .form-select option {
        background-color: #17171C;
        color: #fff;
    }
    </style>

</body>

</html>