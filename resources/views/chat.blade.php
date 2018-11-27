@extends('layouts.app')

@section('content')
    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <!-- Dashboard Content
        ================================================== -->
        <div class="dashboard-content-container" data-simplebar>
            <div class="messages-container margin-top-0" id="chat" data-id="{{ Auth::id() }}" data-rooms="{{ $rooms }}">
            </div>
        </div>
    </div>

    <style>
        #footer {
            display: none;
        }
    </style>
@endsection