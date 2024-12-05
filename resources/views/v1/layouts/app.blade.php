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
      <style>
        #chat-box {
            position: fixed;
            bottom: 0;
            right: 20px;
            z-index: 1000;
            width: 100%;
            max-width: 480px;
            transition: width 0.3s ease, right 0.3s ease;
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
    </style>

<!-- Desktop Chat Box -->
<div id="chat-box" class="d-none d-md-block">
    <div class="card" style="margin-bottom: 0; box-shadow: 0 2rem 2rem rgba(0, 0, 0, 0.175) !important; border: 0;">
        <!-- Chat Header -->
        <div class="card-header bg-primary d-flex justify-content-between align-items-center p-3" id="toggle-chat" style="cursor: pointer;">
            <h3 class="text-white" id="chat-title">Chat</h3>
            <button class="btn btn-sm btn-light" id="toggle-icon" style="line-height: 1; padding: 2px 6px;">
                <i class="fas fa-chevron-up"></i>
            </button>
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
                <textarea class="form-control" id="chat-input" rows="2" placeholder="Type your message here..."></textarea>
                <button class="btn btn-primary mt-2 w-100" id="send-message">Send</button>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Chat Button -->
<button class="btn btn-primary d-block d-md-none" id="mobile-chat-btn" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    Open Chat
</button>

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
            <textarea class="form-control" id="mobile-chat-input" rows="2" placeholder="Type your message here..."></textarea>
            <button class="btn btn-primary mt-2 w-100" id="mobile-send-message">Send</button>
        </div>
    </div>
</div>

      {{-- <a href="#" class="btn btn-success btn-lg" target="_blank"style="position: fixed; bottom: 20px; right: 20px; border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
      <i class="fab fa-whatsapp" style="font-size: 28px;"></i>
      </a> --}}
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

      <script>
        $(document).ready(function () {
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
            $('#toggle-chat').on('click', function () {
                const chatBody = $('#chat-body');
                const isVisible = chatBody.css('display') !== 'none';
                chatBody.slideToggle();
                $('#toggle-icon').html(isVisible ? '<i class="fas fa-chevron-up"></i>' : '<i class="fas fa-chevron-down"></i>');
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
      <!-- END PAGE LEVEL SCRIPTS -->
      <!-- [Page Specific JS] end -->
      <script>
         //   const apiUrl = 'https://pi-admin.tib.co.id';
           const apiUrl = `http://asprof_backend_v2.local.test`;
        //    const apiUrl = `http://localhost:8000`;
      </script>
   </body>
   <!-- [Body] end -->
</html>
