@extends('layouts.app')

@section('title', 'Ogłoszenia')

@section('content')
    <!-- Spacer -->

    <div class="margin-top-50"></div>
    <!-- Spacer / End-->

    <!-- Page Content
    ================================================== -->
    <div class="container gray">
        <div class="dashboard-headline margin-left-10 d-flex justify-content-between">
            <h3>@lang('common.my-offers')</h3>
            <a href="{{ route('offers.create') }}" class="button ripple-effect"><i class="icon-feather-plus"></i> @lang('offers.add_offer')</a>
        </div>
        @if(session()->has('message'))
            @include('partials.message', ['message' => session()->get('message')])
        @endif
        <form method="get">
            <div class="row">
                <div class="col-xl-12 col-lg-12 content-left-offset">
                    <div class="freelancers-container freelancers-list-layout compact-list">
                        @foreach($offers as $offer)
                            @include('offers._my_offer', ['offer' => $offer])
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