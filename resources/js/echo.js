import Echo from 'laravel-echo';

import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') == 'https',
    enabledTransports: ['ws', 'wss'],
});

window.onload = function() {
    const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];

    // Function to get a cookie by name
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length == 2) return parts.pop().split(';').shift();
        return null;
    }

    // Retrieve and parse user_info
    const userInfoCookie = getCookie('user_info');
    let userInfo = null;

    if (userInfoCookie) {
        userInfo = JSON.parse(userInfoCookie);
    }

    // Set up Echo to listen for the message count event
    const channelCount = window.Echo.channel(`medikolegalCount-channel.${userInfo.user_id}`);

    channelCount.listen('.message.count', function (data) {
        const messageCount = data.data;

        // Find the badge element and update it
        const badgeElement = $('.pc-item a .pc-badge');
        if (badgeElement.length) {
            if (messageCount > 0) {
                badgeElement.text(messageCount); // Update the badge count
                badgeElement.removeClass('d-none'); // Ensure the badge is visible
            } else {
                badgeElement.text('0'); // Optionally set to 0
                badgeElement.addClass('d-none'); // Hide the badge if count is 0
            }
        } else {
            console.warn('Badge element not found!');
        }
    });
};
