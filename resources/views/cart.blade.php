@push('after-styles')
@endpush
@extends('layouts.app')
@section('title', 'Home')
@section('content')



<div class="shop-ccc">
 <h1 class="shopping-crt">Shopping Cart</h1>
    <!-- Cart Start -->
    @if($carts->count() > 0)
    <div class="container">
        <div class="row">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table text-center">
                    <thead>
                        <tr>
                        <th scope="col" width="180px">Item Description</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Details</th>
                        <th scope="col" width="100px">Extra Price</th>
                        <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carts as $cat)
                        <?php   $img = App\Models\ProductImage::where('product_id',$cat->product_id)->first();
                                $pro = App\Models\Product::where('status','Active')->where('id',$cat->product_id)->first();
                            if($cat->variation_id == null){
                                //if ($pro->is_variation == '0'){
                                $cartprice=$pro->price;
                                $cartimage=$pro->image;
                           }
                            $productvariation = App\Models\AddSubVariation::where('product_id', $pro->id)->where('id',$cat->variation_id )->first();
                            $img = App\Models\ProductImage::where('product_id',$cat->product_id)->where('variation_product_id',$cat->variation_id)->first();
                            if ($productvariation) {
                                $cartimage=$productvariation->image;
                                $proid=$productvariation->id;
                                $cartprice = $productvariation->price;
                            }
                            $procar = App\Models\ProductCart::where('id',$cat->product_cart_id)->first();
                                if($procar->charm_price != null){
                                    if($procar->giftwrap == 1)
                                    {
                                        $subtotal[] = ($cartprice*$cat->quantity) + $procar->giftwrap_price + $procar->charm_price;
                                    }else{
                                        $subtotal[] = $cartprice * $cat->quantity + $procar->charm_price;
                                    }
                                }else{
                                    if($procar->giftwrap == 1)
                                    {
                                        $subtotal[] = ($cartprice*$cat->quantity) + $procar->giftwrap_price;
                                    }else{
                                        $subtotal[] = $cartprice * $cat->quantity ;
                                    }
                                }
                            ?>
                        <tr>
                            <td class="align-middle">
                                <a href="{{url('/')}}/pro/{{$pro->slug}}">
                                    @if($img == null)
                                     <img class="default-img" src="{{asset('img/ck1.png') }}" alt="#" width="108px" height="229px">
                                     @else
                                     <img src="{{ asset('uploads/images/') }}/{{ $img->images }}" width="90" height="110" alt="Image-HasTech">
                                     @endif
                                 </a>
                                 <a href="{{url('/')}}/pro/{{$pro->slug}}">{{$pro->product_name}} </a>
                            </td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto justify-content-center" style="width:110px;" >
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m " >
                                        <a href="{{url('/')}}/dec/{{$cat->id}}/user_id/{{$cat->user_id}}">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <input class="mtext-104 cl3 txt-center num-product" readonly type="number" step="1" min="1" max="" name="quantity" value="{{$cat->quantity}}" title="Qty" size="4" pattern="" inputmode="" style="width:40px;">
                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m quantity">
                                        <a href="{{url('/')}}/inc/{{$cat->id}}/user_id/{{$cat->user_id}}">
                                        <i class="fa fa-plus" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">₹ {{$cartprice*$cat->quantity}}</td>
                             <td>
                                @if($procar->comment != "undefined" && $procar->comment != null && $procar->comment != "" )
                                <p><strong>Comment:</strong></p>
                                <p>{{$procar->comment}}</p>
                                @endif
                                @if($procar->description != "undefined" && $procar->description != null  && $procar->description != "")
                                @if($pro->textareaa == 1)
                                <p><strong>{{$pro->textarea_name}}:</strong></p>
                                <p>{{$procar->description}}</p>
                                @endif
                                @endif
                                @if($procar->giftwrap == 1)
                                <p><strong>Gift Wrap Price:</strong></p>
                                <p>₹{{$procar->giftwrap_price}}</p>
                                @endif
                                @if($procar->pickup_type != "undefined" && $procar->pickup_type != null  && $procar->pickup_type != "")
                                <p><strong>Pickup Type:</strong></p>
                                <p>{{$procar->pickup_type}}</p>
                                @endif
                                @if($procar->datee != "undefined" && $procar->datee != null  && $procar->datee != "")
                                <p><strong>Date:</strong></p>
                                <p>{{$procar->datee}}</p>
                                @endif
                                @if($procar->timee != "undefined" && $procar->timee != null  && $procar->timee != "")
                                <p><strong>Time:</strong></p>
                                <p>{{$procar->timee}}</p>
                                @endif
                                @if($procar->flowerss_type != "undefined" && $procar->flowerss_type != null  && $procar->flowerss_type != "")
                                <p><strong>Flower Type:</strong></p>
                                <p>{{$procar->flowerss_type}}</p>
                                @endif
                                @if($procar->location != "undefined" && $procar->location != null  && $procar->location != "")
                                <p><strong>Location:</strong></p>
                                <p>{{$procar->location}}</p>
                                @endif
                                @if($procar->colortype != "undefined" && $procar->colortype != null  && $procar->colortype != "")
                                <p><strong> Color:</strong></p>
                                <p>{{$procar->colortype}}</p>
                                @endif
                                @if($procar->printside != "undefined" && $procar->printside != null  && $procar->printside != "")
                                <p><strong>Front And BackPrint:</strong></p>
                                <p>{{$procar->printside}}</p>
                                @endif
                                @if($procar->addtext1 != "undefined" && $procar->addtext1 != null  && $procar->addtext1 != "")
                                @if($pro->text_field == 1)
                                <p><strong>{{$pro->text_heading}}:</strong></p>
                                <p>{{$procar->addtext1}}</p>
                                @endif
                                @endif
                                @if($procar->addtext2 != "undefined" && $procar->addtext2 != null  && $procar->addtext2 != "")
                                @if($pro->addatext_option == 1)
                                <p><strong>{{$pro->addatext_heading}}:</strong></p>
                                <p>{{$procar->addtext2}}</p>
                                @endif
                                @endif
                                @if($procar->egg_type != "undefined" && $procar->egg_type != null  && $procar->egg_type != "")
                                <p><strong>Egg Type:</strong></p>
                                <p>{{$procar->egg_type}}</p>
                                @endif
                                @if($cat->variation_id != null)
                                <?php $provar = App\Models\AddSubVariation::where('id',$cat->variation_id)->first();
                                    $var = App\Models\Addsubvariationn::where('var_id',$cat->variation_id)->get();
                                ?>
                                    @foreach($var as $var)
                                    <?php $attribute = App\Models\Attribute::where('id',$var->main_attr_id)->first();
                                         $attributevalue = App\Models\AttributeValue::where('id',$var->main_attr_value)->first();
                                    ?>
                                    <p><strong>{{$attribute->attr_name}}</strong></p>
                                    <p>{{$attributevalue->attr_value_name}}</p>
                                    @endforeach
                                @endif
                                @if($procar->charm_id != null)
                                <?php $charm = explode(',',$procar->charm_id)?>
                                @foreach($charm as $charm)
                                @php $prcharop = App\Models\ProductSelectOption::where('id',$charm)->first();
                                $prchar = App\Models\ProductSelectHeading::where('id',$prcharop->product_select_id)->first();  @endphp
                                <p><strong>{{$prchar->product_select_title}}</strong></p>
                                <p>{{$prcharop->product_select_option}}
                                @if($prcharop->product_select_option_price != null)
                                ₹{{$prcharop->product_select_option_price}}</p>
                                @endif
                                @endforeach
                                @endif
                            </td>
                            <td class="align-middle">₹
                                    @if($procar->charm_price != null)
                                        @if($procar->giftwrap == 1)
                                        {{($cartprice*$cat->quantity)+$procar->giftwrap_price+$procar->charm_price}}
                                        @else
                                        {{$cartprice*$cat->quantity+ $procar->charm_price}}
                                        @endif
                                    @else
                                        @if($procar->giftwrap == 1)
                                        {{($cartprice*$cat->quantity)+$procar->giftwrap_price}}
                                        @else
                                        {{$cartprice*$cat->quantity}}
                                        @endif
                                    @endif
                            </td>
                            <td class="align-middle">
                                <a href="{{url('del/')}}/{{$cat->id}}/user_id/{{$cat->user_id}}" title="">
                                    <button class="btn btn-sm btn-danger btn_remove"><i class="fa fa-times"></i></button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
						<tr>
						    <td class="align-middle">  <a href="{{url('deletecartalldata/')}}/{{$cat->id}}/user_id/{{$cat->user_id}}" title="">
                                <i class="fas fa-shopping-cart" style="color:#c2272d;"></i> Clear Shopping Cart
                            </a></td>
						    <td colspan="5"> </td>
						</tr>
	                </tbody>
	            </table>
            </div>
            <div class="col-lg-4 bor">
                <h5 class="section-title position-relative  mb-3"><span class="bg-secondary3 pr-3">Cart Subtotal</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Total Price</h6>
                            <h6>₹ {{array_sum($subtotal)}}
                                @php
                                $a= \App\Http\Controllers\CartController::getSubTotalPrice(Auth::user()->id,\App\Http\Controllers\CartController::getCouponDiscount(array_sum($subtotal)));
                                @endphp
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery Charges</h6>
                            <h6 class="font-weight-medium">₹10</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2 border-bottom">
                            <h5>Amount Payable</h5>
                            <?php $disamou=  \App\Http\Controllers\CartController::getCouponDiscount(array_sum($subtotal)); ?>
                            <?php $sub=array_sum($subtotal)-$disamou; ?>
                            <h5>₹{{$sub}}</h5>
                            <?php $rg= \App\Http\Controllers\CartController::getSubTotalPrice(Auth::user()->id,\App\Http\Controllers\CartController::getCouponDiscount(array_sum($subtotal)))?>
                        </div>
						<br>
						<form class="mb-30" action="{{url('/')}}/applyCoupon"  method="post" style="border: 1px solid black;">
                            @csrf
                            <div class="input-group"><i class="fa fa-gift" aria-hidden="true" style="margin: 10px 0 0 10px;color: #c2272d;"></i>
                                <input class="form-control @error('couponcode') is-invalid @enderror" type="text" name="couponcode" placeholder="Have a coupon code?"
                                @if($isCoupon == 1)
                                value="{{@$coupon->coupon_code}}"
                                @elseif($isGiftcard == 1)
                                value="{{@$gift->generated_code}}"
                                @else
                                value="{{ old('couponcode') }}"
                                @endif
                                style="border: none"
                                >
                                <div class="input-group-append" style="margin-left:3px">
                                    <button type="submit" class="btn ">@if($isCoupon == 1) Applied @elseif($isGiftcard == 1) Applied @else Apply @endif </button>
                                    @if ($errors->has('couponcode'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('couponcode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </form>
                        @if($isCoupon == 1)
                        <div class="msg-coupon pt-3">
                            <h5 style="letter-spacing: 1px;">Coupon Applied !! &#8377;
                            {{ \App\Http\Controllers\CartController::getCouponDiscount(array_sum($subtotal)) }} off
                            <a href="{{url('delCoupon/')}}/{{$cat->user_id}}" title="Remove Coupon">
                                    <i class="fa fa-trash" style="color: #c2272d;"></i>
                                </a>
                            </h5>
                        </div>
                        @elseif($isGiftcard == 1)
                        <div class="msg-coupon pt-3">
                            <h5 style="letter-spacing: 1px;">Gift Card  Applied !! &#8377;
                            {{ \App\Http\Controllers\CartController::getCouponDiscount(array_sum($subtotal)) }} off
                            <a href="{{url('delCoupon/')}}/{{$cat->user_id}}" title="Remove Coupon">
                                    <i class="fa fa-trash" style="color: #c2272d;"></i>
                                </a>
                            </h5>
                        </div>
                    @endif
                    @if(Session::has('coupon_danger'))
                    <div class="msg-coupon pt-3">
                        <h5 style="letter-spacing: 1px; color: red;">{{ Session::get('coupon_danger') }}</h5>
                        </div>
                    </div>
                @endif
                @if(Session::has('coupon_success'))
                <div class="msg-coupon pt-3">
                    <h5 style="letter-spacing: 1px; color: red;">{{ Session::get('coupon_success') }}</h5>
                    </div>
                </div>
            @endif
                @if(Session::has('coupon_removed'))
                    {{ Session::get('coupon_removed') }}
                @endif
                        <a href="{{url('/checkout')}}"><button class="btn btn-block btn-primary font-weight-bold my-3 py-3 proceed_btn">Proceed To Checkout</button></a>
                    </div>
                </div>
            </div>
        </div>

@else

        <h4 class="shopping-crt text-center">Your cart is currently empty!</h4>
        <div class="text-center continue_shop"><a href="{{url('/')}}">Continue Shopping</a></div>


@endif
    </div>
	</div>
    <!-- Cart End -->

@push('after-scripts')
@endpush
@endsection
