import { decryptData, encryptData } from "../encrypt.js";

const tempatPraktikDetails = {}; // Initialize tempatPraktikDetails object
var registerId;

$(document).ready(function () {
    const expiresIn = 24 * 60 * 60 * 1000; // 24 hours in milliseconds
    const expirationTime = new Date(Date.now() + expiresIn).toUTCString();
    console.log(userInfo)
    $('#userLogin').html(userInfo.user_name)
    const piat = getCookie('piat');
    if (piat) {
        document.cookie = `piat=${piat}; expires=${expirationTime}; path=/; SameSite=Lax`;
    }
});

// Function to get the value of a specific cookie by name
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}
