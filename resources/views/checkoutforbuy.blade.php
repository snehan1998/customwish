@push('after-styles')
<link href="{{asset('css/custstyle.css')}}" rel="stylesheet"/>
<style>
    h2.per {
  font-size: 22px;
}
input[type='radio'] {
    -webkit-appearance: none;
    -moz-appearance: none;
    width: 35px;
    height: 35px;
    margin: 5px 16px 5px 0px;
    /* background-size: 225px 70px; */
    position: relative;
    float: left;
    display: inline;
    top: 0;
    border-radius: 19px;
    z-index: 99999;
    cursor: pointer;
    /* box-shadow: 0px 1px 1px #000; */
    border: 6px double #c2272d;
}
</style>
@endpush
@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
<div class="shop-ccc">
    <!-- Cart Start -->
    <div class="container-fluid" >
        <div class="row ">
            <div class="col-lg-8 loginbox" style="padding:30px;">
				<div class="row" style="">
					<div class="col-lg-8">
						<h2 class="per">PERSONAL INFORMATION</h2>
					</div>
				</div>
				<div class="row">
				<div class="col-lg-12">
                <form method="post" action="{{url('/placeorderbuy',$CartID)}}">
                @csrf
				<div class="row">
					<div class="col-lg-6">
						<input type="email" name="shipping_email" id="shipping_email" value="{{$user->email}}" class="inputclass" placeholder="Email" required>
					</div>
					<div class="col-lg-6">
					    <input type="tel" name="shipping_phone" id="shipping_phone" value="{{$user->phone}}"  class="inputclass" placeholder="Number" required>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<input type="text" name="shipping_firstname" id="shipping_firstname" value="{{$user->name}}" class="inputclass" placeholder="First Name" required>
					</div>
					<div class="col-lg-6">
						<input type="text" name="shipping_lastname" id="shipping_lastname"  class="inputclass" placeholder="Last Name">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<textarea name="shipping_address1" id="shipping_address1" class="inputclass"  placeholder="Address Line 1">{{$user->address}}</textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<textarea name="ship_address2" id="shipping_address2" class="inputclass" placeholder="Address Line 2"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3">
						<input type="text" name="shipping_pincode" id="shipping_pincode" class="inputclass" value="{{$user->pincode}}" placeholder="Pincode">
					</div>
					<div class="col-lg-3">
						<input type="text" name="shipping_city" id="shipping_city" class="inputclass" value="{{$user->city}}" placeholder="City">
					</div>
					<div class="col-lg-3">
						<input type="text" name="shipping_country" id="shipping_country" value="{{$user->country}}" class="inputclass" placeholder="Country">
					</div>
					<div class="col-lg-3">
						<input type="text" name="shipping_state" id="shipping_state" value="{{$user->state}}" class="inputclass" placeholder="State">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-12">
						<label>Adress Type</label>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
						<input type="radio" class="form-control" value="home"  placeholder="" name="address_type" id="home" checked>
                        <label for="home"> Home</label>
					</div>
					<div class="col-lg-2">
						<input type="radio" class="form-control" value="office" name="address_type" id="office"  placeholder="">
                        <label for="office"> Office </label>
					</div>
					<div class="col-lg-2">
						<input type="radio" class="form-control" value="other" placeholder="" name="address_type" id="other">
                        <label for="other"> Other </label>
					</div>
                </div>
				<div class="row">
					<div class="col-lg-12">
						<button class="logbtn">PROCEED TO MAKE PAYMENT</button>
					</div>
				</div>
			<!--form-->
		</div>
	</div>
