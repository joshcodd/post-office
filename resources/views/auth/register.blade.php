@extends('layouts.auth')

@section('leave_button_href')
    {{ route('login') }}
@endsection

@section('leave_button_title',
    'Already
    have an account?',)

@section('right_title', 'Sign Up')

@section('right_content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- First Name -->
        <div>
            <x-label for="first_name" :value="__('First Name')" />

            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')"
                required autofocus />
        </div>

        <!-- Surname -->
        <div class="mt-4">
            <x-label for="surname" :value="__('Surname')" />

            <x-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required
                autofocus />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-label for="email" :value="__('Email')" />

            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-label for="password" :value="__('Password')" />

            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
                required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ml-4">
                {{ __('Sign me up') }}
            </x-button>
        </div>
    </form>
@endsection
