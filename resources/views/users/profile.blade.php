@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="single-page-header freelancer-header intro-banner" data-background-image="{{ $background }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-page-header-inner">
                        <div class="left-side">
                            <div class="header-image freelancer-avatar"><img src="{{ $user->profile->getAvatar() }}"
                                                                             alt="">
                            </div>
                            <div class="header-details">
                                <h3>
                                    @if(auth()->check() && $user->id === auth()->id())
                                        {{ $user->profile->getFullName() }}
                                    @else
                                        {{ $user->name }}
                                    @endif
                                    <span>{{ $user->city->name }}</span>
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
            @if($user->profile->description)
                <div class="col-xl-8 col-lg-8 content-right-offset">
                    @else
                        <div class="col-xl-12 col-lg-12 content-right-offset">
                            @endif
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
                        @if($user->profile->description)
                            <div class="col-xl-4 col-lg-4">
                                <div class="sidebar-container">
                                    <!-- Profile Overview -->
                                    <div class="profile-overview">
                                        <div class="single-page-section">
                                            <h3 class="margin-bottom-25">@lang('profile.about_me')</h3>
                                            <p>{{ $user->profile->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(count($offers))
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
                        @endif

                </div>
        </div>
@endsection
