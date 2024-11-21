<!DOCTYPE html>
<html lang="en">
   <!-- [Head] start -->
   <head>
      <title>TuguBro | Named & Nakes</title>
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
   <!-- [Head] end -->
   <!-- [Body] Start -->
   <body>
      <!-- [ Pre-loader ] start -->
      <div class="loader-bg">
         <div class="loader-track">
            <div class="loader-fill"></div>
         </div>
      </div>
      <!-- [ Pre-loader ] End -->
      <div class="auth-main">
         <div class="auth-wrapper v3">
            <div class="auth-form">
               <div class="auth-header row">
                  <div class="col my-1">
                     <a href="/">
                     <img src="{{ asset('assets/images/tib-logo.svg') }}" alt="img" style="width: 128px;" />
                     </a>
                  </div>
                  <div class="col-auto my-1">
                     <a class="btn btn-icon btn-lg btn-light-dark" style="border: 2px solid #505050" href="/">
                     <i class="ti ti-home" style="font-size: 28px"></i>
                     </a>
                  </div>
               </div>
               @yield('content')
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
            </div>
            @if (Request::is('login'))
            <div class="auth-sidecontent">
               <div class="p-1 px-lg-5 text-center">
                <h2 class="text-light">Jika anda belum memiliki asuransi profesi silahkan </h2>
                <a href="/pendaftaran" class="btn btn-light my-2">Daftar Sekarang</a>
               </div>
            </div>
            @endif
         </div>
      </div>
      <!-- [ Main Content ] end -->
      <!-- Floating Action Button for WhatsApp -->
      <a href="#" class="btn btn-success btn-lg" target="_blank"style="position: fixed; bottom: 20px; right: 20px; border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
      <i class="fab fa-whatsapp" style="font-size: 28px;"></i>
      </a>
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
         //   const apiUrl = 'https://pi-admin.tib.co.id';
           const apiUrl = `http://asprof_backend_v2.local.test`;
      </script>
   </body>
   <!-- [Body] end -->
</html>
