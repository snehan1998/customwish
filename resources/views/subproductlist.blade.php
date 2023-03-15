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
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumb mb-30">
                    <a class="breadcrumb-item text-dark" href="{{url('/')}}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{url('/cat')}}/{{$cat->id}}">{{$cat->cat_name}} </a>
                    <span class="breadcrumb-item active">{{$sub->subcat_name}} </span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Carousel End -->
    <div class="container">
        <div class="row mb-3">
            <div class="sort">
                <h1 class="birth">{{$cat->cat_name}}  &nbsp;&nbsp;<span class="rate">4.6 <i class="fa fa-star"></i></span> &nbsp;&nbsp;<span class="review">1200 Reviews</span></h1>
                <p class="sortb">Sort By:
                    <button class="sortbar_tab__3Bhn- sortbar_active__3Tw7A" data-att="{{$cat->id}}" data-sortsel="Recommended" value="Recommended" type="button">Recommended</button>
                    <button class="sortbar_tab__3Bhn- false" data-sortsel="New"  value="New" type="button">New</button>
                    <button class="sortbar_tab__3Bhn- false" data-sortsel="Price: Low to High"  value="Price: Low to High" type="button">Price: Low to High</button>
                    <button class="sortbar_tab__3Bhn- false"  data-sortsel="Price: High to Low"  value="Price: High to Low" type="button">Price: High to Low</button>
                </p>
			</div>
		</div>
	</div>
<!----------------------------------------------Filter Start ------------------------------------------------>
    <article class="vendors-filter" style="display:none;">
        <div class="container">
           <div class="row">
           <div class="col-lg-12 vendors-lable">
           <a data-toggle="collapse" href="#top-filter" class="filterhea" role="button" aria-expanded="false" aria-controls="top-filter" id="sidebarCollapse">
             <i class="fa fa-caret-right" aria-hidden="true"></i> Filter</a></div>
           </div>
        </div>
    </article>
    <article class="collapse sidebarnav mt-4 " id="top-filter">
	    <div class="card card-body">
		  <div class="container">

		    </div>
		</div>

	</article>

<!-------------------------------------------------End Filters ------------------------------------------------------------>

    <!-- Products Start -->
    <div class="container pt-5 pb-3">
        <div class="row">
            <div class="col-lg-3">
                <div class="filter_section">
                <div class="row mx-0">
		                    <div class="col-12 p-0" id="catFilters"></div>

                                <div class="col-md-12 col-sm-12 col-lg-12 vendors-list scroll">
                                    <h5>Price</h5>
                                    <?php $pricee=App\Models\PriceRange::get(); ?>
                                    <?php $counter1=0; ?>
                                    @if(!empty($pricee))
                                    @foreach ($pricee as $pricee)
                                    <div class="custom-style">
                                        <input name="price" type="checkbox" value="{{$pricee->id}}" id="price{{$pricee->id}}" onclick="filterResults()">
                                        <label for="price{{$pricee->id}}">{{ $pricee->title }}</label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="col-md-12 col-sm-12 col-lg-12 vendors-list scroll">
                                    <h5>Stock Status</h5>
                                    <div class="custom-style">
                                    <input name="stock" type="checkbox" value="instock" id="stock" onclick="filterResults()">
                                    <label for="stock">Instock</label>
                                    </div>
                                    <div class="custom-style">
                                    <input name="stock" type="checkbox" value="outofstock" id="stockk" onclick="filterResults()">
                                    <label for="stockk">Outofstock</label>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-lg-12 vendors-list scroll">
                                    <h5>Discount</h5>
                                    <?php $discount=App\Models\FilterDiscount::get(); ?>
                                    <?php $counter2=0; ?>
                                    @if(!empty($discount))
                                    @foreach ($discount as $discount)
                                    <div class="custom-style">
                                        <input name="discount" type="checkbox" value="{{$discount->id}}" id="discount{{$discount->id}}" onclick="filterResults()">
                                        <label for="discount{{$discount->id}}">{{ $discount->dtitle }}</label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>


                                <div class="col-md-12 col-sm-12 col-lg-12 vendors-list scroll">
                                    <h5>Category</h5>
                                    <?php $category=App\Models\Category::get(); ?>
                                    <?php $counter3=0; ?>
                                    @if(!empty($category))
                                    @foreach ($category as $category)
                                    <div class="custom-style">
                                        <input name="categoryy" type="checkbox" value="{{$category->id}}" id="categoryy{{$category->id}}" onclick="filterResults()">
                                        <label for="categoryy{{$category->id}}">{{ $category->cat_name }}</label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                                <!--<div class="col-md-12 col-sm-12 col-lg-12 vendors-list ven_last scroll" style="display:none;">
                                <h5>Attribute</h5>
                                <?php $counter=0;
                                ?>
                                    @if(!empty($attribute))
                                    @foreach ($attribute as $attribute)
                                    <h6 class="colorh">{{ $attribute->attr_name }}</h6>
                                    <?php $attvalue = App\Models\AttributeValue::where('attr_id',$attribute->id)->get(); ?>
                                    <div class="custom-style">
                                    @foreach($attvalue as $attvalue)
                                    <input name="attribute" type="checkbox" value="{{$attvalue->id}}" id="attval{{$attvalue->id}}">
                                    <label for="attval{{$attvalue->id}}">{{ $attvalue->attr_value_title	 }}</label >
                                    @endforeach
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="col-md-12 col-sm-12 text-center">
                                        <div class="buttom-gorup">
                                        <button type="submit" id="filter" class="submit-bnt">Submit</button>
                                        </div>

                                        <div class="buttom-gorup"><form method="get" action="{{url('/')}}/sub/{{$sub->id}}">
                                                <button type="submit" class="submit-bnt">Reset</button>
                                            </form> </div>
                                        </div>

                                </div>-->

		        </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="product_list_section">
                            <div class="row">
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
                        <div class="col-lg-4 col-md-4 col-sm-6 pb-1" data-aos="fade-left" data-aos-delay="200">
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
                                <!--        <a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->
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
		<div class="text-center"> <a href="" class="btn btn-primary mx-0">Show More Products</a></div>
                </div>
            <div>
        </div>
</div>



</div>
                                        </div>
    <!-- Products End -->


<!--======================================= Trending Products============================================--->
@if($trend->count() > 0)
<div class="container pt-5 pb-3">

        <h2 class="section-title position-relative text-center mb-5" data-aos="fade-up" data-aos-delay="400" >Trending Products
            <div class="right_viewall"><a href="{{url('/cp/trend')}}" class="btn btn-primary mr-0">View All</a></div>
        </h2>
        <div class="row justify-content-center">
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
                        <!--    <a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->

                        </div>
                    </div>
                    <div class="text-center py-2">
					 <div class="d-flex align-items-center justify-content-center review_star mb-1">
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
    <div class="container">
        <div class="text-center">
            <h3 class="heading mb-5" data-aos="fade-up" data-aos-delay="300">What People are saying?</h3>
        </div>
            <div class="row justify-content-center">
                @foreach($testimonial as $testimonial)
                <div class="col-lg-4 col-md-6 col-12 box box" data-aos="fade-left" data-aos-delay="100">
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


@push('after-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$("button").click(function() {
    var sortsel = $(this).val();

    if ($(this).val() != "") {
        location.href = '{{url()->current()}}?sortby=' + $(this).val();
    } else {
        location.href = "{{route('products.productindex', $sub->id)}}";
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

        let href = '{{url('/')}}/subproducts/{{$sub->id}}?';

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
