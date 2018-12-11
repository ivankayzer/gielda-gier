<!-- Header Container
================================================== -->
<header id="header-container">

    <!-- Header -->
    <div id="header">
        <div class="container">
            <div class="left-side">
                <div id="logo">
                    <a href="/"><img src="{{ asset('images/logo.png') }}" alt=""></a>
                </div>
                @auth
                    <nav id="navigation">
                        <ul id="responsive">
                            <li><a href="{{ route('welcome') }}"
                                   @if(request()->is('/')) class="current" @endif>@lang('common.home')</a></li>
                            {{--<li><a href="/dashboard">Dashboard</a></li>--}}
                            <li class="margin-right-15">
                                <a href="{{ route('offers.index') }}"
                                   @if(request()->is('offers') || request()->is('offers/*')) class="current" @endif>
                                    @lang('offers.offers')
                                </a>
                                <a href="{{ route('offers.create') }}" class="add-offers"
                                   style="padding: 0 !important;">
                                    <i class="icon-feather-plus" style="position: absolute;"></i>
                                </a>
                            </li>
                            <li><a href="{{ route('transactions.index') }}"
                                   @if(request()->is('/transactions') || request()->is('/transactions/*')) class="current" @endif>@lang('common.transactions')</a>
                            </li>
                        </ul>
                    </nav>
                @endauth
                <div class="clearfix"></div>
            </div>
            <div class="right-side">
                @guest
                    <div class="header-widget">
                        <a href="#sign-in-dialog" class="popup-with-zoom-anim log-in-button">
                            <i class="icon-feather-log-in"></i> <span>@lang('auth.login')
                                / @lang('auth.register')</span>
                        </a>
                    </div>
                @endguest
                @auth
                <!--  User Notifications -->
                    <div class="header-widget hide-on-mobile">

                        <!-- Notifications -->
                        <div class="header-notifications">
                            <!-- Trigger -->
                            <div class="header-notifications-trigger">
                                <a href="#"><i class="icon-feather-bell"></i><span>4</span></a>
                            </div>

                            <!-- Dropdown -->
                            <div class="header-notifications-dropdown">

                                <div class="header-notifications-headline">
                                    <h4>@lang('common.notifications')</h4>
                                </div>

                                <div class="header-notifications-content">
                                    <div class="header-notifications-scroll" data-simplebar>
                                        <ul>
                                            @foreach(range(1, 5) as $notication)
                                                <li class="notifications-not-read">
                                                    <a href="dashboard-manage-candidates.html">
                                                        <span class="notification-text">
                                                        <strong>Michael Shannah</strong> applied for a job <span
                                                                    class="color">Full Stack Software Engineer</span>
                                                    </span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <a href="{{ route('dashboard') }}"
                                   class="header-notifications-button ripple-effect button-sliding-icon">@lang('common.all_notifications')
                                    <i class="icon-material-outline-arrow-right-alt"></i></a>
                            </div>

                        </div>

                        <!-- Messages -->
                        <div class="header-notifications">
                            <div class="header-notifications-trigger">
                                <a href="#"><i class="icon-feather-mail"></i><span>3</span></a>
                            </div>

                            <!-- Dropdown -->
                            <div class="header-notifications-dropdown">

                                <div class="header-notifications-headline">
                                    <h4>@lang('common.messages')</h4>
                                </div>

                                <div class="header-notifications-content">
                                    <div class="header-notifications-scroll" data-simplebar>
                                        <ul>
                                            <!-- Notification -->
                                            <li class="notifications-not-read">
                                                <a href="#">
                                                    <span class="notification-avatar status-online"><img
                                                                src="{{ asset('images/user-avatar-small-03.jpg') }}"
                                                                alt=""></span>
                                                    <div class="notification-text">
                                                        <strong>David Peterson</strong>
                                                        <p class="notification-msg-text">Thanks for reaching out. I'm
                                                            quite busy right now on many...</p>
                                                        <span class="color">4 hours ago</span>
                                                    </div>
                                                </a>
                                            </li>

                                            <!-- Notification -->
                                            <li class="notifications-not-read">
                                                <a href="#">
                                                    <span class="notification-avatar status-offline"><img
                                                                src="{{ asset('images/user-avatar-small-02.jpg') }}"
                                                                alt=""></span>
                                                    <div class="notification-text">
                                                        <strong>Sindy Forest</strong>
                                                        <p class="notification-msg-text">Hi Tom! Hate to break it to
                                                            you, but I'm actually on vacation until...</p>
                                                        <span class="color">Yesterday</span>
                                                    </div>
                                                </a>
                                            </li>

                                            <!-- Notification -->
                                            <li class="notifications-not-read">
                                                <a href="dashboard-messages.html">
                                                    <span class="notification-avatar status-offline"><img
                                                                src="{{ asset('images/user-avatar-small-02.jpg') }}"
                                                                alt=""></span>
                                                    <div class="notification-text">
                                                        <strong>Sindy Forest</strong>
                                                        <p class="notification-msg-text">Hi Tom! Hate to break it to
                                                            you, but I'm actually on vacation until...</p>
                                                        <span class="color">Yesterday</span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <a href="{{ route('chat.index') }}"
                                   class="header-notifications-button ripple-effect button-sliding-icon">@lang('common.all_messages')
                                    <i class="icon-material-outline-arrow-right-alt"></i></a>
                            </div>
                        </div>

                    </div>
                    <!--  User Notifications / End -->

                    @auth
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
                                                <span>{{ auth()->user()->profile->getCity() }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="user-menu-small-nav">
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

                <!-- Mobile Navigation Button -->
                    <span class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</span>
                @endauth
            </div>
        </div>
    </div>
</header>
<div class="clearfix"></div>
<!-- Header Container / End -->