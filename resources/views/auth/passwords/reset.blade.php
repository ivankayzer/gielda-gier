@extends('layouts.app')

@section('content')
    <div class="intro-banner intro-full-page bg-left d-flex align-items-center"
         data-background-image="../../images/confirm-background.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-6">
                    <div class="login-register-page">
                        <!-- Welcome Text -->
                        <div class="welcome-text">
                            <h3>@lang('common.reset_password')</h3>
                        </div>

                    <!-- Form -->
                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @include('partials.errors')
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="input-with-icon-left">
                                <i class="icon-material-baseline-mail-outline"></i>
                                <input type="email" class="input-text with-border" name="email"
                                       value="{{ old('email') }}"
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

                            <button class="margin-top-20 button full-width button-sliding-icon ripple-effect"
                                    type="submit">@lang('common.send') <i
                                        class="icon-material-outline-arrow-right-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
