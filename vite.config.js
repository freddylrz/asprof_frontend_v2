import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

const inputFiles = [
    'resources/css/app.css',
    'resources/js/app.js',
    'resources/js/v1/pi/register.js',
    'resources/js/v1/pi/detail.js',
    'resources/js/v1/pi/update.js',
    'resources/js/v1/pi/register-soon.js',
    'resources/js/v1/pi/login.js',
];

export default defineConfig({
    plugins: [
        laravel({
            input: inputFiles,
            refresh: true,
        }),
    ],
});
