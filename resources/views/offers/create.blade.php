@extends('layouts.app')

@section('content')
    <div class="dashboard-container">

        <!-- Dashboard Content
        ================================================== -->
        <div class="dashboard-content-container" data-simplebar>
            <div class="container">
                <div class="dashboard-content-inner">

                    <!-- Dashboard Headline -->
                    <div class="dashboard-headline">
                        <h3>@lang('offers.add_offer')</h3>
                    </div>
                    <form action="{{ route('offers.store') }}" method="post" enctype="multipart/form-data">
                        <div class="row">
                        @csrf
                        <!-- Dashboard Box -->
                            <div class="col-xl-12">
                                <div class="dashboard-box margin-top-0">

                                    <div class="headline">
                                        <h3><i class="icon-material-outline-assignment"></i> @lang('offers.basic')</h3>
                                    </div>
                                    <div class="content with-padding padding-bottom-10">

                                        <div class="row">

                                            <div class="col-xl-4">
                                                <div class="submit-field">
                                                    <h5>@lang('offers.game')</h5>
                                                    <select data-size="7"
                                                            name="game_id"
                                                            title="@lang('offers.select_game')">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-3">
                                                <div class="submit-field">
                                                    <h5>@lang('common.platform')</h5>
                                                    <select class="selectpicker with-border"
                                                            data-size="{{ count($platforms) }}"
                                                            name="platform"
                                                            title="@lang('offers.select_platform')">
                                                        @foreach($platforms as $key => $platform)
                                                            <option value="{{ $key }}">{{ $platform }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-3">
                                                <div class="submit-field">
                                                    <h5>@lang('offers.language')</h5>
                                                    <select class="selectpicker with-border" data-size="7"
                                                            name="language"
                                                            title="@lang('offers.select_language')">
                                                        @foreach ($languages as $language)
                                                            <option value="{{ $language['value'] }}"
                                                                    data-content='<div class="d-flex align-items-center"><img class="flag" src="{{ $language['icon'] }}"> <span style="margin: 2px 0 0 5px;">{{ $language['name'] }}</span></div>'></option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-2">
                                                <div class="submit-field">
                                                    <h5>@lang('offers.price')</h5>
                                                    <div class="input-with-icon">
                                                        <input class="with-border" type="text"
                                                               name="price"
                                                               placeholder="@lang('offers.price')">
                                                        <i class="currency">@lang('common.zl')</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="headline">
                                        <h3><i class="icon-material-outline-money"></i> @lang('offers.payment')</h3>
                                    </div>
                                    <div class="content with-padding padding-bottom-10">

                                        <div class="row">
                                            <div class="col-xl-3">
                                                <div class="submit-field">
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="payment_bank_transfer" value="1"
                                                               id="payment_bank_transfer">
                                                        <label for="payment_bank_transfer"><span
                                                                    class="checkbox-icon"></span> @lang('offers.payment_bank_transfer')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-3">
                                                <div class="submit-field">
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="payment_cash" value="1"
                                                               id="payment_cash">
                                                        <label for="payment_cash"><span
                                                                    class="checkbox-icon"></span> @lang('offers.payment_cash')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="headline">
                                        <h3><i class="icon-material-baseline-mail-outline"></i> @lang('offers.delivery')
                                        </h3>
                                    </div>
                                    <div class="content with-padding padding-bottom-10">

                                        <div class="row">
                                            <div class="col-xl-3">
                                                <div class="submit-field">
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="delivery_post" value="1"
                                                               id="delivery_post">
                                                        <label for="delivery_post"><span
                                                                    class="checkbox-icon"></span> @lang('offers.delivery_post')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-3">
                                                <div class="submit-field">
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="delivery_in_person" value="1"
                                                               id="delivery_in_person">
                                                        <label for="delivery_in_person"><span
                                                                    class="checkbox-icon"></span> @lang('offers.delivery_in_person')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="headline">
                                        <h3>
                                            <i class="icon-material-outline-format-shapes"></i> @lang('offers.additional')
                                        </h3>
                                    </div>
                                    <div class="content with-padding padding-bottom-10">

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="submit-field">
                                                    <h5>@lang('offers.comment')</h5>
                                                    <textarea cols="30" rows="5" class="with-border" name="comment"></textarea>
                                                    <div class="uploadButton margin-top-30">
                                                        <input class="uploadButton-input" type="file"
                                                               name="images[]"
                                                               accept="image/*, application/pdf" id="upload" multiple/>
                                                        <label class="uploadButton-button ripple-effect"
                                                               for="upload">@lang('offers.photos')</label>
                                                        <span class="uploadButton-file-name"></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="headline">
                                        <h3><i class="icon-material-outline-date-range"></i> @lang('offers.publication')
                                        </h3>
                                    </div>
                                    <div class="content with-padding padding-bottom-10">

                                        <div class="row">

                                            <div class="col-xl-3">
                                                <div class="submit-field">
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="sellable" value="1" id="sellable">
                                                        <label for="sellable"><span
                                                                    class="checkbox-icon"></span> @lang('offers.sellable')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-3">
                                                <div class="submit-field">
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="tradeable" value="1"
                                                               id="tradeable">
                                                        <label for="tradeable"><span
                                                                    class="checkbox-icon"></span> @lang('offers.tradeable')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-3">
                                                <div class="submit-field">
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="is_published" value="1"
                                                               id="is_published">
                                                        <label for="is_published"><span
                                                                    class="checkbox-icon"></span> @lang('offers.is_published')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <button type="submit" class="button ripple-effect big margin-top-30"><i
                                            class="icon-feather-plus"></i>
                                    @lang('offers.add_offer')</button>
                            </div>
                        </div>
                    </form>
                    <!-- Footer -->
                    <div class="dashboard-footer-spacer"></div>
                    <!-- Footer / End -->

                </div>
            </div>
        </div>
        <!-- Dashboard Content / End -->

    </div>
@endsection

@section('post-scripts')
    <script>
        $('.selectpicker-live')
            .selectpicker({
                liveSearch: true
            })
            .ajaxSelectPicker({
                ajax: {
                    url: '{{ route(('ajax.game')) }}',
                    data: function () {
                        var csrf_token = $('meta[name="csrf-token"]').attr('content');
                        return {
                            q: $(this)[0].plugin.query,
                            _token: csrf_token
                        };
                    }
                },
                locale: {
                    currentlySelected: '@lang('common.select_currently_selected')',
                    emptyTitle: '@lang('common.select_empty_title')',
                    errorText: '@lang('common.select_error_text')',
                    searchPlaceholder: '@lang('common.select_search_placeholder')',
                    statusInitialized: '@lang('common.select_initialized')',
                    statusNoResults: '@lang('common.select_status_no_results')',
                    statusSearching: '@lang('common.select_status_searching')',
                    statusTooShort: '@lang('common.select_status_too_short')',
                },
                preserveSelected: false
            });
    </script>
@endsection