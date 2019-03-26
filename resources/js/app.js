
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components/Chat');

window.gallery = require('gallery');

$('.select2').select2({
    placeholder: 'Wybierz',
});

$('.select2.games').select2({
    ajax: {
        url: '/szukaj/gry',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: data
            };
        }
    },
});

$('.select2.cities').select2({
    ajax: {
        url: '/szukaj/miasta',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: data
            };
        }
    },
});