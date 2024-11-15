import Echo from 'laravel-echo';

import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

function autoToBottom(containerSelector, timedelay = 0) {
    var scrollId;
    var height = 0;
    var minScrollHeight = 100;

    // Select the container
    var container = document.querySelector(containerSelector);

    if (!container) {
        console.error("Container not found for selector:", containerSelector);
        return;
    }

    scrollId = setInterval(function () {
        // Check if the height is within the scrollable area
        if (height <= container.scrollHeight - container.clientHeight) {
            container.scrollBy(0, minScrollHeight);
        } else {
            clearInterval(scrollId);
        }
        height += minScrollHeight;
    }, timedelay);
}

// Example usage: Call the function for a specific container
autoToBottom('.scroll-block', 50);

window.onload = function() {
    const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];

    // Function to get a cookie by name
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    // Retrieve and parse user_info
    const userInfoCookie = getCookie('user_info');
    let userInfo = null;

    if (userInfoCookie) {
        userInfo = JSON.parse(userInfoCookie);
    }

    // Scroll to the bottom of the chat container
    function scrollToBottom() {
        const chatContainer = document.getElementById('chat-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Fetch existing messages on page load
    $.ajax({
        url: `${apiUrl}/api/client/message/get-message`,
        type: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`
        },
        success: function(response) {
            if (response.status === 200 && response.data) {
                let chatContainer = document.getElementById('chat-container');
                if (chatContainer) {
                    // Clear the chat container and load previous messages
                    let chatBody = chatContainer.querySelector('.card-body');
                    chatBody.innerHTML = '';  // Clear existing content

                    response.data.forEach(message => {
                        let messageElement = document.createElement('div');
                        messageElement.classList.add(message.user_id === userInfo.user_id ? 'message-out' : 'message-in');
                        messageElement.innerHTML = `
                            <div class="d-flex">
                                <div class="flex-grow-1 mx-3">
                                    <div class="msg-content ${message.user_id === userInfo.user_id ? 'bg-primary' : 'bg-light'}">
                                        <p class="mb-0">${message.message || ''}</p>
                                    </div>
                                    <p class="mb-0 text-muted text-sm">
                                        ${new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false })}
                                    </p>
                                </div>
                            </div>
                        `;
                        chatBody.appendChild(messageElement);
                    });
                    scrollToBottom(); // Scroll to bottom after loading messages
                }
            }
        },
        error: function(error) {
            console.error('Error fetching messages:', error);
        }
    });

    // Set up the channel with the user-specific ID
    const channel = window.Echo.channel(`medikolegal-channel.${userInfo.user_id}`);

    channel.listen('.message.sent', function(data) {

        // Push new message to the chat container
        let chatContainer = document.getElementById('chat-container');
        if (chatContainer) {
            let newMessage = document.createElement('div');
            newMessage.classList.add(data.data.user_id === userInfo.user_id.toString() ? 'message-out' : 'message-in');

            newMessage.innerHTML = `
                <div class="d-flex">
                    <div class="flex-grow-1 mx-3">
                        <div class="msg-content ${data.data.user_id === userInfo.user_id.toString() ? 'bg-primary' : 'bg-light'}">
                            <p class="mb-0">${data.data.message}</p>
                        </div>
                        <p class="mb-0 text-muted text-sm">
                            ${new Date(data.data.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false })}
                        </p>
                    </div>
                </div>
            `;

            // Append new message to the chat container
            chatContainer.querySelector('.card-body').appendChild(newMessage);
            scrollToBottom();  // Scroll to the bottom when a new message is received
        }
    });
};

$(document).ready(function () {
    // Get the token from the 'piat' cookie
    const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];

    // Scroll to the bottom of the chat container
    function scrollToBottom() {
        const chatContainer = document.querySelector('#chat-container .card-body');
        if (chatContainer) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    }

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

                // Scroll to the bottom after sending a message
                scrollToBottom();
            },
            error: function (error) {
                console.error('Error sending message:', error);
            }
        });
    });
});
