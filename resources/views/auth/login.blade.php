@push('after-styles')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link href="{{asset('css/custstyle.css')}}" rel="stylesheet"/>
@endpush
@extends('layouts.app')
@section('title', 'Login Page')
@section('content')
<div class="shop-ccc">
    <div class="container">
        <div class="row loginbox mt-5 mx-5">
            <div class="col-lg-6" >
                <div class="row" >
                    <div class="col-lg-4">
                        <h2>Login</h2>
                    </div>
                    <div class="col-lg-6 padding">
                        <a href="{{route('register')}}" class="newuser">New User? Register Now</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

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
        <!--<form method="POST" action="{{ route('login') }}">-->
            <form method="POST" action="{{route('login.custom')}}">
            @csrf

            <div class="row">
            <div class="col-lg-12">
            <!--    <x-jet-label for="email" value="{{ __('Email') }}" />-->
                <x-jet-input id="email" class="inputclass" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
            </div>

            <div class="col-lg-12">
            <!--    <x-jet-label for="password" value="{{ __('Password') }}" />-->
                <x-jet-input id="password" class="inputclass" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
            </div>
            </div>
        

            <!--<div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>-->
            <div class="flex items-center justify-end mt-4">
                <!--<x-jet-button class="ml-4">-->
                    <button class="logbtn">{{ __('LOGIN') }}</button>
                <!--</x-jet-button>-->
            </div>
            <div class="row">
                <div class="col-lg-8 d-flex">
                    <input type="checkbox" > <span class="newuser" style="font-size:12px;">By Continuing, you agree Term & Privacy Policy</span>
                </div>
                <div class="col-lg-4">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 forgot_text " href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
                </div>
            </div>

        </form>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12"><div class="facelog">
    <a class="ml-1 d-flex" href="{{ url('/facebook') }}" id="btn-fblogin">
        <img src="{{asset('image/downloadd.png')}}" style="width:40px;">
        <span class="loginf">Login with Facebook</span>
    </a>
    </div></div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="facelog">
            <a href="{{ url('/redirect') }}"  class="ml-1 d-flex">
            <img src="{{asset('image/google.png')}}" style="width:40px;padding:2px" >
            <span class="loginf">Login with Google</span>
            </a>
        </div>
    </div>
</div>
</div>
<div class="col-lg-6">
    <img src="{{asset('image/aa.jpg')}}" class="img-fluid">
</div>
</div>
</div>
</div>
<!-- Cart End -->
<br>
<br>

@push('after-scripts')
@endpush
@endsection
