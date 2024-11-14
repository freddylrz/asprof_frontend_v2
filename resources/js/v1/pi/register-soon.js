$(document).ready(function () {
    $('#contactButton').on('click', function (e) {
        e.preventDefault();

        // Create a FormData object and append form values
        const form = new FormData();
        form.append('nama', $('#nama').val());
        form.append('email', $('#email').val());
        form.append('no_hp', $('#no_hp').val());

        // AJAX request to API
        $.ajax({
            url: 'http://pi_project_admin11.local.test/api/client/contact-us',
            method: 'POST',
            data: form,
            processData: false,  // Important: prevent jQuery from processing data
            contentType: false,  // Important: prevent jQuery from setting content type
            success: function (response) {
                // Show success message
                Swal.fire({
                    title: 'Terima Kasih!',
                    text: 'Kami akan segera menghubungi Anda untuk informasi lebih lanjut.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                // Clear form fields after successful submission
                $('#nama').val('');
                $('#email').val('');
                $('#no_hp').val('');
            },
            error: function (xhr) {
                // Show error message
                Swal.fire({
                    title: 'Error!',
                    text: 'Maaf, terjadi kesalahan. Silakan coba lagi.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
