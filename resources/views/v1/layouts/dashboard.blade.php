<!DOCTYPE html>
<html lang="en">
   <head>
      <title>TIB | Named & Nakes</title>
      <!-- [Meta] -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="Asuransi profesi tenaga medis dan tenaga kesehatan">
      <meta name="keywords" content="asuransi, tugubro, broker asuransi, asuransi profesi, tenaga kesehatan, tenaga medis">
      <meta name="author" content="tugubro">
      <!-- [Favicon] icon -->
      <link rel="icon" href="{{ asset('assets/images/tib-logo.svg') }}" type="image/x-icon">
      <!-- [Datepicker CSS] start -->
      <link rel="stylesheet" href="{{ asset('assets/css/plugins/datepicker-bs5.min.css') }}">
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
      <!-- BEGIN PAGE LEVEL SCRIPTS -->
      @stack('levelPluginsJsh')
      <!-- END PAGE LEVEL SCRIPTS -->
   </head>
   <body>
      <!-- [ Main Content ] start -->
      <!-- [ Pre-loader ] start -->
      <div class="loader-bg">
         <div class="loader-track">
            <div class="loader-fill"></div>
         </div>
      </div>
      <!-- [ Pre-loader ] End -->
      <!-- [ Sidebar Menu ] start -->
      <nav class="pc-sidebar">
         <div class="navbar-wrapper">
            <div class="m-header">
               <a href="/dashboard" class="b-brand text-primary">
               <img src="{{ asset('assets/images/tib-logo.svg') }}" alt="img" style="width: 100px;" />
               </a>
            </div>
            <div class="navbar-content">
               <style>
                  .pc-sidebar .pc-submenu .pc-link {
                  padding: 12px 30px 12px 43px;
                  }
               </style>
               <ul class="pc-navbar">
                  <li class="pc-item pc-caption">
                     <label>Menu</label>
                     <i class="ti ti-dashboard"></i>
                  </li>
                  <li class="pc-item">
                     <a href="/dashboard" class="pc-link" style="font-size: 18px !important;">
                     <i class="ti ti-presentation"></i>
                     <span class="pc-mtext">Dashboard</span>
                     </a>
                  </li>
                  <li class="pc-item pc-hasmenu">
                     <a href="#!" class="pc-link" style="font-size: 18px !important;">
                     <i class="ti ti-user-check"></i>
                     <span class="pc-mtext">Data Kepesertaan</span>
                     <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                     </a>
                     <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="/peserta" style="font-size: 16px">Informasi Peserta</a></li>
                        <li class="pc-item"><a class="pc-link" href="/info-polis" style="font-size: 16px">Informasi Polis</a></li>
                     </ul>
                  </li>
                  <li class="pc-item pc-hasmenu">
                     <a href="#!" class="pc-link" style="font-size: 18px !important;">
                     <i class="ti ti-file-invoice"></i>
                     <span class="pc-mtext">Akseptasi</span>
                     <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                     </a>
                     <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="/renewal" style="font-size: 16px">Renewal</a></li>
                        <li class="pc-item"><a class="pc-link" href="/cancellation" style="font-size: 16px">Cancellation</a></li>
                        <li class="pc-item"><a class="pc-link" href="/endorsement" style="font-size: 16px">Endorsement</a></li>
                     </ul>
                  </li>
                  {{-- <li class="pc-item">
                     <a href="/renewal" class="pc-link" style="font-size: 18px !important;">
                     <i class="ti ti-refresh-alert"></i>
                     <span class="pc-mtext">Renewal</span>
                     </a>
                  </li>
                  <li class="pc-item">
                     <a href="/cancellation" class="pc-link" style="font-size: 18px !important;">
                     <i class="ti ti-circle-x"></i>
                     <span class="pc-mtext">Cancellation</span>
                     </a>
                  </li>
                  <li class="pc-item">
                     <a href="/endorsement" class="pc-link" style="font-size: 18px !important;">
                     <i class="ti ti-edit-circle"></i>
                     <span class="pc-mtext">Endorsement</span>
                     </a>
                  </li> --}}
                  <li class="pc-item pc-hasmenu">
                     <a href="#!" class="pc-link" style="font-size: 18px !important;">
                     <i class="ti ti-shield-check"></i>
                     <span class="pc-mtext">Klaim</span>
                     <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                     </a>
                     <ul class="pc-submenu">
                         <li class="pc-item"><a class="pc-link" href="/klaim/input" style="font-size: 16px">Pengajuan Klaim</a></li>
                         <li class="pc-item"><a class="pc-link" href="/klaim/data" style="font-size: 16px">Laporan Klaim</a></li>
                     </ul>
                  </li>
                  {{-- <li class="pc-item">
                     <a href="/riwayat-polis" class="pc-link" style="font-size: 18px !important;">
                     <i class="ti ti-report-money"></i>
                     <span class="pc-mtext">Riwayat Polis</span>
                     </a>
                  </li> --}}
                  {{-- <li class="pc-item">
                     <a href="/chat" class="pc-link" style="font-size: 18px !important;">
                     <i class="ti ti-messages"></i>
                     <span class="pc-mtext">Chat</span>
                     <span class="pc-badge bg-danger d-none">0</span>
                     </a>
                  </li> --}}

                  <li class="pc-item">
                     <a href="/faq" class="pc-link" target="_blank" style="font-size: 18px !important;">
                     <i class="ti ti-info-circle"></i>
                     <span class="pc-mtext">FAQ</span>
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <!-- [ Sidebar Menu ] end -->
      <!-- [ Header Topbar ] start -->
      <header class="pc-header">
         <div class="header-wrapper">
            <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
               <ul class="list-unstyled">
                  <!-- ======= Menu collapse Icon ===== -->
                  <li class="pc-h-item pc-sidebar-collapse">
                     <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                     <i class="ti ti-menu-2"></i>
                     </a>
                  </li>
                  <li class="pc-h-item pc-sidebar-popup">
                     <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                     <i class="ti ti-menu-2"></i>
                     </a>
                  </li>
               </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
               <ul class="list-unstyled">
                  <li class="dropdown pc-h-item header-user-profile">
                     <a
                        class="dropdown-toggle arrow-none me-0 btn btn-icon btn-lg btn-light-dark"
                        style="border: 2px solid #505050"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        data-bs-auto-close="outside"
                        aria-expanded="false"
                        >
                     <i class="ti ti-user" style="font-size: 28px"></i>
                     </a>
                     <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-body">
                           <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                              <div class="d-flex mb-1">
                                 <div class="flex-grow-1">
                                    <h6 class="mb-1 name"></h6>
                                 </div>
                              </div>
                              <hr class="border-secondary border-opacity-50" />
                              <div class="d-grid">
                                 <button class="btn btn-danger" id="logout-button">
                                    <svg class="pc-icon me-2">
                                       <use xlink:href="#custom-logout-1-outline"></use>
                                    </svg>
                                    Logout
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </header>
      <!-- [ Header ] end -->
      <!-- [ Main Content ] start -->
      <div class="pc-container">
         <div class="pc-content">
            @yield('content')
         </div>
      </div>
      <input type="hidden" id="token" value="">
      <!-- [ Main Content ] end -->
      <footer class="pc-footer">
         <div class="footer-wrapper container-fluid">
            <div class="row">
               <div class="col my-1">
                  <p class="m-0">Copyright © 2024 Tugu Insurance Brokers. All rights reserved.</p>
               </div>
            </div>
         </div>
      </footer>
      <!-- [ Main Content ] end -->
      <!-- [Page Specific JS] start -->
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
      <!-- BEGIN PAGE LEVEL SCRIPTS -->
      @stack('levelPluginsJs')
      <!-- END PAGE LEVEL SCRIPTS -->
      <!-- [Page Specific JS] end -->
      <script>
        const apiUrl = '{{ config('setup.base_url') }}';
        const domain = '{{ config('setup.domain') }}';
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = "155d25dd-e83f-49ef-92db-b1399189fb1c";
        (function() {
            d = document;
            s = d.createElement("script");
            s.src = "https://client.crisp.chat/l.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();

        // Jalankan setelah Crisp siap
        window.$crisp.push(["on", "session:loaded", function () {
            // Tutup dulu agar nggak auto-restore
            // window.$crisp.push(["do", "chat:close"]);
            // Ambil tanggal hari ini (format YYYY-MM-DD)
            let today = new Date().toISOString().split("T")[0];
            let lastOpened = localStorage.getItem("crispAutoOpenedDate");

            if (lastOpened !== today) {
                window.$crisp.push(["do", "chat:open"]); // auto-open
                localStorage.setItem("crispAutoOpenedDate", today); // simpan tanggal
            }
        }]);

         // Function to get a cookie by name
         function getCookie(name) {
             const value = `; ${document.cookie}`;
             const parts = value.split(`; ${name}=`);
             if (parts.length === 2) return parts.pop().split(';').shift();
             return null;
         }

         // Retrieve and parse user_info
         const userInfoCookie = getCookie('user_info');
         var userInfo = null;

         if (userInfoCookie) {
             userInfo = JSON.parse(userInfoCookie);
             $('.name').text(userInfo.user_name);
         }
      </script>
      @vite(['resources/js/v1/pi/logout.js'])
   </body>
</html>
