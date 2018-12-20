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


    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vendor/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/colors/blue.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/photoswipe.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/default-skin/default-skin.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet"/>
    <script src="{{ asset('js/turbolinks.js') }}"></script>
</head>
<body>
<script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
<div id="wrapper">
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
</div>

<div id="loader">
    <img src="{{ asset('images/logo.png') }}" />
</div>

@yield('modals')

@guest
    <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

        <!--Tabs -->
        <div class="sign-in-form">

            <ul class="popup-tabs-nav">
                <li><a href="#login">@lang('common.do_login')</a></li>
                <li><a href="#register">@lang('common.do_register')</a></li>
            </ul>

            <div class="popup-tabs-container">

                <!-- Login -->
                <div class="popup-tab-content" id="login">

                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h3>@lang('common.glad_to_see_you_again')</h3>
                        <span>@lang('common.no_account') <a href="#" class="register-tab">@lang('common.do_register')
                                !</a></span>
                    </div>

                    <!-- Form -->
                    <form method="post" action="{{ route('login') }}" id="login-form">
                        @csrf
                        <div class="input-with-icon-left">
                            <i class="icon-material-baseline-mail-outline"></i>
                            <input type="text" class="input-text with-border" name="email" id="email"
                                   placeholder="@lang('common.email')" required/>
                        </div>

                        <div class="input-with-icon-left">
                            <i class="icon-material-outline-lock"></i>
                            <input type="password" class="input-text with-border" name="password" id="password"
                                   placeholder="@lang('common.password')" required/>
                        </div>
                        <a href="#" class="forgot-password">@lang('common.forget_pass')</a>
                    </form>

                    <!-- Button -->
                    <button class="button full-width button-sliding-icon ripple-effect" type="submit"
                            form="login-form">@lang('common.do_login') <i
                                class="icon-material-outline-arrow-right-alt"></i></button>
                </div>

                <!-- Register -->
                <div class="popup-tab-content" id="register">

                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h3>@lang('common.do_register')</h3>
                    </div>

                    <!-- Form -->
                    <form method="post" action="{{ route('register') }}">
                        @csrf
                        <div class="input-with-icon-left">
                            <i class="icon-material-baseline-mail-outline"></i>
                            <input type="text" class="input-text with-border" name="email"
                                   placeholder="@lang('common.email')" required/>
                        </div>

                        <div class="input-with-icon-left">
                            <i class="icon-material-outline-lock"></i>
                            <input type="password" class="input-text with-border" name="password"
                                   placeholder="@lang('common.password')" required/>
                        </div>

                        <div class="input-with-icon-left">
                            <i class="icon-material-outline-lock"></i>
                            <input type="password" class="input-text with-border" name="password_confirmation"
                                   placeholder="@lang('common.password_confirm')" required/>
                        </div>
                    </form>

                    <!-- Button -->
                    <button class="margin-top-10 button full-width button-sliding-icon ripple-effect" type="submit"
                            form="register-account-form">@lang('common.send') <i
                                class="icon-material-outline-arrow-right-alt"></i></button>
                </div>

            </div>
        </div>
    </div>
@endguest
<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearchLite.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/vendor/mmenu.min.js') }}"></script>
{{--<script src="{{ asset('js/vendor/counterup.min.js') }}"></script>--}}
<script src="{{ asset('js/vendor/tippy.all.min.js') }}"></script>
<script src="{{ asset('js/vendor/simplebar.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap-slider.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/photoswipe.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/photoswipe-ui-default.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{ asset('js/vendor/snackbar.js') }}"></script>
<script src="{{ asset('js/vendor/clipboard.min.js') }}"></script>
<script src="{{ asset('js/vendor/magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/vendor/slick.min.js') }}"></script>
<script src="{{ asset('js/vendor/custom.js') }}"></script>
@yield('post-scripts')
</body>
</html>