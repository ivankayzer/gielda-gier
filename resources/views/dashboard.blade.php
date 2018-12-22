@extends('layouts.app')

@section('title', 'Powiadomenia')

@section('content')
    <!-- Dashboard Container -->
    <div class="dashboard-container gray">
        <!-- Dashboard Content
        ================================================== -->
        <div class="dashboard-content-container" data-simplebar>
            <div class="container">
                <div class="dashboard-content-inner">

                    <!-- Dashboard Headline -->
                    <div class="dashboard-headline">
                        <h3>@lang('common.all_notifications')</h3>
                    </div>

                    <!-- Row -->
                    <div class="row">

                        <!-- Dashboard Box -->
                        <div class="col-xl-12">
                            <div class="dashboard-box mt-0">
                                <div class="content">
                                    <ul class="dashboard-box-list">
                                        @foreach(range(1, 10) as $notification)
                                            <li>
                                                <span class="notification-icon"><i class="icon-material-outline-group"></i></span>
                                                <span class="notification-text">
                                                    <strong>Michael Shannah</strong> applied for a job <a href="#">Full Stack Software Engineer</a>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Row / End -->

                    <!-- Footer -->
                    <div class="dashboard-footer-spacer"></div>
                    <!-- Footer / End -->

                </div>
            </div>
        </div>
        <!-- Dashboard Content / End -->
    </div>
    <!-- Dashboard Container / End -->
@endsection