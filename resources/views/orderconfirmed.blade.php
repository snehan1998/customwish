@push('after-styles')
<link href="{{asset('css/custstyle.css')}}" rel="stylesheet"/>
@endpush
@extends('layouts.app')
@section('title', 'Checkout')
@section('content')

<div class="shop-ccc">
    <!-- Cart Start -->
    <div class="container">
     <br>
      <div class="row">
      <div class="col-lg-12">
      	<h2 class="orderhead">Your Order Confirmed!</h2>
      	<br>

      	<p class="orderpara">Hi {{$order->firstname}},</p>
      	<p class="orderpara">Your Order has been confirmed and will be shipping soon.</p>
      </div>
       </div>
       <hr class="hrcss">
        <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-6 col-xs-13">
        <p class="pcss">Order date</p>
      	<p class="pcss1">{{ \Carbon\Carbon::parse($order->order_date)->format('j F Y')}}</p>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-13">
        <p class="pcss">Order number</p>
      	<p class="pcss1">{{$order->order_id}}</p>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-6 col-xs-13">
        <p class="pcss">Payment</p>
      	<p class="pcss1">{{$order->payment_type}}</p>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-6 col-xs-13">
        <p class="pcss">Status</p>
      	<p class="pcss1">{{$order->status}}</p>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-13">
        <p class="pcss">Address</p>
      	<p class="pcss1">{{$order->address}}</p>
      </div>
       </div>
       <hr class="hrcss">
       <?php $orderlist = App\Models\OrderList::where('order_id',$order->order_id)->get(); ?>
       @foreach($orderlist as $orderlist)
       <?php $productimg = App\Models\ProductImage::where('product_id',$orderlist->product_id)->first();
                $product = App\Models\Product::where('id',$orderlist->product_id)->first();
       ?>
         <div class="row align-items-center">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-13">
                <img src="{{asset('uploads/images')}}/{{$productimg->images}}" class="img-fluid" style="width:200px;height:100px;">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-13">
                <p class="pcss3">{{$product->product_name}}</p>
            </div>
            @if($orderlist->quantity != "undefined")
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-13">
                <p class="pcss3">{{$orderlist->quantity}}</p>
            </div>
            @endif
            @if($orderlist->giftwrap == 1)
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-13">
                <p class="pcss4">₹{{$orderlist->giftwrap_price}}</p>
            </div>
            @endif
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-13">
                <p class="pcss4">₹{{$orderlist->mrp_price}}</p>
            </div>
       </div>
       @endforeach
       <hr class="hrcss">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-13">
                <p class="pd">Subtotal</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-13">
                <p class="price">₹{{$order->order_price}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-13">
                <p class="pd">Delivery charges</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-13">
                <p class="price">₹0</p>
            </div>
        </div>
       <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-13">
                <p class="pd">Coupon Charge</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-13">
                <p class="price">₹{{$order->coupon_price}}</p>
            </div>
         </div>
        <hr class="hrcss1">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-13">
            <p class="pd" style="font-size:25px;">Total</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-13">
          	<p class="total" >₹{{$order->payable_price}}</p>
            </div>
        </div>
        <hr class="hrcss">
        <div class="row">
            <div class="col-lg-12">
            <p class="orderpara">We'll send you shipping confirmation when your item(s) are on the way! We appreciate your business, and hope you enjoy your purchase.</p>
            <p style="color:#000;font-size:20px;">Questions? Contact our <a href="#" style="color:#43B5E6;">Customer Support</a></p>
        </div>
       </div>
    </div>
	</div>
    <!-- Cart End -->

@push('after-scripts')
@endpush
@endsection
