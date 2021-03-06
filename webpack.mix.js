let mix = require('laravel-mix');
require('laravel-mix-purgecss');
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
    .copy('resources/images', 'public/images')
    .copy('resources/images/favicon.ico', 'public/')
    .copy('resources/fonts', 'public/css/fonts')
    .sass('resources/sass/style.scss', 'public/css')
    .copy('resources/js/vendor', 'public/js/vendor')
    .combine([
        'resources/js/vendor/jquery-3.3.1.min.js',
        'resources/js/vendor/select2.min.js',
        'resources/js/vendor/select2.pl.js',
        'resources/js/vendor/mmenu.min.js',
        'resources/js/vendor/tippy.all.min.js',
        'resources/js/vendor/simplebar.min.js',
        'resources/js/vendor/bootstrap-slider.min.js',
        'resources/js/vendor/flickity.pkgd.js',
        'resources/js/vendor/snackbar.js',
        'resources/js/vendor/clipboard.min.js',
        'resources/js/vendor/magnific-popup.min.js',
        'resources/js/vendor/custom.js',
    ], 'public/js/bundle.js')
    .purgeCss();
