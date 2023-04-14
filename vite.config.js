import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/select2.min.css','resources/css/select2-bootstrap4.min.css','resources/js/select2.full.min.js'],
            refresh: true,
        }),
    ],
});
