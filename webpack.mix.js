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
    .copy('resources/images', 'public/images')
    .copy('resources/images/favicon.ico', 'public/')
    .copy('resources/fonts', 'public/css/fonts')
    .sass('resources/sass/style.scss', 'public/css')
    .combine([
        'resources/js/vendor/jquery-3.3.1.min.js',
        'resources/js/vendor/slick.min.js',
        'resources/js/vendor/algoliasearchLite.min.js',
        'resources/js/vendor/autocomplete.min.js',
        'resources/js/vendor/select2.min.js',
        'resources/js/vendor/mmenu.min.js',
        'resources/js/vendor/tippy.all.min.js',
        'resources/js/vendor/simplebar.min.js',
        'resources/js/vendor/bootstrap-slider.min.js',
        'resources/js/vendor/photoswipe.min.js',
        'resources/js/vendor/photoswipe-ui-default.min.js',
        'resources/js/vendor/snackbar.js',
        'resources/js/vendor/clipboard.min.js',
        'resources/js/vendor/magnific-popup.min.js',
        'resources/js/vendor/custom.js',
    ], 'public/js/bundle.js');