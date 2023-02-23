@push('after-styles')
<link href="{{asset('css/custstyle.css')}}" rel="stylesheet"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <!------ image links-------->
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
<!---image link end---->
<style>

/* logo upload option*/
.img-divv {
    position: relative;
    width: 46%;
    float:left;
    margin-right:5px;
    margin-left:5px;
    margin-bottom:10px;
    margin-top:10px;
}

.image {
    opacity: 1;
    display: block;
    width: 100%;
    max-width: auto;
    transition: .5s ease;
    backface-visibility: hidden;
}

.middle {
    transition: .5s ease;
    opacity: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    text-align: center;
}

.img-divv:hover .image {
    opacity: 0.3;
}

.img-divv:hover .middle {
    opacity: 1;
}
/* image upload option*/
.img-div {
    position: relative;
    width: 46%;
    float:left;
    margin-right:5px;
    margin-left:5px;
    margin-bottom:10px;
    margin-top:10px;
}

.image {
    opacity: 1;
    display: block;
    width: 100%;
    max-width: auto;
    transition: .5s ease;
    backface-visibility: hidden;
}

.middle {
    transition: .5s ease;
    opacity: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    text-align: center;
}

.img-div:hover .image {
    opacity: 0.3;
}

.img-div:hover .middle {
    opacity: 1;
}
/*rating*/
    .rating {
      float:left!important;
    }
    .rating:not(:checked) > input {
        position:absolute;
        clip:rect(0,0,0,0);
    }

    .rating:not(:checked) > label {
        float:right;
        width:1em;
        /* padding:0 .1em; */
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:220%;
        /* line-height:1.2; */
        color:#ddd;
    }

    .rating:not(:checked) > label:before {
        content: '★ ';
    }

    .rating > input:checked ~ label {
        color: #ff8f17;

    }

    .rating:not(:checked) > label:hover,
    .rating:not(:checked) > label:hover ~ label {
        color: #ff8f17;

    }

    .rating > input:checked + label:hover,
    .rating > input:checked + label:hover ~ label,
    .rating > input:checked ~ label:hover,
    .rating > input:checked ~ label:hover ~ label,
    .rating > label:hover ~ input:checked ~ label {
        color: #ff8f17;

    }

    .rating > label:active {
        position:relative;
        top:2px;
        left:2px;
    }
    .btn-sub
        {
            background-color: #f28b00!important;
            margin:20px 0px!important;
        }
    </style>

<style>
button.btn {
    background: #c2272d;
    color: white;
    width: 32%;
    font-size: 18px;
    font-weight: 600;
    border-radius: 4px;
}

.col-lg-5.product-imgs.mrt {
    margin: -85px 0 0 0;
}
.col-lg-5.product-imgs.mrtp {
    margin: -110px 0 0 0;
}
    /* custstylecss*/
    .deco {
    font-size: 27px;
    text-decoration: underline;
    font-weight: 100!important;
}
.inputclass11 {
    width: 100%;
    background: lightgray;
    padding: 15px 17px;
    border: 1px solid #c7c1c1;
    margin: 10px 0px;
    font-size: 15px;
}
input[type="checkbox"] {
    display: block;
}
button.btnn {
    padding: 10px 10px;
    border: none;
    background: none!important;
    color: #000!important;
    width: 32%;
    border-radius: 0px!important;
}
button.havedesign{
    background-color: #29ab1b;
    color: #fff;
    border-radius: 14px;
    border: none;
    padding: 5px 0 9px 0px;
    width: 70%;
    font-size: 24px;
}
</style>
<style>
	button.btn {
    background: #c2272d;
    color: white;
    width: 32%;
    font-size: 18px;
    font-weight: 600;
    border-radius: 4px;
}
.card-wrapper {
    max-width: 1100px;
    margin: 0px auto;
}
/*img{
    width: 100%;
    display: block;
}*/
.img-display{
    overflow: hidden;
}
.img-showcase{
    display: flex;
    width: 100%;
    transition: all 0.5s ease;
}
.img-showcase img{
    min-width: 100%;
}
.img-select{
    display: flex;
}
.img-item{
    margin: 0.3rem;
}
.img-item:nth-child(1),
.img-item:nth-child(2),
.img-item:nth-child(3){
    margin-right: 0;
}
.img-item:hover{
    opacity: 0.8;
}
.product-content{
    padding: 2rem 1rem;
}
.product-title {
    font-size: 26px;
    text-transform: capitalize;
    font-family: 'Mulish', sans-serif;
    font-weight: 700;
    position: relative;
    color: #080808;
    margin: 0px 0 24px 0;
}
.product-title::after{

    content: "";
    position: absolute;
    left: 0;
    bottom: -12px;
    height: 1px;
    width: 100%;
    background: #12263a;

}
.product-link{
    text-decoration: none;
    text-transform: uppercase;
    font-weight: 400;
    font-size: 0.9rem;
    display: inline-block;
    margin-bottom: 0.5rem;
    background: #256eff;
    color: #fff;
    padding: 0 0.3rem;
    transition: all 0.5s ease;
}
.product-link:hover{
    opacity: 0.9;
}
.product-rating {
   color: #ffc107;
    text-align: right;
    font-size: 12px;
    margin: -18px 0 0px 0;
}


.product-rating span{
    font-weight: 600;
    color: #252525;
}
.product-price{
    margin:0 0 40px 0;
    font-size: 1rem;
    font-weight: 700;
}
.product-price span{
    font-weight: 400;
}
.last-price span{
    color: #f64749;
    text-decoration: line-through;
}
.new-price span{
    color: #256eff;
}
.product-detail h2{
    text-transform: capitalize;
    color: #12263a;
    padding-bottom: 0.6rem;
}
.product-detail p{
    font-size: 0.9rem;
    padding: 0.3rem;
    opacity: 0.8;
}
.product-detail ul{
    margin: 1rem 0;
    font-size: 0.9rem;
}
.product-detail ul li{
    margin: 0;
    list-style: none;
    background: url(https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/checked.png) left center no-repeat;
    background-size: 18px;
    padding-left: 1.7rem;
    margin: 0.4rem 0;
    font-weight: 600;
    opacity: 0.9;
}
.product-detail ul li span{
    font-weight: 400;
}
.purchase-info{
    margin: 1.5rem 0;
}
.purchase-info input,
.purchase-info .btn{
    border: 1.5px solid #ddd;
    border-radius: 25px;
    text-align: center;
    padding: 0.45rem 0.8rem;
    outline: 0;
    margin-right: 0.2rem;
    margin-bottom: 1rem;
}
.purchase-info input{
    width: 60px;
}
.purchase-info .btn{
    cursor: pointer;
    color: #fff;
}
.purchase-info .btn:first-of-type{
    background: #256eff;
}
.purchase-info .btn:last-of-type{
    background: #f64749;
}
.purchase-info .btn:hover{
    opacity: 0.9;
}
.social-links{
    display: flex;
    align-items: center;
}
.social-links a{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    color: #000;

    margin: 0 0.2rem;
    border-radius: 50%;
    text-decoration: none;
    font-size: 0.8rem;
    transition: all 0.5s ease;
}
.social-links a:hover{
    background: #000;
    border-color: transparent;
    color: #fff;
}

