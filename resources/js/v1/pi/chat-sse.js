document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendMessage');

    // Disable send button initially
    sendButton.classList.add('disabled');

    // Monitor textarea input
    textarea.addEventListener('input', function () {
        textarea.style.height = 'auto';
        textarea.style.height = `${Math.min(textarea.scrollHeight, 150)}px`;

        if (textarea.value.trim() === '') {
            sendButton.classList.add('disabled');
        } else {
            sendButton.classList.remove('disabled');
        }
    });

    function autoToBottom(containerSelector, timedelay = 0) {
        var scrollId;
        var height = 0;
        var minScrollHeight = 100;
        var container = document.querySelector(containerSelector);

        if (!container) {
            console.error("Container not found for selector:", containerSelector);
            return;
        }

        scrollId = setInterval(function () {
            if (height <= container.scrollHeight - container.clientHeight) {
                container.scrollBy(0, minScrollHeight);
            } else {
                clearInterval(scrollId);
            }
            height += minScrollHeight;
        }, timedelay);
    }

    autoToBottom('.scroll-block', 50);

    const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        return parts.length === 2 ? parts.pop().split(';').shift() : null;
    }

    const userInfoCookie = getCookie('user_info');
    let userInfo = userInfoCookie ? JSON.parse(userInfoCookie) : null;

    function scrollToBottom() {
        const chatContainer = document.getElementById('chat-container');
        if (chatContainer) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    }

    let lastDate = null;

    function fetchMessages() {
        $.ajax({
            url: `${apiUrl}/api/client/message/get-message`,
            type: 'GET',
            headers: { 'Authorization': `Bearer ${token}` },
            success: function (response) {
                if (response.status === 200 && response.data) {
                    let chatContainer = document.getElementById('chat-container');
                    if (chatContainer) {
                        let chatBody = chatContainer.querySelector('.card-body');
                        chatBody.innerHTML = '';

                        const today = new Date().toDateString();

                        response.data.forEach(message => {
                            const messageDate = new Date(message.created_at).toDateString();
                            const messageDateLocalized = new Date(message.created_at).toLocaleDateString('id-ID', {
                                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
                            });

                            if (lastDate !== messageDate) {
                                lastDate = messageDate;
                                let dateDivider = document.createElement('div');
                                dateDivider.classList.add('date-divider');
                                dateDivider.innerHTML = `${messageDate === today ? 'Hari ini' : messageDateLocalized}`;
                                chatBody.appendChild(dateDivider);
                            }

                            let messageElement = document.createElement('div');
                            messageElement.classList.add(message.user_id === userInfo.user_id ? 'message-out' : 'message-in');
                            messageElement.innerHTML = `
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="msg-content ${message.user_id === userInfo.user_id ? 'bg-light-primary text-dark' : 'bg-light-warning text-dark'}">
                                            <p class="mb-2 font-bold">${message.user_id === userInfo.user_id ? userInfo.user_name : message.user_name}</p>
                                            <p class="mb-0">${message.message || ''}</p>
                                        </div>
                                        <p class="mb-0 text-muted text-sm" style="text-align:${message.user_id === userInfo.user_id ? 'right' : 'left'}">
                                            ${new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false })}
                                        </p>
                                    </div>
                                </div>
                            `;
                            chatBody.appendChild(messageElement);
                        });

                        scrollToBottom();
                    }
                }
            },
            error: function (error) {
                console.error('Error fetching messages:', error);
            }
        });
    }

    fetchMessages();

    const eventSource = new EventSource(`${apiUrl}/api/stream/message/${userInfo.user_id}/${token}`);

    eventSource.onmessage = function (event) {
        const data = JSON.parse(event.data);
        if (data == null) return;

        let chatContainer = document.getElementById('chat-container');
        if (chatContainer) {
            let chatBody = chatContainer.querySelector('.card-body');
            const today = new Date().toDateString();

            const messageDate = new Date(data.created_at).toDateString();
            const messageDateLocalized = new Date(data.created_at).toLocaleDateString('id-ID', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            });

            if (lastDate !== messageDate) {
                lastDate = messageDate;
                let dateDivider = document.createElement('div');
                dateDivider.classList.add('date-divider');
                dateDivider.innerHTML = `${messageDate === today ? 'Hari ini' : messageDateLocalized}`;
                chatBody.appendChild(dateDivider);
            }

            let newMessage = document.createElement('div');
            newMessage.classList.add(data.user_id === userInfo.user_id.toString() ? 'message-out' : 'message-in');
            newMessage.innerHTML = `
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <div class="msg-content ${data.user_id === userInfo.user_id.toString() ? 'bg-light-primary text-dark' : 'bg-light-warning text-dark'}">
                            <p class="mb-2 font-bold">${data.user_id === userInfo.user_id.toString() ? userInfo.user_name : data.user_name}</p>
                            <p class="mb-0">${data.message}</p>
                        </div>
                        <p class="mb-0 text-muted text-sm" style="text-align:${data.user_id === userInfo.user_id.toString() ? 'right' : 'left'}">
                            ${new Date(data.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false })}
                        </p>
                    </div>
                </div>
            `;
            chatBody.appendChild(newMessage);
            scrollToBottom();
        }
    };

    eventSource.onerror = function (error) {
        console.error('SSE error:', error);
    };

    $('#sendMessage').on('click', function (e) {
        e.preventDefault();
        const sendButton = $(this);
        const message = $('textarea[name="message"]').val();

        sendButton.prop('disabled', true).html(`<i class="ti ti-loader fa-spin"></i>`);

        $.ajax({
            url: `${apiUrl}/api/client/message/insert-data`,
            type: 'POST',
            headers: { 'Authorization': `Bearer ${token}` },
            data: { message: message },
            success: function () {
                $('textarea[name="message"]').val('');
                sendButton.prop('disabled', false).html('<i class="ti ti-send"></i>');

                let chatContainer = document.getElementById('chat-container');
                if (chatContainer) {
                    let chatBody = chatContainer.querySelector('.card-body');
                    let newMessage = document.createElement('div');
                    newMessage.classList.add('message-out');
                    newMessage.innerHTML = `
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <div class="msg-content bg-light-primary text-dark">
                                    <p class="mb-2 font-bold">${userInfo.user_name}</p>
                                    <p class="mb-0">${message}</p>
                                </div>
                                <p class="mb-0 text-muted text-sm" style="text-align:right">
                                    ${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false })}
                                </p>
                            </div>
                        </div>
                    `;
                    chatBody.appendChild(newMessage);
                    scrollToBottom();
                }
            },
            error: function (error) {
                console.error('Error sending message:', error);
                sendButton.prop('disabled', false).html('<i class="ti ti-send"></i>');
            }
        });
    });
});
