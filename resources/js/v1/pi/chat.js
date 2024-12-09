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

document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendMessage');

    // Disable send button initially
    sendButton.classList.add('disabled');

    // Monitor textarea input
    textarea.addEventListener('input', function () {
        // Reset height to auto to allow shrinking
        textarea.style.height = 'auto';
        // Dynamically adjust height based on scroll height
        textarea.style.height = `${Math.min(textarea.scrollHeight, 150)}px`;

        // Enable or disable the send button
        if (textarea.value.trim() == '') {
            sendButton.classList.add('disabled');
        } else {
            sendButton.classList.remove('disabled');
        }
    });
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
        if (parts.length == 2) return parts.pop().split(';').shift();
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

    let lastDate = null; // Track the last message date

    // Fetch existing messages on page load
    $.ajax({
        url: `${apiUrl}/api/client/message/get-message`,
        type: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`
        },
        success: function(response) {
            if (response.status == 200 && response.data) {
                let chatContainer = document.getElementById('chat-container');
                if (chatContainer) {
                    // Clear the chat container and load previous messages
                    let chatBody = chatContainer.querySelector('.card-body');
                    chatBody.innerHTML = '';  // Clear existing content

                    const today = new Date().toDateString(); // Get today's date in comparable format

                    response.data.forEach(message => {
                        const messageDate = new Date(message.created_at).toDateString();
                        const messageDateLocalized = new Date(message.created_at).toLocaleDateString('id-ID', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });

                        // Add a date divider if the date changes
                        if (lastDate !== messageDate) {
                            lastDate = messageDate;

                            let dateDivider = document.createElement('div');
                            dateDivider.classList.add('date-divider');
                            dateDivider.innerHTML = `
                                ${messageDate == today ? 'Hari ini' : messageDateLocalized}
                            `;
                            chatBody.appendChild(dateDivider);
                        }

                        // Add the message
                        let messageElement = document.createElement('div');
                        messageElement.classList.add(message.user_id == userInfo.user_id ? 'message-out' : 'message-in');
                        messageElement.innerHTML = `
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <div class="msg-content ${message.user_id == userInfo.user_id ? 'bg-light-primary text-dark' : 'bg-light-warning text-dark'}">
                                        <p class="mb-2 font-bold">${message.user_id == userInfo.user_id ? userInfo.user_name : message.user_name}</p>
                                        <p class="mb-0">${message.message || ''}</p>
                                    </div>
                                    <p class="mb-0 text-muted text-sm" style="text-align:${message.user_id == userInfo.user_id ? 'right' : 'left'}">
                                        ${new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false })}
                                    </p>
                                </div>
                            </div>
                        `;
                        chatBody.appendChild(messageElement);
                    });

                    // Scroll to the bottom after loading messages
                    scrollToBottom();
                }
            }

            // Mark messages as read
            $.ajax({
                url: `${apiUrl}/api/client/message/read-data`,
                type: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                success: function (readResponse) {
                    console.log('Messages marked as read:', readResponse);
                },
                error: function (error) {
                    console.error('Error marking messages as read:', error);
                }
            });
        },
        error: function(error) {
            console.error('Error fetching messages:', error);
        }
    });

    // Set up the channel with the user-specific ID
    const channel = window.Echo.channel(`medikolegal-channel.${userInfo.user_id}`);

    channel.listen('.message.sent', function(data) {
        console.log(data);

        // Push new message to the chat container
        let chatContainer = document.getElementById('chat-container');
        if (chatContainer) {

            // Clear the chat container and load previous messages
            let chatBody = chatContainer.querySelector('.card-body');
            const today = new Date().toDateString(); // Get today's date in comparable format

            const messageDate = new Date(data.data.created_at).toDateString();
            const messageDateLocalized = new Date(data.data.created_at).toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            // Add a date divider if the date changes
            if (lastDate !== messageDate) {
                lastDate = messageDate;

                let dateDivider = document.createElement('div');
                dateDivider.classList.add('date-divider');
                dateDivider.innerHTML = `
                    ${messageDate == today ? 'Hari ini' : messageDateLocalized}
                `;
                chatBody.appendChild(dateDivider);
            }

            let newMessage = document.createElement('div');
            newMessage.classList.add(data.data.user_id == userInfo.user_id.toString() ? 'message-out' : 'message-in');

            newMessage.innerHTML = `
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <div class="msg-content ${data.data.user_id == userInfo.user_id.toString() ? 'bg-light-primary text-dark' : 'bg-light-warning text-dark'}">
                            <p class="mb-2 font-bold">${data.data.user_id == userInfo.user_id.toString() ? userInfo.user_name : data.data.user_name}</p>
                            <p class="mb-0">${data.data.message}</p>
                        </div>
                        <p class="mb-0 text-muted text-sm" style="text-align:${data.data.user_id == userInfo.user_id.toString() ? 'right' : 'left'}"">
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

    // Set up Echo to listen for the message count event
    const channelCount = window.Echo.channel(`medikolegalCount-channel.${userInfo.user_id}`);

    channelCount.listen('.message.count', function (data) {
        const messageCount = data.data;

        console.log(messageCount);

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
        const sendButton = $(this);
        const message = $('textarea[name="message"]').val();

        // Disable the button and show a loading spinner
        sendButton.prop('disabled', true).html(`
            <i class="ti ti-loader fa-spin"></i>
        `);

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
                // Clear the input
                $('textarea[name="message"]').val('');

                // Restore the button and re-enable it
                sendButton.prop('disabled', false).html('<i class="ti ti-send"></i>');

                // Scroll to the bottom after sending a message
                scrollToBottom();
            },
            error: function (error) {
                console.error('Error sending message:', error);

                // Restore the button and re-enable it
                sendButton.prop('disabled', false).html('<i class="ti ti-send"></i>');
            }
        });
    });
});
