@extends('layouts.auth')

@section('leave_button_href')
    {{ route('home') }}
@endsection

@section('leave_button_title', 'Cancel')

@section('right_title', 'Forgotten password?')

@section('right_content')
    <div class="mb-4 text-sm text-gray-600">
        {{ __("Enter the email address associated with your account and we'll send you instructions on how to recover your account!") }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-label for="email" :value="__('Email')" />

            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button>
                {{ __('Email Password Reset Link') }}
            </x-button>
        </div>
    </form>
@endsection
