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


window.onload = function() {
    const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];

    const userId = 240812144413731;

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
                        messageElement.classList.add(message.user_id === userId ? 'message-out' : 'message-in');
                        messageElement.innerHTML = `
                            <div class="d-flex">
                                <div class="flex-grow-1 mx-3">
                                    <div class="msg-content bg-primary">
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
                    chatContainer.scrollTop = chatContainer.scrollHeight; // Scroll to bottom
                }
            }
        },
        error: function(error) {
            console.error('Error fetching messages:', error);
        }
    });


    // Set up the channel with the user-specific ID
    const channel = window.Echo.channel(`medikolegal-channel.${userId}`);

    channel.listen('.message.sent', function(data) {
        // Push new message to the chat container
        let chatContainer = document.getElementById('chat-container');
        if (chatContainer) {
            let newMessage = document.createElement('div');
            newMessage.classList.add('message-out');  // Use 'message-out' class for outgoing messages

            newMessage.innerHTML = `
                <div class="d-flex">
                    <div class="flex-grow-1 mx-3">
                        <div class="msg-content bg-primary">
                            <p class="mb-0">${data.message}</p>
                        </div>
                        <p class="mb-0 text-muted text-sm">
                            ${new Date(data.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false })}
                        </p>
                    </div>
                </div>
            `;

            // Append new message to the chat container
            chatContainer.querySelector('.card-body').appendChild(newMessage);
            chatContainer.scrollTop = chatContainer.scrollHeight;  // Scroll to the bottom
        }
    });
};
