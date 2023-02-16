<style>
    .myaccount-tab-menu {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }
    .myaccount-tab-menu.nav-tabs .nav-link {
        background-color: white;
        border: 1px solid #dee2e6;
        border-bottom: none;
        border-radius: 0;
        color: #000;
        font-size: 15px;
        font-weight: 500;
        display: block;
        padding: 15px 15px;
        text-align: left;
        text-transform: capitalize;
    }
    .myaccount-tab-menu.nav-tabs .nav-link.active {
        background-color: #ca9f77;
        border-color: #ca9f77;
        color: #fff;
    }
    .myaccount-tab-menu.nav-tabs .nav-link.active {
        background-color: #c2272d;
        border-color: #c2272d;
        color: #fff;
    }
    .nav-tabs {
        background-color: #f5f5f5;
        border: 1px solid #dee2e6;
        font-size: 18px;
    }
    </style>

@php
  $siteName = url('/');
  $url = url()->current();
  $dash=$siteName.'/user/dashboard';
  $orders=$siteName.'/user/orders';
  $wishlist=$siteName.'/user/wishlist';
  $compare=$siteName.'/user/compare';
  $acc=$siteName.'/user/profiledetails';
  $accset=$siteName.'/user/profilesettings';
@endphp
<div class="col-lg-3">
    <div class="myaccount-tab-menu nav nav-tabs " id="nav-tab" role="tablist">
        <a class="nav-link @if($url == $dash) active  @endif"  href="{{url('/user/dashboard')}}" ><i class="fa fa-dashboard"></i> Dashboard</a>
        <a class="nav-link @if($url == $orders) active  @endif" href="{{url('/user/orders')}}" ><i class="fa fa-shopping-bag"></i> Orders</a>
        <a class="nav-link @if($url == $wishlist) active  @endif" href="{{url('/user/wishlist')}}" ><i class="fa fa-heart"></i> Wishlist</a>
        <a class="nav-link @if($url == $accset) active  @endif" href="{{url('/user/profilesettings')}}" ><i class="fa fa-gear"></i> Profile Settings</a>
        <a class="nav-link @if($url == $acc) active  @endif" href="{{url('/user/profiledetails')}}" ><i class="fa fa-user"></i> Profile Details</a>
        <button class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" type="button"><i class="fa fa-sign-out"></i> Logout</button>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
    </div>
</div>
