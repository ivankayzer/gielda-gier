@extends('layouts.app')

@section('content')
    <!-- Spacer -->

    <div class="margin-top-90"></div>
    <!-- Spacer / End-->

    <!-- Page Content
    ================================================== -->
    <div class="container gray">
        <form method="get">

            <div class="row">
                <div class="col-xl-3 col-lg-4 filters">

                    <form method="get">
                        <div class="sidebar-container">

                            <div class="sidebar-widget">
                                <h3>@lang('common.city')</h3>
                                <select class="selectpicker with-border"
                                        data-live-search="true"
                                        name="city"
                                        title="@lang('settings.select_city')">
                                    @foreach($cities as $slug => $city)
                                        <option @if($slug === request()->get('city')) selected
                                                @endif value="{{ $slug }}">{{ $city }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="sidebar-widget">
                                <h3>@lang('common.platform')</h3>
                                <select class="selectpicker default" multiple data-selected-text-format="count"
                                        data-size="7"
                                        name="platform[]"
                                        title="@lang('common.all_platforms')">
                                    @foreach(\App\Components\Platform::availablePlatforms() as $slug => $platform)
                                        <option @if(in_array($slug, request()->get('platform', []))) selected
                                                @endif value="{{ $slug }}">{{ $platform }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="sidebar-widget">
                                <h3>@lang('common.game')</h3>
                                <div class="input-with-icon">
                                    <input type="text" class="keyword-input"
                                           name="name"
                                           value="{{ request()->get('name') }}"
                                           placeholder="@lang('common.game_placeholder')"/>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <h3>@lang('common.price')</h3>
                            <div class="margin-top-55"></div>

                            <!-- Range Slider -->
                            <input class="range-slider" type="text" name="price" data-slider-currency="zł "
                                   data-slider-min="10"
                                   data-slider-max="250" data-slider-step="5" data-slider-value="[{{ request()->get('price', '10,250') }}]"/>
                        </div>
                        <button type="submit" class="button button-sliding-icon ripple-effect hidden filters-action">
                            @lang('common.filter')
                            <i class="icon-material-outline-arrow-right-alt"></i>
                        </button>
                        <div class="clearfix"></div>

                </div>
                <div class="col-xl-9 col-lg-8 content-left-offset">

                    <div class="notify-box margin-bottom-15">
                        <div class="sort-by">
                            <span>@lang('common.sort_by'):</span>
                            <select name="sort" class="selectpicker hide-tick submit-on-select">
                                <option @if(request()->get('sort') === 'date_asc') selected @endif value="date_asc">@lang('common.sort_date_asc')</option>
                                <option @if(request()->get('sort') === 'date_desc') selected @endif value="date_desc">@lang('common.sort_date_desc')</option>
                                <option @if(request()->get('sort') === 'price_desc') selected @endif value="price_desc">@lang('common.sort_price_desc')</option>
                                <option @if(request()->get('sort') === 'price_asc') selected @endif value="price_asc">@lang('common.sort_price_asc')</option>
                            </select>
                        </div>
                    </div>

                    <div class="freelancers-container freelancers-list-layout compact-list">
                        @foreach($offers as $offer)
                            @include('offers._offer', ['offer' => $offer])
                        @endforeach
                    </div>
                    {{ $offers->links() }}
                </div>
            </div>
        </form>

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
    <div class="dashboard-footer-spacer"></div>
@endsection

@section('post-scripts')
    <script>
        $('.filters input, .filters select').change(function () {
            $('.filters-action').removeClass('hidden');
        });

        $('.submit-on-select').change(function () {
            $(this).parents('form').submit();
        });
    </script>
@endsection