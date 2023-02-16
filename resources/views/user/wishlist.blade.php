@push('after-styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@endpush
@extends('layouts.app')
@section('title', 'Wishlist')
@section('content')

<div class="shop-ccc">
 <h1 class="shopping-crt">WishList</h1>
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            @include('user.layouts.sidemenu')
            <div class="col-lg-9 table-responsive mb-5">
                <table class="table text-center">
                    <thead>
                        <tr>
                        <th scope="col">Item Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wish as $wish)
                        <?php
                            $pro = App\Models\Product::where('id',$wish->product_id)->first();
                            // $img = App\Models\ProductImage::where('product_id',$wish->product_id)->first();
                            if($pro->is_variation == '1'){
                                $img = App\Models\ProductImage::where('product_id',$pro->id)->whereNotNull('variation_product_id')->first();
                                $prod = App\Models\AddSubVariation::where('product_id',$pro->id)->first();
                            }else{
                                $img = App\Models\ProductImage::where('product_id',$pro->id)->first();
                                $prod = App\Models\Product::where('status','Active')->where('id',$pro->id)->first();
                            }
                        ?>
                        <tr>
                            <td class="align-middle">
                                <a href="{{url('/')}}/pro/{{$pro->slug}}">
                                    @if($img == null)
                                        <img src="{{asset('img/ck1.png')}}" alt="" style="width: 100px;">
                                        @else
                                        <img src="{{ asset('uploads/images/') }}/{{ $img->images }}" alt="" style="width: 100px;">
                                    @endif
                                </a>
                                <a href="{{url('/')}}/pro/{{$pro->slug}}">{{$pro->product_name}}</a>
                            </td>
                            <td class="align-middle">₹{{$prod->price}}</td>
                            <td class="align-middle">
                                <a href="{{url('/delwish')}}/{{$wish->id}}" title="">
                                    <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                </a>
                            </td>
                            </tr>
   					    @endforeach
	                </tbody>
	            </table>
            </div>
        </div>
    </div>
	</div>
    <!-- Cart End -->

@push('after-scripts')
@endpush
@endsection
