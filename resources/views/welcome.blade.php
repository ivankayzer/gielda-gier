@extends('layouts.app')

@section('title', 'Strona główna')

@section('content')
    <div class="intro-banner" data-background-image="images/home-background.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><strong>@lang('welcome.intro')</strong></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('offers.index') }}" method="get" id="welcome-search">
                        <div class="intro-banner-search-form margin-top-95">
                            <div class="intro-search-field with-autocomplete">
                                <label for="autocomplete-input"
                                       class="field-title ripple-effect">@lang('welcome.where')</label>
                                <select class="select2 no-border full-container full-height cities" name="city"
                                        title="@lang('settings.select_city')">
                                    <option value="0">@lang('welcome.pick_city')</option>
                                </select>
                            </div>
                            <div class="intro-search-field">
                                <label for="intro-keywords"
                                       class="field-title ripple-effect">@lang('welcome.game_title')</label>
                                <select class="select2 no-border full-container full-height games" name="game_id"
                                        title="Wybierz grę">
                                    <option value="0">Wybierz grę</option>
                                </select>
                            </div>
                            <div class="intro-search-button">
                                <button class="button ripple-effect" type="submit">@lang('common.search')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="section padding-top-65 padding-bottom-45">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section-headline margin-top-0 margin-bottom-5">
                        <h3>@lang('welcome.how_it_works')</h3>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="icon-box with-line">
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
                    <div class="icon-box with-line">
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
                    <div class="icon-box">
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
    @if(count($offers))
        <div class="section gray padding-top-65 padding-bottom-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section-headline margin-top-0 margin-bottom-35">
                            <h3>@lang('welcome.featured_offers')</h3>
                            <a href="{{ route('offers.index') }}" class="headline-link">@lang('welcome.all_offers')</a>
                        </div>
                        <div class="listings-container compact-list-layout margin-top-35">
                            @foreach($offers as $offer)
                                <a href="{{ route('offers.show', ['offer' => $offer->id, 'slug' => str_slug($offer->game->title)]) }}"
                                   class="job-listing with-apply-button">
                                    <div class="job-listing-details">
                                        <div class="job-listing-company-logo">
                                            <img src="{{ $offer->game->cover }}" alt="{{ $offer->game->title }}">
                                        </div>
                                        <div class="job-listing-description">
                                            <h3 class="job-listing-title">{{ $offer->game->title }}</h3>
                                            <div class="job-listing-footer">
                                                <ul>
                                                    <li>
                                                        <i class="icon-material-outline-business"></i> {{ $offer->sellerProfile->getFullName() }}
                                                    </li>
                                                    <li>
                                                        <i class="icon-material-outline-location-on"></i> {{ $offer->city->name }}
                                                    </li>
                                                    <li>
                                                        <i class="icon-material-outline-access-time"></i> {{ $offer->humanCreatedAt() }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <span class="list-apply-button ripple-effect">@lang('welcome.check')</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection