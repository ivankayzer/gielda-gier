@extends('layouts.app')

@section('title', 'Czat')

@section('content')
    <div class="dashboard-content-container">
        <div class="container">
            <div class="dashboard-content-inner">
                <div class="messages-container margin-top-0" id="chat" data-id="{{ Auth::id() }}"
                     data-rooms="{{ $rooms }}">
                </div>
            </div>
        </div>
    </div>

    <style>
        .messages-container, .messages-container-inner {
            max-height: calc(100vh - 254px);
        }
    </style>
@endsection