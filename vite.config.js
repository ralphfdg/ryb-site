import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/home.js",
                'resources/js/admin/dashboard.js',
                'resources/js/admin/car-form.js',
                'resources/js/admin/customers.js'
            ],
            refresh: true,
        }),
        
    ],
});
