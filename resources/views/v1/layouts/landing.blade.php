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
      <section class="bg-white overflow-hidden" id="splashscreen">
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
            <div class="arrow-down">
               <button type="button" class="btn btn-link btn-lg text-primary">
               <i class="fas fa-chevron-down bounce" style="font-size: 48px"></i>
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
                                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" style="font-size: 1.2rem; font-weight:400;" href="/">Asuransi Profesi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('tentang-kami') ? 'active' : '' }}" style="font-size: 1.2rem; font-weight:400;" href="/tentang-kami">Manfaat Pialang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('tata-cara') ? 'active' : '' }}" style="font-size: 1.2rem; font-weight:400;" href="/tata-cara">Tata Cara</a>
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
                                        <a class="btn btn-lg btn-success" href="/login"><i class="ti ti-login"></i> Masuk</a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <a class="btn btn-lg btn-primary" href="/pendaftaran"><i class="ti ti-forms"></i> Daftar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                /* Active class styling */
                .navbar-nav .nav-item .btn.active {
                    background-color: #5b6b79; /* Customize active background color */
                    color: white;
                    font-weight: bold;
                    border-color: #5b6b79;
                }
                .navbar-nav .nav-item .nav-link.active {
                    color: #4680ff;
                    font-weight: 900;
                }
            </style>

               <!-- Horizontal menu for larger screens (visible on lg and above only) -->
               <div class="menu-section d-none d-lg-block">
                  <div class="container d-flex justify-content-between align-items-center">
                     <ul class="navbar-nav flex-row me-auto mb-2 align-items-center">
                        <li class="nav-item">
                           <a class="btn btn-light-secondary p-1 {{ Request::is('/') ? 'active' : '' }}" href="/">Asuransi Profesi</a>
                        </li>
                        <li class="nav-item">
                           <a class="btn btn-light-secondary p-1 {{ Request::is('tentang-kami') ? 'active' : '' }}" href="/tentang-kami">Manfaat Pialang</a>
                        </li>
                        <li class="nav-item">
                           <a class="btn btn-light-secondary p-1 {{ Request::is('tata-cara') ? 'active' : '' }}" href="/tata-cara">Tata Cara</a>
                        </li>
                        <li class="nav-item">
                           <a class="btn btn-light-secondary p-1 {{ Request::is('asuransi-pendukung') ? 'active' : '' }}" href="/asuransi-pendukung">Asuransi Pendukung</a>
                        </li>
                        <li class="nav-item">
                           <a class="btn btn-light-secondary p-1 {{ Request::is('hubungi-kami') ? 'active' : '' }}" href="/hubungi-kami">Hubungi Kami</a>
                        </li>
                     </ul>
                     <ul class="navbar-nav flex-row ms-auto gap-1 align-items-center">
                        <li class="nav-item">
                           <a class="btn btn-sm btn-success" href="/login"><i class="ti ti-login"></i> Masuk</a>
                        </li>
                        <li class="nav-item">
                           <a class="btn btn-sm btn-primary" href="/pendaftaran"><i class="ti ti-forms"></i> Daftar</a>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav>
            @if (Request::is('/'))
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
            @elseif (Request::is('tentang-kami'))
            <div class="container">
               <div class="row">
                <div class="col-12 text-center m-b-30 wow fadeInLeft" data-wow-delay="0.2s" style="margin-top: 140px">
                   <h2 class="text-center uppercase">Manfaat Pialang</h2>
                </div>
                  <div class="col-12">
                     <div class="card bg-light">
                        <div class="card-body p-3">
                           <div class="row">
                              <div class="col-12 col-md-6">
                                 <iframe style="width: 100%; max-width: inherit; height: 540px; border-radius: 12px;" height="215" src="https://www.youtube.com/embed/ScFFzpX8esY?si=_IYM7kWek2ZrSMKN" title="TuguBro - Company Profile 2024" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                              </div>
                              <div class="col-12 col-md-6">
                                 <h4 class="m-b-30" style="text-align: justify; line-height:2rem; font-size: 1.3rem; font-weight:400;">PT. Tugu Insurance Brokers atau dikenal dengan Tugu-Bro, merupakan Perusahaan Pialang Asuransi yang didirikan sejak tahun 1976 dan menjadi salah satu pelopor berdirinya industri Pialang Asuransi di Indonesia.</h4>
                                 <h4 class="m-b-30" style="text-align: justify; line-height:2rem; font-size: 1.3rem; font-weight:400;">Tugu-Bro terdaftar dan diawasi oleh Otoritas Jasa Keuangan. Dengan pengalaman lebih dari 48 tahun, Tugu-Bro selalu berinovasi menghadirkan program-program asuransi yang tepat dengan mengedepankan Profesionalitas, Intelektualitas dan Kepuasan Pelanggan yang didukung teknologi Informasi modern, serta tenaga profesional yang bersertifikasi.</h4>
                                 <h4 class="m-b-30" style="text-align: justify; line-height:2rem; font-size: 1.3rem; font-weight:400;">Tugu-Bro menggunakan aplikasi digital yang memudahkan nasabah dalam melakukan proses berasuransi, dimana saja dan kapan saja.</h4>
                              </div>
                              <div class="col-12">
                                 <h4 class="m-b-30" style="text-align: justify; line-height:2rem; font-size: 1.3rem; font-weight:400;">Tugu-Bro memiliki tim Medikolegal dan Mediator berpengalaman serta bersertifikasi, yang akan menjadi sahabat diskusi anda selama berasuransi, kapanpun, mulai dari pemilihan dan penutupan asuransi sampai pendampingan proses klaim, termasuk memberikan layanan Konsultasi, Negosiasi, Mediasi, Konsiliasi, sampai Penilaian atau pendapat para Ahli dibidangnya.</h4>
                                 <h4 class="m-b-30" style="text-align: justify; line-height:2rem; font-size: 1.3rem; font-weight:400;">Kabar baiknya, semua layanan yang kami berikan Free of charge! Kecuali biaya Premi yang harus anda bayarkan.</h4>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @elseif (Request::is('asuransi-pendukung'))
            <div class="container title mb-0">
               <div class="row align-items-center">
                  <div class="col-12 text-center m-b-30 wow fadeInLeft" data-wow-delay="0.2s" style="margin-top: 80px">
                     <h2 class="text-center uppercase m-b-20">asuransi pendukung</h2>
                  </div>
                  <!-- First Card -->
                  <div class="col-12 col-md-4">
                     <div class="card" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
                        <img class="img-fluid hei-150 d-block mx-auto" src="{{ asset('assets/images/landing/asuransi-askrida.png') }}" alt="Card image" style="object-fit: contain;">
                        <div class="card-body text-center d-grid p-0">
                           <a href="https://askrida.com/" target="blank" class="btn btn-primary btn-lg" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; border-top-right-radius: 0px; border-top-left-radius: 0px;">
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
         <!-- [ footer apps ] End -->>
      </div>
      <!-- Floating Action Button for WhatsApp -->
      <a href="#" style="z-index: 10;position: fixed; bottom: 5px; right: 20px; border-radius: 50%; width: 120px; height: 120px; display: flex; align-items: center; justify-content: center;">
      <image src="{{ asset('assets/images/Customer-Service-0812-6869-1976-(1).png') }}" style="width: 100%"></image>
      </a>
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

         $(document).ready(function() {
             setTimeout(function() {
                 $('#splashscreen').slideUp();
                 $('#main-content').slideDown();
             }, 1250); // 1.25 seconds

             $('.arrow-down').click(function() {
                 $('#splashscreen').slideUp();
                 $('#main-content').slideDown();
             });
         });
      </script>
   </body>
</html>
