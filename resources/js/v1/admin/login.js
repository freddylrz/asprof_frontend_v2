import {
    decryptData,
    encryptData,
    getAccessTokenFromCookies
} from "../encrypt.js";

var base_url = 'http://localhost:8000';


$("#formLogin").on('submit', (async function (e) {

    e.preventDefault();

    Swal.fire({
        icon: 'info',
        title: "Login!",
        text: "Please wait",
        showConfirmButton: false,
        allowOutsideClick: false
    });

    var data = await encryptData(JSON.stringify(
        {
            username: $('#username').val(),
            password: $('#password').val()
        })
    )

    $.ajax({
        "url": base_url.concat('/api/client-admin/login'),
        "method": "POST",
        "data": {
            data : data
        },
        success: async function (responses) {
            var response = await decryptData(responses['data'])

            Swal.fire({
                icon: 'success',
                text: "Login berhasil!",
                showConfirmButton: false,
                timer: 2000
            });
            // localStorage.setItem('token', responses['data'])
            await setCookie("access_token", responses['data']);

            setInterval(function () {
                window.location.href = '/admin/list-data';
            }, 1000);
        },
        error: function (error) {
            // var data = JSON.parse(error);
            Swal.fire({
                icon: 'error',
                title: 'Login gagal!',
                showConfirmButton: false,
                timer: 2000
            });
        }
    })
}))

function setCookie(name, value, expireDate) {
    const date = new Date(expireDate); // Convert expire_token string to Date object
    const expires = "; expires=" + date.toUTCString(); // Format the expiration date
    document.cookie = `${name}=${value}; path=/`;
}

const togglePassword = document.querySelector("#togglePassword");

togglePassword.addEventListener("click", function () {
    // toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    // toggle the icon
    this.classList.toggle("icon-unlock");
});
