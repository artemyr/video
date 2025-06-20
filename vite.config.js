import { defineConfig } from 'vite';
import vue from "@vitejs/plugin-vue";
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/sass/main.sass',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: ['**/vendor/**'],
        },
    },
});
