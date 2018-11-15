@extends('layouts.app')

@section('content')
    <div class="single-page-header freelancer-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-page-header-inner">
                        <div class="left-side">
                            <div class="header-image freelancer-avatar"><img src="{{ $user->profile->getAvatar() }}"
                                                                             alt="">
                            </div>
                            <div class="header-details">
                                <h3>{{ $user->profile->getFullName() }} <span>{{ $user->profile->getCity() }}</span>
                                </h3>
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

                <div class="boxed-list margin-bottom-60">
                    <div class="boxed-list-headline">
                        <h3><i class="icon-material-outline-thumb-up"></i> @lang('profile.reviews')</h3>
                    </div>
                    <ul class="boxed-list-ul">
                        @foreach($reviews as $review)
                            @include('users._review', ['review' => $review])
                        @endforeach

                        @if(!count($reviews))
                            <p class="margin-top-30 margin-left-30">@lang('profile.no_reviews')</p>
                        @endif
                    </ul>

                    <!-- Pagination -->
                    <div class="clearfix"></div>
                    {{ $reviews->links() }}
                    <div class="clearfix"></div>
                    <!-- Pagination / End -->

                </div>
            </div>
            <!-- Sidebar -->
            <div class="col-xl-4 col-lg-4">
                <div class="sidebar-container">

                    <!-- Profile Overview -->
                    <div class="profile-overview">
                        <div class="single-page-section">
                            <h3 class="margin-bottom-25">@lang('profile.about_me')</h3>
                            <p>{{ $user->profile->description }}</p>
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
            <div class="col-xl-12 col-lg-12 content-right-offset">


                <div class="boxed-list margin-bottom-60">
                    <div class="boxed-list-headline">
                        <h3><i class="icon-material-outline-business"></i> @lang('profile.offers')</h3>
                    </div>
                    <div class="freelancers-container freelancers-list-layout compact-list">

                        @foreach($offers as $offer)
                            @include('offers._offer', ['offer' => $offer])
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection