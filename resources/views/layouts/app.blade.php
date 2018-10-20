<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vendor/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/colors/blue.css') }}">
</head>
<body>

<div id="wrapper">
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
</div>

<script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery-migrate-3.0.0.min.js') }}"></script>
<script src="{{ asset('js/vendor/mmenu.min.js') }}"></script>
<script src="{{ asset('js/vendor/tippy.all.min.js') }}"></script>
<script src="{{ asset('js/vendor/simplebar.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap-slider.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/vendor/snackbar.js') }}"></script>
<script src="{{ asset('js/vendor/clipboard.min.js') }}"></script>
<script src="{{ asset('js/vendor/counterup.min.js') }}"></script>
<script src="{{ asset('js/vendor/magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/vendor/slick.min.js') }}"></script>
<script src="{{ asset('js/vendor/custom.js') }}"></script>

<script>
    $('#snackbar-user-status label').click(function() {
        Snackbar.show({
            text: 'Your status has been changed!',
            pos: 'bottom-center',
            showAction: false,
            actionText: "Dismiss",
            duration: 3000,
            textColor: '#fff',
            backgroundColor: '#383838'
        });
    });
</script>


<script>
    function initAutocomplete() {
        var options = {
            types: ['(cities)'],
            // componentRestrictions: {country: "us"}
        };

        var input = document.getElementById('autocomplete-input');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
    }

    if ($('.intro-banner-search-form')[0]) {
        setTimeout(function(){
            $(".pac-container").prependTo(".intro-search-field.with-autocomplete");
        }, 300);
    }

</script>

<!-- Google API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuuDfRlweIs7D6uo4wdIHVvJ0LonQ6g&libraries=places&callback=initAutocomplete"></script>

</body>
</html>