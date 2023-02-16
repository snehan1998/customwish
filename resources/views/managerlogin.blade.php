@push('after-styles')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link href="{{asset('css/custstyle.css')}}" rel="stylesheet"/>
@endpush
@extends('layouts.app')
@section('title', 'Login Page')
@section('content')
<div class="shop-ccc">
    <div class="container">
        <div class="row loginbox">
            <div class="col-lg-6" >
                <div class="row" >
                    <div class="col-lg-12">
                        <h2>Manager Login</h2>
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
                <form method="POST" action="{{ url('managerloginsubmit') }}">
                @csrf
                            <div class="col-md-12">
                                <input id="email" type="email" class="inputclass @error('email') is-invalid @enderror" placeholder="{{ __('Email Address') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <input id="password" type="password" placeholder="{{ __('Password') }}" class="inputclass @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                    <!--    <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>-->

                        <div class="flex items-center justify-end mt-4">
                            <!--<x-jet-button class="ml-4">-->
                                <button class="logbtn">{{ __('LOGIN') }}</button>
                            <!--</x-jet-button>-->
                        </div>
                        <div class="row" style="padding-left:15px;">
                            <div class="col-lg-8 d-flex">
                                <p class="login-wrapper-signup-text "><a href="{{url('/managerregister')}}"> Sign Up</a></p>
                            </div>
                            <div class="col-lg-4">
                                @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 " href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                            </div>
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
<!-- Cart End -->
<br>
<br>

@push('after-scripts')
@endpush
@endsection