</div>

            <div class="col-lg-3 loginbox">
                @foreach($carts as $cart)
                <?php $pro = App\Models\Product::where('status','Active')->where('id',$cart->product_id)->first();
                      if($cart->variation_id == null){
                        $proim = App\Models\ProductImage::where('product_id',$pro->id)->first();
                        $price = $pro->price;
                      }else{
                        $provar = App\Models\AddSubVariation::where('id',$cart->variation_id)->first();
                        $proim = App\Models\ProductImage::where('product_id',$pro->id)->first();
                        $price = $provar->price;
                    }
                    $procar = App\Models\ProductCart::where('id',$cart->product_cart_id)->first();
                    if($cart->quantity != "undefined")
                    {
                        if($procar->charm_price != null){
                            if($procar->giftwrap == 1)
                            {
                                $subtotal[] = ($price*$cart->quantity)+$procar->giftwrap_price+ $procar->charm_price;
                                $total[] = ($price * $cart->quantity)+$procar->giftwrap_price+$procar->charm_price;
                            }else{
                                $subtotal[] = ($price*$cart->quantity)+$procar->charm_price;
                                $total[] = ($price * $cart->quantity)+$procar->charm_price;
                            }
                        }else{
                            if($procar->giftwrap == 1)
                            {
                                $subtotal[] = ($price*$cart->quantity)+$procar->giftwrap_price;
                                $total[] = ($price * $cart->quantity)+$procar->giftwrap_price;
                            }else{
                                $subtotal[] = $price*$cart->quantity;
                                $total[] = $price * $cart->quantity;
                            }
                        }
                    }else{
                        if($procar->charm_price != null){
                            if($procar->giftwrap == 1)
                            {
                                $subtotal[] = $price+$procar->giftwrap_price+$procar->charm_price;
                                $total[] = $price+$procar->giftwrap_price+$procar->charm_price;
                            }else{
                                $subtotal[] = $price+$procar->charm_price;
                                $total[] = $price+$procar->charm_price;
                            }
                        }else{
                            if($procar->giftwrap == 1)
                            {
                                $subtotal[] = $price+$procar->giftwrap_price;
                                $total[] = $price+$procar->giftwrap_price;
                            }else{
                                $subtotal[] = $price;
                                $total[] = $price;
                            }
                        }
                    }

                    $tott = array_sum($total);
                    $sub=array_sum($subtotal);
                ?>

                <div class="row">
                    <div class="col-12">
                        <center><img src="{{asset('uploads/images/')}}/{{$proim->images}}" class="img-fluid"></center>
                        <h4 style="font-size:20px;">{{$pro->product_name}}</h4><br>
                        <h4><b>Cart Subtotat</b></h4>
                    </div>
                </div>
                @endforeach
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <p class="pcss">Total Price:</p>
                    </div>
                    <div class="col-lg-6">
                        <p class="price">₹{{$sub}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <p class="pcss">Delivery Charges</p>
                    </div>
                    <div class="col-lg-6">
                        <p class="price">₹0</p>
                    </div>
                </div>
                @if($isCoupon == 1)
                <div class="row">
                    <div class="col-lg-6">
                        <p class="pcss">Coupon Applied</p>
                    </div>
                    <div class="col-lg-6">
                        <p class="price">₹ {{ \App\Http\Controllers\CartController::getCouponDiscount(array_sum($subtotal)) }}</p>
                    </div>
                </div>
                @endif
                <hr class="hrcss">
                    <div class="row">
                    <div class="col-lg-6">
                        <p class="pcss">Amount Payable</p>
                    </div>
                    <div class="col-lg-6">
                        <input id="amount1" name="payable_price" type="hidden" value="{{ \App\Http\Controllers\CartController::getSubTotalPricee(\Auth::user()->id,\App\Http\Controllers\CartController::getCouponDiscount(array_sum($subtotal)) ,$CartID) }}" readonly>
                        <p class="price">₹ {{ \App\Http\Controllers\CartController::getSubTotalPricee(\Auth::user()->id,\App\Http\Controllers\CartController::getCouponDiscount(array_sum($subtotal)),$CartID ) }}</p>
                    </div>
                </div>
                <hr class="hrcss">
            </div>
        </div>
    </div>
</div>

<input type="hidden"  id="order_price" name="order_price" value="{{$sub}}">
<input type="hidden" id="coupon_amount" name="coupon_amount" value="{{ \App\Http\Controllers\CartController::getCouponDiscount(array_sum($subtotal)) }}">

</form>
    <!-- Cart End -->

<br>
  <br>


@push('after-scripts')
@endpush
@endsection
