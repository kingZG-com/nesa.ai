import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            'reveal.js/dist/reveal.css': path.resolve(
                __dirname, 'node_modules/reveal.js/dist/reveal.css'
            ),
            'reveal.js/dist/theme/white.css': path.resolve(
                __dirname, 'node_modules/reveal.js/dist/theme/white.css'
            ),
        },
    },
    server: {
        cors: true,
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});