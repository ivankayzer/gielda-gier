@extends('layouts.app')

@section('title', 'Edytuj ogłoszenie')

@section('content')
    <div class="dashboard-container">
        <div class="dashboard-content-container" data-simplebar>
            <div class="container">
                <div class="dashboard-content-inner">
                    <div class="dashboard-headline">
                        <h3>@lang('offers.edit_offer') - {{ $model->game->title }}</h3>
                    </div>
                    <form action="{{ route('offers.update', [$model->id]) }}" method="post"
                          enctype="multipart/form-data">
                        <div class="row">
                            @csrf
                            <div class="col-xl-12">
                                @include('partials.errors')
                                <div class="dashboard-box margin-top-0">
                                    <div class="headline">
                                        <h3><i class="icon-material-outline-assignment"></i> @lang('offers.basic')</h3>
                                    </div>
                                    <div class="content with-padding padding-bottom-10">

                                        <div class="row">
                                            <div class="col-xl-5">
                                                <div class="submit-field">
                                                    <h5>@lang('common.platform')</h5>
                                                    <select class="select2 mw-100"
                                                            data-size="{{ count($platforms) }}"
                                                            name="platform"
                                                            title="@lang('offers.select_platform')">
                                                        <option value="0" disabled>Wybierz platformę</option>
                                                        @foreach($platforms as $key => $platform)
                                                            <option @if($key == $model->platform) selected
                                                                    @endif value="{{ $key }}">{{ $platform }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-5">
                                                <div class="submit-field">
                                                    <h5>@lang('offers.language')</h5>
                                                    <select class="select2 mw-100" data-size="7"
                                                            name="language"
                                                            title="@lang('offers.select_language')">
                                                        <option value="0" disabled>Wybierz język</option>
                                                        @foreach ($languages as $language)
                                                            <option @if($language['value'] === $model->language) selected
                                                                    @endif value="{{ $language['value'] }}">
                                                                <div class="d-flex align-items-center"><img class="flag"
                                                                                                            src="{{ $language['icon'] }}">
                                                                    <span style="margin: 2px 0 0 5px;">{{ $language['name'] }}</span>
                                                                </div>
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-2">
                                                <div class="submit-field">
                                                    <h5>@lang('offers.price')</h5>
                                                    <div class="input-with-icon">
                                                        <input class="with-border" type="text"
                                                               name="price" value="{{ new \App\Services\Price($model->price) }}"
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
                                                               @if($model->payment_bank_transfer) checked @endif
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
                                                               @if($model->payment_cash) checked @endif
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
                                                               @if($model->delivery_post) checked @endif
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
                                                               @if($model->delivery_in_person) checked @endif
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
                                                    <textarea cols="30" rows="5" class="with-border"
                                                              name="comment">{{ $model->comment }}</textarea>
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
                                                        <input type="checkbox" name="sellable" value="1" id="sellable"
                                                               @if($model->sellable) checked @endif>
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
                                                               id="tradeable" @if($model->tradeable) checked @endif>
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
                                                               id="is_published"
                                                               @if($model->is_published) checked @endif>
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
                                    @lang('offers.edit_offer')</button>
                            </div>
                        </div>
                    </form>
                    <div class="dashboard-footer-spacer"></div>
                </div>
            </div>
        </div>
    </div>
@endsection