<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>

<script src="{{asset('assets/js/page/carousel-preload.js')}}"></script>
<!--[if IE 8]><html class="ie8"><![endif]-->
<!-- Bootstrap -->
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700,800,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('css/user.css')}}">

<!--<script src="https://use.fontawesome.com/f19af31a67.js"></script>-->


<!-- Plugins -->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/magnific-popup.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl.theme.css')}}">
<!-- Theme -->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/carousel-animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">

@stack('after-styles')

</head>
<body>	<!-- Header End -->
	<!-- Body Start -->
	<br>
	<article class="col-md-9 ml-sm-auto col-lg-9">
		<div class="dashboard-box">
		<h3>Orders</h3>
		<hr>
		    <?php
				    $user = App\Models\User::where('id',$order->user_id)->first();
				    ?>

		<div><div class="card-box">
                <div class="card-body p-0">
                    <div class="row p-4">
                        <div class="col-md-6">
                            <img src="{{asset('assets/images/logo/l1.png')}}" class="text-left">
                             <?php $coo = App\Models\Contact::where('id','1')->first(); ?>
                            <p>{{$coo->address}}</p>
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1">Invoice {{$order->order_id}}</p>
                            <p class="text-muted">Order Date:{{$order->created_at}}</p>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="row pb-5 p-4">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Shipping Information</p>
                             <p class="mb-1">{{$order->firstname}}</p>
                            <p>{{$order->address}} </p>
                            <p class="mb-1">{{$order->city}}</p>
                            <p class="mb-1">{{$order->state}}</p>
                            <p class="mb-1">{{$order->pincode}}</p>
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-4">Payment Details</p>
                            <p class="mb-1"><span class="text-muted">Payment Type: </span> {{$order->payment_type}}</p>
                        </div>
                    </div>
                     <hr class="my-3">
