@extends('layouts.app')

@section('content')
    <!-- Intro Banner
================================================== -->
    <!-- add class "disable-gradient" to enable consistent background overlay -->
    <div class="intro-banner" data-background-image="images/home-background.png">
        <div class="container">

            <!-- Intro Headline -->
            <div class="row">
                <div class="col-md-12">
                    <h1><strong>@lang('welcome.intro')</strong></h1>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="row">
                <div class="col-md-12">
                    <div class="intro-banner-search-form margin-top-95">

                        <!-- Search Field -->
                        <div class="intro-search-field with-autocomplete">
                            <label for="autocomplete-input"
                                   class="field-title ripple-effect">@lang('welcome.where')</label>
                            <div class="input-with-icon">
                                <input id="autocomplete-input" type="text" placeholder="@lang('welcome.pick_city')">
                                <i class="icon-material-outline-location-on"></i>
                            </div>
                        </div>

                        <!-- Search Field -->
                        <div class="intro-search-field">
                            <label for="intro-keywords"
                                   class="field-title ripple-effect">@lang('welcome.game_title')</label>
                            <input id="intro-keywords" type="text"
                                   placeholder="@lang('welcome.game_title_placeholder')">
                        </div>

                        <!-- Button -->
                        <div class="intro-search-button">
                            <button class="button ripple-effect"
                                    onclick="window.location.href='#'">@lang('common.search')
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="intro-stats margin-top-45 hide-under-992px">
                        <li>
                            <strong class="counter">1,586</strong>
                            <span>@lang('welcome.users')</span>
                        </li>
                        <li>
                            <strong class="counter">3,543</strong>
                            <span>@lang('welcome.offers')</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <!-- Icon Boxes -->
    <div class="section padding-top-65 padding-bottom-45">
        <div class="container">
            <div class="row">

                <div class="col-xl-12">
                    <!-- Section Headline -->
                    <div class="section-headline margin-top-0 margin-bottom-5">
                        <h3>@lang('welcome.how_it_works')</h3>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <!-- Icon Box -->
                    <div class="icon-box with-line">
                        <!-- Icon -->
                        <div class="icon-box-circle">
                            <div class="icon-box-circle-inner">
                                <i class="icon-line-awesome-lock"></i>
                                <div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
                            </div>
                        </div>
                        <h3>@lang('welcome.step_1')</h3>
                        <p>@lang('welcome.step_1_description')</p>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <!-- Icon Box -->
                    <div class="icon-box with-line">
                        <!-- Icon -->
                        <div class="icon-box-circle">
                            <div class="icon-box-circle-inner">
                                <i class="icon-line-awesome-search"></i>
                                <div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
                            </div>
                        </div>
                        <h3>@lang('welcome.step_2')</h3>
                        <p>@lang('welcome.step_2_description')</p>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <!-- Icon Box -->
                    <div class="icon-box">
                        <!-- Icon -->
                        <div class="icon-box-circle">
                            <div class="icon-box-circle-inner">
                                <i class=" icon-line-awesome-money"></i>
                                <div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
                            </div>
                        </div>
                        <h3>@lang('welcome.step_3')</h3>
                        <p>@lang('welcome.step_3_description')</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Icon Boxes / End -->

    <!-- Features Cities -->
    <div class="section gray margin-top-65 padding-top-65 padding-bottom-65">
        <div class="container">
            <div class="row">

                <!-- Section Headline -->
                <div class="col-xl-12">
                    <div class="section-headline margin-top-0 margin-bottom-45">
                        <h3>@lang('welcome.featured_platforms')</h3>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <!-- Photo Box -->
                    <a href="#" class="photo-box"
                       data-background-image="images/featured-city-01.jpg">
                        <div class="photo-box-content">
                            <h3>Playstation 4</h3>
                            <span>{{ $offersCount['ps4'] }} @lang('welcome.offers_l')</span>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <!-- Photo Box -->
                    <a href="#" class="photo-box"
                       data-background-image="images/featured-city-02.jpg">
                        <div class="photo-box-content">
                            <h3>Xbox One</h3>
                            <span>{{ $offersCount['xone'] }} @lang('welcome.offers_l')</span>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <!-- Photo Box -->
                    <a href="#" class="photo-box"
                       data-background-image="images/featured-city-03.jpg">
                        <div class="photo-box-content">
                            <h3>Nintendo Switch</h3>
                            <span>{{ $offersCount['switch'] }} @lang('welcome.offers_l')</span>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <!-- Photo Box -->
                    <a href="#" class="photo-box"
                       data-background-image="images/featured-city-04.jpg">
                        <div class="photo-box-content">
                            <h3>PC</h3>
                            <span>{{ $offersCount['pc'] }} @lang('welcome.offers_l')</span>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!-- Features Cities / End -->

    <!-- Features Games -->
    <div class="section padding-top-65 padding-bottom-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">

                    <!-- Section Headline -->
                    <div class="section-headline margin-top-0 margin-bottom-35">
                        <h3>@lang('welcome.featured_offers')</h3>
                        <a href="{{ route('offers.index') }}" class="headline-link">@lang('welcome.all_offers')</a>
                    </div>

                    <!-- Games Container -->
                    <div class="listings-container compact-list-layout margin-top-35">
                        @foreach($offers as $offer)
                            <a href="{{ route('offers.show', ['offer' => $offer->id, 'slug' => str_slug($offer->game->title)]) }}" class="job-listing with-apply-button">
                                <div class="job-listing-details">
                                    <div class="job-listing-company-logo">
                                        <img src="{{ $offer->game->cover }}" alt="{{ $offer->game->title }}">
                                    </div>
                                    <div class="job-listing-description">
                                        <h3 class="job-listing-title">{{ $offer->game->title }}</h3>

                                        <!-- Game Listing Footer -->
                                        <div class="job-listing-footer">
                                            <ul>
                                                <li>
                                                    <i class="icon-material-outline-business"></i> {{ $offer->sellerProfile->getFullName() }}
                                                </li>
                                                <li>
                                                    <i class="icon-material-outline-location-on"></i> {{ $offer->city() }}
                                                </li>
                                                <li>
                                                    <i class="icon-material-outline-access-time"></i> {{ $offer->humanCreatedAt() }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Apply Button -->
                                    <span class="list-apply-button ripple-effect">@lang('welcome.check')</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <!-- Games Container / End -->

                </div>
            </div>
        </div>
    </div>
    <!-- Featured Games / End -->
@endsection