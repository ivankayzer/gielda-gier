@extends('layouts.app')

@section('content')
    <div class="dashboard-container">
        <div class="dashboard-content-container" data-simplebar>
            <div class="container">

                <div class="dashboard-content-inner">

                    <div class="dashboard-headline">
                        <h3>@lang('common.transactions')</h3>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="dashboard-box margin-top-0">

                                <div class="headline">
                                    <h3>
                                        <i class="icon-material-outline-assignment"></i> @lang('transactions.pending_transactions')
                                    </h3>
                                </div>

                                <div class="content">
                                    <ul class="dashboard-box-list">
                                        @foreach($pending as $pendingTransaction)
                                            @include('transactions._transaction', ['transaction' => $pendingTransaction])
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="dashboard-box margin-top-50">

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
                        </div>
                    </div>
                    {{ $completed->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection