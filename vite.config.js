import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/scss/template.scss',
                'resources/scss/component.scss',
                'resources/scss/responsive.scss',
                'resources/js/app.js',
                'resources/js/clickable.js',
                'resources/js/functions.js'
            ],
            refresh: true,
        }),
    ],
});
