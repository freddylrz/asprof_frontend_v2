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

         </div>
      </div>
      <!-- [ Main Content ] end -->
      <!-- Floating Action Button for WhatsApp -->
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

<!-- Tombol FAQ -->
<a href="/faq" class="btn btn-info" id="btn-faq" style="position: fixed; bottom: 20px; left: 20px; z-index: 1000;">
    <i style="font-size: 20px">FAQ</i>
</a>


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

        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/66d5662aea492f34bc0ca4ed/1i6ope6ck';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();

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
      <!-- END PAGE LEVEL SCRIPTS -->
      <!-- [Page Specific JS] end -->
    <script>
        const apiUrl = '{{ config('setup.base_url') }}';
        const domain = '{{ config('setup.domain') }}';
    </script>
   </body>
   <!-- [Body] end -->
</html>
