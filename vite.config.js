import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';

export default defineConfig({
    plugins: [
        laravel({
            input: [
               'resources/css/admin.css', 
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                    optimizedFallbacks: false,
                }),
            ],
        }),
    ],
    server: {
        watch: {
            ignored: [
               '**/storage/framework/views/**',
               '**/vendor/**', 
               '**/node_modules/**',
            ],
        },
    },
});
