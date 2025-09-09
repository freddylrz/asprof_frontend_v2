// Cooldown time for resending OTP in milliseconds (5 minutes)
const resendCooldown = 5 * 60 * 1000;

// Initialize a flag to prevent multiple calls
let otpCalled = false;
const expiresIn = 24 * 60 * 60 * 1000; // 24 hours in milliseconds
const expirationTime = new Date(Date.now() + expiresIn).toUTCString();

// Variable to store selected method
let selectedMethod = '1';

$(document).ready(function () {
    // Input mask for 16 digits STR number
    $(".enambelas").inputmask({
        mask: "9999999999999999",
        placeholder: ""
    });

    // Input mask for 6 digits OTP
    $(".enam").inputmask({
        mask: "999999",
        placeholder: ""
    });

    setCookieIfExists('piat', expirationTime);
    setCookieIfExists('user_info', expirationTime);

    // Automatically handle OTP verification when 6 digits are entered
    $('.otpInput').on('keyup', function() {
        if (this.value.length === 6 && !otpCalled) {
            otpCalled = true; // Set the flag to true
            handleOtpVerification();
        }
    });

    // Handle login form submission
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();
        handleLogin();
    });

    // Handle choose OTP method
    $('#chooseMethodButton').on('click', function (e) {
        e.preventDefault();
        selectedMethod = $('input[name="otp_method"]:checked').val();
        sendOtpCode();
    });

    // Handle OTP form submission
    $('#otpForm').on('submit', function (e) {
        e.preventDefault();
        handleOtpVerification();
    });

    // Handle resend OTP code link click
    $('#resendCode').on('click', function (e) {
        e.preventDefault();
        if (!$(this).hasClass('disabled')) {
            resendOtpCode();
            startResendCooldown();
        }
    });
});

function setCookieIfExists(cookieName, expirationTime) {
    const cookieValue = getCookie(cookieName);
    if (cookieValue) {
        document.cookie = `${cookieName}=${cookieValue}; expires=${expirationTime}; path=/; SameSite=Lax`;
    }
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}

// Function to show alert using SweetAlert
function showAlert(icon, text) {
    Swal.fire({
        icon: icon,
        text: text,
        showConfirmButton: true,
        allowOutsideClick: false,
    });
}

// Function to toggle loading state on a button
function setLoading(button, isLoading) {
    if (isLoading) {
        button.html('<i class="spinner-border spinner-border-sm"></i> Loading...');
        button.prop('disabled', true);
    } else {
        button.html(button.data('original-text'));
        button.prop('disabled', false);
    }
}

// Function to handle login process
function handleLogin() {
    const email = $('#email').val().trim();
    const strNo = $('#strNo').val().trim();

    // Validate email and STR number input
    if (!email) {
        showAlert('error', 'Mohon masukan alamat email anda terlebih dahulu!');
        return;
    }
    if (!strNo) {
        showAlert('error', 'Mohon masukan nomor STR anda terlebih dahulu!');
        return;
    }

    const loginButton = $('#loginButton');
    loginButton.data('original-text', loginButton.html());
    setLoading(loginButton, true);

    // Prepare form data for login request
    const formData = new FormData();
    formData.append("email", email);
    formData.append("str", strNo);

    // Send AJAX request for login
    $.ajax({
        url: `${apiUrl}/api/client/auth/login`,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
    }).done(function (response) {
        setLoading(loginButton, false);
        if (response.status === 200) {
            // Simpan user_id dari response
            window.userId = response.data.user_id;
            switchTab('#auth-2');
        } else {
            showAlert('warning', response.message);
        }
    }).fail(function (error) {
        setLoading(loginButton, false);
        const message = error.responseJSON?.message || 'An unexpected error occurred';
        showAlert('error', message);
    });
}