<?php
                    $bill = App\Models\BillingAddress::where('user_id',Auth::user()->id)->first(); ?>
                    <div class="row pb-5 p-4">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Billing Information</p>
                            <p class="mb-1">{{$bill->billing_name}}</p>
                            <p>{{$bill->billing_address}} </p>
                            <p class="mb-1">{{$bill->billing_state}}</p>
                            <p class="mb-1">{{$bill->billing_city}}</p>
                            <p class="mb-1">{{$bill->billing_pincode}}</p>
                        </div>
                    </div>

                    <div class="row p-4">
                        <div class="col-md-12">
                            <div class="table-responsive">
                             <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Image</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Product Name</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Price</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Change Status</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Reason</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Image</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Extra Fields</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Any Other Comments</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i=1;?>
                                @foreach($orderitems as $row)
                                <?php
                                    $product = App\Models\Product::where('id',$row->product_id)->first();
                                    if($product->is_variation == 1){
                                        $provar = App\Models\AddSubVariation::where('id',$row->variation_id)->where('product_id',$row->product_id)->first();
                                        $product_images = App\Models\ProductImage::where('variation_product_id',$row->variation_id)->where('product_id',$row->product_id)->first();
                                        $price = $provar->price;
                                        $image = $product_images->images;
                                    }else{
                                        $price = $product->price;
                                        $product_image = App\Models\ProductImage::where('product_id',$row->product_id)->first();
                                        $image = $product_image->images;
                                    }
                                ?>
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>
                                                <img style="width:20%" src="{{asset('uploads/images/') }}/{{$product_image->images}}">
                                            </td>
                                            <td>{{ @$product->product_name }}</td>
                                            <td>&#8377;{{ @$row->price }}</td>
                                            <td>{{ @$row->quantity }}</td>
                                            <td>&#8377;@if($row->quantity != "undefined") {{$price * $row->quantity}} @else  {{$price}} @endif</td>
                                            <td>
                                               {{$row->status}}
                                            </td>
                                            <td>{{$row->return_reason}}</td>
                                            <td><img style="width:20%" src="{{ asset('uploads/images/') }}/{{ @$row->image }}"></td>
                                            <td>
                                                @if($row->giftwrap == 1)
                                                <p><strong> Gift Wrap Price</strong></p>
                                                <p>{{$row->giftwrap_price}}</p>
                                                @endif
                                                @if($product->textareaa == 1)
                                                <p><strong>{{$product->textarea_name}}</strong></p>
                                                <p>{{$row->description}}</p>
                                                @endif
                                                @if($product->text_field == 1)
                                                <p><strong>{{$product->text_heading}}</strong></p>
                                                <p>{{$row->addtext1}}</p>
                                                @endif
                                                @if($product->location == 1)
                                                <p><strong>Location</strong></p>
                                                <p>{{$row->location}}</p>
                                                @endif
                                                @if($product->eggoreggless == 1)
                                                <p><strong>Egg Type</strong></p>
                                                <p>{{$row->egg_type}}</p>
                                                @endif
                                                @if($product->datee == 1)
                                                <p><strong>Date</strong></p>
                                                <p>{{$row->datee}}</p>
                                                @endif
                                                @if($product->timee == 1)
                                                <p><strong>Time</strong></p>
                                                <p>{{$row->timee}}</p>
                                                @endif
                                                @if($product->self_pickup == 1)
                                                <p><strong>Pickup Type</strong></p>
                                                <p>{{$row->pickup_type}}</p>
                                                @endif
                                                @if($product->flower_type_option == 1)
                                                <p><strong>Flower Type</strong></p>
                                                <p>{{$row->flowerss_type}}</p>
                                                @endif
                                                @if($product->addatext_option == 1)
                                                <p><strong>{{$product->addatext_heading}}</strong></p>
                                                <p>{{$row->addtext2}}</p>
                                                @endif
                                                @if($product->frontandbackprint_option == 1)
                                                <p><strong>Front and Back Print</strong></p>
                                                <p>{{$row->printside}}</p>
                                                @endif
                                                @if($product->single_option == 1)
                                                <p><strong>Single Color</strong></p>
                                                <p>{{$row->colortype}}</p>
                                                @endif
                                                @if($product->imageuploadoption == 1)
                                                <?php
                                                    $image = explode(',',$row->product_images_id);?>
                                                    <p><strong>{{$product->imageuploadoption_heading}}</strong></p>
                                                    @foreach($image as $image)
                                                    <?php $proimg = App\Models\StoreProductCartImage::where('id',$image)->first();?>
                                                    <a href="{{asset('uploads/images')}}/{{$proimg->cart_images}}" download>{{$proimg->cart_images}}</a>
                                                   @endforeach
                                                @endif
                                                @if($product->uploadlogo_option == 1)
                                                <?php
                                                    $logo = explode(',',$row->product_logos_id);?>
                                                    <p><strong>{{$product->uploadlogo_heading}}</strong></p>
                                                    @foreach($logo as $logo)
                                                    <?php $prolog = App\Models\StoreProductCartLogo::where('id',$logo)->first();?>
                                                    <a href="{{asset('uploads/images')}}/{{$prolog->cart_logo}}" download>{{$prolog->cart_logo}}</a>
                                                    @endforeach
                                                @endif
                                                @if($row->variation_id != null)
                                                <?php $provar = App\Models\AddSubVariation::where('id',$row->variation_id)->first();
                                                    $var = App\Models\Addsubvariationn::where('var_id',$row->variation_id)->get();
                                                ?>
                                                    @foreach($var as $var)
                                                    <?php $attribute = App\Models\Attribute::where('id',$var->main_attr_id)->first();
                                                         $attributevalue = App\Models\AttributeValue::where('id',$var->main_attr_value)->first();
                                                    ?>
                                                    <p><strong>{{$attribute->attr_name}}</strong></p>
                                                    <p>{{$attributevalue->attr_value_name}}</p>
                                                    @endforeach
                                                @endif
                                                @if($row->cart_combo_id != null)
                                                    <?php $exp =explode(',',$row->cart_combo_id); ?>
                                                    @foreach($exp as $cart_combo_id)
                                                    <?php $ccom= App\Models\StoreCartCombo::where('id',$cart_combo_id)->first();
                                                        $procomm = App\Models\ProductCombo::where('id',$ccom->combo_id)->first();
                                                        $attributevalue = App\Models\AttributeValue::where('id',$ccom->att_id)->first();
                                                        $attribute=App\Models\Attribute::where('id',$ccom->attribute)->first();
                                                    ?>
                                                    @if($procomm != null)<p><strong>{{$procomm->button_name}}</strong></p>@endif
                                                    @if($procomm != null)<p><strong>{{$procomm->combo_text_heading}}</strong></p>@endif
                                                    <p>{{$ccom->comboaddtext1}}</p>
                                                    <p><strong>{{$attribute->attr_name}}</strong></p>
                                                    <p>{{$attributevalue->attr_value_name}}</p>
                                                    @endforeach
                                                @endif
                                                @if($row->charm_id != null)
                                                    <?php $expchar =explode(',',$row->charm_id); ?>
                                                    @foreach($expchar as $charm_id)7
                                                    <?php
                                                          $prcharop = App\Models\ProductSelectOption::where('id',$charm_id)->first();
                                                          $prchar = App\Models\ProductSelectHeading::where('id',$prcharop->product_select_id)->first();
                                                          $procom1 = App\Models\ProductCombo::where('id',$prcharop->combo_id)->first();
                                                    ?>
                                                    @if($procom1 != null)<p><strong>{{$procom1->button_name}}</strong></p>@endif
                                                    @if($procom1 != null)<p><strong>{{$procom1->comboaddtext1}}</strong></p>@endif
                                                    <p><strong>{{$prchar->product_select_title}}</strong></p>
                                                    <p>{{$prcharop->product_select_option}}
                                                    @if($prcharop->product_select_option_price != null)
                                                    &#8377;&nbsp;{{$prcharop->product_select_option_price}}</p>
                                                    @endif
                                                    @endforeach
                                                @else
                                                    @if($row->charm_id != null)
                                                    <?php $charm = explode(',',$row->charm_id)?>
                                                    @foreach($charm as $charm)
                                                    @php $prcharop = App\Models\ProductSelectOption::where('id',$charm)->first();
                                                    $prchar = App\Models\ProductSelectHeading::where('id',$prcharop->product_select_id)->first();  @endphp
                                                    <p><strong>{{$prchar->product_select_title}}</strong></p>
                                                    <p>{{$prcharop->product_select_option}}
                                                    @if($prcharop->product_select_option_price != null)
                                                    &#8377;&nbsp;{{$prcharop->product_select_option_price}}</p>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if($product->comment == 1)
                                                <p><strong>{{$product->comment_heading}}</strong></p>
                                                <p>{{$row->comment}}</p>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $i++;?>
                                        @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div></div>

                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="p-r-20 p-l-20 text-right">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2 font-weight-light">₹{{$order->payable_price}}</div>
                        </div>


                    </div>
            			<hr>
						<div class="text-right mb-3"><button class="btn btn-danger btn-sm mr-5" type="button" onclick="window.print()">Print</button></div>

                </div>
            </div>
        </div>

		</article>






