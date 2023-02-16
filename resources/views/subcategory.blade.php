@push('after-styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<style>
    nav.bg-light{
        background-color: white !important;
    }
</style>
@endpush
@extends('layouts.app')
@section('title', 'Subcategory')
@section('content')


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{url('/')}}">Home</a>
                <span class="breadcrumb-item active">{{$cat->cat_name}}</span>
                <a class="breadcrumb-item text-dark" href="{{url('/cat')}}/{{$sub->category_id}}">{{$sub->subcat_name}}</a>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Category Products Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        @foreach($child as $child)
        <div class="col-lg-4 col-md-4 col-sm-6 pb-1" data-aos="fade-left" data-aos-delay="200">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img src="{{asset('/uploads/images')}}/{{$child->childcat_logo}}" class="img-responsive" width="100%" height="100%">
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="{{url('/p')}}/{{$child->id}}">{{$child->childcat_name}}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!--Category Products End -->

<!--================================================You May Also Like ===========================================-------->
@if($youmay->count() > 0)
<div class="container-fluid pt-5 pb-3">
    <div align="right"><a href="{{url('/cp/youmayalsolike')}}" class="btn btn-primary">View All</a></div>
    <h2 class="section-title position-relative text-center mx-xl-5 mb-4 data-aos="fade-up" data-aos-delay="400"" >You May Also Like</h2>
    <div class="row px-xl-5">
        @foreach($youmay as $product)
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

                        @if($product->is_variation == 0)
                        <input type="hidden" value="{{@$product->id}}" name="product_id" class="product_id{{$product->id}}" />
                        <input type="hidden" name="session_id" class="session_id" value="{{\Session::getId() }}">
                        <input type="hidden" name="quantity" class="quantity{{$product->id}}" value="1">
                        <input type="hidden"  name="price" value="{{$product->price}}" class="price{{$product->id}}">
                        <a class="btn btn-outline-dark btn-square botadd add-to-cartpro{{$product->id}}">Add To Cart</a>
                        <script>
                        $(document).ready(function(){
                           function loadcart(){
                            $.ajax({
                                method: "GET",
                                url: "{{url('/load-cart-data')}}",
                                success: function (response) {
                                    $('.cart_count').html('');
                                    $('.cart_count').html(response.count);
                                }
                            });
                        }
                        $('.add-to-cartpro<?php echo $product->id; ?>').click(function(e){
                            var session_id = $('.session_id').val();
                            var product_id = $('.product_id<?php echo $product->id; ?>').val();
                            var quantity = $('.quantity<?php echo $product->id; ?>').val();
                            var price = $('.price<?php echo $product->id; ?>').val();
                            $.ajax({
                                url: "{{url('add-to-cart')}}",
                                method: "POST",
                                data: {_token: '{{ csrf_token() }}',"price": price,"session_id":session_id,"product_id":product_id,"quantity":quantity},
                                dataType: "json",
                                success: function (response) {
                                    if(response.status == 'success'){
                                        loadcart();
                                        Swal.fire(
                                        'Added!',
                                        'Product Added to Cart',
                                        'success'
                                        )
                                    }else if(response.status == 'out'){
                                        Swal.fire(
                                              'Added!',
                                              'Selected Product Is Out Of Stock',
                                              'success'
                                        )
                                    }else if(response.status == 'greate'){
                                        Swal.fire(
                                              'Added!',
                                              'Selected Product quantity is greater than the quantity',
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
                        @else
                        <input type="hidden" value="{{@$product->id}}" name="product_id" class="product_id{{$product->id}}" />
                        <input type="hidden" name="session_id" class="session_id" value="{{\Session::getId() }}">
                        <?php $var = App\Models\AddSubVariation::where('product_id', $product->id)->first(); ?>
                        <input type="hidden" name="quantity" class="quantity{{$product->id}}" value="1">
                        <input type="hidden"  name="price" value="{{$var->price}}"  class="price{{$product->id}}">
                        <input type="hidden"  name="variation" value="{{$var->id}}" class="variation{{$product->id}}">
                        <?php $varia = App\Models\Addsubvariationn::where('product_id', $product->id)->first();
                            $attvalue = App\Models\AttributeValue::where('id',$varia->main_attr_value)->first();
                        ?>
                        <input type="hidden"  name="sradioo" value="{{$attvalue->id}}"  class="sradioo{{$product->id}}">
                        <a class="btn btn-outline-dark btn-square botadd add-to-cartvar{{$product->id}}">Add To Cart</a>
                        <script>
                        $(document).ready(function(){
                           function loadcart(){
                            $.ajax({
                                method: "GET",
                                url: "{{url('/load-cart-data')}}",
                                success: function (response) {
                                    $('.cart_count').html('');
                                    $('.cart_count').html(response.count);
                                }
                            });
                        }
                        $('.add-to-cartvar<?php echo $product->id; ?>').click(function(e){
                            var session_id = $('.session_id').val();
                            var product_id = $('.product_id<?php echo $product->id; ?>').val();
                            var variation_id = $('.variation<?php echo $product->id; ?>').val();
                            var sradioo = $('.sradioo<?php echo $product->id; ?>').val();
                            var colorradioo = $('.colorradioo<?php echo $product->id; ?>').val();
                            var quantity = $('.quantity<?php echo $product->id; ?>').val();
                            var price = $('.price<?php echo $product->id; ?>').val();
                            $.ajax({
                                url: "{{url('relvaradd-to-cart')}}",
                                method: "POST",
                                data: {_token: '{{ csrf_token() }}',"price": price,"sradioo":sradioo,"colorradioo":colorradioo,"session_id":session_id,"product_id":product_id,"quantity":quantity,"variation_id":variation_id},
                                dataType: "json",
                                success: function (response) {
                                //	$('.cart_counter').html(response.cart_counter);
                                    if(response.status == 'success'){
                                        loadcart();
                                        Swal.fire(
                                        'Added!',
                                        'Product Added to Cart',
                                        'success'
                                        )
                                    }else if(response.status == 'out'){
                                        Swal.fire(
                                              'Added!',
                                              'Selected Product Is Out Of Stock',
                                              'success'
                                        )
                                    }else if(response.status == 'greate'){
                                        Swal.fire(
                                              'Added!',
                                              'Selected Product quantity is greater than the quantity',
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
                        @endif

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
</div>
@endif
<!--================================================End You May Also Like ===========================================-------->


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

<div class="foot-top">
 <div class="row" style="text-align: center;">
    <div class="col-sm-2"></div>
        @foreach($section8 as $section8)
        <div class="col-sm-3">
            <img src="{{asset('uploads/images')}}/{{$section8->section_image}}">
            <p class="event">{{$section8->section_name}}</p>
        </div>
        @endforeach
    </div>
    <div class="col-sm-1"></div>
</div>
</div>


@push('after-scripts')
@endpush
@endsection
