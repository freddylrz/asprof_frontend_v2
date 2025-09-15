import './bootstrap';

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
            const fiatCookie = getCookie('fiat');
            // Tombol Desktop
            const loginBtn = $('#loginButton');
            const dashboardBtn = $('#dashboardButton');
            // Tombol Mobile
            const loginBtnMobile = $('#loginButtonMobile');
            const dashboardBtnMobile = $('#dashboardButtonMobile');

            if (fiatCookie) {
                // Jika cookie 'fiat' ada
                loginBtn.hide();       // Sembunyikan tombol Login Desktop
                dashboardBtn.show();   // Tampilkan tombol Dashboard Desktop
                loginBtnMobile.hide(); // Sembunyikan tombol Login Mobile
                dashboardBtnMobile.show(); // Tampilkan tombol Dashboard Mobile
            } else {
                // Jika cookie 'fiat' tidak ada
                dashboardBtn.hide();   // Sembunyikan tombol Dashboard Desktop
                loginBtn.show();       // Tampilkan tombol Login Desktop
                dashboardBtnMobile.hide(); // Sembunyikan tombol Dashboard Mobile
                loginBtnMobile.show(); // Tampilkan tombol Login Mobile
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
