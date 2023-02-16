@push('after-styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<style>
    nav.bg-light{
        background-color: white !important;
    }
    .offertag{
        color:#ffffff;
        background:#c2272d;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        display: inline-block;
        padding: 4px 15px 2px;
        position: absolute;
        left: 0;
        top: 14px;
        border-radius: 0;
        line-height: 1.5;
    }
</style>
<style>
    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        /*min-width: 0;*/
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0,0,0,.125);
        border-radius: 0.25rem;



        width: 92%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
        box-shadow: 0 0 20px #bfbfbf;
    }
</style>

@endpush
@extends('layouts.app')
@section('title', 'Product List')
@section('content')



    <!-- Breadcrumb Start -->
    <!--<div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Cake </a>
                    <span class="breadcrumb-item active">Online Cake Delivery</span>
                </nav>
            </div>
        </div>
    </div>-->
    <!-- Breadcrumb End -->

    <!-- Carousel End -->



  <!-- Carousel End -->
  <div class="container-fluid">
    <div class="row px-xl-5">
        <div class="sort">
            <h1 class="birth">&nbsp;&nbsp;<span class="rate">4.6 <i class="fa fa-star"></i></span> &nbsp;&nbsp;<span class="review">1200 Reviews</span></h1>
            <p class="sortb">Sort By:
                <button class="sortbar_tab__3Bhn- sortbar_active__3Tw7A"  data-sortsel="Recommended" value="Recommended" type="button">Recommended</button>
                <button class="sortbar_tab__3Bhn- false" data-sortsel="New"  value="New" type="button">New</button>
                <button class="sortbar_tab__3Bhn- false" data-sortsel="Price: Low to High"  value="Price: Low to High" type="button">Price: Low to High</button>
                <button class="sortbar_tab__3Bhn- false"  data-sortsel="Price: High to Low"  value="Price: High to Low" type="button">Price: High to Low</button>
            </p>
        </div>
    </div>
</div>

    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            @foreach($products as $product)
            <?php
            if($product->is_variation == '1'){
                $proimag = App\Models\ProductImage::where('product_id',$product->id)->whereNotNull('variation_product_id')->first();
                $provar = App\Models\AddSubVariation::where('product_id',$product->id)->first();
                $attribute = App\Models\ProductVariation::where('product_id', $product->id)->get();
            }else{
                $proimag = App\Models\ProductImage::where('product_id',$product->id)->first();
                $provar = App\Models\Product::where('status','Active')->where('id',$product->id)->first();
            }
            $pronewtre = App\Models\Product::where('status','Active')->where('id',$product->id)->first();
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1" data-aos="fade-left" data-aos-delay="200">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <a href="{{url('/pro')}}/{{$product->slug}}">
                            @if($proimag == null)
                            <img class="img-fluid w-100" src="{{asset('img/ck1.png') }}" alt="service-image2">
                            @else
                            <img src="{{ asset('uploads/images/') }}/{{$proimag->images}}" alt="service-image2" class="img-fluid w-100">
                            @endif
                            </a>
                            <span class="offertag">{{$product->discount}}</span>
                        <input type="hidden" name="product_id" value="{{$product->id}}" class="product_id{{$product->id}}" />
                        <input type="hidden" name="product_name" class="product_name{{$product->id}}" value="{{@$product->product_name}}"/>
                        <input type="hidden" name="product_price" class="product_price{{$product->id}}" value="{{@$product->price}}"/>
                        <input type="hidden" class="session_id" name="session_id" value="{{session()->getId()}}"/>

                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square bluey" href="{{url('/pro')}}/{{$product->slug}}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-outline-dark btn-square yehr wishlistproduct{{$product->id}}"><i class="far fa-heart"></i></a>
