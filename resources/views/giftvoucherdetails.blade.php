@push('after-styles')
<link href="{{asset('css/custstyle.css')}}" rel="stylesheet"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@endpush
@extends('layouts.app')
@section('title', 'GiftVoucher Detail')
@section('content')

<div class="container mt-5 mb-5">
    <div class="row align-items-start">
        <!-- card left -->

        <div class="col-lg-5 product-imgs">
            <div class="img-display">
                <div class="img-showcase">
                    <img src="{{asset('uploads/images')}}/{{$gifts->giftvoucher_image}}">
                </div>
            </div>
            <br>
        </div>
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
        <div class="col-lg-7 product-content">
            <h2 class="product-title">{{$gifts->giftvoucher_name}}</h2>
            <div class="product_desc">
                <h2>{{$gifts->giftvoucher_price}}</h2>
            </div>
            <form method="post" action="{{url('/giftcardbuy')}}" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="form_title">Enter Your Gift Card Details:</h3>
                </div>
                <input type="hidden" name="giftcard_id" value="{{$gifts->id}}">
                <div class="col-lg-12">
                    <h5 class="song">To</h5><br>
                    <p style="display: flex;"><input type="email" class="inputclass11 email" name="to_email" placeholder="Enter recipent e-mail address" required ></p>
                </div>
                <div class="col-lg-12">
                    <h5 class="song">From Name</h5><br>
                    <p style="display: flex;"><input type="text" class="inputclass11 addtext18" name="from_name" required placeholder="Your Name" required></p>
                </div>
                <div class="col-lg-12">
                    <h5 class="song">Message</h5><br>
                    <p style="display: flex;"><textarea type="text" class="inputclass11 addtext18" name="message" placeholder="Enter Message"></textarea></p>
                </div>
                <div class="col-lg-12">
                    <h5 class="song">Delivery Date</h5><br>
                    <p style="display: flex;"><input type="date" class="inputclass11 addtext18" name="delivery_date" required ></p>
                </div>
                <x-honey/>
                <?php $user = App\Models\User::where('id',Auth::user()->id)->first();
                      $userpro = App\Models\UserProfile::where('user_id',Auth::user()->id)->first();
                ?>
                <input type="hidden" name="shipping_firstname" value="{{ $userpro->name }}">
                <input type="hidden" name="shipping_lastname" value="{{ $userpro->name }}">
                <input type="hidden" name="shipping_phone" value="{{ $userpro->phone }}">
                <input type="hidden" name="shipping_email" value="{{ $userpro->email }}">
                <input type="hidden" name="shipping_country" value="{{ $userpro->country }}">
                <input type="hidden" name="shipping_state" value="{{ $userpro->state }}">
                <input type="hidden" name="shipping_city" value="{{ $userpro->city }}">
                <input type="hidden" name="shipping_address1" value="{{ $userpro->address }}">
                <input type="hidden" name="shipping_pincode" value="{{ $userpro->pincode }}">

                <div class="col-lg-6">
                <button type="submit" class="logbtn checkadd-to-procart32" style="width: 100%; ">Buy Now</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>

@push('after-scripts')
<script>
const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;
    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);
</script>
@endpush
@endsection
