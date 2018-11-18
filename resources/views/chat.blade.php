@extends('layouts.app')

@section('content')
    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <!-- Dashboard Content
        ================================================== -->
        <div class="dashboard-content-container" data-simplebar>

            <div class="messages-container margin-top-0" id="chat" data-rooms="{{ $rooms }}">
            </div>
            <!-- Messages Container / End -->
        </div>
        <!-- Dashboard Content / End -->

    </div>
    <!-- Dashboard Container / End -->
@endsection