// Function to send OTP code based on selected method
function sendOtpCode() {
    const chooseMethodButton = $('#chooseMethodButton');
    chooseMethodButton.data('original-text', chooseMethodButton.html());
    setLoading(chooseMethodButton, true);

    const formData = new FormData();
    formData.append("user_id", window.userId);
    formData.append("type", selectedMethod);

    $.ajax({
        url: `${apiUrl}/api/client/auth/otp`,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
    }).done(function (response) {
        setLoading(chooseMethodButton, false);
        if (response.status === 200) {
            let timerInterval;
            Swal.fire({
                icon: 'success',
                title: response.message,
                html: "<small>Anda akan dialihkan ke halaman berikutnya dalam <b></b> detik</small>",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                allowOutsideClick: false,
                didOpen: () => {
                    const timer = Swal.getPopup().querySelector('b');
                    timerInterval = setInterval(() => {
                        timer.textContent = Math.ceil(Swal.getTimerLeft() / 1000);
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then(() => {
                switchTab('#auth-3');
                startResendCooldown();
            });
        } else {
            showAlert('warning', response.message);
        }
    }).fail(function (error) {
        setLoading(chooseMethodButton, false);
        const message = error.responseJSON?.message || 'An unexpected error occurred';
        showAlert('error', message);
    });
}

// Function to handle OTP verification process
function handleOtpVerification() {
    const otp = $('.otpInput').map((_, el) => el.value).get().join('');

    // Validasi OTP input
    if (otp.length < 6) {
        showAlert('error', 'Mohon masukan kode OTP dengan lengkap!');
        otpCalled = false;
        return;
    }

    const otpButton = $('#otpButton');
    otpButton.data('original-text', otpButton.html());
    setLoading(otpButton, true);

    // Siapkan form data untuk verifikasi OTP
    const formData = new FormData();
    formData.append("user_id", window.userId); // dari response login
    formData.append("otp", otp);

    $.ajax({
        url: `${apiUrl}/api/client/auth/verify`,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
    }).done(function (response) {
        setLoading(otpButton, false);
        if (response.status === 200) {
            console.log(response);

            let timerInterval;

            // Simpan access_token ke cookie
            document.cookie = `piat=${response.access_token}; expires=${expirationTime}; path=/; SameSite=Lax`;

            // Simpan user_info ke cookie sebagai string JSON
            document.cookie = `user_info=${JSON.stringify(response.user_info)}; expires=${expirationTime}; path=/; SameSite=Lax`;

            // Tampilkan sukses dan redirect ke dashboard
            Swal.fire({
                icon: 'success',
                title: response.message,
                html: "<small>Anda akan dialihkan ke halaman dashboard dalam <b></b> detik</small>",
                timer: 10000,
                timerProgressBar: true,
                showConfirmButton: true,
                allowOutsideClick: false,
                didOpen: () => {
                    const timer = Swal.getPopup().querySelector('b');
                    timerInterval = setInterval(() => {
                        timer.textContent = Math.ceil(Swal.getTimerLeft() / 1000);
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then(() => {
                window.location.replace('/dashboard');
            });
        } else {
            otpCalled = false;
            showAlert('warning', response.message);
        }
    }).fail(function (error) {
        otpCalled = false;
        setLoading(otpButton, false);
        const message = error.responseJSON?.message || 'An unexpected error occurred';
        showAlert('error', message);
    }).always(function () {
        otpCalled = false;
    });
}

// Function to switch tabs
function switchTab(tabId) {
    const tabTrigger = $(`a[href="${tabId}"]`);
    $('#auth-active-slide').html(tabTrigger.data('slide-index'));
    const tab = new bootstrap.Tab(tabTrigger[0]);
    tab.show();

    // Update OTP method text when switching to auth-3 tab
    if (tabId === '#auth-3') {
        const methodText = selectedMethod === 'email' ? 'email' : 'SMS';
        $('#otpMethodText').text(`Kami telah mengirim kode OTP ke ${methodText} anda.`);
    }
}

// Function to resend OTP code
function resendOtpCode() {
    const resendButton = $('#resendCode');
    const originalText = resendButton.text();
    resendButton.text('Mengirim...');
    resendButton.addClass('disabled');

    const formData = new FormData();
    formData.append("user_id", window.userId);
    formData.append("type", selectedMethod);

    $.ajax({
        url: `${apiUrl}/api/client/auth/send-otp`,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
    }).done(function (response) {
        resendButton.removeClass('disabled');
        resendButton.text(originalText);
        if (response.status === 200) {
            showAlert('info', `Kode OTP telah dikirim ulang via ${selectedMethod === '1' ? 'email' : 'SMS'}.`);
            startResendCooldown();
        } else {
            showAlert('warning', response.message);
        }
    }).fail(function (error) {
        resendButton.removeClass('disabled');
        resendButton.text(originalText);
        const message = error.responseJSON?.message || 'An unexpected error occurred';
        showAlert('error', message);
    });
}

// Function to start the resend OTP cooldown timer
function startResendCooldown() {
    const resendButton = $('#resendCode');
    resendButton.addClass('disabled');
    resendButton.css('pointer-events', 'none');

    const endTime = Date.now() + resendCooldown;
    const timerInterval = setInterval(() => {
        const remainingTime = endTime - Date.now();
        if (remainingTime <= 0) {
            clearInterval(timerInterval);
            resendButton.removeClass('disabled');
            resendButton.css('pointer-events', 'auto');
            resendButton.text('Kirim kembali kode');
        } else {
            const minutes = Math.floor(remainingTime / 60000);
            const seconds = Math.floor((remainingTime % 60000) / 1000);
            resendButton.text(` Kirim kembali kode otp dalam (${minutes}:${seconds < 10 ? '0' : ''}${seconds})`);
        }
    }, 1000);
}
