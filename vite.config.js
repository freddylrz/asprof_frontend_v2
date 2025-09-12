import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

const inputFiles = [
    'resources/css/app.css',
    'resources/js/app.js',
    'resources/js/v1/pi/register.js',
    'resources/js/v1/pi/detail.js',
    'resources/js/v1/pi/detail-sse.js',
    'resources/js/v1/pi/update.js',
    'resources/js/v1/pi/register-soon.js',
    'resources/js/v1/pi/login.js',
    'resources/js/v1/pi/logout.js',
    'resources/js/v1/pi/dashboard.js',
    'resources/js/v1/pi/kepesertaan.js',
    'resources/js/v1/pi/chat.js',
    'resources/js/v1/pi/chat-sse.js',
    'resources/js/v1/pi/renewal.js',
    'resources/js/v1/pi/endorsement.js',
    'resources/js/v1/pi/count-message.js',
    'resources/js/v1/pi/count-messages-sse.js',
    'resources/js/v1/pi/klaim/detail.js',
    'resources/js/v1/pi/klaim/input.js',

    'resources/js/v1/admin/login.js',
    'resources/js/v1/admin/list.js',
    'resources/js/v1/admin/list-detail.js',
    'resources/js/v1/admin/detail.js',
];

export default defineConfig({
    plugins: [
        laravel({
            input: inputFiles,
            refresh: true,
        }),
    ],
});
