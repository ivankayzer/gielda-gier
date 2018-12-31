@extends('layouts.app')

@section('title', $offer->game->title)

@section('content')
    <div class="single-page-header" data-background-image="{{ $offer->game->background }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-page-header-inner">
                        <div class="left-side">
                            <div class="header-image"><img src="{{ $offer->game->cover }}"
                                                           alt="{{ $offer->game->title }}"></div>
                            <div class="header-details">
                                <h3>{{ $offer->game->title }}</h3>
                                <h6>
                                    <mark class="color {{ $offer->platform }}">{{ $offer->platform() }}</mark>
                                </h6>
                                <ul class="margin-top-25">
                                    <li><strong>
                                            <i class="icon-material-outline-location-on"></i>
                                            {{ $offer->city() }}
                                        </strong></li>
                                </ul>
                            </div>
                        </div>
                        <div class="right-side">
                            @if($offer->sellable)
                                <div class="salary-box">
                                    <div class="salary-amount"><strong>{{ $offer->price() }}</strong></div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">


            @if(count($offer->image))
            <!-- Content -->
            <div class="col-xl-8 col-lg-8 content-right-offset">

                <div class="single-page-section">
                    <p>{{ $offer->comment }}</p>
                </div>

                <ul id="vertical" class="gallery padding-bottom-20">
                    @foreach ($offer->image as $image)
                        <img data-gallery-src="{{ asset('storage/' . $image->url) }}"
                             class="gallery__item"
                             src="{{ asset('storage/' . $image->url) }}"
                             onerror="this.src='{{ asset('images/no-image.png') }}'"
                        />
                        <img data-gallery-src="{{ asset('storage/' . $image->url) }}"
                             class="gallery__item"
                             src="{{ asset('storage/' . $image->url) }}"
                             onerror="this.src='{{ asset('images/no-image.png') }}'"
                        />
                    @endforeach
                </ul>

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
                        <div class="sidebar-container">
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
                @endif
        </div>
    </div>
@endsection

@section('modals')
    @include('offers._buy_modal', ['offer' => $offer])
@endsection

@section('post-scripts')
    <script>
        $('.gallery').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1
        });
    </script>
@endsection