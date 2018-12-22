<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @env('production')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130652682-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-130652682-1');
    </script>
    @endenv

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="turbolinks-cache-control" content="no-preview">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Giełda gier') }}</title>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vendor/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/colors/blue.css') }}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/default-skin/default-skin.min.css">
</head>
<body>
<div id="wrapper">
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
</div>
@yield('modals')
<script src="{{ asset('js/bundle.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@yield('post-scripts')
</body>
</html>