@extends('layouts.app')

@section('title', 'Transakcje')

@section('content')
    <div class="dashboard-container">
        <div class="dashboard-content-container" data-simplebar>
            <div class="container">

                <div class="dashboard-content-inner">

                    <div class="dashboard-headline">
                        <h3>@lang('common.transactions')</h3>
                    </div>
                    @if(session()->has('message'))
                        @include('partials.message', ['message' => session()->get('message')])
                    @endif
                    <div class="row">
                        <div class="col-xl-12">
                            @if(count($pending))
                                <div class="dashboard-box margin-top-0">

                                    <div class="headline">
                                        <h3>
                                            <i class="icon-material-outline-assignment"></i> @lang('transactions.pending_transactions')
                                        </h3>
                                    </div>

                                    <div class="content">
                                        <ul class="dashboard-box-list">
                                            @foreach($pending as $pendingTransaction)
                                                @include('transactions._transaction_pending', ['transaction' => $pendingTransaction])
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @if(count($toRate))
                                <div class="dashboard-box margin-top-{{ count($pending) ? '50' : '0' }}">

                                    <div class="headline">
                                        <h3>
                                            <i class="icon-material-outline-assignment"></i> @lang('transactions.to_rate')
                                        </h3>
                                    </div>

                                    <div class="content">
                                        <ul class="dashboard-box-list">
                                            @foreach($toRate as $rateTransaction)
                                                @include('transactions._transaction_rate', ['transaction' => $rateTransaction])
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @if(count($active))
                                <div class="dashboard-box margin-top-{{ count($toRate) ? '50' : '0' }}">

                                    <div class="headline">
                                        <h3>
                                            <i class="icon-material-outline-assignment"></i> @lang('transactions.in_progress')
                                        </h3>
                                    </div>

                                    <div class="content">
                                        <ul class="dashboard-box-list">
                                            @foreach($active as $activeTransaction)
                                                @include('transactions._transaction', ['transaction' => $activeTransaction])
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @if(count($completed))
                                <div class="dashboard-box margin-top-50">

                                    <div class="headline">
                                        <h3>
                                            <i class="icon-material-outline-assignment"></i> @lang('transactions.completed_transactions')
                                        </h3>
                                    </div>

                                    <div class="content">
                                        <ul class="dashboard-box-list">
                                            @foreach($completed as $completedTransaction)
                                                @include('transactions._transaction', ['transaction' => $completedTransaction])
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            @endif
                        </div>
                    </div>
                    {{ $completed->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection

@section('modals')
    @include('transactions._user_info_modal', ['transaction' => null])
    @include('transactions._review_modal', ['transaction' => null])
@endsection

@section('post-scripts')
    <script>
        $('.open-transaction-data').click(function () {
            $('.user-info-dialog .welcome-text').html('');
            var url = '{{ route('transactions.info', ['user' => '#user#']) }}'.replace('#user#', $(this).data('id'));
            $.get(url).then(function (response) {
                $('.user-info-dialog .welcome-text').html(response);
            });
        });

        $('[href=".finish-transaction"]').click(function () {
            $('.finish-transaction input[name="transaction_id"]').val($(this).data('id'));
        });
    </script>
@endsection