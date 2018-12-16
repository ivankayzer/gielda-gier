@extends('layouts.app')

@section('content')
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-5 offset-xl-3">

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
                            <input type="text" class="input-text with-border" name="email" value="{{ old('email') }}"
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

                        <button class="margin-top-20 button full-width button-sliding-icon ripple-effect" type="submit">@lang('common.send') <i
                                    class="icon-material-outline-arrow-right-alt"></i></button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Spacer -->
    <div class="margin-top-70"></div>
    <!-- Spacer / End-->
@endsection
