@extends('layouts.app')

@section('content')
    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <!-- Dashboard Content
        ================================================== -->
        <div class="dashboard-content-container">
            <div class="container">
                <div class="dashboard-content-inner">
                    <!-- Dashboard Headline -->
                    <div class="dashboard-headline">
                        <h3>@lang('settings.settings')</h3>
                    </div>
                    <!-- Row -->
                    <div class="row">
                        <form method="post" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <!-- Dashboard Box -->
                            <div class="col-xl-12">
                                <div class="dashboard-box margin-top-0">
                                    <!-- Headline -->
                                    <div class="headline">
                                        <h3>
                                            <i class="icon-material-outline-account-circle"></i> @lang('settings.my_account')
                                        </h3>
                                    </div>
                                    <div class="content with-padding padding-bottom-0">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar-wrapper" data-tippy-placement="bottom"
                                                     title="@lang('settings.change_avatar')">
                                                    <img class="profile-pic" src="images/user-avatar-placeholder.png"
                                                         alt=""/>
                                                    <div class="upload-button"></div>
                                                    <input class="file-upload" name="avatar" type="file" accept="image/*"/>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="submit-field">
                                                            <h5>@lang('settings.name')</h5>
                                                            <input type="text" class="with-border" name="name"
                                                                   value="{{ $profile->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="submit-field">
                                                            <h5>@lang('settings.surname')</h5>
                                                            <input type="text" class="with-border" name="surname"
                                                                   value="{{ $profile->surname }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="submit-field">
                                                            <h5>@lang('common.email')</h5>
                                                            <input type="text" class="with-border" disabled
                                                                   value="{{ $user->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="submit-field">
                                                            <h5>@lang('settings.phone')</h5>
                                                            <input type="text" class="with-border" name="phone"
                                                                   value="{{ $profile->phone }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Dashboard Box -->
                            <div class="col-xl-12">
                                <div class="dashboard-box">
                                    <!-- Headline -->
                                    <div class="headline">
                                        <h3>
                                            <i class="icon-material-outline-my-location"></i> @lang('settings.address_data')
                                        </h3>
                                    </div>
                                    <div class="content">
                                        <ul class="fields-ul">
                                            <li>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="submit-field">
                                                            <h5>@lang('settings.address')</h5>
                                                            <input type="text" class="with-border" name="address"
                                                                   value="{{ $profile->address }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="submit-field">
                                                            <h5>@lang('settings.city')</h5>
                                                            <select class="selectpicker with-border"
                                                                    data-live-search="true"
                                                                    name="city"
                                                                    title="@lang('settings.select_city')">
                                                                @foreach($cities as $slug => $city)
                                                                    <option @if($profile->city === $slug) selected
                                                                            @endif value="{{ $slug }}">{{ $city }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2">
                                                        <div class="submit-field">
                                                            <h5>@lang('settings.zip')</h5>
                                                            <input type="text" class="with-border" name="zip"
                                                                   value="{{ $profile->zip }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <div class="submit-field">
                                                            <h5>@lang('settings.additional_info')</h5>
                                                            <textarea cols="30" rows="5" name="description"
                                                                      class="with-border">{{ $profile->description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="submit-field">
                                                            <h5>@lang('settings.bank_nr')</h5>
                                                            <input type="text" class="with-border" name="bank_nr"
                                                                   value="{{ $profile->bank_nr }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="submit-field">
                                                            <h5>@lang('settings.company_name')</h5>
                                                            <input type="text" class="with-border" name="company_name"
                                                                   value="{{ $profile->company_name }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Dashboard Box -->
                            {{--<div class="col-xl-12">--}}
                                {{--<div id="test1" class="dashboard-box">--}}
                                    {{--<!-- Headline -->--}}
                                    {{--<div class="headline">--}}
                                        {{--<h3><i class="icon-material-outline-lock"></i> @lang('settings.pass_change')--}}
                                        {{--</h3>--}}
                                    {{--</div>--}}
                                    {{--<div class="content with-padding">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-xl-4">--}}
                                                {{--<div class="submit-field">--}}
                                                    {{--<h5>@lang('settings.current_pass')</h5>--}}
                                                    {{--<input type="password" class="with-border" name="current_password" placeholder="********">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-xl-4">--}}
                                                {{--<div class="submit-field">--}}
                                                    {{--<h5>@lang('settings.new_pass')</h5>--}}
                                                    {{--<input type="password" class="with-border" name="new_password" placeholder="********">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-xl-4">--}}
                                                {{--<div class="submit-field">--}}
                                                    {{--<h5>@lang('settings.new_pass_confirm')</h5>--}}
                                                    {{--<input type="password" class="with-border" name="new_password_confirmation" placeholder="********">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <!-- Button -->
                            <div class="col-xl-12">
                                <input type="submit" class="button ripple-effect big margin-top-30" value="@lang('settings.save')" /></input>
                            </div>
                        </form>
                    </div>
                    <!-- Row / End -->
                </div>
            </div>
        </div>
        <!-- Dashboard Content / End -->
    </div>
    <!-- Dashboard Container / End -->
@endsection