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
            font-size: inherit; /* Normal button font size */
        }

        /* For screens larger than 768px (tablet and above) */
        @media (min-width: 768px) {
            #closeSplashscreen {
                font-size: 20px;
            }
        }
        /* Animation for the specific class on hover */
        .animated-image {
        transition: transform 0.3s ease-in-out; /* Smooth transition */
        }

        .animated-image:hover {
        transform: scale(1.1); /* Slightly enlarges the image */
        }

        @media (max-width: 768px) { /* Adjust based on your breakpoint for mobile */
            .animated-image {
                width: 50%;
            }
        }

        @media (min-width: 769px) { /* Above mobile width */
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
            color: #ff5733; /* Change to your desired hover text color */
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
         0%, 20%, 50%, 80%, 100% {
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
         bottom: 0;
         width: 100%;
         background-color: #f7f7f7;
         color: #fff;
         z-index: 1099;
         padding: 10px 0;
         }
         /* Ukuran font default */
         .menu-section .navbar-nav .nav-item .btn {
         font-size: 14px; /* Default font size */
         margin-right: 5px;
         }
         /* Media query untuk layar antara 992px dan 1399px */
         @media (min-width: 992px) and (max-width: 1399px) {
         .menu-section .navbar-nav .nav-item .btn {
         font-size: 12px; /* Ukuran font lebih kecil */
         margin-right: 0;
         }
         }
         /* Optional styling to adjust the look of the burger icon */
         .navbar-toggler-icon {
         color: #000;
         }
         .offcanvas.offcanvas-top {
         min-height: 100vh; /* Fullscreen height */
         height: 100%; /* Ensure it takes available space */
         }
         .offcanvas-body {
         overflow-y: auto; /* Scroll if content exceeds height */
         }
         .navbar-brand {
            display: flex;
            align-items: center;
        }

        .tib-logo {
            margin: 0 8px;
        }

        .image-divider {
            width:1px;
            height: 64px; /* Adjust height as needed */
            background-color: #ccc; /* Adjust color as needed */
        }
         @media (max-width: 768px) {
             .logo2{
                 display: block !important;
             }
             .logo1{
                 display: none;
             }
         } @media (min-width: 768px) {
             .logo2{
                 display: none;
             }
             .logo1{
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
                            <img src="{{ asset('assets/images/splashscreen/splashscreen.svg') }}" alt="img" class="img-fluid rounded" />
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
         <header id="home" style="background-image: url({{ asset('assets/images/landing/img-headerbg.png') }}">
            <!-- [ Nav ] start -->
            <nav class="navbar navbar-light default" style="background: #fff">
               <div class="container m-b-20">
                  <a class="navbar-brand logo1" href="/">
                  <img src="{{ asset('assets/images/tib-logo.svg') }}" alt="logo" class="tib-logo" />
                  </a>
                  <a class="navbar-brand logo1" href="/">
                    <img src="{{ asset('assets/images/landing/solusi-tepat-berasuransi.svg') }}" alt="logo" class="tib-logo" />
                    <span class="image-divider"></span>
                    <img src="{{ asset('assets/images/logo_ojk.png') }}" alt="logo" class="tib-logo" />
                  </a>
                  <a class="navbar-brand logo2" href="/" style="display: none">
                  <img src="{{ asset('assets/images/tib-logo.svg') }}" alt="logo" class="tib-logo" />
                    <img src="{{ asset('assets/images/landing/solusi-tepat-berasuransi.svg') }}" alt="logo" class="tib-logo" />
                    <span class="image-divider"></span>
                    <img src="{{ asset('assets/images/logo_ojk.png') }}" alt="logo" class="tib-logo" />
                  </a>
               </div>
               <!-- Collapsible burger menu for mobile screens (visible on mobile only) -->
               <div class="menu-section d-lg-none text-end">
                <div class="container">
                    <!-- Burger menu toggle button -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavMobile" aria-controls="navbarNavMobile" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Fullscreen offcanvas menu -->
                    <div class="offcanvas offcanvas-top" tabindex="-1" id="navbarNavMobile" aria-labelledby="navbarNavMobileLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="navbarNavMobileLabel">Menu</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body d-flex flex-column justify-content-center align-items-center">
                            <ul class="navbar-nav my-auto gap-1 align-items-center text-center">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" style="font-size: 1.2rem; font-weight:400;" href="/">Beranda</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('asuransi-profesi') ? 'active' : '' }}" style="font-size: 1.2rem; font-weight:400;" href="/">Asuransi Profesi</a>
                                </li>
                                    <a class="nav-link {{ Request::is('pialang-asuransi') ? 'active' : '' }}" style="font-size: 1.2rem; font-weight:400;" href="/tentang-kami">Pialang Asuransi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('asuransi-pendukung') ? 'active' : '' }}" style="font-size: 1.2rem; font-weight:400;" href="/asuransi-pendukung">Asuransi Pendukung</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('hubungi-kami') ? 'active' : '' }}" style="font-size: 1.2rem; font-weight:400;" href="/hubungi-kami">Hubungi Kami</a>
                                </li>
                            </ul>
                            <div class="row gap-3 mt-auto w-100">
                                <div class="col-12">
                                    <div class="d-grid">
                                        <a class="btn btn-lg btn-success" href="/login"><i class="ti ti-login"></i> Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                /* Active class styling */
                .navbar-nav .nav-item .menu-btn.active {
                    background-color: #5b6b79; /* Customize active background color */
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
                    background-color: #f0f0f0; /* Default background color */
                    color: #333; /* Text color */
                    font-weight: bold;
                    padding: 10px 20px;
                    transition: all 0.3s ease-in-out;
                    border-top: 2px solid #b2bec3;
                    border-bottom: 2px solid #b2bec3;
                }

                /* Add hover effects with animation */
                .navbar-nav .nav-item .menu-btn:hover {
                    background-color: #5b6b79; /* Hover background color */
                    color: white; /* Hover text color */
                    border-top: 2px solid #b2bec3;
                    border-bottom: 2px solid #b2bec3;
                    transform: scale(1.05); /* Slight scaling on hover */
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Add shadow for effect */
                    transition: all 0.3s ease-in-out; /* Smooth animation */
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
                    <div class="container d-flex justify-content-between align-items-center">
                        <ul class="navbar-nav flex-row me-auto mb-2 align-items-center gap-3">
                            <li class="nav-item">
                                <a class="menu-btn py-1 px-4 {{ Request::is('/') ? 'active' : '' }}" href="/">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="menu-btn py-1 px-4 {{ Request::is('asuransi-profesi') ? 'active' : '' }}" href="/asuransi-profesi">Asuransi Profesi</a>
                            </li>
                            <li class="nav-item">
                                <a class="menu-btn py-1 px-4 {{ Request::is('pialang-asuransi') ? 'active' : '' }}" href="/pialang-asuransi">Pialang Asuransi</a>
                            </li>
                            <li class="nav-item">
                                <a class="menu-btn py-1 px-4 {{ Request::is('asuransi-pendukung') ? 'active' : '' }}" href="/asuransi-pendukung">Asuransi Pendukung</a>
                            </li>
                            <li class="nav-item">
                                <a class="menu-btn py-1 px-4 {{ Request::is('hubungi-kami') ? 'active' : '' }}" href="/hubungi-kami">Hubungi Kami</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav flex-row ms-auto gap-1 align-items-center">
                            <li class="nav-item">
                                <a class="btn btn-success" style="font-weight: bold;" href="/login"><i class="ti ti-login"></i> Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            @if (Request::is('/'))
            <div class="container">
                <div class="row justify-content-center align-items-center" style="margin-top: 80px; min-height: 60vh;">
                    <!-- Left Column for Image -->
                    <div class="col-12 col-md-5 text-center m-t-20">
                        <img
                            src="{{ asset('assets/images/landing/beranda.png') }}"
                            alt="img"
                            class="img-fluid animated-image"
                        />
                    </div>
                    <!-- Right Column for Text -->
                    <div class="col-12 col-md-7 d-flex align-items-center m-t-20">
                        <div>
                            <h1 class="h1 my-4 fw-bold wow fadeInUp" data-wow-delay="0.2s">
                                Apakah Anda sudah membaca dan paham isi
                                <span class="text-primary highlight-animate">polis asuransi</span> yang Anda beli?
                            </h1>
                            <h2 class="h2 my-4 wow fadeInUp" data-wow-delay="0.3s">
                                Jika tidak, mungkin produk asuransi yang Anda beli
                                <span class="text-danger fw-bold highlight-animate">tidak seperti yang Anda inginkan.</span>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
             <div class="arrow-down">
                 <button type="button" class="btn btn-link btn-lg text-primary" id="scroll-button">
                    <span class="info-text">info lebih lanjut</span><br />
                    <i class="fas fa-chevron-down bounce" style="font-size: 48px"></i>
                 </button>
              </div>
              <div id="main-scroll"></div>
             <script>
                 document.getElementById("scroll-button").addEventListener("click", function () {
                     document.getElementById("main-scroll").scrollIntoView({ behavior: "smooth" });
                 });
             </script>
            @elseif (Request::is('asuransi-profesi'))
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-md-12 m-t-30 text-center">
                     <h1 class="h1 my-4 wow fadeInUp" data-wow-delay="0.2s">
                        ASURANSI PROFESI <br />
                        <span style="font-weight: 900">TENAGA MEDIS & TENAGA KESEHATAN</span>
                     </h1>
                     <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                        <div class="col-md-12">
                           <img src="{{ asset('assets/images/landing/tenaga-kesehatan.svg') }}" alt="img" class="img-fluid rounded" />
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="arrow-down">
                <button type="button" class="btn btn-link btn-lg text-primary" id="scroll-button">
                   <span class="info-text">info lebih lanjut</span><br />
                   <i class="fas fa-chevron-down bounce" style="font-size: 48px"></i>
                </button>
             </div>
             <div id="main-scroll"></div>
            <script>
                document.getElementById("scroll-button").addEventListener("click", function () {
                    document.getElementById("main-scroll").scrollIntoView({ behavior: "smooth" });
                });
            </script>
            @elseif (Request::is('pialang-asuransi'))
            <div class="container">
                <div class="row">
                    <div class="col-12 m-b-30 wow fadeInLeft" data-wow-delay="0.2s" style="margin-top: 140px">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-center text-uppercase">Perbedaan Pialang Asuransi dengan Agen Asuransi</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-20 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="card bg-light" style="border: 2px solid #ff0000">
                            <div class="card-body p-3">
                                <h2 class="text-center text-uppercase">Pialang Asuransi</h2>
                                <hr/>
                                <ul class="pl-0" style="font-size: 1.3rem; font-weight:400; text-align: justify;">
                                    <li>
                                        Bertindak sebagai perantara independen antara klien dan perusahaan asuransi.
                                    </li>
                                    <li>
                                        Tidak terikat pada satu perusahaan asuransi, menawarkan produk dari berbagai perusahaan.
                                    </li>
                                    <li>
                                        Fokus pada kepentingan klien dengan memberikan rekomendasi yang obyektif.
                                    </li>
                                    <li>
                                        Membantu klien mulai dari memilih polis hingga proses klaim.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-20 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="card bg-light" style="border: 2px solid #112284">
                            <div class="card-body p-3">
                                <h2 class="text-center text-uppercase">Agen Asuransi</h2>
                                <hr/>
                                <ul class="pl-0" style="font-size: 1.3rem; font-weight:400; text-align: justify;">
                                    <li>
                                        Bertindak sebagai perwakilan resmi dari perusahaan asuransi tertentu.
                                    </li>
                                    <li>
                                        Hanya menawarkan produk dari perusahaan asuransi yang diwakilinya.
                                    </li>
                                    <li>
                                        Fokus pada memasarkan produk perusahaan dan mencapai target penjualan.
                                    </li>
                                    <li>
                                        Membantu proses pembelian polis, tetapi keterlibatan dalam klaim biasanya terbatas.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif (Request::is('asuransi-pendukung'))
            <div class="container title mb-0" id="asuransi-pendukung-section">
               <div class="row align-items-center">
                  <div class="col-12 text-center m-b-30 wow fadeInLeft" data-wow-delay="0.2s" style="margin-top: 80px">
                     <h2 class="text-center uppercase m-b-20">asuransi pendukung</h2>
                  </div>
                  <!-- First Card -->
                  <div class="col-12 col-md-4">
                     <div class="card" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
                        <img class="img-fluid hei-150 d-block mx-auto" src="{{ asset('assets/images/landing/asuransi-asei.png') }}" alt="Card image" style="object-fit: contain;">
                        <div class="card-body text-center d-grid p-0">
                           <a href="https://www.asei.co.id/" target="blank" class="btn btn-primary btn-lg" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; border-top-right-radius: 0px; border-top-left-radius: 0px;">
                           Lihat lebih lengkap <i class="ti ti-chevron-right"></i>
                           </a>
                        </div>
                     </div>
                  </div>
                  <!-- Second Card -->
                  <div class="col-12 col-md-4">
                     <div class="card" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
                        <img class="img-fluid hei-150 d-block mx-auto" src="{{ asset('assets/images/landing/asuransi-bgu.png') }}" alt="Card image" style="object-fit: contain;">
                        <div class="card-body text-center d-grid p-0">
                           <a href="https://asuransibinagriya.com/" target="blank" class="btn btn-primary btn-lg" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; border-top-right-radius: 0px; border-top-left-radius: 0px;">
                           Lihat lebih lengkap <i class="ti ti-chevron-right"></i>
                           </a>
                        </div>
                     </div>
                  </div>
                  <!-- Third Card -->
                  <div class="col-12 col-md-4">
                     <div class="card" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
                        <img class="img-fluid hei-150 d-block mx-auto" src="{{ asset('assets/images/landing/asuransi-fpg.png') }}" alt="Card image" style="object-fit: contain;">
                        <div class="card-body text-center d-grid p-0">
                           <a href="https://id.fpgins.com/" target="blank" class="btn btn-primary btn-lg" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; border-top-right-radius: 0px; border-top-left-radius: 0px;">
                           Lihat lebih lengkap <i class="ti ti-chevron-right"></i>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @elseif (Request::is('hubungi-kami'))
            <div class="container">
               <div class="row justify-content-center" style="margin-top: 80px">
                  <div class="text-center my-5">
                     <h1 class="text-center">PT. TUGU INSURANCE BROKERS</h1>
                  </div>
                  <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 my-2">
                     <div class="card">
                        <div class="card-body">
                           <h3 class="card-title">Kantor Pusat</h3>
                           <div class="d-flex align-items-center my-2">
                              <div class="flex-shrink-0">
                                 <div class="avtar avtar-s bg-light-primary">
                                    <i class="ti ti-building f-20"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <h5 class="mb-0">Graha Pratama 3rd Floor<br>
                                    JL. M. T. Haryono Kav 15 Jakarta 12810 Indonesia.
                                 </h5>
                              </div>
                           </div>
                           <div class="d-flex align-items-center my-2">
                              <div class="flex-shrink-0">
                                 <div class="avtar avtar-s bg-light-primary">
                                    <i class="ti ti-phone-call f-20"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <h5 class="mb-0"><a href="tel:02183790789" class=" link-primary"> 021 - 83790789</a></h5>
                              </div>
                           </div>
                           <div class="d-flex align-items-center justify-content-between mt-4">
                              <a href="https://goo.gl/maps/rrF9oGzxiRNYk7fd9" class="btn btn-primary" target="blank">
                              <i class="ti ti-location f-20 me-1"></i> view on map
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-body">
                           <h3 class="card-title">Kantor Perwakilan</h3>
                           <div class="d-flex align-items-center my-2">
                              <div class="flex-shrink-0">
                                 <div class="avtar avtar-s bg-light-primary">
                                    <i class="ti ti-building f-20"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <h5 class="mb-0">Cluster Delta Pelangi 2 No.73, Perumahan Deltasari Baru,<br>
                                    Ngingas, Waru, Sidoarjo, Jawa Timur 61256
                                 </h5>
                              </div>
                           </div>
                           <div class="d-flex align-items-center my-2">
                              <div class="flex-shrink-0">
                                 <div class="avtar avtar-s bg-light-primary">
                                    <i class="ti ti-phone-call f-20"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <h5 class="mb-0"><a href="tel:03185583459" class=" link-primary"> 031-85583459</a></h5>
                              </div>
                           </div>
                           <div class="d-flex align-items-center justify-content-between mt-4">
                              <a href="https://maps.app.goo.gl/eHiPSZurnbaNnvPM6" class="btn btn-primary" target="blank">
                              <i class="ti ti-location f-20 me-1"></i> view on map
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 my-2">
                     <div class="card">
                        <div class="card-body">
                           <div class="row">
                              <h2 class=" text-uppercase">hubungi kami</h2>
                              <div class="col-12">
                                 <div class="form-group">
                                    <label class="form-label">Email id</label>
                                    <input type="email" class="form-control" placeholder="Email" />
                                 </div>
                              </div>
                              <div class="col-12">
                                 <div class="form-group">
                                    <label class="form-label">Pesan anda</label>
                                    <textarea rows="3" class="form-control" placeholder="Pesan" ></textarea>
                                 </div>
                              </div>
                              <div class="col-12">
                                 <div class="mt-4 d-grid">
                                    <button type="button" class="btn btn-primary">Submit</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @elseif (Request::is('pendampingan-dan-jaminan'))
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-md-12 m-t-30 text-center">
                     <h1 class="h1 my-4 wow fadeInUp" data-wow-delay="0.2s">
                        Bagaimana Pendampingan dan Jaminan yang diberikan <br />
                        <span style="font-weight: 900">ASURANSI PROFESI?</span>
                     </h1>
                     <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                        <div class="col-md-12">
                           <img src="{{ asset('assets/images/landing/tenaga-medis.svg') }}" alt="img" class="img-fluid rounded" />
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @elseif (Request::is('tata-cara'))
            <div class="container">
               <div class="row justify-content-center" style="margin-top: 80px">
                  <div class="col-md-12 m-t-30 text-center">
                     <h1 class="h1 my-4 wow fadeInUp" data-wow-delay="0.2s">
                        Bagaimana Tata Cara Menjadi Peserta <br />
                        <span style="font-weight: 900">ASURANSI PROFESI?</span>
                     </h1>
                     <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                        <div class="col-md-4">
                           <img src="{{ asset('assets/images/landing/tata-cara.svg') }}" alt="img" class="img-fluid rounded" />
                        </div>
                        <div class="col-md-8">
                           <ol class="list-group list-group-numbered" style="font-size: 1.3rem; font-weight: 500; margin: 0">
                                <li class="list-group-item">Persiapkan dokumen Anda seperti KTP, STR dan SIP. Setelah itu isi form dan unggah dokumen tersebut pada menu <a href="/pendaftaran" class="btn btn-sm  btn-primary" target="blank"> <i class="ti ti-forms me-1"></i> Daftar</a></li>
                                <li class="list-group-item">Data yang telah disubmit akan divalidasi oleh tim TuguBro, selanjutnya akan diinformasikan untuk melakukan konfirmasi pendaftaran melalui email</li>
                                <li class="list-group-item">Peserta dapat melakukan pembayaran dengan memilih metode pembayaran yang kami sediakan setelah melakukan konfirmasi pendaftaran</li>
                                <li class="list-group-item">E-sertifikat dapat diunduh pada dashboard peserta dengan melakukan login menggunakan nomor STR dan alamat email yang terdaftar melalui tombol <a class="btn btn-sm btn-success" href="/login"><i class="ti ti-login"></i> Masuk</a></li>
                            </ol>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @endif
         </header>
         <!-- [ Header ] End -->
         @yield('content')
         <!-- [ footer apps ] start -->
         <footer class="footer margin-bottom-footer">
            <div class="border-top border-bottom footer-center">
               <div class="container">
                  <div class="row">
                     <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                        <a href="/">
                        <img src="./assets/images/tib-logo.svg" alt="img" style="width: 128px;" />
                        </a>
                        <p>PT Tugu Insurance Brokers</p>
                        <table style="border: 0px; color: #050505;margin-bottom:2rem" class="mt-2">
                           <tr>
                              <td>
                                 Surat Izin usaha OJK
                              </td>
                              <td>
                                 : 504/KMK.017/1994
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 Keanggotaan APPARINDO
                              </td>
                              <td>
                                 : 004 - 1986
                              </td>
                           </tr>
                           <tr>
                              <td colspan="2">
                                 Berizin dan Diawasi oleh Otoritas Jasa Keuangan
                              </td>
                           </tr>
                        </table>
                     </div>
                     <div class="col-md-8">
                        <div class="row">
                           <div class="col-sm-12 wow fadeInUp" data-wow-delay="1s">
                              <h5 class="mb-2">Temukan kami</h5>
                              <div class="row">
                                 <div class="col-md-8">
                                    <ul class="list-unstyled footer-link">
                                       <li>
                                          <a href="https://www.tib.co.id/" target="_blank" class="media-link"> <i class="ti ti-world" style="font-size: 28px;"></i> tib.co.id</a>
                                       </li>
                                       <li>
                                          <a href="https://maps.app.goo.gl/BHNXZZvGC1f7CLUV6" target="_blank" class="media-link"> <i class="ti ti-building" style="font-size: 28px;"></i> Graha Pratama 3rd Floor <br>JL. M. T. Haryono Kav 15 Jakarta 12810 Indonesia.</a>
                                       </li>
                                       <li>
                                          <a href="tel:021-83790789" target="_blank" class="media-link"> <i class="ti ti-phone-call" style="font-size: 28px;"></i> 021 - 83790789</a>
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-4">
                                    <ul class="list-unstyled footer-link">
                                       <li>
                                          <a href="mailto:asprof@tib.co.id" class="media-link"> <i class="ti ti-mail" style="font-size: 28px;"></i> asprof@tib.co.id</a>
                                       </li>
                                       <li>
                                          <a href="https://id-id.facebook.com/pages/category/Company/PT-Tugu-Insurance-Brokers-482851612051828/" target="_blank" class="media-link">
                                          <i class="ti ti-brand-facebook" style="font-size: 28px;"></i> PT Tugu Insurance Brokers
                                          </a>
                                       </li>
                                       <li>
                                          <a href="https://www.instagram.com/tugubro/" target="_blank" class="media-link"> <i class="ti ti-brand-instagram" style="font-size: 28px;"></i> @tugubro</a>
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
                  <div class="col-12 my-1 wow fadeInUp text-center" data-wow-delay="0.4s">
                     <a class="link-primary" href="/syarat-ketentuan" style="font-size: 16px;">Syarat & Ketentuan</a>
                     <span class="separator"> • </span>
                     <a class="link-primary" href="/kebijakan-privasi" style="font-size: 16px;">Kebijakan Privasi</a>
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
            bottom: 80px; /* Adjusted to appear above the toggle button */
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
    <div class="card" style="margin-bottom: 0; box-shadow: 0 2rem 2rem rgba(0, 0, 0, 0.175) !important; border: 0;" style="display: none;">
        <div class="card-header bg-primary p-3" id="chat-header" style="display: none;">
            <h3 class="text-white" id="chat-title">Chat</h3>
        </div>
        <!-- Chat Body -->
        <div class="card-body p-2" id="chat-body" style="display: none;">
            <div id="department-selection">
                <p class="text-muted">Silakan pilih departemen:</p>
                <button class="btn btn-sm btn-light-dark w-100 mb-2 department-btn" data-department="Marketing" role="button">
                    <i class="fas fa-user me-1"></i> Marketing
                </button>
                <button class="btn btn-sm btn-light-dark w-100 department-btn" data-department="Medikolegal" role="button">
                    <i class="fas fa-user-md me-1"></i> Medikolegal
                </button>
            </div>
            <div id="chat-messages" style="height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; display: none;">
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
<button class="btn btn-primary d-non d-md-block" id="toggle-chat-btn" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    <i class="ti ti-message-circle" id="toggle-chat-icon" style="font-size: 28px"></i>
</button>

<!-- Mobile Chat Button -->
<button class="btn btn-primary d-block d-md-none" id="mobile-chat-btn" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    <i class="ti ti-message-circle" style="font-size: 28px"></i>
</button>

<!-- Tombol FAQ -->
<a href="/faq" class="btn btn-info" id="btn-faq" style="position: fixed; bottom: 20px; left: 20px; z-index: 1000;">
    <i style="font-size: 20px">FAQ</i>
</a>

<!-- Offcanvas for Mobile -->
<div class="offcanvas offcanvas-bottom offcanvas-fullscreen" id="mobileChat" tabindex="-1">
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
</div>

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
      <script src="https://cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js"></script>
      <script src="{{ asset('assets/js/plugins/Jarallax.js') }}"></script>
      <script>
         // Start [ Menu hide/show on scroll ]
         let ost = 0;
         document.addEventListener("scroll", function () {
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

        // Helper function to get cookies
        function getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

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
            $('.department-btn').on('click', function () {
                const department = $(this).data('department');
                selectDepartment(department);
            });

            // Toggle chat visibility (Desktop)
            $('#toggle-chat-btn').on('click', function () {
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
            $('#mobile-chat-btn').on('click', function () {
                const offcanvasElement = new bootstrap.Offcanvas(document.getElementById('mobileChat'));
                offcanvasElement.show();
            });

            // Handle sending messages (Desktop)
            $('#send-message').on('click', function () {
                const message = $('#chat-input').val().trim();
                if (message) {
                    $('#chat-messages').append(`<div class="text-end"><span class="badge bg-primary">${message}</span></div>`);
                    $('#chat-input').val('');
                    $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
                }
            });

            // Handle sending messages (Mobile)
            $('#mobile-send-message').on('click', function () {
                const message = $('#mobile-chat-input').val().trim();
                if (message) {
                    $('#mobile-chat-messages').append(`<div class="text-end"><span class="badge bg-primary">${message}</span></div>`);
                    $('#mobile-chat-input').val('');
                    $('#mobile-chat-messages').scrollTop($('#mobile-chat-messages')[0].scrollHeight);
                }
            });
        });
      </script>
   </body>
</html>
