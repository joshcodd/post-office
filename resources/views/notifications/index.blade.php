@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
    <div class="grid justify-items-center">
        <div class="sm:w-2/3 md:w-1/2 m-5 rounded-xl justify-items-center">
            @include('components.notification-panel')
        </div>
    </div>
    @php
    Auth::User()->unreadNotifications->markAsRead();
    @endphp
@endsection
