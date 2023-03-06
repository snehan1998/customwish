@push('after-styles')
<style>
</style>
@endpush
@extends('layouts.app')
@section('title', 'Custom wish | Dashboard')
@section('content')


<div class="shop-ccc">
    <h1 class="shopping-crt">Dashboard</h1>
       <div class="container-fluid">
           <div class="row px-xl-5">
               @include('user.layouts.sidemenu')
                <div class="col-xl-9 col-lg-9">
                <div class="dashboard-box">
                <div>
                    <p>Hello, <strong>Custom Wish</strong> (If Not <strong>Custom Wish!</strong><a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                    </a>).</p></div>
                    <p>From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="navigation-box">
                            <a href="{{url('/user/dashboard')}}"> <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
                            </div>
                            </div>

                            <div class="col-lg-4">
                            <div class="navigation-box">
                            <a href="{{url('/user/orders')}}"> <i class="fa fa-shopping-bag" aria-hidden="true"></i>  Orders</a>
                            </div>
                            </div>

                            <div class="col-lg-4">
                            <div class="navigation-box">
                            <a href="{{url('/user/wishlist')}}">  <i class="fa fa-heart" aria-hidden="true" style="color:black;"></i> Wishlist</a>
                            </div>
                            </div>

                            <div class="col-lg-4">
                            <div class="navigation-box">
                            <a href="{{url('/user/profilesettings')}}"> <i class="fa fa-gear" aria-hidden="true"></i>Profile Setting</a>
                            </div>
                            </div>

                            <div class="col-lg-4">
                            <div class="navigation-box">
                            <a href="{{url('/user/profiledetails')}}"> <i class="fa fa-user" aria-hidden="true" style="color:#555555"></i>Profile Details</a>
                            </div>
                            </div>

                    </div>
                </div>
            </div><!-- Main row end -->
            </div><!-- Conatiner end -->
        </div><!-- Main container end -->
</div>


@push('after-scripts')
@endpush
@endsection
