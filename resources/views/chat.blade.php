@extends('layouts.app')

@section('content')
    <!-- Dashboard Container -->
    <div class="container margin-top-30">
        <!-- Dashboard Content
        ================================================== -->
        <div class="dashboard-content-container">
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