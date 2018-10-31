<!-- Header Container
================================================== -->
<header id="header-container">

    <!-- Header -->
    <div id="header">
        <div class="container">
            <div class="left-side">
                <div id="logo">
                    <a href="/"><img src="images/logo.png" alt=""></a>
                </div>
                @auth
                    <nav id="navigation">
                        <ul id="responsive">
                            <li><a href="/" class="current">Home</a></li>
                            <li><a href="/dashboard">Dashboard</a></li>
                            <li><a href="/offers">Offers</a></li>
                            <li><a href="/transactions">Transactions</a></li>
                            <li><a href="/reviews">Reviews</a></li>
                            <li><a href="/chat">Chat</a></li>
                            <li><a href="/settings">Settings</a></li>
                            <li><a href="/users">Users</a></li>
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
            </div>
        </div>
    </div>
</header>
<div class="clearfix"></div>
<!-- Header Container / End -->