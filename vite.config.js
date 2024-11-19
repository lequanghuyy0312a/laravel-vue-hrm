import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { resolve } from 'path';

export default defineConfig({
    base: '/',
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            '@': resolve(__dirname, 'resources/js'), // Trỏ đến `resources/js`
        },
    },
    server: {
        host: '127.0.0.1',
        port: 8000,
        open: true,
        hmr: true, // Hot module replacement
        watch: {
            usePolling: true,
        },
    },
    build: {
        outDir: 'dist',
    },
});
