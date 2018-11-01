@extends('layouts.app')

@section('content')
    <!-- Spacer -->

    <div class="margin-top-90"></div>
    <!-- Spacer / End-->

    <!-- Page Content
    ================================================== -->
    <div class="container gray">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="sidebar-container">

                    <!-- Location -->
                    <div class="sidebar-widget">
                        <h3>@lang('common.city')</h3>
                        <div class="input-with-icon">
                            <div id="autocomplete-container">
                                <input id="autocomplete-input" type="text"
                                       placeholder="@lang('common.city_placeholder')">
                            </div>
                            <i class="icon-material-outline-location-on"></i>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="sidebar-widget">
                        <h3>@lang('common.platform')</h3>
                        <select class="selectpicker default" multiple data-selected-text-format="count" data-size="7"
                                title="@lang('common.all_platforms')">
                            @foreach(\App\Components\Platform::availablePlatforms() as $slug => $platform)
                                <option value="{{ $slug }}">{{ $platform }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Keywords -->
                    <div class="sidebar-widget">
                        <h3>@lang('common.game')</h3>
                        <div class="input-with-icon">

                            <input type="text" class="keyword-input" placeholder="@lang('common.game_placeholder')"/>
                        </div>
                    </div>
                </div>

                <!-- Hourly Rate -->
                <div class="sidebar-widget">
                    <h3>@lang('common.price')</h3>
                    <div class="margin-top-55"></div>

                    <!-- Range Slider -->
                    <input class="range-slider" type="text" value="" data-slider-currency="zł " data-slider-min="10"
                           data-slider-max="250" data-slider-step="5" data-slider-value="[10,250]"/>
                </div>

                <div class="clearfix"></div>

            </div>
        <div class="col-xl-9 col-lg-8 content-left-offset">

            <div class="notify-box margin-bottom-15">
                <div class="sort-by">
                    <span>@lang('common.sort_by'):</span>
                    <select class="selectpicker hide-tick">
                        <option>@lang('common.sort_date_asc')</option>
                        <option>@lang('common.sort_date_desc')</option>
                        <option>@lang('common.sort_price_desc')</option>
                        <option>@lang('common.sort_price_asc')</option>
                    </select>
                </div>
            </div>

            <!-- Freelancers List Container -->
            <div class="freelancers-container freelancers-list-layout compact-list">
                @foreach($offers as $offer)
                    @include('offers._offer', ['offer' => $offer])
                @endforeach
            </div>
            <!-- Freelancers Container / End -->
            {{ $offers->links() }}
        </div>
    </div>
    </div>

    <div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
        <!--Tabs -->
        <div class="sign-in-form">

            <ul class="popup-tabs-nav">
            </ul>

            <div class="popup-tabs-container">

                <!-- Tab -->
                <div class="popup-tab-content" id="tab">
                    <button class="button full-width button-sliding-icon ripple-effect margin-top-0" type="submit"
                            form="send-pm">
                        kup Call of Duty: Black Ops IIII za 93,90 zł <i
                                class="icon-material-outline-arrow-right-alt"></i>
                    </button>

                    <!-- Welcome Text -->
                    <div class="welcome-text margin-top-20">
                        <h3>lub</h3>
                    </div>

                    <!-- Form -->
                    <form method="post" id="send-pm">
                        <textarea name="textarea" cols="5" rows="3" placeholder="Wiadomość" class="with-border"
                                  required></textarea>
                    </form>

                    <!-- Button -->
                    <button class="button button-sliding-icon ripple-effect" type="submit" form="send-pm">wymień się <i
                                class="icon-material-outline-arrow-right-alt"></i></button>

                </div>

            </div>
        </div>
    </div>
@endsection