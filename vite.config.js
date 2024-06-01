import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/theme.scss',
                'resources/js/app.js',
                'resources/js/functions.js',
                'resources/js/tinyMCE.js',
            ],
            refresh: true,
        }),
    ],
});
