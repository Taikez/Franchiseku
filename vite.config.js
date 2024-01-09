import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "/resources/js/app.js",
                "/resources/css/app.css",
                "/resources/css/header.css",
                "/resources/css/footer.css",
                "/resources/css/education.css",
                "/resources/js/education.js",
                "/resources/css/blog.css",
                "/resources/css/sidebar.css",
                "/resources/js/sidebar.js",
                "/resources/css/franchise.css",
                "/resources/css/auth.css"  
            ],
            refresh: true,
        }),
    ],
});
