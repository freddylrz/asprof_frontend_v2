<!DOCTYPE html>
<html lang="en">

<head>
    <title>TuguBro | Named & Nakes</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Asuransi profesi tenaga medis dan tenaga kesehatan">
    <meta name="keywords" content="asuransi, tugubro, broker asuransi, asuransi profesi, tenaga kesehatan, tenaga medis">
    <meta name="author" content="tugubro">
    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('assets/images/tib-logo.svg') }}" type="image/x-icon">
    <!-- [Page specific CSS] start -->
    <link href="{{ asset('assets/css/plugins/animate.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- [Page specific CSS] end -->
    <!-- [Font] Family -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/inter/inter.css') }}" id="main-font-link" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/botui/build/botui.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/botui/build/botui-theme-default.css" />
    @stack('levelPluginHeader')
    @if (Request::is('/'))
        <style>
            #splashscreen {
                position: fixed;
                width: 100%;
                height: 100%;
                background-color: white;
                z-index: 10000;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            #main-content {
                display: none;
            }

            /* Default styles for mobile (small screens) */
            #closeSplashscreen {
                font-size: inherit;
                /* Normal button font size */
            }

            /* For screens larger than 768px (tablet and above) */
            @media (min-width: 768px) {
                #closeSplashscreen {
                    font-size: 20px;
                }
            }

            /* Animation for the specific class on hover */
            .animated-image {
                transition: transform 0.3s ease-in-out;
                /* Smooth transition */
            }

            .animated-image:hover {
                transform: scale(1.1);
                /* Slightly enlarges the image */
            }

            @media (max-width: 768px) {

                /* Adjust based on your breakpoint for mobile */
                .animated-image {
                    width: 50%;
                }
            }

            @media (min-width: 769px) {

                /* Above mobile width */
                .animated-image {
                    width: 100%;
                }
            }

            /* Define custom animation for highlighting */
            .highlight-animate {
                position: relative;
                display: inline-block;
                transition: color 0.3s ease;
            }

            .highlight-animate::before {
                content: '';
                position: absolute;
                width: 100%;
                height: 0.2em;
                bottom: 0;
                left: 0;
                background-color: currentColor;
                z-index: -1;
                transition: transform 0.3s ease;
                transform: scaleX(0);
                transform-origin: left;
            }

            .highlight-animate:hover::before {
                transform: scaleX(1);
            }

            .highlight-animate:hover {
                color: #ff5733;
                /* Change to your desired hover text color */
            }
        </style>
    @endif
    @if (Request::is('asuransi-profesi') || Request::is('/'))
        <style>
            .arrow-down {
                position: absolute;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                cursor: pointer;
                text-align: center;
            }

            .arrow-down .info-text {
                color: black;
                font-size: 16px;
            }

            .bounce {
                animation: bounce 2s infinite;
            }

            @keyframes bounce {

                0%,
                20%,
                50%,
                80%,
                100% {
                    transform: translateY(0);
                }

                40% {
                    transform: translateY(-15px);
                }

                60% {
                    transform: translateY(-15px);
                }
            }
        </style>
    @endif
    <style>
        /* CSS umum untuk menu */
        .menu-section {
            position: fixed;
            width: 100%;
            top:67%;
            background-color: #f7f7f7;
            color: #fff;
            z-index: 1099;
            padding: 10px 0;
        }

        /* Ukuran font default */
        .menu-section .navbar-nav .nav-item .btn {
            font-size: 14px;
            /* Default font size */
            margin-right: 5px;
        }

        /* Media query untuk layar antara 992px dan 1399px */
        @media (min-width: 992px) and (max-width: 1399px) {
            .menu-section .navbar-nav .nav-item .btn {
                font-size: 12px;
                /* Ukuran font lebih kecil */
                margin-right: 0;
            }
        }

        /* Optional styling to adjust the look of the burger icon */
        .navbar-toggler-icon {
            color: #000;
        }

        .offcanvas.offcanvas-top {
            min-height: 100vh;
            /* Fullscreen height */
            height: 100%;
            /* Ensure it takes available space */
        }

        .offcanvas-body {
            overflow-y: auto;
            /* Scroll if content exceeds height */
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .tib-logo {
            margin: 0 8px;
        }

        .image-divider {
            width: 1px;
            height: 64px;
            /* Adjust height as needed */
            background-color: #ccc;
            /* Adjust color as needed */
        }

        @media (max-width: 768px) {
            .logo2 {
                display: block !important;
            }

            .logo1 {
                display: none;
            }
        }

        @media (min-width: 768px) {
            .logo2 {
                display: none;
            }

            .logo1 {
                display: block;
            }
        }
    </style>
</head>

<body class="landing-page">
    <!-- [ Main Content ] start -->
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    @if (Request::is('/'))
        <section class="bg-white overflow-hidden" id="splashscreen" style="display: none;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <img src="{{ asset('assets/images/splashscreen/splashscreen.svg') }}" alt="img"
                                    class="img-fluid rounded" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="arrow-down text-center">
                    <button type="button" class="btn btn-lg btn-primary" id="closeSplashscreen">
                        Lihat Beranda
                    </button>
                </div>
            </div>
        </section>
    @endif
    <div id="main-content">
        <!-- [ Header ] start -->
        <header id="home" style="background-image: url({{ asset('assets/images/landing/img-headerbg.jpg') }}">
            <!-- [ Nav ] start -->
            <nav class="navbar navbar-light default" style="background: #fff">
                <div class="container-fluid m-b-10">
                    <a class="navbar-brand logo1" href="/">
                        <img src="{{ asset('assets/images/tib-logo.svg') }}" alt="logo" class="tib-logo" />
                    </a>
                    <a class="navbar-brand logo1" href="/">
                        <img src="{{ asset('assets/images/landing/solusi-tepat-berasuransi.svg') }}" alt="logo"
                            class="tib-logo" />
                    </a>
                    <div class="d-flex align-items-center w-100">
                        <!-- Logo kiri -->
                        <a class="navbar-brand logo2" href="/" style="display: none">
                            <img src="{{ asset('assets/images/tib-logo.svg') }}" alt="logo kiri" class="tib-logo" />
                        </a>

                        <!-- Logo kanan -->
                        <a class="navbar-brand logo2 ms-auto" href="/" style="display: none">
                            <img src="{{ asset('assets/images/landing/solusi-tepat-berasuransi.svg') }}" alt="logo kanan" class="tib-logo" />
                        </a>
                    </div>

                </div>
                <!-- Collapsible burger menu for mobile screens (visible on mobile only) -->
                <div class="menu-section d-lg-none text-end">
                    <div class="container">
                        <!-- Burger menu toggle button -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#navbarNavMobile" aria-controls="navbarNavMobile" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- Fullscreen offcanvas menu -->
                        <div class="offcanvas offcanvas-top" tabindex="-1" id="navbarNavMobile"
                            aria-labelledby="navbarNavMobileLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="navbarNavMobileLabel">Menu</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body d-flex flex-column justify-content-center align-items-center">
                                <ul class="navbar-nav my-auto gap-1 align-items-center text-center">
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                            style="font-size: 1.2rem; font-weight:400;" href="/">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('asuransi-profesi') ? 'active' : '' }}"
                                            style="font-size: 1.2rem; font-weight:400;"
                                            href="/asuransi-profesi">Asuransi Tanggung Gugat Profesi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('pialang-asuransi') ? 'active' : '' }}"
                                            style="font-size: 1.2rem; font-weight:400;"
                                            href="/pialang-asuransi">Pialang Asuransi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('asuransi-pendukung') ? 'active' : '' }}"
                                            style="font-size: 1.2rem; font-weight:400;"
                                            href="/asuransi-pendukung">Asuransi Pendukung</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('hubungi-kami') ? 'active' : '' }}"
                                            style="font-size: 1.2rem; font-weight:400;" href="/hubungi-kami">Hubungi
                                            Kami</a>
                                    </li>
                                    <li class="nav-item">
                                        <hr>
                                       <a class="btn btn-lg btn-success" href="/login"
                                                id="loginButtonMobile"><i class="ti ti-login"></i> Login</a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    /* Active class styling */
                    .navbar-nav .nav-item .menu-btn.active {
                        background-color: #5b6b79;
                        /* Customize active background color */
                        color: white;
                        font-weight: bold;
                        border-top: 2px solid #b2bec3;
                        border-bottom: 2px solid #b2bec3;
                    }

                    /* Make custom menu buttons parallelogram-shaped */
                    .navbar-nav .nav-item .menu-btn {
                        position: relative;
                        display: inline-block;
                        text-decoration: none;
                        background-color: #f0f0f0;
                        /* Default background color */
                        color: #333;
                        /* Text color */
                        font-weight: bold;
                        padding: 10px 20px;
                        transition: all 0.3s ease-in-out;
                        border-top: 2px solid #b2bec3;
                        border-bottom: 2px solid #b2bec3;
                    }

                    /* Add hover effects with animation */
                    .navbar-nav .nav-item .menu-btn:hover {
                        background-color: #5b6b79;
                        /* Hover background color */
                        color: white;
                        /* Hover text color */
                        border-top: 2px solid #b2bec3;
                        border-bottom: 2px solid #b2bec3;
                        transform: scale(1.05);
                        /* Slight scaling on hover */
                        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                        /* Add shadow for effect */
                        transition: all 0.3s ease-in-out;
                        /* Smooth animation */
                    }

                    /* For the active button */
                    .navbar-nav .nav-item .menu-btn.active {
                        border-top: 2px solid #b2bec3;
                        border-bottom: 2px solid #b2bec3;
                        background-color: #5b6b79;
                        color: white;
                    }
                </style>

                <!-- Horizontal menu for larger screens (visible on lg and above only) -->
                <div class="menu-section d-none d-lg-block">
                    <div class="container-fluid d-flex justify-content-between align-items-center">
                        <ul class="navbar-nav flex-row me-auto mb-2 align-items-center gap-3">
                            <li class="nav-item">
                                <a class="menu-btn py-1 px-4 {{ Request::is('/') ? 'active' : '' }}"
                                    href="/">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="menu-btn py-1 px-4 {{ Request::is('asuransi-profesi') ? 'active' : '' }}"
                                    href="/asuransi-profesi">Asuransi Tanggung Gugat Profesi</a>
                            </li>
                            <li class="nav-item">
                                <a class="menu-btn py-1 px-4 {{ Request::is('pialang-asuransi') ? 'active' : '' }}"
                                    href="/pialang-asuransi">Pialang Asuransi</a>
                            </li>
                            <li class="nav-item">
                                <a class="menu-btn py-1 px-4 {{ Request::is('asuransi-pendukung') ? 'active' : '' }}"
                                    href="/asuransi-pendukung">Asuransi Pendukung</a>
                            </li>
                            <li class="nav-item">
                                <a class="menu-btn py-1 px-4 {{ Request::is('hubungi-kami') ? 'active' : '' }}"
                                    href="/hubungi-kami">Hubungi Kami</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav flex-row ms-auto gap-1 align-items-center">
                            <li class="nav-item">
                                <a class="btn btn-success" style="font-weight: bold;" href="/login"
                                    id="loginButton"><i class="ti ti-login"></i> Login</a>
                                {{-- <a class="btn btn-info" style="font-weight: bold; display: none;" href="/dashboard"
                                    id="dashboardButton"><i class="ti ti-dashboard"></i> Dashboard</a> --}}
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            @yield('content-fullpage')
        </header>
        <!-- [ Header ] End -->
        @yield('content')
        <!-- [ footer apps ] start -->
        <footer class="footer margin-bottom-footer">
            <div class="border-top border-bottom footer-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="d-flex align-items-center flex-wrap justify-content-start">
                                <a href="/">
                                    <img src="./assets/images/tib-logo.svg" alt="img" style="width: 220px;" />
                                </a>
                                <h5><i>Insurance Broking & Consultant</i></h4>
                                <a href="https://ojk.go.id/id/" target="_blank" class="mt-2">
                                    <img src="{{ asset('assets/images/logo_ojk.png') }}" alt="logo-ojk"
                                        class="tib-logo" style="width: 180px;" />
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-sm-12 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="mb-4">PT Tugu Insurance Brokers</h5>
                                            <ul class="list-unstyled footer-link">
                                                <li>
                                                    <p>Surat Izin usaha OJK : 504/KMK.017/1994</p>
                                                </li>
                                                <li>
                                                    <p>Keanggotaan APPARINDO : 004 - 1986</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="mb-2">Temukan kami</h5>
                                            <ul class="list-unstyled footer-link">
                                                <li>
                                                    <a href="https://www.tib.co.id/" target="_blank"
                                                        class="media-link"> <i class="ti ti-world"
                                                            style="font-size: 28px;"></i> tib.co.id</a>
                                                </li>
                                                <li>
                                                    <a href="mailto:asprof@tib.co.id" class="media-link"> <i
                                                            class="ti ti-mail" style="font-size: 28px;"></i>
                                                        asprof@tib.co.id</a>
                                                </li>
                                                <li>
                                                    <a href="https://id-id.facebook.com/pages/category/Company/PT-Tugu-Insurance-Brokers-482851612051828/"
                                                        target="_blank" class="media-link">
                                                        <i class="ti ti-brand-facebook" style="font-size: 28px;"></i>
                                                        TuguBro
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.instagram.com/tugubro/" target="_blank"
                                                        class="media-link"> <i class="ti ti-brand-instagram"
                                                            style="font-size: 28px;"></i> @tugubro</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 my-1 wow fadeInUp text-center" data-wow-delay="0.6s">
                        <a class="link-primary" href="/syarat-ketentuan" style="font-size: 16px;">Syarat &
                            Ketentuan</a>
                        <span class="separator"> • </span>
                        <a class="link-primary" href="/kebijakan-privasi" style="font-size: 16px;">Kebijakan
                            Privasi</a>
                    </div>
                    <div class="col-12 my-1 wow fadeInUp text-center" data-wow-delay="0.4s">
                        <p>&copy; Copyrights 2024. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- [ footer apps ] End -->
    </div>
    <style>
        #chat-box {
            position: fixed;
            bottom: 80px;
            /* Adjusted to appear above the toggle button */
            right: 20px;
            z-index: 1000;
            width: 100%;
            max-width: 480px;
            transition: all 0.3s ease;
        }

        #chat-body {
            height: auto;
        }

        .offcanvas-fullscreen {
            height: 100vh !important;
        }

        @media (max-width: 768px) {
            #chat-box {
                display: none;
            }
        }

        @media (min-width: 769px) {
            #mobile-chat-btn {
                display: none;
            }
        }

        .chat-input-container {
            display: flex;
            align-items: center;
            border-top: 1px solid #ddd;
            padding: 10px;
            background: #f8f9fa;
        }

        .chat-input {
            flex-grow: 1;
            border: none;
            border-radius: 20px;
            padding: 10px 15px;
            font-size: 14px;
            outline: none;
            resize: none;
            background: #fff;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .chat-input:focus {
            border-color: #007bff;
            box-shadow: inset 0 1px 3px rgba(0, 123, 255, 0.25);
        }

        .send-btn {
            background-color: #007bff;
            border: none;
            margin-left: 10px;
            border-radius: 50%;
            padding: 10px 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 16px;
            width: 40px;
            height: 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .send-btn:hover {
            background-color: #0056b3;
        }

        .send-btn:active {
            background-color: #004085;
            box-shadow: none;
        }
    </style>

    <!-- Desktop Chat Box -->
    <div id="chat-box" class="d-none d-md-block">
        <div class="card"
            style="margin-bottom: 0; box-shadow: 0 2rem 2rem rgba(0, 0, 0, 0.175) !important; border: 0;"
            style="display: none;">
            <div class="card-header bg-primary p-3" id="chat-header" style="display: none;">
                <h3 class="text-white" id="chat-title">Chat</h3>
            </div>
            <!-- Chat Body -->
            <div class="card-body p-2" id="chat-body" style="display: none;">
                <div id="department-selection">
                    <p class="text-muted">Silakan pilih departemen:</p>
                    <button class="btn btn-sm btn-light-dark w-100 mb-2 department-btn" data-department="Marketing"
                        role="button">
                        <i class="fas fa-user me-1"></i> Marketing
                    </button>
                    <button class="btn btn-sm btn-light-dark w-100 department-btn" data-department="Medikolegal"
                        role="button">
                        <i class="fas fa-user-md me-1"></i> Medikolegal
                    </button>
                </div>
                <div id="chat-messages"
                    style="height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; display: none;">
                    <p class="text-muted">No messages yet...</p>
                </div>
                <div class="mt-2" id="chat-input-section" style="display: none;">
                    <div class="chat-input-container">
                        <textarea class="form-control chat-input" id="chat-input" placeholder="Type your message here..."></textarea>
                        <button class="btn btn-primary send-btn" id="send-message">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Desktop Chat Button -->
    {{-- <button class="btn btn-primary d-non d-md-block" id="toggle-chat-btn" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    <i class="ti ti-message-circle" id="toggle-chat-icon" style="font-size: 28px"></i>
</button>

<!-- Mobile Chat Button -->
<button class="btn btn-primary d-block d-md-none" id="mobile-chat-btn" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    <i class="ti ti-message-circle" style="font-size: 28px"></i>
</button> --}}

    <!-- Tombol FAQ -->
    <a href="/faq" class="btn btn-info" id="btn-faq"
        style="position: fixed; bottom: 20px; left: 20px; z-index: 1000;">
        <i style="font-size: 20px">FAQ</i>
    </a>

    <!-- Offcanvas for Mobile -->
    {{-- <div class="offcanvas offcanvas-bottom offcanvas-fullscreen" id="mobileChat" tabindex="-1">
    <div class="offcanvas-header bg-primary text-white">
        <h5 class="text-white" id="mobileChatTitle">Chat</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div id="mobile-department-selection">
            <p class="text-muted">Silakan pilih departemen:</p>
            <button class="btn btn-sm btn-light-dark w-100 mb-2 department-btn" data-department="Marketing" role="button">
                <i class="fas fa-user me-1"></i> Marketing
            </button>
            <button class="btn btn-sm btn-light-dark w-100 department-btn" data-department="Medikolegal" role="button">
                <i class="fas fa-user-md me-1"></i> Medikolegal
            </button>
        </div>
        <div id="mobile-chat-messages" style="height: 75%; overflow-y: auto; border: 1px solid #ddd; padding: 10px; display: none;">
            <p class="text-muted">No messages yet...</p>
        </div>
        <div class="mt-2" id="mobile-chat-input-section" style="display: none;">
            <div class="chat-input-container">
                <textarea class="form-control chat-input" id="chat-input" placeholder="Type your message here..."></textarea>
                <button class="btn btn-primary send-btn" id="send-message">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>

        </div>
    </div>
</div> --}}

    <!-- [ Main Content ] end -->
    <!-- Jquery -->
    <script src="{{ asset('assets/js/plugins/jquery-3.7.1.min.js') }}"></script>
    <!-- Required Js -->
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <!-- [Page Specific JS] start -->
    <script src="{{ asset('assets/js/plugins/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/Jarallax.js') }}"></script>
    <script>

        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/66d5662aea492f34bc0ca4ed/1i6ope6ck';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();

        // Start [ Menu hide/show on scroll ]
        let ost = 0;
        document.addEventListener("scroll", function() {
            let cOst = document.documentElement.scrollTop;
            if (cOst == 0) {
                document.querySelector(".navbar").classList.add("top-nav-collapse");
            } else if (cOst > ost) {
                document.querySelector(".navbar").classList.add("top-nav-collapse");
                document.querySelector(".navbar").classList.remove("default");
            } else {
                document.querySelector(".navbar").classList.add("default");
                document.querySelector(".navbar").classList.remove("top-nav-collapse");
            }
            ost = cOst;
        });
        // End [ Menu hide/show on scroll ]
        var wow = new WOW({
            animateClass: "animated",
        });
        wow.init();

        // Helper function to set cookies
        function setCookie(name, value, hours) {
            const date = new Date();
            date.setTime(date.getTime() + (hours * 60 * 60 * 1000));
            document.cookie = name + "=" + value + "; expires=" + date.toUTCString() + "; path=/";
        }

        function getCookie(name) {
            // Fungsi ini sudah ada, kita gunakan kembali
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function updateLoginButton() {
            const fiatCookie = getCookie('piat');
            // Tombol Desktop
            const loginBtn = $('#loginButton');
            const dashboardBtn = $('#dashboardButton');
            // Tombol Mobile
            const loginBtnMobile = $('#loginButtonMobile');
            const dashboardBtnMobile = $('#dashboardButtonMobile');

            if (fiatCookie) {
                // Jika cookie 'fiat' ada
                $('#loginButton, #loginButtonMobile').attr('href','/dashboard')
                 $('#loginButton, #loginButtonMobile').html('<i class="ti ti-presentation"></i> Dashboard')
            } else {
               $('#loginButton, #loginButtonMobile').attr('href','/login')
                $('#loginButton, #loginButtonMobile').html('<i class="ti ti-login"></i> Login')
            }
        }

        // Jalankan pengecekan saat halaman dimuat
        updateLoginButton();

        $(document).ready(function() {

            // Check if the splash screen cookie exists
            if (!getCookie('splashscreen_seen')) {
                $('#splashscreen').show();
            } else {
                $('#main-content').show();
            }

            $('#closeSplashscreen').click(function() {
                $('#splashscreen').slideUp();
                $('#main-content').slideDown();

                // Set a cookie to remember that the splash screen was seen
                setCookie('splashscreen_seen', 'true', 24); // 24 hours
            });

            // Unified function to handle department selection
            function selectDepartment(department) {
                if (department === 'Marketing') {
                    const loadingMessage = `<div class="text-center">
                        <i class="fas fa-spinner fa-spin"></i> Mohon ditunggu, kami akan segera menghubungkan Anda dengan tim marketing kami...
                    </div>`;
                    $('#department-selection, #mobile-department-selection').hide();
                    $('#chat-messages, #mobile-chat-messages').html(loadingMessage).show();
                    setTimeout(() => {
                        $('#chat-title, #mobileChatTitle').text(`Chat - ${department}`);
                        $('#chat-messages, #mobile-chat-messages').html('');
                        $('#chat-input-section, #mobile-chat-input-section').show();
                    }, 3000); // Simulate loading for 3 seconds
                } else if (department === 'Medikolegal') {
                    window.location.href = '/chat';
                }
            }

            // Attach event listener to department buttons
            $('.department-btn').on('click', function() {
                const department = $(this).data('department');
                selectDepartment(department);
            });

            // Toggle chat visibility (Desktop)
            $('#toggle-chat-btn').on('click', function() {
                const chatBody = $('#chat-body');
                const chatHeader = $('#chat-header');
                const isVisible = chatBody.css('display') !== 'none';

                // Toggle visibility of chat elements
                chatBody.slideToggle();
                chatHeader.slideToggle();

                // Change icon based on visibility
                const icon = $('#toggle-chat-icon');
                if (isVisible) {
                    icon.removeClass('ti-x').addClass('ti-message-circle'); // Set to chat icon
                } else {
                    icon.removeClass('ti-message-circle').addClass('ti-x'); // Set to close icon
                }
            });

            // Open mobile offcanvas
            $('#mobile-chat-btn').on('click', function() {
                const offcanvasElement = new bootstrap.Offcanvas(document.getElementById('mobileChat'));
                offcanvasElement.show();
            });

            // Handle sending messages (Desktop)
            $('#send-message').on('click', function() {
                const message = $('#chat-input').val().trim();
                if (message) {
                    $('#chat-messages').append(
                        `<div class="text-end"><span class="badge bg-primary">${message}</span></div>`);
                    $('#chat-input').val('');
                    $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
                }
            });

            // Handle sending messages (Mobile)
            $('#mobile-send-message').on('click', function() {
                const message = $('#mobile-chat-input').val().trim();
                if (message) {
                    $('#mobile-chat-messages').append(
                        `<div class="text-end"><span class="badge bg-primary">${message}</span></div>`);
                    $('#mobile-chat-input').val('');
                    $('#mobile-chat-messages').scrollTop($('#mobile-chat-messages')[0].scrollHeight);
                }
            });
        });
    </script>
    @stack('levelPluginsJs')
</body>

</html>
