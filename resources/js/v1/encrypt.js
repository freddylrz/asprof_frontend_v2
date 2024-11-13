import CryptoJS from 'crypto-js';

export async function encryptData(data) {
    const key1Part2 = '6SwIZ62G';
    const key1Part3 = 'vkrVtVDD';
    const key1Part4 = '01CQz4n7';
    const key1Part5 = 'xhamBnLp';
    const key1Part6 = 'wsNwgZu4qFs=';
    const key1 = key1Part2 + key1Part3 + key1Part4 + key1Part5 + key1Part6;

    const key = CryptoJS.enc.Base64.parse(key1); // Kunci dalam Base64
    const iv = CryptoJS.lib.WordArray.random(16); // IV acak 16 byte

    // Enkripsi data (diubah ke format JSON terlebih dahulu)
    const encrypted = CryptoJS.AES.encrypt(data, key, {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7
    });

    // Gabungkan IV dan ciphertext dalam format JSON
    const result = {
        iv: CryptoJS.enc.Base64.stringify(iv),
        value: encrypted.toString()
    };

    return btoa(JSON.stringify(result)); // Encode menjadi Base64 agar mudah dikirim
}

export async function decryptData(encryptedJsonString) {
    const key1Part2 = '6SwIZ62G';
    const key1Part3 = 'vkrVtVDD';
    const key1Part4 = '01CQz4n7';
    const key1Part5 = 'xhamBnLp';
    const key1Part6 = 'wsNwgZu4qFs=';
    const key1 = key1Part2 + key1Part3 + key1Part4 + key1Part5 + key1Part6;

    const key = CryptoJS.enc.Base64.parse(key1); // Pastikan ini adalah kunci enkripsi yang sesuai

    // Parse JSON data dari Laravel
    const encryptedDataJs = JSON.parse(atob(encryptedJsonString)); // Dekode dari Base64 lalu parse JSON

    // Ambil nilai IV dan ciphertext (value)
    const iv = CryptoJS.enc.Base64.parse(encryptedDataJs.iv);
    const ciphertext = CryptoJS.enc.Base64.parse(encryptedDataJs.value);

    // Dekripsi menggunakan AES-256-CBC
    const decrypted = CryptoJS.AES.decrypt(
        { ciphertext: ciphertext },
        key,
        {
            iv: iv,
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7,
        }
    );

    // Konversi hasil ke string UTF-8 (data asli)
    const decryptedText = decrypted.toString(CryptoJS.enc.Utf8);
    return JSON.parse(decryptedText)
}

export async function getAccessTokenFromCookies() {
    const name = "access_token=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieArray = decodedCookie.split(';');
    for (let i = 0; i < cookieArray.length; i++) {
        let cookie = cookieArray[i].trim();
        if (cookie.indexOf(name) === 0) {
            // var data = decryptAndParseToken(cookie.substring(name.length, cookie.length),window.APP_KEY,window.APP_KEY2);
            var data = await decryptData(cookie.substring(name.length, cookie.length))
            return data.access_token
        }
    }
    return null; // Return null if the token isn't found
}

export async function getRoleFromCookies() {
    const name = "access_token=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieArray = decodedCookie.split(';');
    for (let i = 0; i < cookieArray.length; i++) {
        let cookie = cookieArray[i].trim();
        if (cookie.indexOf(name) === 0) {
            // var data = decryptAndParseToken(cookie.substring(name.length, cookie.length),window.APP_KEY,window.APP_KEY2);
            var data = await decryptData(cookie.substring(name.length, cookie.length))
            return data.user_info[1].role
        }
    }
    return null; // Return null if the token isn't found
}