<script>
 $(document).ready(function(){
     function loadwish(){
         $.ajax({
             method: "GET",
             url: '{{url('/load-wishlist-data')}}',
             success: function (response) {
                 $('.wishlist_count').html('');
                 $('.wishlist_count').html(response.count);
             }
         });
     }

     $('.wishlistproduct<?php echo $product->id; ?>').click(function(e){
         var session_id = $('.session_id').val();
         var product_id = $('.product_id<?php echo $product->id; ?>').val();
         var product_name = $('.product_name<?php echo $product->id; ?>').val();
         var product_price = $('.product_price<?php echo $product->id; ?>').val();
         $.ajax({
             url: '{{url('addwishlist')}}',
             method: "POST",
             data: {_token: '{{ csrf_token() }}',"session_id":session_id, "product_id":product_id,"product_name":product_name,"product_price":product_price},
             dataType: "json",
             success: function (response) {
                 if(response.status == 'success'){
                     loadwish();
                 Swal.fire(
                   'Added!',
                   'Product Added to Wishlist',
                   'success'
                 )
             }else if(response.status == 'exists'){
                  Swal.fire(
                   'Already Exists',
                   'success'
                 )
             }else if(response.status == 'failure'){
                 window.location.replace('http://127.0.0.1:8000/login')
             }
             }
         });
     });
 });
 </script>
                            <a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>
                        </div>
                    </div>
                    <div class="text-center py-4">
					 <div class="d-flex align-items-center justify-content-center mb-1">
                        <?php $ratingg = App\Models\Review::where('product_id',$product->id)->avg('rating'); ?>
                        @if($ratingg != null)<p>
                            @foreach(range(1,5) as $i)
                            <span class="fa-stack" style="width:1em">
                                <i class="far fa-star fa-stack-1x"></i>

                                @if($ratingg >0)
                                    @if($ratingg >0.5)
                                        <i class="fas fa-star fa-stack-1x"></i>
                                    @else
                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                    @endif
                                @endif
                                @php $ratingg--; @endphp
                            </span>
                            @endforeach
                        @endif

                        </div>
                        <a class="h6 text-decoration-none text-truncate" href="{{url('/pro')}}/{{$product->slug}}">{{$product->product_name}}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>₹{{$provar->price}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
		<div align="center"> <a href="" class="btn btn-primary">Show More Products</a></div>
    </div>
    <!-- Products End -->


<!--======================================= Trending Products============================================--->
@if($trend->count() > 0)
<div class="container-fluid pt-5 pb-3">
	<div align="right"><a href="{{url('/cp/trend')}}" class="btn btn-primary">View All</a></div>
        <h2 class="section-title position-relative text-center mx-xl-5 mb-4 data-aos="fade-up" data-aos-delay="400"" >Trending Products</h2>
        <div class="row px-xl-5">
            @foreach($trend as $trend)
            <?php
            if($trend->is_variation == '1'){
                $proimagt = App\Models\ProductImage::where('product_id',$trend->id)->whereNotNull('variation_product_id')->first();
                $provart = App\Models\AddSubVariation::where('product_id',$trend->id)->first();
                $attributet = App\Models\ProductVariation::where('product_id', $trend->id)->get();
            }else{
                $proimagt = App\Models\ProductImage::where('product_id',$trend->id)->first();
                $provart = App\Models\Product::where('status','Active')->where('id',$trend->id)->first();
            }
            $pronewtret = App\Models\Product::where('status','Active')->where('id',$trend->id)->first();
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1" data-aos="fade-left" data-aos-delay="200">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <a href="{{url('/pro')}}/{{$trend->slug}}">
                            @if($proimagt == null)
                            <img class="img-fluid w-100" src="{{asset('img/ck1.png') }}" alt="service-image2">
                            @else
                            <img src="{{ asset('uploads/images/') }}/{{$proimagt->images}}" alt="service-image2" class="img-fluid w-100">
                            @endif
                        </a>

                        <input type="hidden" name="product_id" value="{{$trend->id}}" class="product_id{{$trend->id}}" />
                        <input type="hidden" name="product_name" class="product_name{{$trend->id}}" value="{{@$trend->product_name}}"/>
                        <input type="hidden" name="product_price" class="product_price{{$trend->id}}" value="{{@$trend->price}}"/>
                        <input type="hidden" class="session_id" name="session_id" value="{{session()->getId()}}"/>

                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square bluey" href="{{url('/pro')}}/{{$trend->slug}}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-outline-dark btn-square yehr wishlisttrend{{$trend->id}}"><i class="far fa-heart"></i></a>
<script>
 $(document).ready(function(){
     function loadwish(){
         $.ajax({
             method: "GET",
             url: '{{url('/load-wishlist-data')}}',
             success: function (response) {
                 $('.wishlist_count').html('');
                 $('.wishlist_count').html(response.count);
             }
         });
     }

     $('.wishlisttrend<?php echo $trend->id; ?>').click(function(e){
         var session_id = $('.session_id').val();
         var product_id = $('.product_id<?php echo $trend->id; ?>').val();
         var product_name = $('.product_name<?php echo $trend->id; ?>').val();
         var product_price = $('.product_price<?php echo $trend->id; ?>').val();
         $.ajax({
             url: '{{url('addwishlist')}}',
             method: "POST",
             data: {_token: '{{ csrf_token() }}',"session_id":session_id, "product_id":product_id,"product_name":product_name,"product_price":product_price},
             dataType: "json",
             success: function (response) {
                 if(response.status == 'success'){
                     loadwish();
                 Swal.fire(
                   'Added!',
                   'Product Added to Wishlist',
                   'success'
                 )
             }else if(response.status == 'exists'){
                  Swal.fire(
                   'Already Exists',
                   'success'
                 )
             }else if(response.status == 'failure'){
                 window.location.replace('http://127.0.0.1:8000/login')
             }
             }
         });
     });
 });
 </script>
                            <a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>

                        </div>
                    </div>
                    <div class="text-center py-4">
					 <div class="d-flex align-items-center justify-content-center mb-1">
                        <?php $rating = App\Models\Review::where('product_id',$trend->id)->avg('rating'); ?>
                        @if($rating != null)<p>
                            @foreach(range(1,5) as $i)
                            <span class="fa-stack" style="width:1em">
                                <i class="far fa-star fa-stack-1x"></i>

                                @if($rating >0)
                                    @if($rating >0.5)
                                        <i class="fas fa-star fa-stack-1x"></i>
                                    @else
                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                    @endif
                                @endif
                                @php $rating--; @endphp
                            </span>
                            @endforeach
                        @endif


                        </div>
                        <a class="h6 text-decoration-none text-truncate" href="{{url('/pro')}}/{{$trend->slug}}">{{$trend->product_name}}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>₹{{$provart->price}}</h5>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endif
<!--=======================================End Trending Products============================================--->

<div class="what-people">
    <div align="center">
        <h3 class="heading" data-aos="fade-up" data-aos-delay="300">What People are saying?</h3>
    </div><br>
    <br>
    <div class="row px-xl-5">
        @foreach($testimonial as $testimonial)
        <div class="col-sm-4 box" data-aos="fade-left" data-aos-delay="100">
            <div class="test-img"><span class="aname">{{$testimonial->letter}}</span>
                <p class="clicl">{{$testimonial->name}}<span class="our">{{$testimonial->designation}}</span></p>
                <p class="tes">{!!$testimonial->description!!}</p>
                <div class="d-flex align-items-center justify-content-left mb-1">
                    @if($testimonial->rating != null)
                    @for($i=1; $i<=$testimonial->rating; $i++)
                    <small class="fa fa-star text-primary mr-1"></small>
                    @endfor
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('after-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$("button").click(function() {
    var sortsel = $(this).val();

    if ($(this).val() != "") {
        location.href = '{{url()->current()}}?sortby=' + $(this).val();
    } else {
        location.href = "{{route('products.productindex')}}";
    }

});
</script>
<script>
    function getIds(checkboxName) {
        let checkBoxes = document.getElementsByName(checkboxName);
        let ids = Array.prototype.slice.call(checkBoxes)
                        .filter(ch => ch.checked==true)
                        .map(ch => ch.value);
        return ids;
    }

     function filterResults () {
        let priceIds = getIds("price");

        let stockIds = getIds("stock");

        let attributeIds = getIds("attribute");

        let href = '{{url('/')}}/searchproductfilter?';

        if(priceIds.length) {
            href += 'price=' + priceIds + '&stock=' + stockIds + '&attribute=' + attributeIds;
        }if(attributeIds.length) {
            href += 'price=' + priceIds + '&stock=' + stockIds + '&attribute=' + attributeIds;
        }else if(stockIds.length) {
            href += 'price=' + priceIds + '&stock=' + stockIds + '&attribute=' + attributeIds;
        }else if(priceIds.length && stockIds.length && attributeIds.length){
            href += 'price=' + priceIds + '&stock=' + stockIds + '&attribute=' + attributeIds;
        }

        document.location.href=href;
    }

    document.getElementById("filter").addEventListener("click", filterResults);
</script>

@endpush
@endsection