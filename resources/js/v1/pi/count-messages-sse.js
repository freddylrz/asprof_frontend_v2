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

    // Set up SSE to listen for message count updates
    const eventSource = new EventSource(`${apiUrl}/api/client/message/count-updates?user_id=${userInfo.user_id}&token=${token}`);

    eventSource.onmessage = function(event) {
        const data = JSON.parse(event.data);
        const messageCount = data.data;

        // Find the badge element and update it
        const badgeElement = document.querySelector('.pc-item a .pc-badge');
        if (badgeElement) {
            if (messageCount > 0) {
                badgeElement.textContent = messageCount; // Update the badge count
                badgeElement.classList.remove('d-none'); // Ensure the badge is visible
            } else {
                badgeElement.textContent = '0'; // Optionally set to 0
                badgeElement.classList.add('d-none'); // Hide the badge if count is 0
            }
        } else {
            console.warn('Badge element not found!');
        }
    };

    eventSource.onerror = function(error) {
        console.error('Error with SSE connection:', error);
        eventSource.close(); // Optionally close the connection on error
    };
};