@media screen and (min-width: 992px){
    .card{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 1.5rem;
    }
    .card-wrapper{
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .product-imgs{
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .product-content{
        padding-top: 0;
    }
}


.timecss {
    width: 100%;
    padding: 14px 27px;
    color: #000;
    background: #F2F2F2;
    border-radius: 5px;
    border: none;
}

/*.input-group-append1 {
    padding: 10px;
    font-size: 20px;
    background: #F2F2F2;
}*/
.loc {
    border-radius: 5px;
    border: 1px solid #F2F2F2;
    background: #F2F2F2;
}

.check {
    width: 100%;
    padding: 10px 17px;
    border: none!important;
    border-radius: 6px;
    font-size: 15px;
    background-color: #c2272d;
    color: #fff;
}
/* Input Radio variation checking
input[type="radio"]:checked.btn {
    background: #c2272d;
    color: white;
    width: 100%;
    border-radius: 4px;
    border: none;
}

input[type="radio"].btn {
    background: #f4f4f4;
    color: black;
    width: 100%;
    border-radius: 4px;
    border: none;
}

input[type="radio"].btn.btn-primary-sign {
    width: 100%;
    margin: 0 0px 0 0;
}
*/

.boxed label {
    background: #f4f4f4;
    color: black;
  display: inline-block;
  width: 200px;
  padding: 10px;
  border-radius: 4px;
    border: none;
    text-align: center;
}

.boxed input[type="radio"] {
  display: none;
}
.LargeOptionRadio--checked {
    background: #c2272d !important;
    color: white !important;
    border-radius: 4px !important;
    border: none !important;
}
.boxed input[type="radio"]:checked + label {
  background: #c2272d;
    color: white;
    border-radius: 4px;
    border: none;
}
</style>
<style>
    nav.bg-light{
        background-color: white !important;
    }

   /* .img-showcase{
        display: none;
    }*/
</style>
<style>
/*Image upload option*/
.image-uploader {
    min-height: 3rem!important;
    border: 1px solid #d9d9d9;
    position: relative;
    background:#eeeeee;
    border-radius:5px;
}
	.image-uploader .upload-text i
	{
	    display:none!important;
	}

</style>
@endpush
@extends('layouts.app')
@section('title', 'Product Detail')
@section('content')
<!-- Breadcrumb Start -->
<div class="container">
    <div class="row mb-3">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Gifts</a>
                <a class="breadcrumb-item text-dark" href="#">Cakes </a>
                <span class="breadcrumb-item active">Regular Cakes</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<!-- Carousel End -->
<div class="container">
    @if($product->is_variation == '1')
    <?php
        $attribute = App\Models\ProductVariation::where('product_id', $product->id)->get();
        $variationsss = App\Models\AddSubVariation::where('product_id', $product->id)->first();
        $provar = App\Models\AddSubVariation::where('product_id',$product->id)->get();
        $productimg = App\Models\ProductImage::where('product_id', $product->id)->where('variation_product_id',$variationsss->id)->get();
        $producimg = App\Models\ProductImage::where('product_id', $product->id)->where('variation_product_id',$variationsss->id)->get();
    ?>

    <div class="row align-items-start">
            <!-- card left -->
        <div class="col-lg-5 product-imgs mrt">
            <div class="img-display">
                <div id="imggs">
                    <div class="img-showcase" id="imggs">
                    @foreach($productimg as $productimg)
                        <img src="{{ asset('uploads/images/') }}/{{$productimg->images}}">
                    @endforeach
                    </div>
                </div>
            </div>

            <div class = "img-select" id="imggss">
                <?php $i = 1; ?>
                @foreach($producimg as $producimg)
                <div class = "img-item">
                    <a href = "#" data-id = "{{$i}}">
                        <img src = "{{ asset('uploads/images/') }}/{{$producimg->images}}" onclick="currentSlide({{$i}})"  height="100px">
                    </a>
                </div>
                <?php $i++; ?>
                @endforeach
            </div><br>
            <input type="hidden" name="product_id" id="productdd" value="{{$product->id}}"/>

            <p>Share with loved ones </p>
            <div class = "social-links">
                <a href = "#">
                <img src="{{ asset('img/icons/fb.png')}}">
                </a>
                <a href = "#">
                <img src="{{ asset('img/icons/tw.png')}}">
                </a>
                <a href = "#">
                <img src="{{ asset('img/icons/ins.png')}}">
                </a>
                <a href = "#">
                <img src="{{ asset('img/icons/ln.png')}}">
                </a>
                <a href = "#">
                <img src="{{ asset('img/icons/pin.png')}}">
                </a>
            </div>
        </div>
    	<div class = "col-lg-7 product-content">
            <h2 class = "product-title">{{$product->product_name}}
            <div class = "product-rating">
                <?php $rating = App\Models\Review::where('product_id',$product->id)->avg('rating'); ?>
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
            </h2>
            <div class="product-price">
                <div class="container px-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class = "new-price" id="pric-dd">₹{{$variationsss->price}}<span> (Inclusive of GST)</span></p>
                            <div class="fomright">
                                @if($product->eggoreggless == 1)
                                <div class="custom-control custom-radio custom-control-inline al-lft">
                                    <input type="radio" class="custom-control-input eggtype{{$product->id}}" id="size-1" value="Egg" name="egg_type">
                                    <label class="custom-control-label" for="size-1"> <img src="{{ asset('img/egg.png')}}" class="egg">Egg</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input eggtype{{$product->id}}" id="size-2" value="Egg Less" name="egg_type">
                                <label class="custom-control-label" for="size-2">  <img src="{{ asset('img/eggless.png')}}" class="eggless">Eggless</label>
                                </div>
                                @endif
                            </div>

                            @if($product->quantity_show == 1)
                            <h4 class="qun">Quantity</h4>
                            <div class="input-group quantity" style="width: 100px; border:1px solid gray;color:#000;">
                                <div class="input-group-btn">
                                    <button class="btnn btn-sm btn-primary1 btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary1 text-center quantity{{$product->id}}" name="quantity" value="1" style="border-color:#fff;font-size:20px; color:#000;">
                                <div class="input-group-btn">
                                    <button class="btnn btn-sm btn-primary1 btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @foreach($attribute as $attribute)
                    <?php $attname = App\Models\Attribute::where('id',$attribute->product_attr_id)->first();
                          $variantt = App\Models\Addsubvariationn::where('product_id',$product->id)->where('main_attr_id',$attribute->product_attr_id)->get();
                          $variant = $variantt->unique('main_attr_value');
                       // dd($variant);
                    ?>
                        @if($attname->attr_label == 'label')
                        <label class="slect-varient">Select Variant</label>
                        <div class="boxed">
                        @foreach($variant as $variant)
                        @if($variant->main_attr_id == $attribute->product_attr_id)
                        <?php
                            $attvalue = App\Models\AttributeValue::where('id',$variant->main_attr_value)->first();
                            $fetchvariant = App\Models\AddSubVariation::where('id',$variant->var_id)->first();
                            $producimgs = App\Models\ProductImage::where('product_id',$fetchvariant->product_id)->where('variation_product_id',$fetchvariant->id)->first();
                        ?>
                        <label class="LargeOptionRadio__label  LargeOptionRadio LargeOptionRadio{{$attvalue->id}}">
                            <input class="form-control sradioatt sradio{{$attvalue->id}} product-filter-item sradioo{{$product->id}}" value="{{$attvalue->id}}" name="attsname{{$attvalue->attr_id}}" type="radio" id="sradioatt" data-at="{{$attvalue->attr_id}}" data-attr="{{$attvalue->var_id}}"  onclick="getattr(); getclass(); getimages();">
                            <span class="sradio" data-name="{{$attname->attr_name}}"  data-price="{{$fetchvariant->price}}"  data-skucode="{{$fetchvariant->skucode}}" data-quantity="{{$fetchvariant->quantity}}" data-stock="{{$fetchvariant->stock}}">
                            {{$attvalue->attr_value_title}}
                        </label>
                         <!--<input type="radio" id="android{{$attvalue->id}}" name="attname" value="{{$attname->attr_name}}" onclick="getattr(); getclass(); getimages();">
                         <label for="android{{$attvalue->id}}">{{$attvalue->attr_value_title}}</label>-->
                       <!--<label class="boxed">
                        <input class="form-control btn" value="{{$attname->attr_name}}"  name="attname" type="radio" onclick="getclass(); getimages();">
                        <span>{{$attvalue->attr_value_title}}</span></label>-->
                        @endif
                        @endforeach
                        </div>
                        @endif
                        <?php $attnamee1 = App\Models\Attribute::where('id',$attribute->product_attr_id)->first();
                            $varianttt1 = App\Models\Addsubvariationn::where('product_id',$product->id)->where('main_attr_id',$attribute->product_attr_id)->get();
                            $variantt1 = $varianttt1->unique('main_attr_value');
                        ?>
                        @if($attnamee1->attr_label == 'color')
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="gst">Color </p>
                                <div class="preview">
                                    @foreach($variantt1 as $variantt1)
                                    @if($variantt1->main_attr_id == $attribute->product_attr_id)
                                    <?php   $attvaluee1 = App\Models\AttributeValue::where('id',$variantt1->main_attr_value)->first();
                                            $fetchvariantt1 = App\Models\AddSubVariation::where('id',$variantt1->var_id)->first();
                                            $producimgss1 = App\Models\ProductImage::where('product_id',$fetchvariantt1->product_id)->where('variation_product_id',$fetchvariantt1->id)->first();
                                    ?>
                                        <label><!--name="attr_{{$attnamee1->attr_name}}"-->
                                            <input type="hidden" name="product_id" value="{{$product->id}}"/>
                                            <input  style="background-color:{{$attvaluee1->attr_value_title}};" class="form-control cradio{{$attvaluee1->id}} product-filter-item colorradioo{{$product->id}}" value="{{$attvaluee1->id}}"  name="attname" type="radio" id="colorradio"  data-attr="{{$variantt1->var_id}}" data-attr-image="{{ asset('uploads/images/') }}/{{$producimgss1->images}}"  onclick="getattr(); getclass(); getimages();">
                                            <span  class="colorradio" data-name="{{$attnamee1->attr_name}}" data-bg-color="#{{$attvaluee1->attr_value_title}}" data-price="{{$fetchvariantt1->price}}"  data-skucode="{{$fetchvariantt1->skucode}}" data-quantity="{{$fetchvariantt1->quantity}}" data-stock="{{$fetchvariantt1->stock}}" class="size-code">
                                        </label>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        <?php $attnameee1 = App\Models\Attribute::where('id',$attribute->product_attr_id)->first();
                        $variantttt1 = App\Models\Addsubvariationn::where('product_id',$product->id)->where('main_attr_id',$attribute->product_attr_id)->get();
                        $varianttt2 = $variantttt1->unique('main_attr_value');
                        ?>
                        @if($attnameee1->attr_label == 'selectoption')
                            <label>{{$attnameee1->attr_name}}</label>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="pflex">
                                        <select class="form-select inputclass12 sselect{{$product->id}}" onclick="getattr(); getclass(); getimages();" name="sselectt" aria-label="Default select example" style="color: gray;">
                                            @foreach($varianttt2 as $varianttt2)
                                        <?php
                                        $attvalueeee1 = App\Models\AttributeValue::where('id',$varianttt2->main_attr_value)->first();
                                        $fetchvariantttt1 = App\Models\AddSubVariation::where('id',$varianttt2->var_id)->first();
                                        $producimgssss1 = App\Models\ProductImage::where('product_id',$fetchvariantttt1->product_id)->where('variation_product_id',$fetchvariantttt1->id)->first();
                                        ?>
                                        @if($varianttt2->main_attr_id == $attribute->product_attr_id)
                                        @if($loop->first) <option>Choose a {{$attnameee1->attr_name}}</option>@endif
                                        <option value="{{$attvalueeee1->id}}">{{$attvalueeee1->attr_value_title}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>











            @if($product->is_combo == 1)
            <?php  $procombopart = App\Models\ProductCombo::where('product_id',$product->id)->get();?>
                @foreach($procombopart as $procombopart)
                <div class="col-lg-6 ">
                    <p style="display: flex;">For {{$procombopart->button_name}}{{$procombopart->id}}:
                    <button class="logbtn1" value="{{$procombopart->id}}" type="button" data-id="{{$procombopart->id}}" data-box="buttonattr{{$procombopart->id}}">Show</button></p>
                </div>
                <input type="hidden" name="comboname" value="{{$procombopart->id}}" id="comboname">
                <div class="showonlyclick{{$procombopart->id}}" style="display: none;"  id="buttonattr{{$procombopart->id}}">
                    <div class="row">
                        @if($procombopart->combo_text_field == 1)
                        <div class="col-lg-12">
                            <h5 class="song">{{$procombopart->combo_text_heading}}<span class="char">@if($procombopart->combo_text_validation != "")(Max {{$procombopart->variation_text_validation}} characters ) @endif</span></h5><br>
                            <p style="display: flex;"><input type="text" class="inputclass11 comboaddtext1{{$procombopart->id}}" value="" id="comboaddtext1{{$procombopart->id}}" name="comboaddtext1" maxlength="{{$procombopart->combo_text_validation}}" placeholder="Type here" style=""></p>
                        </div>
                        @endif
                    </div>
                    <?php $attributecom = App\Models\ProductComboVariation::where('product_id', $product->id)->get();?>
                    @foreach($attributecom as $attributecom)
                    <?php
                    $attnamee1com = App\Models\Attribute::where('id',$attributecom->product_combo_attr_id)->first();
                    $varianttt1combo = App\Models\ProductCombooo::where('product_id',$product->id)->where('combo_attr_id',$attributecom->product_combo_attr_id)->where('combo_id',$procombopart->id)->get();
                    $variantt1combo = $varianttt1combo->unique('combo_attr_value');
                    $fetchvarianttext1com = App\Models\ProductCombo::where('product_id',$product->id)->where('combo_attr_id',$attributecom->product_combo_attr_id)->where('id',$procombopart->id)->first();
                    ?>

                    @if($attnamee1com->attr_label == 'color')
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="gst">Color </p>
                            <div class="preview">
                                @foreach($variantt1combo as $variantt1combo)
                                 @if($variantt1combo->combo_attr_id == $attributecom->product_combo_attr_id)
                                 <?php  $attvaluee1co = App\Models\AttributeValue::where('id',$variantt1combo->combo_attr_value)->first();
                                        $fetchvariantt1co = App\Models\ProductCombo::where('id',$variantt1combo->combo_id)->first();
                                    ?>
                                    <label><!--name="attr_{{$attnamee1com->attr_name}}"-->
                                    <input type="hidden" name="productid" value="{{$product->id}}" id="productid{{$product->id}}"/>
                                    <input style="background-color:{{$attvaluee1co->attr_value_title}};" class="form-control comcradio{{$attvaluee1co->id}} product-filter-item colorradioo{{$product->id}}" value="{{$attvaluee1co->id}}"  name="comattsname" type="radio" id="comcolorradio" data-comboattr="{{$variantt1combo->combo_id}}" onclick="getcomboattr();">
                                    <span  class="comcolorradio" data-name="{{$attnamee1com->attr_name}}" data-bg-color="#{{$attvaluee1co->attr_value_title}}"  class="size-code">
                                    </label>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <?php $attnamecom = App\Models\Attribute::where('id',$attributecom->product_combo_attr_id)->first();
                    $varianttcom = App\Models\ProductCombooo::where('product_id',$product->id)->where('combo_attr_id',$attributecom->product_combo_attr_id)->where('combo_id',$procombopart->id)->get();
                    $variantcom = $varianttcom->unique('combo_attr_value');
                    ?>
                        @if($attnamecom->attr_label == 'label')
                        <label class="slect-varient">Select Variant</label>
                        <div class="boxed">
                        @foreach($variantcom as $variantcom)
                        @if($variantcom->combo_attr_id == $attributecom->product_combo_attr_id)
                        <?php
                            $attvaluecom = App\Models\AttributeValue::where('id',$variantcom->combo_attr_value)->first();
                            $fetchvariantcom = App\Models\ProductCombo::where('id',$variantcom->combo_id)->where('id',$procombopart->id)->first();
                        ?>
                            <input type="hidden" name="productid" value="{{$product->id}}" id="productid{{$product->id}}"/>
                            <label class="LargeOptionRadio__label">
                            <input class="form-control sradioatt comsradio{{$attvaluecom->id}} product-filter-item comsradioo{{$product->id}}" value="{{$attvaluecom->id}}" name="comboattsname" type="radio" id="comsradioatt" data-at="{{$attvaluecom->attr_id}}" data-attr="{{$attvaluecom->combo_id}}"  data-comboattr="{{$variantcom->combo_id}}" onclick="getcomboattr();">
                            <span class="comsradio" data-name="{{$attnamecom->attr_name}}" >
                            {{$attvaluecom->attr_value_title}}
                        </label>
                        @endif
                        @endforeach
                        </div>
                        @endif


                    @endforeach

                    <div class="row">
                        <?php  $optionheading = App\Models\ProductSelectHeading::where('product_id',$product->id)->where('combo_id',$procombopart->id)->get();?>
                        @foreach($optionheading as $optionheading)
                        <?php $option = App\Models\ProductSelectOption::where('product_id',$product->id)->where('product_select_id',$optionheading->id)->where('combo_id',$procombopart->id)->get(); ?>
                        <div class="col-lg-12">
                            <p class="pflex">
                                <select class="form-select inputclass12 charm_id{{$product->id}}" data-comboattrr="{{$optionheading->combo_id}}" onclick="getcharmid();" id="charm_idd" aria-label="Default select example" name="charm_id" style="color: gray;">
                                <option data-comboattrr="{{$optionheading->combo_id}}">{{$optionheading->product_select_title}}</option>
                                @foreach($option as $option)
                                <option value="{{$option->id}}" data-comboattrr="{{$optionheading->combo_id}}">{{$option->product_select_option}}</option>
                                @endforeach
                                </select>
                            </p>
                        </div>
                        @endforeach
                    </div>

                </div>
                    @endforeach
                @endif

                <div id="variationn-dd">
                </div>



            <div class="row img_upload_sec">
                @if($product->imageuploadoption == 1)
                <div class="col-lg-6">
                    <h5>{{$product->imageuploadoption_heading}}</h5>
                    <p style="display: flex;"> <input type="file" name="imageupload[]" multiple id="imageuploadd" class="imageupload{{$product->id}}" style="" accept="image/png, image/jpeg,image/jpg" ></p>
                    <div id="uploadimage_preview" style="width:100%;">
                    </div>
                </div>
                    <input type="hidden" name="imageuploadoption_validation" id="imageuploadoption_validation" class="imageuploadoption_validation{{$product->id}}" value="{{$product->imageuploadoption_validation}}">
                    <input type="hidden" name="imageuploadoption_size" id="imageuploadoption_size" class="imageuploadoption_size{{$product->id}}" value="{{$product->imageuploadoption_size}}">
                @else
                <div class="col-lg-6" style="display:none">
                    <h5>{{$product->imageuploadoption_heading}}</h5>
                    <p style="display: flex;"> <input type="file" name="imageupload[]" multiple id="imageuploadd" class="imageupload{{$product->id}}" style="" accept="image/png, image/jpeg,image/jpg" ></p>
                    <div id="uploadimage_preview" style="width:100%;"></div>
                </div>
                    <input type="hidden" name="imageuploadoption_validation" id="imageuploadoption_validation" class="imageuploadoption_validation{{$product->id}}" value="{{$product->imageuploadoption_validation}}">
                    <input type="hidden" name="imageuploadoption_size" id="imageuploadoption_size" class="imageuploadoption_size{{$product->id}}" value="{{$product->imageuploadoption_size}}">
                @endif
                @if($product->uploadlogo_option == 1)
                <div class="col-lg-6">
                    <h5>{{$product->uploadlogo_heading}}</h5>
                    <p style="display: flex;"> <input type="file" name="logoupload[]" multiple id="logouploadd" class="logoupload{{$product->id}}" style="" accept="image/png, image/jpeg,image/jpg" ></p>
                    <div id="logoimage_preview" style="width:100%;"></div>
                </div>
                <input type="hidden" name="uploadlogo_validation" id="uploadlogo_validation" class="uploadlogo_validation{{$product->id}}" value="{{$product->uploadlogo_validation}}">
                <input type="hidden" name="uploadlogo_size" id="uploadlogo_size" class="uploadlogo_size{{$product->id}}" value="{{$product->uploadlogo_size}}">
                @else
                <div class="col-lg-6" style="display:none;">
                    <h5>{{$product->uploadlogo_heading}}</h5>
                    <p style="display: flex;"> <input type="file" name="logoupload[]" multiple id="logouploadd" class="logoupload{{$product->id}}" style="" accept="image/png, image/jpeg,image/jpg" ></p>
                    <div id="logoimage_preview" style="width:100%;"></div>
                </div>
                <input type="hidden" name="uploadlogo_validation" id="uploadlogo_validation" class="uploadlogo_validation{{$product->id}}" value="{{$product->uploadlogo_validation}}">
                <input type="hidden" name="uploadlogo_size" id="uploadlogo_size" class="uploadlogo_size{{$product->id}}" value="{{$product->uploadlogo_size}}">
                @endif
                </div>
            <div class="row">
                @if($product->text_field == 1)
                <div class="col-lg-12">
                    <h5 class="song">{{$product->text_heading}}<span class="char">@if($product->text_validation != "")(Max {{$product->text_validation}} characters ) @endif</span></h5><br>
                    <p style="display: flex;"><input type="text" class="inputclass11 addtext1{{$product->id}}" name="addtext1" maxlength="{{$product->text_validation}}" placeholder="Type here" style="" ></p>
                </div>
                @endif
            </div>
            <div class="row">
                @if($product->addatext_option == 1)
                @if($product->is_variation == '1')
                <h2 class="deco">Input Personalization Details</h2>
                @endif
                <div class="col-lg-12">
                    <h5 class="song">{{$product->addatext_heading}}<span class="char">@if($product->addatext_validation != "")(Max {{$product->addatext_validation}} characters ) @endif</span></h5><br>
                    <p style="display: flex;"><input type="text" class="inputclass11 addtext2{{$product->id}}" name="addtext2" maxlength="{{$product->addatext_validation}}" placeholder="Type here" style="" ></p>
                </div>
                @endif
            </div>
            <div class="row">
                <?php  $optionheading = App\Models\ProductSelectHeading::where('product_id',$product->id)->whereNull('combo_id')->get();?>
                @foreach($optionheading as $optionheading)
                <?php $option = App\Models\ProductSelectOption::where('product_id',$product->id)->whereNull('combo_id')->where('product_select_id',$optionheading->id)->get(); ?>
                <div class="col-lg-12">
                    <p class="pflex">
                        <select class="form-select inputclass12 charm_id{{$product->id}}" onclick="getcharmid();" id="charm_idd" aria-label="Default select example" name="charm_id" style="color: gray;">
                        <option>{{$optionheading->product_select_title}}</option>
                        @foreach($option as $option)
                        <option value="{{$option->id}}">{{$option->product_select_option}}</option>
                        @endforeach
                        </select>
                    </p>
                </div>
                @endforeach
            </div>
            @if($product->single_option == '1')
                <div class="row">
                    <div class="col-lg-12">
                        <p class="pflex">
                            <select class="form-select inputclass12 printside{{$product->id}}" name="printside" style="color: gray;">
                            <option selected>Front And BackPrint</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            </select>
                        </p>
                    </div>
                </div>
            @endif
            @if($product->frontandbackprint_option == '1')
                <div class="row">
                    <div class="col-lg-12">
                        <p class="pflex">
                            <select class="form-select inputclass12 colortype{{$product->id}}" name="colortype" style="color: gray;">
                            <option selected>Single Color</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            </select>
                        </p>
                    </div>
                </div>
            @endif
            @if($product->location == 1)
            <div class="row pincode_sec">
                <div class="col-lg-10">
                <div class="input-group-append1">
                    <form class="mb-30 loc" action="">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent text-primary1">
                                <i class="fa fa-map-marker-alt"></i>
                            </span>
                            <input type="text" class="form-control border-0 p-4 timecss location{{$product->id}}" name="location" placeholder="Pincode/Location (only Bangalore)" style="color:#000!important;">
                            
                        </div>
                    </form>
                </div>
                </div>
                <div class="col-lg-2">
                    <button class="check">Check</button>
                </div>
            </div>
            @endif
            @if($product->flower_type_option == 1)
            <div class="row">
                <div class="col-lg-12">
                    <?php $flow = App\Models\ProductFlower::where('product_id',$product->id)->get();
                        $f=1;
                    ?>
                    @foreach($flow as $flow)
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input flowerss_type{{$product->id}}" id="flowerr{{$f}}" name="flowerss_type" value="{{$flow->product_flower_name}}"  >
                        <label class="custom-control-label" for="flowerr{{$f}}" style="color:#000;font-size:18px;">{{$flow->product_flower_name}}</label>
                    </div>
                    <?php $f++; ?>
                    @endforeach
                </div>
            </div>
            @endif


            <div class="row">
                @if($product->datee == 1)
                <div class="col-lg-6">
                    <input type="date"  name="datee" class="datecss datee{{$product->id}}" placeholder="Select Delivery Date"  onfocus = "(this.type = 'date')"  id = "date" >
                </div>
                @endif
                @if($product->timee == 1)
                <div class="col-lg-6">
                    <select name="timee" id="timee" class="timecss timee{{$product->id}}" id = "time">
                        @foreach($time as $time)
                            <option value="{{$time->button_name}}">{{$time->button_name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>

            @if($product->self_pickup == 1)
            <div class="row">
                <div class="col-lg-12">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input pickup_type{{$product->id}}" value="Self Pickup" id="selfpickup" name="pickup_type" >
                        <label class="custom-control-label" for="selfpickup" style="color:#000;font-size:18px;">Self Pickup</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input pickup_type{{$product->id}}" value="Delivery" id="delivery" name="pickup_type">
                        <label class="custom-control-label" for="delivery" style="color:#000;font-size:18px;">Delivery</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input pickup_type{{$product->id}}" value="Ola/Uber"  id="Ola/Uber" name="pickup_type">
                        <label class="custom-control-label" for="Ola/Uber" style="color:#000;font-size:18px;">Ola/Uber</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input pickup_type{{$product->id}}" value="Dunzo/Porter" id="Dunzo/Porter" name="pickup_type">
                        <label class="custom-control-label" for="Dunzo/Porter" style="color:#000;font-size:18px;">Dunzo/Porter</label>
                    </div>

                </div>
            </div>
            @endif
            @if($product->anyspecificdesign_option == 1)
            <p>Any specific design?<a href="{{url('/contactus')}}" style="color:#33cfff">Contact Us</a></p>
            @endif
            @if($product->giftwrapper_option == 1)
            <div class="row pure-veg gift_wrap ">
                <div class="col-lg-12 pure-veg">
                    <h5>Gift-Wrap:</h5>
                    <p style="display: flex;"><input type="checkbox" name="giftwrap" data-gif="{{$product->giftwrapper_price}}" id="giftwrap" class="giftwrap{{$product->id}}" style="width: 20px;" onclick="myFunction(); gettotal();"><span style="padding-left: 10px;">Add Gift wrap(+₹{{$product->giftwrapper_price}})</span></p>
                    <input type="hidden" class="giftwrap_price{{$product->id}}" id="giftwrappr"  name="giftwrap_price" value="{{$product->giftwrapper_price}}">
                </div>
            </div>
            <div class="row" id="nonvegprice">
                <div class="col-lg-12" id="text" style="display:none;">
                    <input type="text" value="" name="giftwrap">
                </div>
            </div>
            @endif
            @if($product->haveadesigninmind_option == 1)
            <button type = "button" class ="havedesign">Have a design in mind? WhatsApp Us!</button>
            @endif

            @if($product->textareaa == 1)
            <div class="form-group">
                <h5>{{$product->textarea_name}} <span class="text-danger1">@if($product->textarea_validation != "")(Max {{$product->textarea_validation}} characters) @endif</span></h5>
                <textarea class="form-control description{{$product->id}}" name="description" required id="message_popup" maxlength="{{$product->textarea_validation}}" cols="30" rows="4" tabindex="1" style="border: 1px solid #767676;"></textarea>
            </div>
            @endif

            @if($product->comment == 1)
            <div class="row comment_sec">
                <div class="col-lg-12">
                    <h5>{{$product->comment_heading}}</h5>
                    <p><input type="text" name="comment" class="inputclass  comment{{$product->id}}" style="width:100%;height:100px;"></p>
                </div>
            </div>
            @endif
            @if($product->query == 1)
            <div class="row">
                <div class="col-lg-12">
                    <!-- Button trigger modal -->
                    <a href="" data-toggle="modal" data-target="#exampleModalCenter" style="color: darkturquoise;font-size: 18px;">
                        For any Queries - Get in Touch
                    </a>
                </div>
            </div>
            @endif
            <!--@if($product->textareaa == 1)
            <div class="form-group">
                <label style="color: #333;">{{$product->textarea_name}}</label>
                <textarea class="form-control" name="description" required id="message_popup" maxlength="25" cols="30" rows="4" tabindex="1" style="border: 2px solid #c2272d; "></textarea>
            </div>
            @endif-->
            <div class="row">
                @if($product->stock_status == "outofstock")
                <div class="col-lg-6">
                <button type = "button" class = "logbtn notify{{$product->id}}" style="width: 100%; ">Notify Me</button>
                </div>
                <input type="hidden" value="{{@$product->id}}" name="product_id" class="product_id{{$product->id}}" />
                <input type="hidden" name="session_id" class="session_id" value="{{\Session::getId() }}">
                <input type="hidden"  name="price" value="{{$product->price}}" class="price{{$product->id}}">

                <script>
                $(document).ready(function(){

                $('.notify<?php echo $product->id; ?>').click(function(e){
                    var session_id = $('.session_id').val();
                    var product_id = $('.product_id<?php echo $product->id; ?>').val();
                    var _token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: "{{url('notifyinstock')}}",
                        method: "POST",
                        data: {'session_id':session_id,'product_id':product_id,_token: '{{ csrf_token() }}'},
                        dataType: "json",
                        success: function (response) {
                            if(response.status == 'success'){
                                Swal.fire(
                                'Added!',
                                'Notify Me',
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
                            <div class="col-lg-6">
            <button type = "button" class = "logbtn add-to-varcartt1{{$product->id}}"  style="background: #f2f2f2; color: black;  border: none;width: 100%;">ADD TO CART</button>
            </div>

            <input type="hidden" name="location_required" value="{{$proreq->location_required}}" class="location_required{{$product->id}}">
            <input type="hidden" name="datee_required" value="{{$proreq->datee_required}}" class="datee_required{{$product->id}}">
            <input type="hidden" name="timee_required" value="{{$proreq->timee_required}}" class="timee_required{{$product->id}}">
            <input type="hidden" name="textarea_required" value="{{$proreq->textarea_required}}" class="textarea_required{{$product->id}}">
            <input type="hidden" name="eggoreggless_required" value="{{$proreq->eggoreggless_required}}" class="eggoreggless_required{{$product->id}}">
            <input type="hidden" name="imageupload_required" value="{{$proreq->imageupload_required}}" class="imageupload_required{{$product->id}}">
            <input type="hidden" name="textfield_required" value="{{$proreq->textfield_required}}" class="textfield_required{{$product->id}}">
            <input type="hidden" name="logoupload_required" value="{{$proreq->logoupload_required}}" class="logoupload_required{{$product->id}}">
            <input type="hidden" name="addtext_required" value="{{$proreq->addtext_required}}" class="addtext_required{{$product->id}}">
            <input type="hidden" name="flowertype_required" value="{{$proreq->flowertype_required}}" class="flowertype_required{{$product->id}}">
            <input type="hidden" name="selfpickup_required" value="{{$proreq->selfpickup_required}}" class="selfpickup_required{{$product->id}}">

            <input type="hidden" value="{{@$product->id}}" name="product_id" class="product_id{{$product->id}}"/>
            <input type="hidden" name="session_id" class="session_id" value="{{\Session::getId() }}">
            <!--<input type="text"  name="price" id="price-dd"  class="price{{$product->id}}">-->
            <!-- <input type="text"  name="variation" id="variation-dd" class="variation{{$product->id}}">-->
            <div id="price-dd">
            </div>
            <div id="variation-dd">
            </div>

        <script>
        $(document).ready(function(){
           function loadcart(){
            $.ajax({
                method: "GET",
                url: "{{url('/load-cart-data')}}",
                success: function (response) {
                    //alert(response);
                    $('.cart_count').html('');
                    $('.cart_count').html(response.count);
                     //console.log(response.length);
                }
            });
        }

        $('.add-to-varcartt1<?php echo $product->id; ?>').click(function(e){
            var formData = new FormData();
            var a = $('#sradioatt:checked').data('at');
            var session_id = $('.session_id').val();
            var buttonid = $('.buttonid<?php echo $product->id; ?>').val();
            var eggtype = $('.eggtype<?php echo $product->id; ?>:checked').val();
            var quantity = $('.quantity<?php echo $product->id; ?>').val();
            var addtext1 = $('.addtext1<?php echo $product->id; ?>').val();
            var addtext2 = $('.addtext2<?php echo $product->id; ?>').val();
            var printside = $('.printside<?php echo $product->id; ?>').val();
            var colortype = $('.colortype<?php echo $product->id; ?>').val();
            var location = $('.location<?php echo $product->id; ?>').val();
            var flowerss_type = $('.flowerss_type<?php echo $product->id; ?>:checked').val();
            var datee = $('.datee<?php echo $product->id; ?>').val();
            var timee = $('.timee<?php echo $product->id; ?>').val();
            var pickup_type = $('.pickup_type<?php echo $product->id; ?>:checked').val();
            var giftwrap = $('.giftwrap<?php echo $product->id; ?>:checked').val();
            var giftwrap_price = $('.giftwrap_price<?php echo $product->id; ?>').val();
            var description = $('.description<?php echo $product->id; ?>').val();
            var comment = $('.comment<?php echo $product->id; ?>').val();
            var product_id = $('.product_id<?php echo $product->id; ?>').val();
            var variation_id = $('.variation<?php echo $product->id; ?>').val();
            var sradioo = $('.sradioo<?php echo $product->id; ?>:checked').val();
            var sselect = $('.sselect<?php echo $product->id; ?>:selected').val();
            var colorradioo = $('.colorradioo<?php echo $product->id; ?>:checked').val();
            var quantity = $('.quantity<?php echo $product->id; ?>').val();
            var price = $('.price<?php echo $product->id; ?>').val();
            var charm_id = $('.charm_id<?php echo $product->id; ?>').val();
            var imageval = $('.imageuploadoption_validation<?php echo $product->id; ?>').val();
            var imagesiz = $('.imageuploadoption_size<?php echo $product->id; ?>').val();
            var logoval = $('.uploadlogo_validation<?php echo $product->id; ?>').val();
            var logosiz = $('.uploadlogo_size<?php echo $product->id; ?>').val();

         //   var imageupload = $('.imageupload<?php echo $product->id; ?>').val();
         //   var logoupload = $('.logoupload<?php echo $product->id; ?>').val();
    var imageupload = $('#imageuploadd').prop('files')?.[0];
    var logoupload = $('#logouploadd').prop('files')?.[0];
    var _token = $('meta[name="csrf-token"]').attr('content');

    var imageupload = $("#imageuploadd")[0].files.length;
    var images = $("#imageuploadd")[0];

    for (var i = 0; i < imageupload; i++) {
        formData.append('imageupload' + i, images.files[i]);
    }
    var logoupload = $("#logouploadd")[0].files.length;
    var logo = $("#logouploadd")[0];

    for (var i = 0; i < logoupload; i++) {
        formData.append('logoupload' + i, logo.files[i]);
    }

    var location_required = $('.location_required<?php echo $product->id; ?>').val();
    var datee_required = $('.datee_required<?php echo $product->id; ?>').val();
    var timee_required = $('.timee_required<?php echo $product->id; ?>').val();
    var textarea_required = $('.textarea_required<?php echo $product->id; ?>').val();
    var eggoreggless_required = $('.eggoreggless_required<?php echo $product->id; ?>').val();
    var imageupload_required = $('.imageupload_required<?php echo $product->id; ?>').val();
    var textfield_required = $('.textfield_required<?php echo $product->id; ?>').val();
    var logoupload_required = $('.logoupload_required<?php echo $product->id; ?>').val();
    var addtext_required = $('.addtext_required<?php echo $product->id; ?>').val();
    var flowertype_required = $('.flowertype_required<?php echo $product->id; ?>').val();
    var selfpickup_required = $('.selfpickup_required<?php echo $product->id; ?>').val();

    formData.append('location_required', location_required);formData.append('datee_required', datee_required);
    formData.append('timee_required', timee_required);formData.append('textarea_required', textarea_required);
    formData.append('eggoreggless_required', eggoreggless_required);formData.append('imageupload_required', imageupload_required);
    formData.append('textfield_required', textfield_required);formData.append('logoupload_required', logoupload_required);
    formData.append('addtext_required', addtext_required);formData.append('flowertype_required', flowertype_required);
    formData.append('selfpickup_required', selfpickup_required);

    formData.append('logosiz', logosiz);formData.append('logoval', logoval);
    formData.append('imageval', imageval);formData.append('imagesiz', imagesiz);
    formData.append('imageupload', imageupload);formData.append('eggtype', eggtype);
    formData.append('price', price);formData.append('session_id', session_id);formData.append('a', a);
    formData.append('product_id', product_id);formData.append('quantity', quantity);
    formData.append('comment', comment);formData.append('description', description);
    formData.append('giftwrap_price', giftwrap_price);formData.append('giftwrap', giftwrap);formData.append('variation_id', variation_id);
    formData.append('pickup_type', pickup_type);formData.append('timee', timee);formData.append('sradioo', sradioo);
    formData.append('datee', datee);formData.append('flowerss_type', flowerss_type);formData.append('sselect', sselect);
    formData.append('location', location);formData.append('colortype', colortype);formData.append('colorradioo', colorradioo);
    formData.append('printside', printside);formData.append('charm_id', charm_id);formData.append('addtext2', addtext2);
    formData.append('addtext1', addtext1);formData.append('logoupload', logoupload);formData.append('buttonid', buttonid);
    formData.append('quantity', quantity);formData.append('eggtype', eggtype);formData.append('{{ csrf_token() }}',_token);

    $.ajax({
        url: "{{url('varadd-to-cart')}}",
        method: "POST",
        contentType: 'multipart/form-data',
        cache: false,
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        contentType: false,
        processData: false,
        data: formData,
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
            }else if(response.status == 'selected'){
                Swal.fire(
                        'Added!',
                        'Please Login As A Vendor To Add More Products',
                        'success'
                )
            }else if(response.status == 'attribute'){
                Swal.fire(
                        'Added!',
                        "Selected Atrribute Doesn't Exisits",
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



  <div class="col-lg-6">
    <button type = "button" class = "logbtn checkoutadd-to-varcartt1{{$product->id}}" style="width: 100%; ">BUY NOW</button>
  </div>


<input type="hidden" value="{{@$product->id}}" name="product_id" class="product_id{{$product->id}}"/>
<input type="hidden" name="session_id" class="session_id" value="{{\Session::getId() }}">
<!--<input type="text"  name="price" id="price-dd"  class="price{{$product->id}}">-->
<!-- <input type="text"  name="variation" id="variation-dd" class="variation{{$product->id}}">-->
<div id="price-dd">
</div>
<div id="variation-dd">
</div>

<script>
$(document).ready(function(){
    function loadcart(){
        $.ajax({
            method: "GET",
            url: "{{url('/load-cart-data')}}",
            success: function (response) {
                //alert(response);
                $('.cart_count').html('');
                $('.cart_count').html(response.count);
                //console.log(response.length);
            }
        });
    }
    $('.checkoutadd-to-varcartt1<?php echo $product->id; ?>').click(function(e){
        var formData = new FormData();
        var a = $('#sradioatt:checked').data('at');
        var session_id = $('.session_id').val();
        var buttonid = $('.buttonid<?php echo $product->id; ?>').val();
        var eggtype = $('.eggtype<?php echo $product->id; ?>:checked').val();
        var quantity = $('.quantity<?php echo $product->id; ?>').val();
        var addtext1 = $('.addtext1<?php echo $product->id; ?>').val();
        var addtext2 = $('.addtext2<?php echo $product->id; ?>').val();
        var printside = $('.printside<?php echo $product->id; ?>').val();
        var colortype = $('.colortype<?php echo $product->id; ?>').val();
        var location = $('.location<?php echo $product->id; ?>').val();
        var flowerss_type = $('.flowerss_type<?php echo $product->id; ?>:checked').val();
        var datee = $('.datee<?php echo $product->id; ?>').val();
        var timee = $('.timee<?php echo $product->id; ?>').val();
        var pickup_type = $('.pickup_type<?php echo $product->id; ?>:checked').val();
        var giftwrap = $('.giftwrap<?php echo $product->id; ?>:checked').val();
        var giftwrap_price = $('.giftwrap_price<?php echo $product->id; ?>').val();
        var description = $('.description<?php echo $product->id; ?>').val();
        var comment = $('.comment<?php echo $product->id; ?>').val();
        var product_id = $('.product_id<?php echo $product->id; ?>').val();
        var variation_id = $('.variation<?php echo $product->id; ?>').val();
        var sradioo = $('.sradioo<?php echo $product->id; ?>:checked').val();
        var sselect = $('.sselect<?php echo $product->id; ?>:selected').val();
        var colorradioo = $('.colorradioo<?php echo $product->id; ?>:checked').val();
        var quantity = $('.quantity<?php echo $product->id; ?>').val();
        var price = $('.price<?php echo $product->id; ?>').val();
        var charm_id = $('.charm_id<?php echo $product->id; ?>').val();
        //   var imageupload = $('.imageupload<?php echo $product->id; ?>').val();
        //   var logoupload = $('.logoupload<?php echo $product->id; ?>').val();
        var imageval = $('.imageuploadoption_validation<?php echo $product->id; ?>').val();
        var imagesiz = $('.imageuploadoption_size<?php echo $product->id; ?>').val();
        var logoval = $('.uploadlogo_validation<?php echo $product->id; ?>').val();
        var logosiz = $('.uploadlogo_size<?php echo $product->id; ?>').val();
        var imageupload = $('#imageuploadd').prop('files')?.[0];
        var logoupload = $('#logouploadd').prop('files')?.[0];
        var _token = $('meta[name="csrf-token"]').attr('content');

        var imageupload = $("#imageuploadd")[0].files.length;
        var images = $("#imageuploadd")[0];

        for (var i = 0; i < imageupload; i++) {
        formData.append('imageupload' + i, images.files[i]);
        }
        var logoupload = $("#logouploadd")[0].files.length;
        var logo = $("#logouploadd")[0];

        for (var i = 0; i < logoupload; i++) {
        formData.append('logoupload' + i, logo.files[i]);
        }

        formData.append('logosiz', logosiz);formData.append('logoval', logoval);
        formData.append('imageval', imageval);formData.append('imagesiz', imagesiz);
        formData.append('imageupload', imageupload);formData.append('eggtype', eggtype);
        formData.append('price', price);formData.append('session_id', session_id);formData.append('a', a);
        formData.append('product_id', product_id);formData.append('quantity', quantity);
        formData.append('comment', comment);formData.append('description', description);
        formData.append('giftwrap_price', giftwrap_price);formData.append('giftwrap', giftwrap);formData.append('variation_id', variation_id);
        formData.append('pickup_type', pickup_type);formData.append('timee', timee);formData.append('sradioo', sradioo);
        formData.append('datee', datee);formData.append('flowerss_type', flowerss_type);formData.append('sselect', sselect);
        formData.append('location', location);formData.append('colortype', colortype);formData.append('colorradioo', colorradioo);
        formData.append('printside', printside);formData.append('charm_id', charm_id);formData.append('addtext2', addtext2);
        formData.append('addtext1', addtext1);formData.append('logoupload', logoupload);formData.append('buttonid', buttonid);
        formData.append('quantity', quantity);formData.append('eggtype', eggtype);formData.append('{{ csrf_token() }}',_token);

        $.ajax({
            url: "{{url('checkoutvaradd-to-cart')}}",
            method: "POST",
            contentType: 'multipart/form-data',
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
            data: formData,
            dataType: "json",
            success: function (response) {
            if(response.status == 'success'){
            window.location.replace('http://127.0.0.1:8000/checkout/'+response.cart_id)
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
                }else if(response.status == 'selected'){
                    Swal.fire(
                            'Added!',
                            'Please Login As A Vendor To Add More Products',
                            'success'
                    )
                }else if(response.status == 'attribute'){
                    Swal.fire(
                            'Added!',
                            "Selected Atrribute Doesn't Exisits",
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


</div>


@endif

        </div>
    </div>

@else

<?php
$productimg = App\Models\ProductImage::where('product_id', $product->id)->whereNull('variation_product_id')->get();
$producimg = App\Models\ProductImage::where('product_id', $product->id)->whereNull('variation_product_id')->get();
$prodimg = App\Models\ProductImage::where('product_id', $product->id)->whereNull('variation_product_id')->first();
?>
    <div class="row align-items-start">
        <!-- card left -->
    <div class="col-lg-5 product-imgs mrtp">
        <div class="img-display">
            <div id="imggs">
                <div class = "img-showcase">
                @foreach($productimg as $productimg)
                    <img src = "{{ asset('uploads/images/') }}/{{$productimg->images}}">
                @endforeach
            </div>
        </div>
        </div>
        <div class = "img-select" id="imggss">
            <?php $i = 1; ?>
            @foreach($producimg as $producimg)
            <div class = "img-item">
                <a href = "#" data-id = "{{$i}}">
                    <img src = "{{ asset('uploads/images/') }}/{{$producimg->images}}" onclick="currentSlide({{$i}})"  height="100px">
                </a>
            </div>
            <?php $i++; ?>
            @endforeach
        </div><br>
        <input type="hidden" name="product_id" id="productdd" value="{{$product->id}}"/>
        <p>Share with loved ones </p>
        <div class = "social-links">
            <a href = "#">
            <img src="{{ asset('img/icons/fb.png')}}">
            </a>
            <a href = "#">
            <img src="{{ asset('img/icons/tw.png')}}">
            </a>
            <a href = "#">
            <img src="{{ asset('img/icons/ins.png')}}">
            </a>
            <a href = "#">
            <img src="{{ asset('img/icons/ln.png')}}">
            </a>
            <a href = "#">
            <img src="{{ asset('img/icons/pin.png')}}">
            </a>
        </div>
    </div>
    <div class = "col-lg-7 product-content">
        <h2 class = "product-title">{{$product->product_name}}
        <div class = "product-rating">
            <?php $rating = App\Models\Review::where('product_id',$product->id)->avg('rating'); ?>
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
        </h2>
        <div class="product-price">
            <div class="container px-0">
                <div class="row">
                    <div class="col-lg-12">
                        <p class = "new-price" id="pric-dd">₹{{$product->price}}<span> (Inclusive of GST)</span></p>
                        <br>
                        @if($product->quantity_show == 1)
                        <h4 class="qun">Quantity</h4><br>
                        <div class="input-group quantity" style="width: 100px; border:1px solid gray;color:#000;">
                            <div class="input-group-btn">
                                <button class="btnn btn-sm btn-primary1 btn-minus" >
                                <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control form-control-sm bg-secondary1 text-center quantity{{$product->id}}" name="quantity" value="1" style="border-color:#fff;font-size:20px; color:#000;">
                            <div class="input-group-btn">
                                <button class="btnn btn-sm btn-primary1 btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        @endif

                        @if($product->textareaa == 1)
                        <div class="form-group">
                            <h5>{{$product->textarea_name}} <span class="text-danger1">@if($product->textarea_validation != "")(Max {{$product->textarea_validation}} characters) @endif</span></h5>
                            <textarea class="form-control description{{$product->id}}" name="description" required id="message_popup" maxlength="{{$product->textarea_validation}}" cols="30" rows="4" tabindex="1" style="border: 1px solid #767676; "></textarea>
                        </div>
                        @endif

                        <div class="fomright">
                        <form>
                            @if($product->eggoreggless == 1)
                            <div class="custom-control custom-radio custom-control-inline al-lft">
                                <input type="radio" class="custom-control-input eggtype{{$product->id}}" id="eggtype" value="Egg" name="egg_type">
                                <label class="custom-control-label" for="size-1"> <img src="{{ asset('img/egg.png')}}" class="egg">Egg</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input eggtype{{$product->id}}" id="eggtype" value="Egg Less" name="egg_type">
                            <label class="custom-control-label" for="size-2">  <img src="{{ asset('img/eggless.png')}}" class="eggless">Eggless</label>
                            </div>
                            @endif
                            @if ($errors->has('eggtype'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('eggtype') }}</strong>
                            </span>
                        @endif
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>









        @if($product->is_combo == 1)
        <?php  $procombopart = App\Models\ProductCombo::where('product_id',$product->id)->get();?>
            @foreach($procombopart as $procombopart)
            <div class="col-lg-6 ">
                <p style="display: flex;">For {{$procombopart->button_name}}{{$procombopart->id}}:
                <button class="logbtn1" value="{{$procombopart->id}}" type="button" data-id="{{$procombopart->id}}" data-box="buttonattr{{$procombopart->id}}">Show</button></p>
            </div>
            <input type="hidden" name="comboname" value="{{$procombopart->id}}" id="comboname">
            <div class="showonlyclick{{$procombopart->id}}" style="display: none;"  id="buttonattr{{$procombopart->id}}">
                <div class="row">
                    @if($procombopart->combo_text_field == 1)
                    <div class="col-lg-12">
                        <h5 class="song">{{$procombopart->combo_text_heading}}<span class="char">@if($procombopart->combo_text_validation != "")(Max {{$procombopart->variation_text_validation}} characters ) @endif</span></h5><br>
                        <p style="display: flex;"><input type="text" class="inputclass11 comboaddtext1{{$procombopart->id}}" value="" id="comboaddtext1{{$procombopart->id}}" name="comboaddtext1" maxlength="{{$procombopart->combo_text_validation}}" placeholder="Type here" style=""></p>
                    </div>
                    @endif
                </div>
                <?php $attributecom = App\Models\ProductComboVariation::where('product_id', $product->id)->get();?>
                @foreach($attributecom as $attributecom)
                <?php
                $attnamee1com = App\Models\Attribute::where('id',$attributecom->product_combo_attr_id)->first();
                $varianttt1combo = App\Models\ProductCombooo::where('product_id',$product->id)->where('combo_attr_id',$attributecom->product_combo_attr_id)->where('combo_id',$procombopart->id)->get();
                $variantt1combo = $varianttt1combo->unique('combo_attr_value');
                $fetchvarianttext1com = App\Models\ProductCombo::where('product_id',$product->id)->where('combo_attr_id',$attributecom->product_combo_attr_id)->where('id',$procombopart->id)->first();
                ?>

                @if($attnamee1com->attr_label == 'color')
                <div class="row">
                    <div class="col-lg-12">
                        <p class="gst">Color </p>
                        <div class="preview">
                            @foreach($variantt1combo as $variantt1combo)
                             @if($variantt1combo->combo_attr_id == $attributecom->product_combo_attr_id)
                             <?php  $attvaluee1co = App\Models\AttributeValue::where('id',$variantt1combo->combo_attr_value)->first();
                                    $fetchvariantt1co = App\Models\ProductCombo::where('id',$variantt1combo->combo_id)->first();
                                ?>
                                <label><!--name="attr_{{$attnamee1com->attr_name}}"-->
                                <input type="hidden" name="productid" value="{{$product->id}}" id="productid{{$product->id}}"/>
                                <input style="background-color:{{$attvaluee1co->attr_value_title}};" class="form-control comcradio{{$attvaluee1co->id}} product-filter-item colorradioo{{$product->id}}" value="{{$attvaluee1co->id}}"  name="comattsname" type="radio" id="comcolorradio" data-comboattr="{{$variantt1combo->combo_id}}" onclick="getcomboattr();">
                                <span  class="comcolorradio" data-name="{{$attnamee1com->attr_name}}" data-bg-color="#{{$attvaluee1co->attr_value_title}}"  class="size-code">
                                </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <?php $attnamecom = App\Models\Attribute::where('id',$attributecom->product_combo_attr_id)->first();
                $varianttcom = App\Models\ProductCombooo::where('product_id',$product->id)->where('combo_attr_id',$attributecom->product_combo_attr_id)->where('combo_id',$procombopart->id)->get();
                $variantcom = $varianttcom->unique('combo_attr_value');
                ?>
                    @if($attnamecom->attr_label == 'label')
                    <label class="slect-varient">Select Variant</label>
                    <div class="boxed">
                    @foreach($variantcom as $variantcom)
                    @if($variantcom->combo_attr_id == $attributecom->product_combo_attr_id)
                    <?php
                        $attvaluecom = App\Models\AttributeValue::where('id',$variantcom->combo_attr_value)->first();
                        $fetchvariantcom = App\Models\ProductCombo::where('id',$variantcom->combo_id)->where('id',$procombopart->id)->first();
                    ?>
                        <input type="hidden" name="productid" value="{{$product->id}}" id="productid{{$product->id}}"/>
                        <label class="LargeOptionRadio__label">
                        <input class="form-control sradioatt comsradio{{$attvaluecom->id}} product-filter-item comsradioo{{$product->id}}" value="{{$attvaluecom->id}}" name="comboattsname" type="radio" id="comsradioatt" data-at="{{$attvaluecom->attr_id}}" data-attr="{{$attvaluecom->combo_id}}"  data-comboattr="{{$variantcom->combo_id}}" onclick="getcomboattr();">
                        <span class="comsradio" data-name="{{$attnamecom->attr_name}}" >
                        {{$attvaluecom->attr_value_title}}
                    </label>
                    @endif
                    @endforeach
                    </div>
                    @endif

                @endforeach

                <div class="row">
                    <?php  $optionheading = App\Models\ProductSelectHeading::where('product_id',$product->id)->where('combo_id',$procombopart->id)->get();?>
                    @foreach($optionheading as $optionheading)
                    <?php $option = App\Models\ProductSelectOption::where('product_id',$product->id)->where('product_select_id',$optionheading->id)->where('combo_id',$procombopart->id)->get(); ?>
                    <div class="col-lg-12">
                        <p class="pflex">
                            <select class="form-select inputclass12 charm_id{{$product->id}}" data-comboattrr="{{$optionheading->combo_id}}" onclick="getcharmid();" id="charm_idd" aria-label="Default select example" name="charm_id" style="color: gray;">
                            <option data-comboattrr="{{$optionheading->combo_id}}">{{$optionheading->product_select_title}}</option>
                            @foreach($option as $option)
                            <option value="{{$option->id}}" data-comboattrr="{{$optionheading->combo_id}}">{{$option->product_select_option}}</option>
                            @endforeach
                            </select>
                        </p>
                    </div>
                    @endforeach
                </div>

            </div>
                @endforeach
            @endif

            <div id="variationn-dd">
            </div>

        <div class="row img_upload_sec">
            @if($product->imageuploadoption == 1)
            <div class="col-lg-6">
                <h5>{{$product->imageuploadoption_heading}}</h5>
                <p style="display: flex;"> <input type="file" name="imageupload[]" multiple id="imageuploadd" class="imageupload{{$product->id}}" style="" accept="image/png, image/jpeg,image/jpg"></p>
                <div id="uploadimage_preview" style="width:100%;"></div>
            </div>
            <input type="hidden" name="imageuploadoption_validation" id="imageuploadoption_validation" class="imageuploadoption_validation{{$product->id}}" value="{{$product->imageuploadoption_validation}}">
            <input type="hidden" name="imageuploadoption_size" id="imageuploadoption_size" class="imageuploadoption_size{{$product->id}}" value="{{$product->imageuploadoption_size}}">
            @else
            <div class="col-lg-6" style="display:none">
                <h5>{{$product->imageuploadoption_heading}}</h5>
                <p style="display: flex;"> <input type="file" name="imageupload[]" multiple id="imageuploadd" class="imageupload{{$product->id}}" style="" accept="image/png, image/jpeg,image/jpg"></p>
                <div id="uploadimage_preview" style="width:100%;"></div>
            </div>
            <input type="hidden" name="imageuploadoption_validation" id="imageuploadoption_validation" class="imageuploadoption_validation{{$product->id}}" value="{{$product->imageuploadoption_validation}}">
            <input type="hidden" name="imageuploadoption_size" id="imageuploadoption_size" class="imageuploadoption_size{{$product->id}}" value="{{$product->imageuploadoption_size}}">
            @endif
            @if($product->uploadlogo_option == 1)
            <div class="col-lg-6">
                <h5>{{$product->uploadlogo_heading}}</h5>
                <p style="display: flex;"> <input type="file" name="logoupload[]"  multiple id="logouploadd" class="logoupload{{$product->id}}" style="" accept="image/png, image/jpeg,image/jpg"></p>
                <div id="logoimage_preview" style="width:100%;"></div>
            </div>
            <input type="hidden" name="uploadlogo_validation" id="uploadlogo_validation" class="uploadlogo_validation{{$product->id}}" value="{{$product->uploadlogo_validation}}">
            <input type="hidden" name="uploadlogo_size" id="uploadlogo_size" class="uploadlogo_size{{$product->id}}" value="{{$product->uploadlogo_size}}">
            @else
            <div class="col-lg-6" style="display:none;">
                <h5>{{$product->uploadlogo_heading}}</h5>
                <p style="display: flex;"> <input type="file" name="logoupload[]"  multiple id="logouploadd" class="logoupload{{$product->id}}" style="" accept="image/png, image/jpeg,image/jpg"></p>
                <div id="logoimage_preview" style="width:100%;"></div>
            </div>
            <input type="hidden" name="uploadlogo_validation" id="uploadlogo_validation" class="uploadlogo_validation{{$product->id}}" value="{{$product->uploadlogo_validation}}">
            <input type="hidden" name="uploadlogo_size" id="uploadlogo_size" class="uploadlogo_size{{$product->id}}" value="{{$product->uploadlogo_size}}">
        @endif
        </div>
         <div class="row">
            @if($product->text_field == 1)
            <div class="col-lg-12">
                <h5 class="song">{{$product->text_heading}}<span class="char">@if($product->text_validation != "")(Max {{$product->text_validation}} characters ) @endif</span></h5><br>
                <p style="display: flex;"><input type="text" class="inputclass11 addtext1{{$product->id}}" name="addtext1" maxlength="{{$product->text_validation}}" placeholder="Type here" style=""></p>
            </div>
            @endif
        </div>
        <div class="row">
            @if($product->addatext_option == 1)
            <div class="col-lg-12">
                <h5 class="song">{{$product->addatext_heading}}<span class="char">@if($product->addatext_validation != "")(Max {{$product->addatext_validation}} characters ) @endif</span></h5><br>
                <p style="display: flex;"><input type="text" class="inputclass11 addtext2{{$product->id}}" name="addtext2" maxlength="{{$product->addatext_validation}}" placeholder="Type here" style=""></p>
            </div>
            @endif
        </div>
    <br>
    <div class="row">
        <?php  $optionheading = App\Models\ProductSelectHeading::where('product_id',$product->id)->whereNull('combo_id')->get();?>
        @foreach($optionheading as $optionheading)
        <?php $option = App\Models\ProductSelectOption::where('product_id',$product->id)->where('product_select_id',$optionheading->id)->whereNull('combo_id')->get(); ?>
        <div class="col-lg-12">
            <p class="pflex">
                <select class="form-select inputclass12 charm_id{{$product->id}}" onclick="getcharmid();" id="charm_idd" aria-label="Default select example" name="charm_id" style="color: gray;">
                <option>{{$optionheading->product_select_title}}</option>
                @foreach($option as $option)
                <option value="{{$option->id}}">{{$option->product_select_option}}</option>
                @endforeach
                </select>
            </p>
        </div>
        @endforeach
    </div>
      @if($product->location == 1)
        <div class="row pincode_sec">
            <div class="col-lg-10">
                <div class="input-group-append1">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent text-primary1">
                            <i class="fa fa-map-marker-alt" aria-hidden="true"></i>
                        </span>
                        <input type="text" class="form-control location{{$product->id}}" id="location" name="location" placeholder="Pincode/Location (only Bangalore)" style="color:#000!important;">
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <button class="check" onclick="checklocation()">Check</button>
            </div>
        </div>
        @endif

        @if($product->flower_type_option == 1)
        <div class="row">
            <div class="col-lg-12">
                <?php $flow = App\Models\ProductFlower::where('product_id',$product->id)->get();
                    $f=1;
                ?>
                @foreach($flow as $flow)
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input flowerss_type{{$product->id}}" id="flowerr{{$f}}" name="flowerss_type" value="{{$flow->product_flower_name}}" checked>
                    <label class="custom-control-label" for="flowerr{{$f}}" style="color:#000;font-size:18px;">{{$flow->product_flower_name}}</label>
                </div>
                <?php $f++; ?>
                @endforeach
            </div>
        </div>
        @endif

        <div class="row">
            @if($product->datee == 1)
            <div class="col-lg-6">
                <input type="date"  name="datee" class="datecss datee{{$product->id}}" placeholder="Select Delivery Date"  onfocus = "(this.type = 'date')"  id = "datee">
            </div>
            @endif
            @if ($errors->has('datee'))
            <span class="text-danger">
                <strong>{{ $errors->first('datee') }}</strong>
            </span>
            @endif
            @if($product->timee == 1)
            <div class="col-lg-6">
                <select name="timee" id="timee" class="timecss timee{{$product->id}}" id = "timee"  @if($proreq->timee_required == 1) required @endif>
                    @foreach($time as $time)
                        <option value="{{$time->button_name}}">{{$time->button_name}}</option>
                    @endforeach
                </select>
            </div>
            @endif
            @if ($errors->has('timee'))
            <span class="text-danger">
                <strong>{{ $errors->first('timee') }}</strong>
            </span>
            @endif
        </div>

        @if($product->self_pickup == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input pickup_type{{$product->id}}" value="Self Pickup" id="selfpickup" name="pickup_type" checked>
                    <label class="custom-control-label" for="selfpickup" style="color:#000;font-size:18px;">Self Pickup</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input pickup_type{{$product->id}}" value="Delivery" id="delivery" name="pickup_type">
                    <label class="custom-control-label" for="delivery" style="color:#000;font-size:18px;">Delivery</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input pickup_type{{$product->id}}" value="Ola" id="ola" name="pickup_type">
                    <label class="custom-control-label" for="ola" style="color:#000;font-size:18px;">Ola</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input pickup_type{{$product->id}}" value="Uber"  id="uber" name="pickup_type">
                    <label class="custom-control-label" for="uber" style="color:#000;font-size:18px;">Uber</label>
                </div>

            </div>
        </div>
        @endif
        @if($product->anyspecificdesign_option == 1)
        <p>Any specific design?<a href="{{url('/contactus')}}" style="color:#33cfff">Contact Us</a></p>
        @endif
        @if($product->giftwrapper_option == 1)
        <div class="row gift_wrap">
            <div class="col-lg-12">
                <h5 class="gift">Gift-Wrap:</h5>
                <p style="display: flex;"><input type="checkbox" class="giftwrap{{$product->id}}" name="giftwrap" style="width: 20px;"><span style="padding-left: 10px;">Add Gift wrap(+₹{{$product->giftwrapper_price}})</span></p>
                <input type="hidden" name="giftwrap_price" class="giftwrap_price{{$product->id}}" value="{{$product->giftwrapper_price}}">
            </div>
        </div>
        @endif
        @if($product->haveadesigninmind_option == 1)
        <button type = "button" class ="havedesign">Have a design in mind? WhatsApp Us!</button>
        @endif

        @if($product->comment == 1)
        <div class="row comment_sec">
            <div class="col-lg-12">
                <h5>{{$product->comment_heading}}</h5>
                <p><input type="text" name="comment" class="inputclass comment{{$product->id}}" style="width:100%;height:100px;"></p>
            </div>
        </div>
        @endif
        @if($product->query == 1)
        <div class="row">
            <div class="col-lg-12">
                <!-- Button trigger modal -->
                <a href="" data-toggle="modal" data-target="#exampleModalCenter" style="color: darkturquoise;font-size: 18px;">
                    For any Queries - Get in Touch
                </a>
            </div>
        </div>
        @endif
        <div class="row">
    @if($product->stock_status == "outofstock")
    <div class="col-lg-6">
    <button type = "button" class = "logbtn notify{{$product->id}}" style="width: 100%; ">Notify Me</button>
    </div>
    <input type="hidden" value="{{@$product->id}}" name="product_id" class="product_id{{$product->id}}" />
    <input type="hidden" name="session_id" class="session_id" value="{{\Session::getId() }}">
    <input type="hidden"  name="price" value="{{$product->price}}" class="price{{$product->id}}">

    <script>
    $(document).ready(function(){

    $('.notify<?php echo $product->id; ?>').click(function(e){
        var session_id = $('.session_id').val();
        var product_id = $('.product_id<?php echo $product->id; ?>').val();
        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{url('notifyinstock')}}",
            method: "POST",
            data: {'session_id':session_id,'product_id':product_id,_token: '{{ csrf_token() }}'},
            dataType: "json",
            success: function (response) {
                if(response.status == 'success'){
                    Swal.fire(
                    'Added!',
                    'Notify Me',
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
        <div class="col-lg-6">
        <button type = "button" class = "logbtn add-to-procartt11{{$product->id}}"  style="background: #f2f2f2; color: black;  border: none;width: 100%;">ADD TO CART</button>
        </div>

<input type="hidden" value="{{@$product->id}}" name="product_id" class="product_id{{$product->id}}" />
<input type="hidden" name="session_id" class="session_id" value="{{\Session::getId() }}">
<input type="hidden"  name="price" value="{{$product->price}}" class="price{{$product->id}}">

<script>
$(document).ready(function(){
    function loadcart(){
    $.ajax({
        method: "GET",
        url: "{{url('/load-cart-data')}}",
        success: function (response) {
            //alert(response);
            $('.cart_count').html('');
            $('.cart_count').html(response.count);
             //console.log(response.length);
        }
    });
}
$('.add-to-procartt11<?php echo $product->id; ?>').click(function(e){
    var formData = new FormData();
    var eggtype = $('.eggtype<?php echo $product->id; ?>:checked').val();
    var quantity = $('.quantity<?php echo $product->id; ?>').val();
    var addtext1 = $('.addtext1<?php echo $product->id; ?>').val();
    var addtext2 = $('.addtext2<?php echo $product->id; ?>').val();
    var charm_id = $('.charm_id<?php echo $product->id; ?>').val();
    var printside = $('.printside<?php echo $product->id; ?>').val();
    var colortype = $('.colortype<?php echo $product->id; ?>').val();
    var location = $('.location<?php echo $product->id; ?>').val();
    var flowerss_type = $('.flowerss_type<?php echo $product->id; ?>:checked').val();
    var datee = $('.datee<?php echo $product->id; ?>').val();
    var timee = $('.timee<?php echo $product->id; ?>').val();
    var pickup_type = $('.pickup_type<?php echo $product->id; ?>:checked').val();
    var giftwrap = $('.giftwrap<?php echo $product->id; ?>:checked').val();
    var giftwrap_price = $('.giftwrap_price<?php echo $product->id; ?>').val();
    var description = $('.description<?php echo $product->id; ?>').val();
    var comment = $('.comment<?php echo $product->id; ?>').val();
    var session_id = $('.session_id').val();
    var product_id = $('.product_id<?php echo $product->id; ?>').val();
    var quantity = $('.quantity<?php echo $product->id; ?>').val();
    var price = $('.price<?php echo $product->id; ?>').val();
    var imageval = $('.imageuploadoption_validation<?php echo $product->id; ?>').val();
    var imagesiz = $('.imageuploadoption_size<?php echo $product->id; ?>').val();
    var logoval = $('.uploadlogo_validation<?php echo $product->id; ?>').val();
    var logosiz = $('.uploadlogo_size<?php echo $product->id; ?>').val();
    //var imageupload = $('.imageupload<?php echo $product->id; ?>').val();
    //var logoupload = $('.logoupload<?php echo $product->id; ?>').val();
    var imageupload = $('#imageuploadd').prop('files')?.[0];
    var logoupload = $('#logouploadd').prop('files')?.[0];
    var _token = $('meta[name="csrf-token"]').attr('content');

    var imageupload = $("#imageuploadd")[0].files.length;
    var images = $("#imageuploadd")[0];

    for (var i = 0; i < imageupload; i++) {
        formData.append('imageupload' + i, images.files[i]);
    }
    var logoupload = $("#logouploadd")[0].files.length;
    var logo = $("#logouploadd")[0];

    for (var i = 0; i < logoupload; i++) {
        formData.append('logoupload' + i, logo.files[i]);
    }
    formData.append('logosiz', logosiz);formData.append('logoval', logoval);
    formData.append('imageval', imageval);formData.append('imagesiz', imagesiz);
    formData.append('imageupload', imageupload);formData.append('eggtype', eggtype);
    formData.append('price', price);formData.append('session_id', session_id);
    formData.append('product_id', product_id);formData.append('quantity', quantity);
    formData.append('comment', comment);formData.append('description', description);
    formData.append('giftwrap_price', giftwrap_price);formData.append('giftwrap', giftwrap);
    formData.append('pickup_type', pickup_type);formData.append('timee', timee);
    formData.append('datee', datee);formData.append('flowerss_type', flowerss_type);
    formData.append('location', location);formData.append('colortype', colortype);
    formData.append('printside', printside);formData.append('charm_id', charm_id);formData.append('addtext2', addtext2);
    formData.append('addtext1', addtext1);formData.append('logoupload', logoupload);
    formData.append('quantity', quantity);formData.append('eggtype', eggtype);formData.append('{{ csrf_token() }}',_token);

    $.ajax({
//        url: "{{url('add-to-cart')}}",
        url: "{{url('comadd-to-cart')}}",
        method: "POST",
        contentType: "multipart/form-data",
        cache: false,
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        contentType: false,
        processData: false,
        data: formData,
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
            }else if(response.status == 'error'){
                Swal.fire(
                    response.msg
                )
            }else if(response.status == 'out'){
                Swal.fire(
                      'Added!',
                      'Selected Product Is Out Of Stock',
                      'success'
                )
            }else if(response.status == 'selected'){
                Swal.fire(
                      'Added!',
                      'Please Login As A Vendor To Add More Products',
                      'success'
                )


            }else if(response.status == 'attribute'){
                Swal.fire(
                      'Added!',
                      'Please select attribute',
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





<div class="col-lg-6">
<button type = "button" class = "logbtn checkadd-to-procart{{$product->id}}" style="width: 100%; ">BUY NOW</button>
</div>


<input type="hidden" value="{{@$product->id}}" name="product_id" class="product_id{{$product->id}}" />
<input type="hidden" name="session_id" class="session_id" value="{{\Session::getId() }}">
<input type="hidden"  name="price" value="{{$product->price}}" class="price{{$product->id}}">

<script>
$(document).ready(function(){
    function loadcart(){
    $.ajax({
        method: "GET",
        url: "{{url('/load-cart-data')}}",
        success: function (response) {
            //alert(response);
            $('.cart_count').html('');
            $('.cart_count').html(response.count);
             //console.log(response.length);
        }
    });
}
$('.checkadd-to-procart<?php echo $product->id; ?>').click(function(e){
    var formData = new FormData();
    var eggtype = $('.eggtype<?php echo $product->id; ?>:checked').val();
    var quantity = $('.quantity<?php echo $product->id; ?>').val();
    var addtext1 = $('.addtext1<?php echo $product->id; ?>').val();
    var addtext2 = $('.addtext2<?php echo $product->id; ?>').val();
    var charm_id = $('.charm_id<?php echo $product->id; ?>').val();
    var printside = $('.printside<?php echo $product->id; ?>').val();
    var colortype = $('.colortype<?php echo $product->id; ?>').val();
    var location = $('.location<?php echo $product->id; ?>').val();
    var flowerss_type = $('.flowerss_type<?php echo $product->id; ?>:checked').val();
    var datee = $('.datee<?php echo $product->id; ?>').val();
    var timee = $('.timee<?php echo $product->id; ?>').val();
    var pickup_type = $('.pickup_type<?php echo $product->id; ?>:checked').val();
    var giftwrap = $('.giftwrap<?php echo $product->id; ?>:checked').val();
    var giftwrap_price = $('.giftwrap_price<?php echo $product->id; ?>').val();
    var description = $('.description<?php echo $product->id; ?>').val();
    var comment = $('.comment<?php echo $product->id; ?>').val();
    var session_id = $('.session_id').val();
    var product_id = $('.product_id<?php echo $product->id; ?>').val();
    var quantity = $('.quantity<?php echo $product->id; ?>').val();
    var price = $('.price<?php echo $product->id; ?>').val();
    var imageval = $('.imageuploadoption_validation<?php echo $product->id; ?>').val();
    var imagesiz = $('.imageuploadoption_size<?php echo $product->id; ?>').val();
    var logoval = $('.uploadlogo_validation<?php echo $product->id; ?>').val();
    var logosiz = $('.uploadlogo_size<?php echo $product->id; ?>').val();
    // var imageupload = $('.imageupload<?php echo $product->id; ?>').val();
    //var logoupload = $('.logoupload<?php echo $product->id; ?>').val();
    var imageupload = $('#imageuploadd').prop('files')?.[0];
    //alert(imageupload);
    var logoupload = $('#logouploadd').prop('files')?.[0];
    var _token = $('meta[name="csrf-token"]').attr('content');

    var imageupload = $("#imageuploadd")[0].files.length;
    var images = $("#imageuploadd")[0];

    for (var i = 0; i < imageupload; i++) {
        formData.append('imageupload' + i, images.files[i]);
    }
    var logoupload = $("#logouploadd")[0].files.length;
    var logo = $("#logouploadd")[0];

    for (var i = 0; i < logoupload; i++) {
        formData.append('logoupload' + i, logo.files[i]);
    }
    formData.append('logosiz', logosiz);formData.append('logoval', logoval);
    formData.append('imageval', imageval);formData.append('imagesiz', imagesiz);
    formData.append('imageupload', imageupload);formData.append('eggtype', eggtype);
    formData.append('price', price);formData.append('session_id', session_id);
    formData.append('product_id', product_id);formData.append('quantity', quantity);
    formData.append('comment', comment);formData.append('description', description);
    formData.append('giftwrap_price', giftwrap_price);formData.append('giftwrap', giftwrap);
    formData.append('pickup_type', pickup_type);formData.append('timee', timee);
    formData.append('datee', datee);formData.append('flowerss_type', flowerss_type);
    formData.append('location', location);formData.append('colortype', colortype);
    formData.append('printside', printside);formData.append('charm_id', charm_id);formData.append('addtext2', addtext2);
    formData.append('addtext1', addtext1);formData.append('logoupload', logoupload);
    formData.append('quantity', quantity);formData.append('eggtype', eggtype);formData.append('{{ csrf_token() }}',_token);

    $.ajax({
//        url: "{{url('add-to-cart')}}",
        url: "{{url('checkoutadd-to-cart')}}",
        method: "POST",
        contentType: 'multipart/form-data',
        cache: false,
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        contentType: false,
        processData: false,
        data: formData,
        dataType: "json",
        success: function (response) {
        //	$('.cart_counter').html(response.cart_counter);
            if(response.status == 'success'){
                window.location.replace('http://127.0.0.1:8000/checkout/'+response.cart_id)

            }else if(response.status == 'out'){
                Swal.fire(
                      'Added!',
                      'Selected Product Is Out Of Stock',
                      'success'
                )
            }else if(response.status == 'selected'){
                Swal.fire(
                      'Added!',
                      'Please Login As A Vendor To Add More Products',
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
</div>

    @endif
</div>
<div class="container desc_sec_details">
    <div class="row">
        <div class="col">
            <div class="bg-light">
                <div class="nav nav-tabs mb-4 justify-content-center">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Specifications </a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Delivery Information</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-4">Color Disclaimer </a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-5">Return Policy </a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-6">Reviews</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show" id="tab-pane-1">
                        <p>{!!$product->pro_long_desc!!}</p>

                    </div>
                        <div class="tab-pane fade " id="tab-pane-2">
                        <p>{!!$product->specification!!}</p>

                    </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                        <p>{!!$product->delivery_info!!}</p>

                    </div>
                        <div class="tab-pane fade " id="tab-pane-4">
                        <p>{!!$product->color_desclaimer!!}</p>

                    </div>
                    <div class="tab-pane fade" id="tab-pane-5">
                        <p>{!!$product->return_policy!!}</p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-6">
                        <div class="row mx-0">
                            <div class="col-md-12 p-3">
                                <h4 class="mb-4" style="display:none;">Review</h4>
                                <div class="media" >
                                    <div class="media-body">
                                        @foreach($review as $review)
                                            @foreach(range(1,5) as $i)
                                            <span class="fa-stack" style="width:1em">
                                                <i class="far fa-star fa-stack-1x"></i>

                                                @if($review->rating >0)
                                                    @if($review->rating >0.5)
                                                        <i class="fas fa-star fa-stack-1x"></i>
                                                    @else
                                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                                    @endif
                                                @endif
                                                @php $review->rating--; @endphp
                                            </span>
                                            @endforeach
                                        <h6>{{$review->name}}<small> - <i>{{ \Carbon\Carbon::parse($review->datee)->format('j F Y')}}</i></small></h6>
                                        <p>{!!$review->comment!!}</p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        <div class="col-lg-12">
                        <h2>Leave a comment here</h2>
                        <form id="contact-form" action="{{url('/productreview')}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <input type="hidden" name="productid" id="productid" value="{{$product->id}}">

                                <div class="flex-w flex-m p-t-50 p-b-23">
                                    <span class="stext-102 cl3 m-r-16">
                                        Your Rating
                                    </span>
                                </div>
                                <div class="error-container"></div>
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="rating" id="btn-writereview">

                                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Meh">5 stars</label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Kinda bad">4 stars</label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Kinda bad">3 stars</label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Sucks big tim">2 stars</label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
                                </div>
                                </div>
                                <br>
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control form-control-name" name="name" id="name" placeholder="Enter Name" type="text" required>
                                    </div>
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control form-control-email" name="email" id="email" placeholder="Enter Email" type="email" required>
                                    </div>
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control form-control-message" name="review" id="message" placeholder="Your Comments" rows="3" required></textarea>
                                    </div>
                                    </div>
                                    <br>
                                </div>
                                <x-honey/>

                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary mx-0">Submit</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!--================================================You May Also Like ===========================================-------->
@if($youmay->count() > 0)
<div class="container pt-5 pb-3">
    <h2 class="section-title position-relative text-center mb-5 mt-3" data-aos="fade-up" data-aos-delay="400" >You May Also Like
        <div class="right_viewall"><a href="{{url('/cp/youmayalsolike')}}" class="btn btn-primary mr-0">View All</a></div>

    </h2>
    <div class="row justify-content-center">
        @foreach($youmay as $youmay)
        <?php
        if($youmay->is_variation == '1'){
            $youproimag = App\Models\ProductImage::where('product_id',$youmay->id)->whereNotNull('variation_product_id')->first();
            $youprovar = App\Models\AddSubVariation::where('product_id',$youmay->id)->first();
            $youattribute = App\Models\ProductVariation::where('product_id', $youmay->id)->get();
        }else{
            $youproimag = App\Models\ProductImage::where('product_id',$youmay->id)->first();
            $youprovar = App\Models\Product::where('status','Active')->where('id',$youmay->id)->first();
        }
        $youpronewtre = App\Models\Product::where('status','Active')->where('id',$youmay->id)->first();
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1" data-aos="fade-left" data-aos-delay="200">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <a href="{{url('/pro')}}/{{$youmay->slug}}">
                        @if($youproimag == null)
                        <img class="img-fluid w-100" src="{{asset('img/ck1.png') }}" alt="service-image2">
                        @else
                        <img src="{{ asset('uploads/images/') }}/{{$youproimag->images}}" alt="service-image2" class="img-fluid w-100">
                        @endif
                    </a>
                    <input type="hidden" name="product_id" value="{{$youmay->id}}" class="product_id{{$youmay->id}}" />
                    <input type="hidden" name="product_name" class="product_name{{$youmay->id}}" value="{{@$youmay->product_name}}"/>
                    <input type="hidden" name="product_price" class="product_price{{$youmay->id}}" value="{{@$youmay->price}}"/>
                    <input type="hidden" class="session_id" name="session_id" value="{{session()->getId()}}"/>

                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square bluey" href="{{url('/pro')}}/{{$youmay->slug}}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-outline-dark btn-square yehr wishlistproduct{{$youmay->id}}"><i class="far fa-heart"></i></a>
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

                            $('.wishlistproduct<?php echo $youmay->id; ?>').click(function(e){
                                var session_id = $('.session_id').val();
                                var product_id = $('.product_id<?php echo $youmay->id; ?>').val();
                                var product_name = $('.product_name<?php echo $youmay->id; ?>').val();
                                var product_price = $('.product_price<?php echo $youmay->id; ?>').val();
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

                           <!-- <a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->

                    </div>
                </div>
                <div class="text-center py-2">
                 <div class="d-flex align-items-center justify-content-center review_star mb-1">
                    <?php $ratingg = App\Models\Review::where('product_id',$youmay->id)->avg('rating'); ?>
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
                    <a class="h6 text-decoration-none text-truncate" href="{{url('/pro')}}/{{$youmay->slug}}">{{$youmay->product_name}}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>₹{{$youprovar->price}}</h5>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
<!--================================================End You May Also Like ===========================================-------->

<!--======================================= Trending Products============================================--->
@if($trend->count() > 0)
<div class="container pt-5 pb-3">
        <h2 class="section-title position-relative text-center mb-5 mt-3" data-aos="fade-up" data-aos-delay="400" >Trending Products
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
                          <!--  <a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->

                        </div>
                    </div>
                    <div class="text-center py-2">
					 <div class="d-flex align-items-center justify-content-center review_star mb-1">
                        <?php $ratinggg = App\Models\Review::where('product_id',$trend->id)->avg('rating'); ?>
                        @if($ratinggg != null)<p>
                            @foreach(range(1,5) as $i)
                            <span class="fa-stack" style="width:1em">
                                <i class="far fa-star fa-stack-1x"></i>

                                @if($ratinggg >0)
                                    @if($ratinggg >0.5)
                                        <i class="fas fa-star fa-stack-1x"></i>
                                    @else
                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                    @endif
                                @endif
                                @php $ratinggg--; @endphp
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


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Any Query</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="">
            <div class="form-group">
                <label for="Name" class="col-form-label">Name:</label>
                <input type="text" class="form-control" id="Name">
              </div>
              <div class="form-group">
                <label for="Name" class="col-form-label">Email:</label>
                <input type="email" class="form-control" id="email">
              </div>
              <div class="form-group">
                <label for="Name" class="col-form-label">Phone:</label>
                <input type="text" class="form-control" id="phone">
              </div>
              <div class="form-group">
                <label for="Message" class="col-form-label">Message:</label>
                <textarea class="form-control" id="Message"></textarea>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@push('after-scripts')

<script>
    const imgs = document.querySelectorAll('.img-select a');
    const imgBtns = [...imgs];
    let imgId = 1;

    imgBtns.forEach((imgItem) => {
        imgItem.addEventListener('click', (event) => {
            event.preventDefault();
            imgId = imgItem.dataset.id;
            slideImage();
        });
    });

    function slideImage(){
        const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

        document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
    }

    window.addEventListener('resize', slideImage);
    </script>
    <script>
    $(function() {
      //default intialize
      $('#dp0').datetimepicker();
      // Date only
      $('#dp1').datetimepicker({
        format: 'L'
      });
      //Disable past dates
       $('#dp2').datetimepicker({
          minDate: moment().add(2)
      });
      //only show 15 days
       $('#dp3').datetimepicker({
          minDate: moment().add(1),
          maxDate: moment().add(15,'days')
      });
    });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function opencolor(){
             var shodd = $('#onshoww').val();
            alert(shodd);
        }
    </script>

<script>
function getcharmid(){
    $('select[name="charm_id"] option:selected').each(function () {
   	    var charm = $(this).attr('value');
        var productdd = $('#productdd').val();
        var combo_idd = $(this).data('comboattrr');
       // alert(combo_idd);
        var data = $.parseJSON($.ajax({
            url: "{{url('/charmloadd')}}",
            type: "POST",
            data: {'product':productdd, 'charmvalue': charm,'combo_idd':combo_idd, _token: '{{csrf_token()}}' },
            dataType: 'JSON',
            async: false
    }).responseText);
    var charmm = [data.attribute];
        });

}
</script>

<script>
function getattr() {
//    var v = $('select[name="sselectt"] option:selected').attr("value");
    $('select[name="sselectt"] option:selected').each(function () {
   	    var a = $(this).attr('value');
        var productdd = $('#productdd').val();
        var buttonid = $(this).data('butt');
        var variationaddtext1 =$('#variationaddtext1'+ buttonid).val();
  //      alert(variationaddtext1);
        $("#att-dd").html('');
        var data = $.parseJSON($.ajax({
            url: "{{url('/loadd')}}",
            type: "POST",
            data: {'product':productdd, 'att': a,'variationaddtext1':variationaddtext1,'buttonid':buttonid, _token: '{{csrf_token()}}' },
            dataType: 'JSON',
            async: false
    }).responseText);
    var x = [data.attribute];
        });

    $('input[type=radio]:checked').each(function () {
   	    var a = $(this).attr('value');
        var productdd = $('#productdd').val();
        var buttonid = $(this).data('butt');
        var variationaddtext1 =$('#variationaddtext1'+ buttonid).val();
    //    alert(variationaddtext1);
        $("#att-dd").html('');
        var data = $.parseJSON($.ajax({
            url: "{{url('/loadd')}}",
            type: "POST",
            data: {'product':productdd, 'att': a,'variationaddtext1':variationaddtext1,'buttonid':buttonid , _token: '{{csrf_token()}}' },
            dataType: 'JSON',
            async: false
    }).responseText);
    var x = [data.attribute];
        });
    }
    function getclass() {
        var radVal = $("input[type=radio][name=attsname]:checked").val();
//        var radVall = $("input[type=radio][name=attsname"+x+"]:checked").val();
        var productdd = $('#productdd').val();
        $("#price-dd").html('');
        $("#pric-dd").html('');
        $("#quantity-dd").html('');
        $("#sku-dd").html('');
        $("#variation-dd").html('');
        $("#image-dd").html('');
        $.ajax({
            url: "{{url('/fetchproduct')}}",
            type: "POST",
            data: { 'attr1': radVal,'productdd':productdd, _token: '{{csrf_token()}}' },
            dataType: 'JSON',
            success: function (dataa) {
               $.each(dataa, function(key,value) {
                $("#price-dd").append('<input type="hidden" class="price'+value.product_id+'" name="price" id="price-dd" value="'+ value.price+'" >');
                $("#pric-dd").append(' <p class = "new-price">₹'+value.price+' <span> (Inclusive of GST)</span></p>');
                $("#quantity-dd").append('<span>' + value.quantity + '</span>');
                $("#sku-dd").append('<span>' + value.skucode + '</span>');
                $("#variation-dd").append('<input type="hidden" class="variation'+value.product_id+'" name="variation" id="variation-dd" value="'+ value.id +'" >');
            });
        }
    });
    }
</script>
<script>
function getimages() {
        var radVal = $("input[type=radio][name=attname]:checked").val();
        var radVall = $("input[type=radio][name=attsname]:checked").val();
        var productdd = $('#productdd').val();
     $("#image-dd").html('');
        $.ajax({
        url: "{{url('/fetchimages')}}",
        type: "POST",
        data: { 'attr1': radVal, 'attr2': radVall,'productdd':productdd, _token: '{{csrf_token()}}' },
        dataType: 'JSON',
        success:function(data)
        {
            //console.log(data);
            var res='';
            var ress='';
            var i = 1;
            $('#imggs').html(data);
             $('#imggss').html(data);
            $.each (data, function (key, value) {
            if(key == 0){
                res += '<img src = "http://127.0.0.1:8000/uploads/images/'+value.images+'" style="display:block;">';
            }else{
                res += '<img src = "http://127.0.0.1:8000/uploads/images/'+value.images+'" style="display:none;">';
            }
                ress += '<div class = "img-item">'+
                            '<a href = "#" data-id = "'+i+'">'+
                                '<img src = "http://127.0.0.1:8000/uploads/images/'+value.images+'" onclick="currentSlide('+i+')"  height="100px">'+
                            '</a>'+
                        '</div>';
                    i++;
            });
            //console.log(res);
            //console.log(ress);
             $('#imggs').append(res);
             $('#imggss').append(ress);
        }
    });
    }
</script>
<script>
function getcomboattr(){
    $('input[type=radio]:checked').each(function () {
   	    var aa = $(this).attr('value');
        var productdd = $('#productdd').val();
        var comboname = $(this).data('comboattr');
        var comboaddtext1 = $('#comboaddtext1'+ comboname).val();
        $("#att-dd").html('');
        var data = $.parseJSON($.ajax({
            url: "{{url('/comboloadd')}}",
            type: "POST",
            data: {'product':productdd, 'att': aa,'comboname':comboname,'comboaddtext1':comboaddtext1, _token: '{{csrf_token()}}' },
            dataType: 'JSON',
            async: false
    }).responseText);
    var x = [data.attribute];
        });
    }
</script>
<script>
$('.logbtn1').on('click', function () {
    var buttonid = $(this).data('id');
    var a = $('.showonlyclick'+ buttonid).css('display','block')
});
/*$('buttonattr').on('click', function () {
  var divID = $(this).attr('data-box');
  alert(div)
  $(this).addClass('Active');
  $('#' + divID).addClass('Active');
});*/
</script>
<script>
function checklocation(){
    var locationdd = $('#location').val();
    //alert(locationdd);
    $.ajax({
    url: "{{url('/locationcheck')}}",
    type: "POST",
    data: { 'locationdd': locationdd, _token: '{{csrf_token()}}' },
    dataType: 'JSON',
    success:function(data)
    {
        alert(data.status);
        alert(data.message);
    }
    });

}
</script>
<script>
$(document).ready(function() {
    var fileArr = [];
     $("#imageuploadd").change(function(){
        // check if fileArr length is greater than 0
        if (fileArr.length > 0) fileArr = [];

          $('#uploadimage_preview').html("");
          var imlen = $(this).data('vali');
          var total_file = document.getElementById("imageuploadd").files;
          if (!total_file.length) return;
            for (var i = 0; i < total_file.length; i++) {
                if (total_file[i].size > 1048576) {
                return false;
                } else {
                fileArr.push(total_file[i]);
                $('#uploadimage_preview').append("<div class='img-div' id='img-div"+i+"'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive image img-thumbnail' title='"+total_file[i].name+"'><div class='middle'><button id='imageaction-icon' value='img-div"+i+"' class='btn btn-danger' role='"+total_file[i].name+"'><i class='fa fa-trash'></i></button></div></div>");
                }
            }
     });

    $('body').on('click', '#imageaction-icon', function(evt){
        var divName = this.value;
        var fileName = $(this).attr('role');
        $(`#${divName}`).remove();

        for (var i = 0; i < fileArr.length; i++) {
          if (fileArr[i].name === fileName) {
            fileArr.splice(i, 1);
          }
        }
      document.getElementById('imageuploadd').files = FileListItem(fileArr);
        evt.preventDefault();
    });

     function FileListItem(file) {
              file = [].slice.call(Array.isArray(file) ? file : arguments)
              for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
              if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
              for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
              return b.files
          }
  });

</script>

<script>
    $(document).ready(function() {
        var fileArrr = [];
         $("#logouploadd").change(function(){
            // check if fileArr length is greater than 0
             if (fileArrr.length > 0) fileArrr = [];

              $('#logoimage_preview').html("");
              var total_filee = document.getElementById("logouploadd").files;
              if (!total_filee.length) return;
              for (var j = 0; j < total_filee.length; j++) {
                if (total_filee[j].size > 1048576) {
                  return false;
                } else {
                  fileArrr.push(total_filee[j]);
                  $('#logoimage_preview').append("<div class='img-divv' id='img-divv"+j+"'><img src='"+URL.createObjectURL(event.target.files[j])+"' class='img-responsive image img-thumbnail' title='"+total_filee[j].name+"'><div class='middle'><button id='logoaction-icon' value='img-divv"+j+"' class='btn btn-danger' rolee='"+total_filee[j].name+"'><i class='fa fa-trash'></i></button></div></div>");
                }
              }
         });

        $('body').on('click', '#logoaction-icon', function(evt){
            var divNamee = this.value;
            var fileNamee = $(this).attr('rolee');
            $(`#${divNamee}`).remove();

            for (var j = 0; j < fileArrr.length; j++) {
              if (fileArrr[j].name === fileNamee) {
                fileArrr.splice(j, 1);
              }
            }
          document.getElementById('logouploadd').files = FileListItemm(fileArrr);
            evt.preventDefault();
        });

         function FileListItemm(file) {
                  file = [].slice.call(Array.isArray(file) ? file : arguments)
                  for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
                  if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
                  for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
                  return b.files
              }
      });
      </script>


<script type='text/javascript'>

    $('input:radio').on('change',function(){
            $d = $(this).attr('value');
                if ($('.sradio'+$d)){
                    $(".LargeOptionRadio").removeClass('LargeOptionRadio--checked');
                    $(".LargeOptionRadio"+$d).addClass('LargeOptionRadio--checked');
                }
            });

    </script>
    <script type='text/javascript'>

        $('input:radio').on('change',function(){
                $d = $(this).attr('value');
                    if ($('.cradio'+$d)){
                        $(".coRadio").removeClass('active');
                        $(".coRadio"+$d).addClass('active');
                    }
                });

    </script>
<script>
    function myFunction() {
      var checkBox = document.getElementById("giftwrap");
      var text = document.getElementById("text");
      if (checkBox.checked == true){
        text.style.display = "block";
      } else {
         text.style.display = "none";
      }
    }
    </script>
<script>
function gettotal(){
    var gif = document.getElementById("giftwrappr").value();
    alert(gif);
}
</script>
@endpush
@endsection
