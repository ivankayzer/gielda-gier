@extends('layouts.app')

@section('content')
    <div class="intro-banner intro-full-page d-flex align-items-center"
         data-background-image="../images/reset-background.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="login-register-page animated pulse faster">
                        <!-- Welcome Text -->
                        <div class="welcome-text">
                            <h3>@lang('common.reset_password')</h3>
                        </div>

                        @if (session('status'))
                            <div class="notification success closeable">
                                {{ session('status') }}
                                <a class="close"></a>
                            </div>
                    @endif
                    <!-- Form -->
                        <form method="post" action="{{ route('password.email') }}">
                            @csrf
                            @include('partials.errors')
                            <div class="input-with-icon-left">
                                <i class="icon-material-baseline-mail-outline"></i>
                                <input type="email" class="input-text with-border" name="email"
                                       value="{{ old('email') }}"
                                       placeholder="@lang('common.email')" required/>
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
