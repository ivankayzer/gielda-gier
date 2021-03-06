require('./bootstrap');

window.gallery = require('gallery');

$('.select2').select2({
    placeholder: Lang.get('common.select'),
});

$('.select2.games').select2({
    language: 'pl',
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
    language: 'pl',
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

$('.notifications-trigger').click(function () {
    $.get('/powiadomienia/przeczytaj');
});
