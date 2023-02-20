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
@section('title', 'Category')
@section('content')

<div class="section-heading-page" >
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="text-center">
          <h1 class="heading-page text-center-xs">Let's Us Create Joy For You!</h1>
          <a href="" class="btn btn-primary">Explore Products</a>
        </div>
      </div>
	  
    </div>
  </div>
</div>

<div class=cat_blocks>
    <div class="container">
        <div class="row justify-content-center">
        @foreach($category as $category)
            <div class="col-lg-2 col-md-6">
                <div class="cat_block_inner">
                    <a href="{{url('/sub')}}/{{$category->id}}" title="Image">
                        <div class="block1_img">
                            <img src="{{asset('/uploads/images')}}/{{$category->subcat_logo}}" class="img-fluid">
                        </div>
                        <div class="block1_all_text text-center">
                            <div class="block1_text">
                                <p>{{$category->subcat_name}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>



<!--================================================You May Also Like ===========================================-------->
@if($youmay->count() > 0)
<div class="you_mayalso">
<div class="container pt-5 pb-3">
    
    <h2 class="section-title position-relative text-center mb-4" data-aos="fade-up" data-aos-delay="400" >You May Also Like
    <div class="right_viewall"><a href="{{url('/cp/youmayalsolike')}}" class="btn btn-primary mr-0">View All</a></div>
    </h2>
    <div class="row justify-content-center">
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

                            <a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>

                    </div>
                </div>
                <div class="text-center py-2">
                 <div class="d-flex align-items-center justify-content-center review_star mb-1">
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
</div>
@endif
<!--================================================End You May Also Like ===========================================-------->
<div class="what-people">
    <div class="container">
	  <div class="text-center">
       <h3 class="heading mb-5" data-aos="fade-up" data-aos-delay="300">What People are saying?</h3>
      </div>

        <div class="row justify-content-center">
            @foreach($testimonial as $testimonial)
            <div class="col-lg-4 col-md-6 col-12 box" data-aos="fade-left" data-aos-delay="100">
                <div class="test-img">
                    <div class="d-flex align-items-center justify-content-start">
                        <span class="aname">{{$testimonial->letter}}</span>
                        <p class="clicl">{{$testimonial->name}}<span class="our">{{$testimonial->designation}}</span></p>
                    </div>
                    
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
</div>

<div class="foot-top">
    <div class="container">
        <div class="row justify-content-center align-items-center" >
            
                @foreach($section8 as $section8)
                <div class="col-md-3 text-center">
                    <img src="{{asset('uploads/images')}}/{{$section8->section_image}}">
                    <p class="event">{{$section8->section_name}}</p>
                </div>
                @endforeach
        </div>
    </div>
	 
</div>


@push('after-scripts')
@endpush
@endsection
