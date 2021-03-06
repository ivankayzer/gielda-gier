<header id="header-container">
    <div id="header">
        <div class="container">
            <div class="left-side">
                <div id="logo">
                    <a href="/"><img src="{{ asset('images/logo.png') }}" alt=""></a>
                </div>
                @auth
                    <nav id="navigation">
                        <ul id="responsive">
                            <li>
                                <a href="{{ route('offers.index') }}"
                                   @if(request()->is('ogloszenia') || request()->is('ogloszenia/*')) class="current" @endif>
                                    @lang('offers.offers')
                                </a>
                            </li>
                            <li class="margin-right-15"><a href="{{ route('my-offers.index') }}"
                                                           @if(request()->is('moje-ogloszenia') || request()->is('moje-ogloszenia/*')) class="current" @endif>@lang('common.my-offers')</a>
                                <a href="{{ route('offers.create') }}" class="add-offers"
                                   style="padding: 0 !important;">
                                    <i class="icon-feather-plus" style="position: absolute;"></i>
                                </a>
                            </li>
                            <li><a href="{{ route('transactions.index') }}"
                                   @if(request()->is('transakcje') || request()->is('transakcje/*')) class="current" @endif>@lang('common.transactions')
                                    @if($newTransactionsCount)<span
                                        class="header-notifications-trigger margin-left-10 margin-top-5">
                                        <span>{{ $newTransactionsCount }}</span></span>@endif</a>
                            </li>
                        </ul>
                    </nav>
                @endauth

                @guest
                    <nav id="navigation">
                        <ul id="responsive">
                            <li class="margin-right-15">
                                <a href="{{ route('offers.index') }}"
                                   @if(request()->is('ogloszenia') || request()->is('ogloszenia/*')) class="current" @endif>
                                    @lang('offers.offers')
                                </a>
                            </li>

                            <li class="mobile-only">
                                <a href="{{ route('login') }}"
                                   @if(request()->is('zaloguj-sie')) class="current" @endif>
                                    @lang('common.do_login')
                                </a>
                            </li>
                            <li class="mobile-only">
                                <a href="{{ route('register') }}"
                                   @if(request()->is('zaloz-konto')) class="current" @endif>
                                    @lang('auth.register')
                                </a>
                            </li>
                        </ul>
                    </nav>
                @endguest
                <div class="clearfix"></div>
            </div>
            <div class="right-side">
                @guest
                    <div class="header-widget">
                        <nav id="navigation">
                            <ul id="responsive">
                                <li><a href="{{ route('login') }}"
                                       @if(request()->is('zaloguj-sie')) class="current" @endif>@lang('common.do_login')</a>
                                </li>
                                <li><a href="{{ route('register') }}"
                                       @if(request()->is('zaloz-konto')) class="current" @endif>@lang('auth.register')</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                @endguest
                @auth
                <!--  User Notifications -->
                    <div class="header-widget hide-on-mobile">

                        <!-- Notifications -->
                        <div class="header-notifications">
                            <!-- Trigger -->
                            <div class="header-notifications-trigger notifications-trigger">
                                <a href="#"><i class="icon-feather-bell"></i>@if($notificationsCount)
                                        <span>{{ $notificationsCount }}</span>@endif</a>
                            </div>

                            <!-- Dropdown -->
                            <div class="header-notifications-dropdown notifications-wrapper">

                                <div class="header-notifications-headline">
                                    <h4>@lang('common.notifications')</h4>
                                </div>

                                <div class="header-notifications-content">
                                    <div class="header-notifications-scroll" data-simplebar>
                                        @if(count($notifications))
                                            <ul>
                                                @foreach($notifications as $notication)
                                                    <li class="notifications-not-read">
                                                        <a href="{{ $notication->url ?? '#' }}">
                                                        <span class="notification-text">
                                                        {!! $notication->text !!}
                                                            <p class="color">{{ $notication->created_at->diffForHumans() }}</p>
                                                    </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <div class="margin-bottom-20 margin-top-20 margin-left-20">
                                                <p>@lang('common.empty_notifications')</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!--  User Notifications / End -->
                    <!-- User Menu -->
                    <div class="header-widget">

                        <!-- Messages -->
                        <div class="header-notifications user-menu">
                            <div class="header-notifications-trigger">
                                <a href="#">
                                    <div class="user-avatar"><img src="{{ auth()->user()->profile->getAvatar() }}"
                                                                  alt=""></div>
                                </a>
                            </div>

                            <!-- Dropdown -->
                            <div class="header-notifications-dropdown">

                                <!-- User Status -->
                                <div class="user-status">

                                    <!-- User Name / Avatar -->
                                    <div class="user-details">
                                        <div class="user-name">
                                            {{ auth()->user()->profile->getFullName() }}
                                            <span>{{ auth()->user()->city->name }}</span>
                                        </div>
                                    </div>
                                </div>

                                <ul class="user-menu-small-nav">
                                    <li><a href="{{ route('profile.me') }}"><i
                                                class="icon-material-outline-person-pin"></i> @lang('common.my-profile')
                                        </a></li>
                                    <li><a href="{{ route('settings.index') }}"><i
                                                class="icon-material-outline-settings"></i> @lang('settings.settings')
                                        </a></li>
                                    <li><a href="{{ route('exit') }}"><i
                                                class="icon-material-outline-power-settings-new"></i> @lang('common.logout')
                                        </a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <!-- User Menu / End -->
                @endauth
                <span class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</span>
            </div>
        </div>
    </div>
</header>
<div class="clearfix"></div>
<!-- Header Container / End -->
