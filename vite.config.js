import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js','resources/js/v1/pi/register.js','resources/js/v1/pi/detail.js'],
            refresh: true,
        }),
    ],
});
