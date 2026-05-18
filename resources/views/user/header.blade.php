<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid">
        <div class="header-content d-flex align-items-center justify-content-between">

            <!-- Logo Section -->
            <div class="logo-section d-flex align-items-center">
                <div class="logo-item">
                    <a href="{{ route('user::index') }}">
                        <img src="{{ asset('assets_user/img/emba_white.png') }}" alt="EMBA">
                    </a>
                </div>
                <div class="logo-divider"></div>
                <div class="logo-item">
                    <a href="{{ route('user::index') }}">
                        <img src="{{ asset('assets_user/img/mogmain_horisontal_white.png') }}" alt="MOGMAIN">
                    </a>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <nav class="main-nav d-none d-lg-flex">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="{{ route('user::index') }}#about" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('user::index') }}#services" class="nav-link dropdown-toggle">
                            Services
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('user::index') }}#services" class="dropdown-item">Services Overview</a>
                            <a href="{{ route('user::index') }}#service-portfolio" class="dropdown-item">Service
                                Portfolio</a>
                            <a href="{{ route('user::services') }}" class="dropdown-item">Service Gallery</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user::index') }}#clients" class="nav-link">Our Clients</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('user::index') }}#events" class="nav-link dropdown-toggle">
                            Events
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('user::events::index_events') }}" class="dropdown-item">Our Events</a>
                        </div>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="#organizational-structure" class="nav-link">Teams</a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('user::career') }}" class="nav-link">Career</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('registrasi.index') }}" class="nav-link">Registrasi</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://api.whatsapp.com/send?phone=6282316382299" class="nav-link contact-btn"
                            target="_blank">Contact</a>
                    </li>
                </ul>
            </nav>

            <!-- Mobile Menu Button -->
            <button class="mobile-menu-btn d-lg-none" onclick="toggleMobileNav()">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div id="mobileNav" class="mobile-nav">
        <div class="mobile-nav-overlay" onclick="toggleMobileNav()"></div>
        <div class="mobile-nav-content">
            <div class="mobile-nav-header">
                <div class="mobile-logo">
                    <img src="{{ asset('assets_user/img/mogmain_horisontal_white.png') }}" alt="MOGMAIN">
                </div>
                <button class="mobile-nav-close" onclick="toggleMobileNav()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="mobile-nav-menu">
                <a href="#about" class="mobile-nav-link">About Us</a>
                <a href="#services" class="mobile-nav-link">Services Overview</a>
                <a href="#service-portfolio" class="mobile-nav-link">Service Portfolio</a>
                <a href="{{ route('user::services') }}" class="mobile-nav-link">Service Gallery</a>
                <a href="#clients" class="mobile-nav-link">Our Clients</a>
                <a href="#events" class="mobile-nav-link">Our Events</a>
                <a href="{{ route('user::events::index_events') }}" class="mobile-nav-link">Events Gallery</a>
                <a href="#organizational-structure" class="mobile-nav-link">Teams</a>
                {{-- <a href="{{ route('user::career') }}" class="mobile-nav-link">Career</a> --}}
                <a href="{{ route('registrasi.index') }}" class="mobile-nav-link">Registrasi</a>
                <a href="https://api.whatsapp.com/send?phone=6282316382299" class="mobile-nav-link contact-link"
                    target="_blank" rel="noopener noreferrer">Contact</a>
            </nav>
        </div>
    </div>
</header>
