let mix = require('laravel-mix');

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

mix.react('resources/js/app.js', 'public/js')
    .react('resources/js/turbolinks.js', 'public/js')
    .copy('resources/js/vendor', 'public/js/vendor')
    .copy('resources/images', 'public/images')
    .copy('resources/images/favicon.ico', 'public/')
    .copy('resources/fonts', 'public/css/fonts')
    .sass('resources/sass/style.scss', 'public/css');
