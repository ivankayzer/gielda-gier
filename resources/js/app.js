
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

var client = algoliasearch('YULENP2XSS', '04de3e60020d1f86ef283879bff67b39');
window.algoliaGames = client.initIndex('games');
window.algoliaCities = client.initIndex('cities');

$('.select2').select2({
    placeholder: 'Wybierz',
});

$('.select2.games').select2({
    ajax: {
        transport: function (params, success, failure) {
            var queryParams = params.data;
            var q = queryParams.query;
            delete queryParams.query;
            algoliaGames.search(q, queryParams).then(success, failure);
        },
        data: function (params) {
            return {query: params.term, hitsPerPage: 10, page: (params.page || 1) - 1};
        },
        processResults: function (data) {
            return {
                results: data.hits,
                pagination: {
                    more: data.page + 1 < data.nbPages
                }
            };
        }
    },
    escapeMarkup: function (markup) {
        return markup;
    },
    minimumInputLength: 0,
    cache: false,
    templateSelection: function (suggestion) {
        if (suggestion.text === "Wybierz grę") {
            return "Wybierz grę";
        } else {
            return suggestion.title;
        }
    },
    templateResult: function (suggestion) {
        return '<div class="algolia-suggestion">' + suggestion.title + '</div>';
    }
});
$('.select2.cities').select2({
    ajax: {
        transport: function (params, success, failure) {
            var queryParams = params.data;
            var q = queryParams.query;
            delete queryParams.query;
            algoliaCities.search(q, queryParams).then(success, failure);
        },
        data: function (params) {
            return {query: params.term, hitsPerPage: 10, page: (params.page || 1) - 1};
        },
        processResults: function (data) {
            return {
                results: data.hits,
                pagination: {
                    more: data.page + 1 < data.nbPages
                }
            };
        }
    },
    escapeMarkup: function (markup) {
        return markup;
    },
    minimumInputLength: 0,
    cache: false,
    templateSelection: function (suggestion) {
        if (suggestion.text === "Wybierz miasto") {
            return "Wybierz miasto";
        } else {
            return suggestion.name;
        }
    },
    templateResult: function (suggestion) {
        return '<div class="algolia-suggestion">' + suggestion.name + '</div>';
    }
});