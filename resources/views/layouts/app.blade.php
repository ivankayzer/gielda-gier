<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Giełda gier') }}</title>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/default-skin/default-skin.min.css">
</head>
<body>
<div id="wrapper" class="animated fadeIn faster">
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