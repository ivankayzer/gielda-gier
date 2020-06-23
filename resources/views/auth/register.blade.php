@extends('layouts.app')

@section('title', 'Załóż konto')

@section('content')
    <div class="intro-banner intro-full-page bg-left d-flex align-items-center">
        <div class="background-image-container animated fadeIn" style="background-image: url('images/register-background.jpg');"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-6">
                    <div class="login-register-page">
                        <!-- Welcome Text -->
                        <div class="welcome-text">
                            <h3>@lang('common.do_register')</h3>
                        </div>


                        <!-- Form -->
                        <form method="post" action="{{ route('register') }}">
                            @include('partials.errors')
                            @csrf
                            <div class="input-with-icon-left">
                                <i class="icon-material-outline-account-circle"></i>
                                <input type="text" class="input-text with-border" name="name" value="{{ old('name') }}"
                                       placeholder="@lang('common.username')" required/>
                            </div>

                            <div class="input-with-icon-left">
                                <i class="icon-material-baseline-mail-outline"></i>
                                <input type="email" class="input-text with-border" name="email" value="{{ old('email') }}"
                                       placeholder="@lang('common.email')" required/>
                            </div>

                            <div class="input-with-icon-left margin-bottom-15">
                                <i class="icon-material-outline-my-location"></i>
                                <select class="select2 full-container registration cities" name="city"
                                        title="@lang('settings.select_city')">
                                    <option value="0">Wybierz miasto</option>
                                </select>
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

                            <button class="margin-top-20 button full-width button-sliding-icon ripple-effect" type="submit">@lang('common.send') <i
                                        class="icon-material-outline-arrow-right-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
