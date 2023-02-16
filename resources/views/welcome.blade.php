@push('after-styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@endpush
@extends('layouts.app')
@section('title', 'Home')
@section('content')

<div class="slide">
    <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php $counter1 = 0; ?>
            @foreach($banners as $banner)
            <?php $counter1++; ?>
            <li data-target="#header-carousel" data-slide-to="{{$counter1}}" class="@if($counter1 == 1) active @endif"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            <?php $counter = 0; ?>
            @foreach($banners as $banner)
            <?php $counter++; ?>
            <div class="carousel-item position-relative  @if($counter == 1) active @endif" style="height: 430px;">
                <img src="{{asset('uploads/images/') }}/{{ @$banner->banner_image}}" class="position-absolute w-100 h-100" alt="Los Angeles" style="object-fit: cover;">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Carousel End -->

 <!-- Offer Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        @foreach ($section2 as $section2)
        <div class="col-md-4" data-aos="fade-down" data-aos-delay="300">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="{{asset('uploads/images')}}/{{$section2->image}}" alt="">
                <div class="offer-text">
                    <h3 class="text-white mb-3">{{$section2->title}}</h3>
                    <a href="{{$section2->button_url}}" class="btn btn-primary">{{$section2->button_name}}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Offer End -->

<div class="tab-sec">
	<div class="container">
    	<div class="row">
            <div align="center">
                <h3 class="heading" data-aos="fade-up" data-aos-delay="300">Fall in love with our cakes</h3>
                <div class="tabset">
                    <!-- Tab 1 -->
                    <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
                    <label for="tab1">Birthday</label>
                    <!-- Tab 2 -->
                    <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
                    <label for="tab2">Anniversary</label>
                    <!-- Tab 3 -->
                    <input type="radio" name="tabset" id="tab3" aria-controls="dunkles">
                    <label for="tab3">Wedding</label>
                    <!-- Tab 3 -->
                    <input type="radio" name="tabset" id="tab4" aria-controls="specialdays">
                    <label for="tab4">Special Days</label>
                    <!-- Tab 3 -->
                    <input type="radio" name="tabset" id="tab5" aria-controls="others">
                    <label for="tab5">Otrhers</label>
                <div class="tab-panels">
                    <section id="marzen" class="tab-panel">
                        <div class="row px-xl-5">
                            @foreach($cake as $cake)
                            <?php
                            if($cake->is_variation == '1'){
                                $proimagc = App\Models\ProductImage::where('product_id',$cake->id)->whereNotNull('variation_product_id')->first();
                                $provarc = App\Models\AddSubVariation::where('product_id',$cake->id)->first();
                                $attributec = App\Models\ProductVariation::where('product_id', $cake->id)->get();
                            }else{
                                $proimagc = App\Models\ProductImage::where('product_id',$cake->id)->first();
                                $provarc = App\Models\Product::where('status','Active')->where('id',$cake->id)->first();
                            }
                            $pronewtrec = App\Models\Product::where('status','Active')->where('id',$cake->id)->first();
                            ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 pb-1" data-aos="fade-left" data-aos-delay="200">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <a href="{{url('/pro')}}/{{$cake->slug}}">
                                            @if($proimagc == null)
                                            <img class="img-fluid w-100" src="{{asset('img/ck1.png') }}" alt="service-image2">
                                            @else
                                            <img src="{{ asset('uploads/images/') }}/{{$proimagc->images}}" alt="service-image2" class="img-fluid w-100">
                                            @endif
                                            </a>

                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square bluey" href="{{url('/pro')}}/{{$cake->slug}}"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-outline-dark btn-square yehr wishlistcake{{$cake->id}}"><i class="far fa-heart"></i></a>
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

                         $('.wishlistcake<?php echo $cake->id; ?>').click(function(e){
                             var session_id = $('.session_id').val();
                             var product_id = $('.product_id<?php echo $cake->id; ?>').val();
                             var product_name = $('.product_name<?php echo $cake->id; ?>').val();
                             var product_price = $('.product_price<?php echo $cake->id; ?>').val();
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
                                        <!--<a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <?php $ratingcc11 = App\Models\Review::where('product_id',$cake->id)->avg('rating'); ?>
                                        @if($ratingcc11 != null)<p>
                                            @foreach(range(1,5) as $i)
                                            <span class="fa-stack" style="width:1em">
                                                <i class="far fa-star fa-stack-1x"></i>

                                                @if($ratingcc11 >0)
                                                    @if($ratingcc11 >0.5)
                                                        <i class="fas fa-star fa-stack-1x"></i>
                                                    @else
                                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                                    @endif
                                                @endif
                                                @php $ratingcc11--; @endphp
                                            </span>
                                            @endforeach
                                        @endif

                                    </div>
                                    <a class="h6 text-decoration-none text-truncate" href="{{url('/pro')}}/{{$cake->slug}}">{{$cake->product_name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>₹{{$provarc->price}}</h5>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    <section id="rauchbier" class="tab-panel">
                        <div class="row px-xl-5">

                            @foreach($cake1 as $cake1)
                            <?php
                            if($cake1->is_variation == '1'){
                                $proimagc1 = App\Models\ProductImage::where('product_id',$cake1->id)->whereNotNull('variation_product_id')->first();
                                $provarc1 = App\Models\AddSubVariation::where('product_id',$cake1->id)->first();
                                $attributec1 = App\Models\ProductVariation::where('product_id', $cake1->id)->get();
                            }else{
                                $proimagc1 = App\Models\ProductImage::where('product_id',$cake1->id)->first();
                                $provarc1 = App\Models\Product::where('status','Active')->where('id',$cake1->id)->first();
                            }
                            $pronewtrec1 = App\Models\Product::where('status','Active')->where('id',$cake1->id)->first();
                            ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <a href="{{url('/pro')}}/{{$cake1->slug}}">
                                            @if($proimagc1 == null)
                                            <img class="img-fluid w-100" src="{{asset('img/ck1.png') }}" alt="service-image2">
                                            @else
                                            <img src="{{ asset('uploads/images/') }}/{{$proimagc1->images}}" alt="service-image2" class="img-fluid w-100">
                                            @endif
                                            </a>
                                            <input type="hidden" name="product_id" value="{{$cake1->id}}" class="product_id{{$cake1->id}}" />
                                            <input type="hidden" name="product_name" class="product_name{{$cake1->id}}" value="{{@$cake1->product_name}}"/>
                                            <input type="hidden" name="product_price" class="product_price{{$cake1->id}}" value="{{@$cake1->price}}"/>
                                            <input type="hidden" class="session_id" name="session_id" value="{{session()->getId()}}"/>

                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square bluey" href="{{url('/pro')}}/{{$cake1->slug}}"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-outline-dark btn-square yehr wishlistcake1{{$cake1->id}}"><i class="far fa-heart"></i></a>
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

                         $('.wishlistcake1<?php echo $cake1->id; ?>').click(function(e){
                             var session_id = $('.session_id').val();
                             var product_id = $('.product_id<?php echo $cake1->id; ?>').val();
                             var product_name = $('.product_name<?php echo $cake1->id; ?>').val();
                             var product_price = $('.product_price<?php echo $cake1->id; ?>').val();
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
                               <!--<a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->

                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <?php $ratingc11 = App\Models\Review::where('product_id',$cake1->id)->avg('rating'); ?>
                                        @if($ratingc11 != null)<p>
                                            @foreach(range(1,5) as $i)
                                            <span class="fa-stack" style="width:1em">
                                                <i class="far fa-star fa-stack-1x"></i>

                                                @if($ratingc11 >0)
                                                    @if($ratingc11 >0.5)
                                                        <i class="fas fa-star fa-stack-1x"></i>
                                                    @else
                                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                                    @endif
                                                @endif
                                                @php $ratingc11--; @endphp
                                            </span>
                                            @endforeach
                                        @endif

                                    </div>
                                    <a class="h6 text-decoration-none text-truncate" href="{{url('/pro')}}/{{$cake1->slug}}">{{$cake1->product_name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>₹{{$provarc1->price}}</h5>
                                    </div>

                                    </div>
                                </div>
                            </div>
                           @endforeach
                        </div>
                    </section>

                    <section id="dunkles" class="tab-panel">
                        <div class="row px-xl-5">
                            @foreach($cake2 as $cake2)
                            <?php
                            if($cake2->is_variation == '1'){
                                $proimagc2 = App\Models\ProductImage::where('product_id',$cake2->id)->whereNotNull('variation_product_id')->first();
                                $provarc2 = App\Models\AddSubVariation::where('product_id',$cake2->id)->first();
                                $attributec2 = App\Models\ProductVariation::where('product_id', $cake2->id)->get();
                            }else{
                                $proimagc2 = App\Models\ProductImage::where('product_id',$cake2->id)->first();
                                $provarc2 = App\Models\Product::where('status','Active')->where('id',$cake2->id)->first();
                            }
                            $pronewtrec2 = App\Models\Product::where('status','Active')->where('id',$cake2->id)->first();
                            ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <a href="{{url('/pro')}}/{{$cake2->slug}}">
                                            @if($proimagc2 == null)
                                            <img class="img-fluid w-100" src="{{asset('img/ck1.png') }}" alt="service-image2">
                                            @else
                                            <img src="{{ asset('uploads/images/') }}/{{$proimagc2->images}}" alt="service-image2" class="img-fluid w-100">
                                            @endif
                                            </a>
                                            <input type="hidden" name="product_id" value="{{$cake2->id}}" class="product_id{{$cake2->id}}" />
                                            <input type="hidden" name="product_name" class="product_name{{$cake2->id}}" value="{{@$cake2->product_name}}"/>
                                            <input type="hidden" name="product_price" class="product_price{{$cake2->id}}" value="{{@$cake2->price}}"/>
                                            <input type="hidden" class="session_id" name="session_id" value="{{session()->getId()}}"/>

                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square bluey" href="{{url('/pro')}}/{{$cake2->slug}}"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-outline-dark btn-square yehr wishlistcake2{{$cake2->id}}"><i class="far fa-heart"></i></a>
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

                         $('.wishlistcake2<?php echo $cake2->id; ?>').click(function(e){
                             var session_id = $('.session_id').val();
                             var product_id = $('.product_id<?php echo $cake2->id; ?>').val();
                             var product_name = $('.product_name<?php echo $cake2->id; ?>').val();
                             var product_price = $('.product_price<?php echo $cake2->id; ?>').val();
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
                                        <!--<a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->

                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <?php $ratingc2 = App\Models\Review::where('product_id',$cake2->id)->avg('rating'); ?>
                                        @if($ratingc2 != null)<p>
                                            @foreach(range(1,5) as $i)
                                            <span class="fa-stack" style="width:1em">
                                                <i class="far fa-star fa-stack-1x"></i>

                                                @if($ratingc2 >0)
                                                    @if($ratingc2 >0.5)
                                                        <i class="fas fa-star fa-stack-1x"></i>
                                                    @else
                                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                                    @endif
                                                @endif
                                                @php $ratingc2--; @endphp
                                            </span>
                                            @endforeach
                                        @endif

                                    </div>
                                    <a class="h6 text-decoration-none text-truncate" href="{{url('/pro')}}/{{$cake2->slug}}">{{$cake2->product_name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>₹{{$provarc2->price}}</h5>
                                    </div>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>

                    <section id="specialdays" class="tab-panel">
                        <div class="row px-xl-5">
                            @foreach($cake3 as $cake3)
                            <?php
                            if($cake3->is_variation == '1'){
                                $proimagc3 = App\Models\ProductImage::where('product_id',$cake3->id)->whereNotNull('variation_product_id')->first();
                                $provarc3 = App\Models\AddSubVariation::where('product_id',$cake3->id)->first();
                                $attributec3 = App\Models\ProductVariation::where('product_id', $cake3->id)->get();
                            }else{
                                $proimagc3 = App\Models\ProductImage::where('product_id',$cake3->id)->first();
                                $provarc3 = App\Models\Product::where('status','Active')->where('id',$cake3->id)->first();
                            }
                            $pronewtrec3 = App\Models\Product::where('status','Active')->where('id',$cake3->id)->first();
                            ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <a href="{{url('/pro')}}/{{$cake3->slug}}">
                                            @if($proimagc3 == null)
                                            <img class="img-fluid w-100" src="{{asset('img/ck1.png') }}" alt="service-image2">
                                            @else
                                            <img src="{{ asset('uploads/images/') }}/{{$proimagc3->images}}" alt="service-image2" class="img-fluid w-100">
                                            @endif
                                            </a>
                                                <input type="hidden" name="product_id" value="{{$cake3->id}}" class="product_id{{$cake3->id}}" />
                                                <input type="hidden" name="product_name" class="product_name{{$cake3->id}}" value="{{@$cake3->product_name}}"/>
                                                <input type="hidden" name="product_price" class="product_price{{$cake3->id}}" value="{{@$cake3->price}}"/>
                                                <input type="hidden" class="session_id" name="session_id" value="{{session()->getId()}}"/>

                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square bluey" href="{{url('/pro')}}/{{$cake3->slug}}"><i class="fa fa-eye"></i></a>
                                                    <a class="btn btn-outline-dark btn-square yehr wishlistcake3{{$cake3->id}}"><i class="far fa-heart"></i></a>
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

                             $('.wishlistcake3<?php echo $cake3->id; ?>').click(function(e){
                                 var session_id = $('.session_id').val();
                                 var product_id = $('.product_id<?php echo $cake3->id; ?>').val();
                                 var product_name = $('.product_name<?php echo $cake3->id; ?>').val();
                                 var product_price = $('.product_price<?php echo $cake3->id; ?>').val();
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
                              <!--<a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->

                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <?php $ratingc3 = App\Models\Review::where('product_id',$cake3->id)->avg('rating'); ?>
                                        @if($ratingc3 != null)<p>
                                            @foreach(range(1,5) as $i)
                                            <span class="fa-stack" style="width:1em">
                                                <i class="far fa-star fa-stack-1x"></i>

                                                @if($ratingc3 >0)
                                                    @if($ratingc3 >0.5)
                                                        <i class="fas fa-star fa-stack-1x"></i>
                                                    @else
                                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                                    @endif
                                                @endif
                                                @php $ratingc3--; @endphp
                                            </span>
                                            @endforeach
                                        @endif

                                    </div>
                                    <a class="h6 text-decoration-none text-truncate" href="{{url('/pro')}}/{{$cake3->slug}}">{{$cake3->product_name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>₹{{$provarc3->price}}</h5>
                                    </div>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>

                    <section id="others" class="tab-panel">
                        <div class="row px-xl-5">
                            @foreach($cake4 as $cake4)
                            <?php
                            if($cake4->is_variation == '1'){
                                $proimagc4 = App\Models\ProductImage::where('product_id',$cake4->id)->whereNotNull('variation_product_id')->first();
                                $provarc4 = App\Models\AddSubVariation::where('product_id',$cake4->id)->first();
                                $attributec4 = App\Models\ProductVariation::where('product_id', $cake4->id)->get();
                            }else{
                                $proimagc4 = App\Models\ProductImage::where('product_id',$cake4->id)->first();
                                $provarc4 = App\Models\Product::where('status','Active')->where('id',$cake4->id)->first();
                            }
                            $pronewtrec4 = App\Models\Product::where('status','Active')->where('id',$cake4->id)->first();
                            ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <a href="{{url('/pro')}}/{{$cake4->slug}}">
                                            @if($proimagc4 == null)
                                            <img class="img-fluid w-100" src="{{asset('img/ck1.png') }}" alt="service-image2">
                                            @else
                                            <img src="{{ asset('uploads/images/') }}/{{$proimagc4->images}}" alt="service-image2" class="img-fluid w-100">
                                            @endif
                                            </a>
                                            <input type="hidden" name="product_id" value="{{$cake4->id}}" class="product_id{{$cake4->id}}" />
                                            <input type="hidden" name="product_name" class="product_name{{$cake4->id}}" value="{{@$cake4->product_name}}"/>
                                            <input type="hidden" name="product_price" class="product_price{{$cake4->id}}" value="{{@$cake4->price}}"/>
                                            <input type="hidden" class="session_id" name="session_id" value="{{session()->getId()}}"/>

                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square bluey" href="{{url('/pro')}}/{{$cake4->slug}}"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-outline-dark btn-square yehr wishlistcake4{{$cake4->id}}"><i class="far fa-heart"></i></a>
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

                         $('.wishlistcake4<?php echo $cake4->id; ?>').click(function(e){
                             var session_id = $('.session_id').val();
                             var product_id = $('.product_id<?php echo $cake4->id; ?>').val();
                             var product_name = $('.product_name<?php echo $cake4->id; ?>').val();
                             var product_price = $('.product_price<?php echo $cake4->id; ?>').val();
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
                                            <!--<a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->

                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <?php $ratingc = App\Models\Review::where('product_id',$cake4->id)->avg('rating'); ?>
                                        @if($ratingc != null)<p>
                                            @foreach(range(1,5) as $i)
                                            <span class="fa-stack" style="width:1em">
                                                <i class="far fa-star fa-stack-1x"></i>

                                                @if($ratingc >0)
                                                    @if($ratingc >0.5)
                                                        <i class="fas fa-star fa-stack-1x"></i>
                                                    @else
                                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                                    @endif
                                                @endif
                                                @php $ratingc--; @endphp
                                            </span>
                                            @endforeach
                                        @endif
                                    </div>
                                    <a class="h6 text-decoration-none text-truncate" href="{{url('/pro')}}/{{$cake4->slug}}">{{$cake4->product_name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>₹{{$provarc4->price}}</h5>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

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
                         <!--  <a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->
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
<!--======================================= End Trending Products============================================--->

    <!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
	<div align="right"><a href="{{url('/cp/newarrival')}}" class="btn btn-primary">View All</a></div>
        <h2 class="section-title position-relative text-center mx-xl-5 mb-4" data-aos="fade-up" data-aos-delay="300">New Arrival Gifts</h2>
        <div class="row px-xl-5">
            @foreach($new as $new)
            <?php
            if($new->is_variation == '1'){
                $proimagn = App\Models\ProductImage::where('product_id',$new->id)->whereNotNull('variation_product_id')->first();
                $provarn = App\Models\AddSubVariation::where('product_id',$new->id)->first();
                $attributen = App\Models\ProductVariation::where('product_id', $new->id)->get();
            }else{
                $proimagn = App\Models\ProductImage::where('product_id',$new->id)->first();
                $provarn = App\Models\Product::where('status','Active')->where('id',$new->id)->first();
            }
            $pronewtren = App\Models\Product::where('status','Active')->where('id',$new->id)->first();
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1" data-aos="fade-letf" data-aos-delay="100">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <a href="{{url('/pro')}}/{{$new->slug}}">
                            @if($proimagn == null)
                            <img class="img-fluid w-100" src="{{asset('img/ck1.png') }}" alt="service-image2">
                            @else
                            <img src="{{ asset('uploads/images/') }}/{{$proimagn->images}}" alt="service-image2" class="img-fluid w-100">
                            @endif
                        </a>
                        <input type="hidden" name="product_id" value="{{$new->id}}" class="product_id{{$new->id}}" />
                        <input type="hidden" name="product_name" class="product_name{{$new->id}}" value="{{@$new->product_name}}"/>
                        <input type="hidden" name="product_price" class="product_price{{$new->id}}" value="{{@$new->price}}"/>
                        <input type="hidden" class="session_id" name="session_id" value="{{session()->getId()}}"/>

                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square bluey" href="{{url('/pro')}}/{{$new->slug}}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-outline-dark btn-square yehr wishlistnew{{$new->id}}"><i class="far fa-heart"></i></a>
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

     $('.wishlistnew<?php echo $new->id; ?>').click(function(e){
         var session_id = $('.session_id').val();
         var product_id = $('.product_id<?php echo $new->id; ?>').val();
         var product_name = $('.product_name<?php echo $new->id; ?>').val();
         var product_price = $('.product_price<?php echo $new->id; ?>').val();
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
                            <!--<a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->
                        </div>
                    </div>
                    <div class="text-center py-4">
					 <div class="d-flex align-items-center justify-content-center mb-1">
                        <?php $ratingg = App\Models\Review::where('product_id',$new->id)->avg('rating'); ?>
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
                      <a class="h6 text-decoration-none text-truncate" href="{{url('/pro')}}/{{$new->slug}}">{{$new->product_name}}</a>
                      <div class="d-flex align-items-center justify-content-center mt-2">
                          <h5>₹{{$provarn->price}}</h5>
                      </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->


    <!-- Vendor Start -->
<div class="container-fluid py-5">
   <div align="center">
       <div align="right"><a href="" class="btn btn-primary">View All</a></div>
        <h3 class="heading" style="color:white;" data-aos="fade-up" data-aos-delay="300">Perfect Gifts for all Occasions</h3><br>
<br>
   </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="bg-light p-4">
                    <img src="{{asset('img/fd.png')}}" alt="">
                    <p class="ll">Fathers Day</p>
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('img/md.png')}}" alt="">
                    <p class="ll">Mothers Day</p>
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('img/ffd.png')}}" alt="">
                    <p class="ll">Friendship Day</p>
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('img/vd.png')}}" alt="">
                    <p class="ll">Valentine's Day</p>
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('img/wd.png')}}" alt="">
                    <p class="ll">Womens Day</p>
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('img/ny.png')}}" alt="">
                    <p class="ll">New Year</p>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->
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
