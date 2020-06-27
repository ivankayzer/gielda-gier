@extends('layouts.app')

@section('title', $offer->game->title)

@section('content')
    <div class="single-page-header" data-background-image="{{ $offer->game->background }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-page-header-inner">
                        <div class="left-side">
                            <div class="header-image"><img src="{{ $offer->game->cover }}" class="animated fadeIn"
                                                           alt="{{ $offer->game->title }}"></div>
                            <div class="header-details">
                                <h3>{{ $offer->game->title }}</h3>
                                <h6>
                                    <mark class="color {{ $offer->platform }}">{{ $offer->platform() }}</mark>
                                </h6>
                                <ul class="margin-top-25">
                                    <li><strong>
                                            <i class="icon-material-outline-location-on"></i>
                                            {{ $offer->city->name }}
                                        </strong></li>
                                </ul>
                            </div>
                        </div>
                        <div class="right-side">
                            @if($offer->sellable)
                                <div class="salary-box">
                                    <div class="salary-amount"><strong>{{ $offer->formatted_price }}</strong></div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @if(session()->has('message'))
            @include('partials.message', ['message' => session()->get('message')])
        @endif
        <div class="row">


        @if(count($offer->image))
            <!-- Content -->
                <div class="col-xl-8 col-lg-8 content-right-offset">

                    <div class="single-page-section">
                        <p>{{ $offer->comment }}</p>
                    </div>

                    <div id="vertical" class="carousel @if(count($offer->image) === 1) disabled @endif padding-bottom-20" tabindex="-1" role="dialog" aria-hidden="true"
                         data-flickity='{ "imagesLoaded": true, "percentPosition": false }'>
                        @foreach ($offer->image as $image)
                            <img alt="" src="{{ asset('storage/' . $image->url) }}"
                                 onerror="this.src='{{ asset('images/no-image.png') }}'"
                            />
                        @endforeach
                    </div>

                    @if(count($similar))
                        <div class="single-page-section">
                            <h3 class="margin-bottom-25">@lang('offers.similar')</h3>

                            <div class="freelancers-container freelancers-list-layout compact-list">
                                @foreach($similar as $similarOffer)
                                    @include('offers._offer', ['offer' => $similarOffer])
                                @endforeach
                            </div>

                        </div>
                    @endif
                </div>
        @endif

        @if(count($offer->image))
            <!-- Sidebar -->
                <div class="col-xl-4 col-lg-4">
                    <div class="sidebar-container">

                        @auth
                            @if($offer->actionable())
                                <a href=".buy-dialog"
                                   class="apply-now-button popup-with-zoom-anim">{{ $offer->buyText() }} <i
                                        class="icon-material-outline-arrow-right-alt"></i></a>
                            @endif
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="apply-now-button">@lang('common.do_login') <i
                                    class="icon-material-outline-arrow-right-alt"></i></a>
                        @endguest
                        <ul class="features margin-bottom-35">
                            <li><strong>@lang('offers.payment')</strong></li>
                            <li class="{{ $offer->payment_bank_transfer ? 'yes' : 'no' }}">@lang('offers.payment_bank_transfer')</li>
                            <li class="{{ $offer->payment_cash ? 'yes' : 'no' }}">@lang('offers.payment_cash')</li>
                            <li class="margin-top-10"><strong>@lang('offers.delivery')</strong></li>
                            <li class="{{ $offer->delivery_post ? 'yes' : 'no' }}">@lang('offers.delivery_post')</li>
                            <li class="{{ $offer->delivery_in_person ? 'yes' : 'no' }}">@lang('offers.delivery_in_person')</li>
                        </ul>

                        <!-- Sidebar Widget -->
                        <div class="sidebar-widget">
                            <div class="job-overview">
                                <div class="job-overview-headline">@lang('offers.seller')</div>
                                <div class="job-overview-inner">
                                    <ul>
                                        <li class="d-flex justify-content-center" style="padding-left: 0 !important;">
                                            <div class="user-avatar">
                                                <img src="{{ $offer->sellerProfile->getAvatar() }}" alt="">
                                                <a href="{{ route('profile.show', ['user' => $offer->seller->name]) }}"><h5>{{ $offer->seller->name }}</h5></a>
                                            </div>
                                        </li>
                                        <li>
                                            <i class="icon-material-outline-location-on"></i>
                                            <span>@lang('offers.location')</span>
                                            <h5>{{ $offer->city->name }}</h5>
                                        </li>
                                        <li>
                                            <i class="icon-material-outline-access-time"></i>
                                            <span>@lang('offers.publish_at')</span>
                                            <h5>{{ $offer->publish_at->diffForHumans() }}</h5>
                                        </li>
                                        <li>
                                            <i class="icon-material-outline-thumb-up"></i>
                                            <span>@lang('offers.comments_positive')</span>
                                            <h5>{{ $offer->seller->positiveReviewsCount() }}</h5>
                                        </li>
                                        <li>
                                            <i class="icon-material-outline-thumb-down"></i>
                                            <span>@lang('offers.comments_negative')</span>
                                            <h5>{{ $offer->seller->negativeReviewsCount() }}</h5>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endif

        @if(!count($offer->image))
            <!-- Sidebar -->
                <div class="col-xl-4 col-lg-4 offset-4">
                    <div class="sidebar-container">

                        <!-- Sidebar Widget -->
                        <div class="sidebar-widget">
                            <div class="job-overview">
                                <div class="job-overview-headline">@lang('offers.seller')</div>
                                <div class="job-overview-inner">
                                    <ul>
                                        <li class="d-flex justify-content-center" style="padding-left: 0 !important;">
                                            <div class="user-avatar">
                                                <img src="{{ $offer->sellerProfile->getAvatar() }}" alt="">
                                                <a href="{{ route('profile.show', ['user' => $offer->seller->name]) }}"><h5>{{ $offer->seller->name }}</h5></a>
                                            </div>
                                        </li>
                                        <li>
                                            <i class="icon-material-outline-location-on"></i>
                                            <span>@lang('offers.location')</span>
                                            <h5>{{ $offer->city->name }}</h5>
                                        </li>
                                        <li>
                                            <i class="icon-material-outline-access-time"></i>
                                            <span>@lang('offers.publish_at')</span>
                                            <h5>{{ $offer->publish_at->diffForHumans() }}</h5>
                                        </li>
                                        <li>
                                            <i class="icon-material-outline-thumb-up"></i>
                                            <span>@lang('offers.comments_positive')</span>
                                            <h5>{{ $offer->seller->positiveReviewsCount() }}</h5>
                                        </li>
                                        <li>
                                            <i class="icon-material-outline-thumb-down"></i>
                                            <span>@lang('offers.comments_negative')</span>
                                            <h5>{{ $offer->seller->negativeReviewsCount() }}</h5>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4">
                    <div class="sidebar-container">

                        @auth
                            @if($offer->actionable())
                                <a href=".buy-dialog"
                                   class="apply-now-button popup-with-zoom-anim">{{ $offer->buyText() }} <i
                                        class="icon-material-outline-arrow-right-alt"></i></a>
                            @endif
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="apply-now-button">@lang('common.do_login') <i
                                    class="icon-material-outline-arrow-right-alt"></i></a>
                        @endguest
                        <ul class="features margin-bottom-35">
                            <li><strong>@lang('offers.payment')</strong></li>
                            <li class="{{ $offer->payment_bank_transfer ? 'yes' : 'no' }}">@lang('offers.payment_bank_transfer')</li>
                            <li class="{{ $offer->payment_cash ? 'yes' : 'no' }}">@lang('offers.payment_cash')</li>
                            <li class="margin-top-10"><strong>@lang('offers.delivery')</strong></li>
                            <li class="{{ $offer->delivery_post ? 'yes' : 'no' }}">@lang('offers.delivery_post')</li>
                            <li class="{{ $offer->delivery_in_person ? 'yes' : 'no' }}">@lang('offers.delivery_in_person')</li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('modals')
    @auth
        @if(!$offer->isMyOffer())
            @include('offers._buy_modal', ['offer' => $offer])
        @endif
    @endauth
@endsection

@section('post-scripts')
    <script>

    </script>
@endsection
