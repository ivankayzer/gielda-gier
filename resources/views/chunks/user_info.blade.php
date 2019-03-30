<h3>{{$profile->getFullName()}}</h3>
<h3>{{$profile->email}}</h3>
<h3>{{$profile->phone}}</h3>
<br><span>"@lang('settings.company_name')</span>
<h3>{{$profile->company_name}}</h3>

<br><br><span>@lang('common.address')</span>
<h3>{{$profile->address}}, {{$profile->user->city->name}}, {{$profile->zip}}</h3>

<br><br><span>@lang('settings.bank_nr')</span>
<h3>{{$profile->bank_nr}}</h3>
