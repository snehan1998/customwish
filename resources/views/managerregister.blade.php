@push('after-styles')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link href="{{asset('css/custstyle.css')}}" rel="stylesheet"/>
@endpush
@extends('layouts.app')
@section('title', 'Register Page')
@section('content')
<div class="shop-ccc">
    <div class="container">
        <div class="row loginbox">
            <div class="col-lg-6" >
                <div class="row" >
                    <div class="col-lg-12">
                        <h2>Manager Register</h2>
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
                            <form method="POST" action="{{ url('managerregistersubmit') }}">
                            @csrf
                                <div class="col-lg-12">
                                    <input id="name" type="text" placeholder="Enter Name" class="inputclass  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <input id="dob" type="date" placeholder="Enter DOB" class="inputclass  @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob" autofocus>
                                    @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <label for="male">Male
                                    <input id="male" type="radio" placeholder="Enter Gender" class="form-control" name="gender" value="male" required>
                                    </label>
                                    <label for="male">Female
                                    <input id="female" type="radio" placeholder="Enter Gender" class="form-control" name="gender" value="female">
                                    </label>
                                </div>

                                <div class="col-lg-12">
                                    <input id="email" type="email" placeholder="Enter Email" class="inputclass @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <input id="password" type="password" placeholder="Enter Password" class="inputclass @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                    <div class="col-lg-12">
                                            <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}" class="inputclass" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        <!--<x-jet-button class="ml-4">-->
                                            <button type="submit" class="logbtn">{{ __('Register') }}</button>
                                       <!-- </x-jet-button>-->
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{url('/managerlogin')}}">
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
