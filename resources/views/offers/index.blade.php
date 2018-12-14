@extends('layouts.app')

@section('content')
    <!-- Spacer -->

    <div class="margin-top-90"></div>
    <!-- Spacer / End-->

    <!-- Page Content
    ================================================== -->
    <div class="container gray">
        @if(session()->has('message'))
            @include('partials.message', ['message' => session()->get('message')])
        @endif
        <form method="get">

            <div class="row">
                <div class="col-xl-3 col-lg-4 filters">

                    <form method="get">
                        <div class="sidebar-container">

                            <div class="sidebar-widget">
                                <h3>@lang('common.city')</h3>
                                <select class="select2 cities" name="city"
                                        title="@lang('settings.select_city')">
                                        <option value="0">Wybierz miasto</option>
                                </select>
                            </div>

                            <div class="sidebar-widget">
                                <h3>@lang('common.platform')</h3>
                                <select class="select2" multiple name="platform[]" title="@lang('common.all_platforms')">
                                    @foreach(\App\Components\Platform::availablePlatforms() as $slug => $platform)
                                        <option @if(in_array($slug, request()->get('platform', []))) selected
                                                @endif value="{{ $slug }}">{{ $platform }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="sidebar-widget">
                                <h3>@lang('common.game')</h3>
                                <select class="select2 games" name="game_id"
                                        title="@lang('common.game')">
                                    <option value="0">Wybierz grę</option>
                                </select>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <h3>@lang('common.price')</h3>
                            <div class="margin-top-55"></div>

                            <!-- Range Slider -->
                            <input class="range-slider" type="text" name="price" data-slider-currency="zł "
                                   data-slider-min="{{ request()->get}}"
                                   data-slider-max="{{ $maxPrice }}" data-slider-step="5"
                                   data-slider-value="[{{ request()->get('price', $minPrice . ',' . $maxPrice) }}]"/>
                        </div>

                        <div class="sidebar-widget">
                            <h3>@lang('common.type')</h3>
                            <div class="checkbox">
                                <input type="checkbox" name="sellable" value="1" id="sellable"
                                       @if(request()->get('sellable')) checked="checked" @endif>
                                <label for="sellable"><span class="checkbox-icon"></span> @lang('common.for_sale')
                                </label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="tradeable" value="1" id="tradeable"
                                       @if(request()->get('tradeable')) checked="checked" @endif>
                                <label for="tradeable"><span class="checkbox-icon"></span> @lang('common.for_trade')
                                </label>
                            </div>
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
                                <option @if(request()->get('sort') === 'date_desc') selected
                                        @endif value="date_desc">@lang('common.sort_date_desc')</option>
                                <option @if(request()->get('sort') === 'date_asc') selected
                                        @endif value="date_asc">@lang('common.sort_date_asc')</option>
                                <option @if(request()->get('sort') === 'price_desc') selected
                                        @endif value="price_desc">@lang('common.sort_price_desc')</option>
                                <option @if(request()->get('sort') === 'price_asc') selected
                                        @endif value="price_asc">@lang('common.sort_price_asc')</option>
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