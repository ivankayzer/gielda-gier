<h3>{{$profile->name}} {{ $profile->surname }}</h3>
<p class="margin-bottom-0">{{$profile->user->email}}</p>
<p>{{$profile->phone ?? 'brak telefonu'}}</p>
@if($profile->company_name)
    <br><span>@lang('settings.company_name')</span>
    <h3>{{$profile->company_name}}</h3>
@endif

<br><span>@lang('common.address')</span>
<h3>{{$profile->address ? $profile->address . ', ' : ''}}{{$profile->user->city->name ? $profile->user->city->name . ', ' : ''}}{{$profile->zip ?? ''}}</h3>

@if($profile->bank_nr)
    <br><span>@lang('settings.bank_nr')</span>
    <h3>{{$profile->bank_nr}}</h3>
@endif