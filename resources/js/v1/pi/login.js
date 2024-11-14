// Cooldown time for resending OTP in milliseconds (5 minutes)
const resendCooldown = 5 * 60 * 1000;

// Initialize a flag to prevent multiple calls
let otpCalled = false;
const expiresIn = 24 * 60 * 60 * 1000; // 24 hours in milliseconds
const expirationTime = new Date(Date.now() + expiresIn).toUTCString();

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
            let timerInterval; // Define timerInterval here for proper scoping
            // Successful login, show success alert and switch to OTP tab
            Swal.fire({
                icon: 'success',
                title: response.message,
                html: "<small>Anda akan dialihkan ke halaman berikutnya dalam <b></b> detik</small>",
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
                switchTab('#auth-2');
                startResendCooldown();
            });
        } else {
            showAlert('warning', response.message);
        }
    }).fail(function (error) {
        setLoading(loginButton, false);
        // for dev
        switchTab('#auth-2');
        const message = error.responseJSON?.message || 'An unexpected error occurred';
        showAlert('error', message);
    });
}

// Function to handle OTP verification process
function handleOtpVerification() {
    const email = $('#email').val().trim();
    const strNo = $('#strNo').val().trim();
    const otp = $('.otpInput').map((_, el) => el.value).get().join('');

    // Validate email, STR number, and OTP input
    if (!email) {
        showAlert('error', 'Mohon masukan alamat email anda terlebih dahulu!');
        otpCalled = false;
        return;
    }
    if (!strNo) {
        showAlert('error', 'Mohon masukan nomor STR anda terlebih dahulu!');
        otpCalled = false;
        return;
    }
    if (otp.length < 6) {
        showAlert('error', 'Mohon masukan kode OTP dengan lengkap!');
        otpCalled = false;
        return;
    }

    const otpButton = $('#otpButton');
    otpButton.data('original-text', otpButton.html());
    setLoading(otpButton, true);

    // Prepare form data for OTP verification request
    const formData = new FormData();
    formData.append("email", email);
    formData.append("str", strNo);
    formData.append("otp", otp);

    // Send AJAX request for OTP verification
    $.ajax({
        url: `${apiUrl}/api/client/auth/verify`,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
    }).done(function (response) {
        setLoading(otpButton, false);
        if (response.status === 200) {
            let timerInterval; // Define timerInterval here for proper scoping
            document.cookie = `piat=${response.access_token}; expires=${expirationTime}; path=/; SameSite=Lax`;
            // Successful OTP verification, show success alert and redirect to dashboard
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
            otpCalled = false; // Reset the flag after verification attempt
            showAlert('warning', response.message);
        }
    }).fail(function (error) {
        otpCalled = false; // Reset the flag after verification attempt
        setLoading(otpButton, false);
        const message = error.responseJSON?.message || 'An unexpected error occurred';
        showAlert('error', message);
    }).always(function () {
        otpCalled = false; // Reset the flag after verification attempt
    });
}

// Function to switch tabs
function switchTab(tabId) {
    const tabTrigger = $(`a[href="${tabId}"]`);
    $('#auth-active-slide').html(tabTrigger.data('slide-index'));
    const tab = new bootstrap.Tab(tabTrigger[0]);
    tab.show();
}

// Function to resend OTP code
function resendOtpCode() {
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

    // Prepare form data for resend OTP request
    const formData = new FormData();
    formData.append("email", email);
    formData.append("str", strNo);

    // Send AJAX request for resending OTP
    $.ajax({
        url: `${apiUrl}/api/client/auth/login`,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
    }).done(function (response) {
        setLoading(loginButton, false);
        if (response.status === 200) {
            showAlert('info', 'Kode OTP telah dikirim ulang.');
            startResendCooldown();
        } else {
            showAlert('warning', response.message);
        }
    }).fail(function (error) {
        setLoading(loginButton, false);
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
