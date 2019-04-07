@extends('layouts.app')

@section('title', 'Zaloguj się')

@section('content')
    <div class="intro-banner intro-full-page d-flex align-items-center">
        <div class="background-image-container animated fadeIn" style="background-image: url('images/login-background.jpg');"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="login-register-page">
                        <!-- Welcome Text -->
                        <div class="welcome-text">
                            <h3>@lang('common.glad_to_see_you_again')</h3>
                            <span>@lang('common.no_account') <a href="{{ route('register') }}">@lang('common.do_register')!</a></span>
                        </div>
                        <!-- Form -->
                        <form method="post" action="{{ route('login') }}" id="login-form">
                            @csrf
                            @include('partials.errors')
                            <div class="input-with-icon-left">
                                <i class="icon-material-baseline-mail-outline"></i>
                                <input type="email" class="input-text with-border" name="email" id="email" value="{{ old('email') }}"
                                       placeholder="@lang('common.email')" required/>
                            </div>

                            <div class="input-with-icon-left">
                                <i class="icon-material-outline-lock"></i>
                                <input type="password" class="input-text with-border" name="password" id="password"
                                       placeholder="@lang('common.password')" required/>
                            </div>
                            <a href="{{ route('password.request') }}" class="forgot-password">@lang('common.forget_pass')</a>

                            <button class="margin-top-20 button full-width button-sliding-icon ripple-effect" type="submit"
                                    form="login-form">@lang('common.do_login') <i
                                        class="icon-material-outline-arrow-right-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
