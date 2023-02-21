@push('after-styles')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link href="{{asset('css/custstyle.css')}}" rel="stylesheet"/>
@endpush
@extends('layouts.app')
@section('title', 'Register Page')
@section('content')
<div class="shop-ccc">
    <div class="container">
        <div class="row loginbox mt-5">
            <div class="col-lg-6" >
                <div class="row" >
                    <div class="col-lg-4">
                        <h2>Register</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        @if (Session::has('flash_success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ Session::get('flash_success') }}
                        </div>
                        @endif
                        @if (Session::has('flash_error'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ Session::get('flash_error') }}
                            </div>
                        @endif
                            <form method="POST" action="{{ url('/registerNewUser') }}">
                        <!--<form method="POST" action="{{ route('register') }}">-->
                            @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <x-jet-input id="name" class="block mt-1 w-full inputclass" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            </div>

                            <div class="col-lg-12">
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <x-jet-input id="email" class="block mt-1 w-full inputclass" type="email" name="email" :value="old('email')" required />
                            </div>

                            <div class="col-lg-12">
                                <x-jet-label for="password" value="{{ __('Password') }}" />
                                <x-jet-input id="password" class="block mt-1 w-full inputclass" type="password" name="password" required autocomplete="new-password" />
                            </div>

                            <div class="col-lg-12">
                                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-jet-input id="password_confirmation" class="block mt-1 w-full inputclass" type="password" name="password_confirmation" required autocomplete="new-password" />
                            </div>
                        </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-jet-label for="terms">
                                        <div class="flex items-center">
                                            <x-jet-checkbox name="terms" id="terms" required />

                                            <div class="ml-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-jet-label>
                                </div>
                            @endif

                            <div class="flex items-center justify-end mt-4">
                                <!--<x-jet-button class="ml-4">-->
                                    <button class="logbtn">{{ __('Register') }}</button>
                               <!-- </x-jet-button>-->
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                            </div>
                        </form>
                        </div>
                    </div>
                    <br>

                </div>
                <div class="col-lg-6">
                    <img src="{{asset('image/aa.jpg')}}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
<br>
<br>
@push('after-scripts')
@endpush
@endsection
