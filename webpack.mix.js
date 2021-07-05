const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.js([
        'resources/js/app.js',
        'resources/js/admin.js',
]   , 'public/js')
    .js('resources/js/client/home.js', 'public/js/client')
    .js('resources/js/admin/home.js', 'public/js/admin')
    .sass('resources/sass/app.scss', 'public/css')
    .styles([
        'resources/css/base.css',
        'resources/css/main.css',
        'resources/css/dashboard.css',
    ], 'public/css/style.css');
