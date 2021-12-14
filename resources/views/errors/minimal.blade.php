@extends('layouts.app')

@section('content')

    <div class="-top-24 relative flex flex-col items-top justify-center min-h-screen dark:bg-gray-900 items-center">
        <div class="py-3 text-6xl">🏣</div>
        <div class="px-2 text-6xl text-gray-700 tracking-wider ">
            @yield('code')
        </div>

        <div class="text-lg text-gray-700 uppercase tracking-wider">
            @yield('message')
        </div>
    </div>
@endsection
