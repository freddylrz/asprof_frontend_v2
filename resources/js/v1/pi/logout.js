
        // Call this function when the document is ready or on a specific event
        $(document).ready(function () {
            $('#logout-button').click(function() {
                // Show loading alert
                Swal.fire({
                    title: 'Sedang proses keluar...',
                    text: 'Mohon tunggu sebentar.',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading(); // Show loading spinner
                    }
                });

                // Simulate an async operation (clearing cookies)
                setTimeout(function() {
                    // Clear cookies
                    clearCookies();

                    // Close loading alert
                    Swal.close();

                    // Show success alert
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil keluar!',
                        timer: 2000,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                    }).then(() => {
                        // Redirect to the login page after the success alert
                        window.location.href = "/login";
                    });

                }, 2000); // Simulate delay for clearing cookies
            });

        });

        // Function to clear all cookies
        function clearCookies() {
            document.cookie.split(";").forEach(function(cookie) {
                var name = cookie.split("=")[0];
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            });
        }
