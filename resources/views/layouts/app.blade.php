<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    @env('production')
    <script type="text/javascript">
        window.heap = window.heap || [], heap.load = function (e, t) {
            window.heap.appid = e, window.heap.config = t = t || {};
            var r = t.forceSSL || "https:" === document.location.protocol, a = document.createElement("script");
            a.type = "text/javascript", a.async = !0, a.src = (r ? "https:" : "http:") + "//cdn.heapanalytics.com/js/heap-" + e + ".js";
            var n = document.getElementsByTagName("script")[0];
            n.parentNode.insertBefore(a, n);
            for (var o = function (e) {
                return function () {
                    heap.push([e].concat(Array.prototype.slice.call(arguments, 0)))
                }
            }, p = ["addEventProperties", "addUserProperties", "clearEventProperties", "identify", "resetIdentity", "removeEventProperty", "setEventProperties", "track", "unsetEventProperty"], c = 0; c < p.length; c++) heap[p[c]] = o(p[c])
        };
        heap.load("1478647781");
    </script>
    @endenv
</head>
<body>

<div id="wrapper">
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
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

<script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/vendor/mmenu.min.js') }}"></script>
{{--<script src="{{ asset('js/vendor/counterup.min.js') }}"></script>--}}
<script src="{{ asset('js/vendor/tippy.all.min.js') }}"></script>
<script src="{{ asset('js/vendor/simplebar.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap-slider.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ajax-bootstrap-select/1.4.4/js/ajax-bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/photoswipe.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/photoswipe-ui-default.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('js/vendor/snackbar.js') }}"></script>
<script src="{{ asset('js/vendor/clipboard.min.js') }}"></script>
<script src="{{ asset('js/vendor/magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/vendor/slick.min.js') }}"></script>
<script src="{{ asset('js/vendor/custom.js') }}"></script>
<script>
    $('#snackbar-user-status label').click(function () {
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
<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearchLite.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@yield('post-scripts')
</body>
</html>