</div><!-- Body inner end -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('assets/js/page/page.navbar-transparent-fixed-shrinked.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('assets/js/jquery.waypoints.js')}}"></script>
<script src="{{asset('assets/js/jquery.countTo.js')}}"></script>
<script src="{{asset('assets/js/page/theme.js')}}"></script>
<script src="{{asset('assets/js/page/page.home.js')}}"></script>
<script src="{{asset('assets/js/page/page.portfolio.js')}}"></script>
<script src="{{asset('assets/js/jquery.mixitup.js')}}"></script>
<script src="{{asset('assets/js/page/theme.js')}}"></script>
<script src="{{asset('assets/js/page/mix1.js')}}"></script>



 <script src="{{asset('assets/js/page/page.about-us-option-2.js')}}"></script>

<script>

	$('.nav-search').on('click', function () {
		$('.search-block').fadeIn(350);
	});

	$('.search-close').on('click', function () {
		$('.search-block').fadeOut(350);
	});


	</script>



	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

	<script>

	$(document).ready(function(){

$('.gallery_items').slick({
dots: true,
infinite: true,
speed: 800,
autoplay: true,
autoplaySpeed: 2000,
slidesToShow: 1,
slidesToScroll: 1,
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 1,
slidesToScroll: 1,
infinite: true,
dots: true
}
},
{
breakpoint: 600,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
},
{
breakpoint: 480,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
}

]
});
});
	</script>


	<script>

	$(document).ready(function(){

$('.stories_items').slick({
dots: true,
infinite: true,
speed: 800,
autoplay: true,
autoplaySpeed: 2000,
slidesToShow: 1,
slidesToScroll: 1,
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 1,
slidesToScroll: 1,
infinite: true,
dots: true
}
},
{
breakpoint: 600,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
},
{
breakpoint: 480,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
}

]
});
});
	</script>

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(){
        /////// Prevent closing from click inside dropdown
        document.querySelectorAll('.dropdown-menu').forEach(function(element){
        	element.addEventListener('click', function (e) {
        		e.stopPropagation();
        	});
        })
    });
	// DOMContentLoaded  end
</script>

      @stack('after-scripts')
</body>
</html>
