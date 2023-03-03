@push('after-styles')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link href="{{asset('css/custstyle.css')}}" rel="stylesheet"/>
@endpush
@extends('layouts.app')
@section('title', 'Resend OTP Page')
@section('content')
<div class="shop-ccc">
    <div class="container">
        <div class="row loginbox">
            <div class="col-lg-6" >
                <div class="row" >
                    <div class="col-lg-4">
                        <h2>Resend OTP</h2>
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
            <form method="POST" action="{{url('otpresendmail')}}">
            @csrf
            <div class="col-lg-12">
                <x-jet-input id="email" class="inputclass" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
            </div>
            <div class="flex items-center justify-end mt-4">
                <button class="logbtn">{{ __('Submit') }}</button>
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
