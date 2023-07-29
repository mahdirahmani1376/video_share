import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/bootstrap.min.css',
                'resources/css/responsive.css',
                'resources/css/style.css',
                'resources/css/grid-blog.min.js',
                'resources/css/imagesloaded.pkgd.min.js',
                'resources/css/jquery.sticky-kit.min.js',
                'resources/css/jquery-3.2.1.min.js',
                'resources/css/smooth-scroll.min.js',
            ],
            refresh: true,
        }),
    ],
});

