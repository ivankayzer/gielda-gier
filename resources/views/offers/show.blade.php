@extends('layouts.app')

@section('content')
    <div class="single-page-header" data-background-image="images/single-job.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-page-header-inner">
                        <div class="left-side">
                            <div class="header-image"><img src="{{ $offer->game->cover }}"
                                                           alt="{{ $offer->game->title }}"></div>
                            <div class="header-details">
                                <h3>{{ $offer->game->title }}</h3>
                                <h5>{{ $offer->platform() }}</h5>
                                <ul class="margin-top-25">
                                    <li><strong>
                                            <i class="icon-material-outline-location-on"></i>
                                            {{ $offer->city() }}
                                        </strong></li>
                                </ul>
                            </div>
                        </div>
                        <div class="right-side">
                            <div class="salary-box">
                                <div class="salary-amount"><strong>{{ $offer->price() }}</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <!-- Content -->
            <div class="col-xl-8 col-lg-8 content-right-offset">

                <ul id="vertical">
                    @foreach ($offer->image as $image)
                        <li data-thumb="{{ asset('storage/' . $image->url) }}">
                            <img src="{{ asset('storage/' . $image->url) }}"/>
                        </li>
                    @endforeach
                </ul>

                <div class="single-page-section">
                    <p>{{ $offer->comment }}</p>
                </div>

                <div class="single-page-section">
                    <h3 class="margin-bottom-25">@lang('offers.similar')</h3>

                    <div class="freelancers-container freelancers-list-layout compact-list">
                        @foreach($similar as $offer)
                            @include('offers._offer', ['offer' => $offer])
                        @endforeach
                    </div>

                </div>
            </div>


            <!-- Sidebar -->
            <div class="col-xl-4 col-lg-4">
                <div class="sidebar-container">

                    <a href="#small-dialog" class="apply-now-button popup-with-zoom-anim">{{ $offer->buyText() }} <i
                                class="icon-material-outline-arrow-right-alt"></i></a>

                    <!-- Sidebar Widget -->
                    <div class="sidebar-widget">
                        <div class="job-overview">
                            <div class="job-overview-headline">@lang('offers.seller')</div>
                            <div class="job-overview-inner">
                                <ul>
                                    <li class="d-flex justify-content-center" style="padding-left: 0 !important;">
                                        <div class="user-avatar">
                                            <img src="{{ $offer->sellerProfile->getAvatar() }}" alt="">
                                        </div>
                                    </li>
                                    <li>
                                        <i class="icon-material-outline-location-on"></i>
                                        <span>@lang('offers.location')</span>
                                        <h5>{{ $offer->city() }}</h5>
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

                    <!-- Sidebar Widget -->
                    <div class="sidebar-widget">
                        <h3>@lang('offers.share')</h3>

                        <!-- Copy URL -->
                        <div class="copy-url">
                            <input id="copy-url" type="text" value="" class="with-border">
                            <button class="copy-url-button ripple-effect" data-clipboard-target="#copy-url"
                                    title="Copy to Clipboard" data-tippy-placement="top"><i
                                        class="icon-material-outline-file-copy"></i></button>
                        </div>

                        <!-- Share Buttons -->
                        <div class="share-buttons margin-top-25">
                            <div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
                            <div class="share-buttons-content">
                                <span>@lang('offers.share')</span>
                                <ul class="share-buttons-icons">
                                    <li><a href="#" data-button-color="#3b5998" title="Share on Facebook"
                                           data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
                                    <li><a href="#" data-button-color="#1da1f2" title="Share on Twitter"
                                           data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
                                    <li><a href="#" data-button-color="#dd4b39" title="Share on Google Plus"
                                           data-tippy-placement="top"><i class="icon-brand-google-plus-g"></i></a></li>
                                    <li><a href="#" data-button-color="#0077b5" title="Share on LinkedIn"
                                           data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection