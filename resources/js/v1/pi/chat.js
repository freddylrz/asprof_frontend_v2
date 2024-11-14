$(document).ready(function () {
    // Get the token from the 'piat' cookie
    const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];

    $('#sendMessage').on('click', function (e) {
        e.preventDefault();
        let message = $('textarea[name="message"]').val();

        $.ajax({
            url: `${apiUrl}/api/client/message/insert-data`,
            type: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`
            },
            data: {
                message: message
            },
            success: function (response) {
                // Clear input
                $('textarea[name="message"]').val('');
            },
            error: function (error) {
                console.error('Error sending message:', error);
            }
        });
    });
});
