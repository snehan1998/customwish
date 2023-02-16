@push('after-styles')
<link href="{{asset('css/custstyle.css')}}" rel="stylesheet"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<style>

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
@endpush
@extends('layouts.app')
@section('title', 'Product Detail')
@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
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


    <div class="row">
            <!-- card left -->
        <div class = "col-lg-5 product-imgs mrt">
            <div class = "img-display">
                <div id="imggs">
                    <div class = "img-showcase" id="imggs">
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
                <i class = "fas fa-star"></i>
                <i class = "fas fa-star"></i>
                <i class = "fas fa-star"></i>
                <i class = "fas fa-star"></i>
                <i class = "fas fa-star"></i>
            </div>
            </h2>
            <div class = "product-price">
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
                        <label class="LargeOptionRadio__label">
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
                        <?php $attnamee1show = App\Models\Attribute::where('id',$attribute->product_attr_id)->first();
                            $varianttt1show = App\Models\Addsubvariationn::where('product_id',$product->id)->where('main_attr_id',$attribute->product_attr_id)->get();
                            $variantt1show = $varianttt1show->unique('main_attr_value');
                            $probutt = App\Models\ProductVariationButton::where('product_id',$product->id)->get();
                        // dd($variant);
                        ?>
                        @if($product->button_type_option == 1)
                        <h2 class="deco">Input Personalization Details</h2>
                        <div class="row">
                            @foreach($probutt as $probutt)
                            <div class="col-lg-6 ">
                                <p style="display: flex;">For {{$probutt->button_name}}{{$probutt->id}}:
                                <button class="logbtn1" value="{{$probutt->id}}" type="button" data-id="{{$probutt->id}}" data-box="buttonattr{{$probutt->id}}">Show</button></p>
                            </div>
                            <div class="showonlyclick{{$probutt->id}}" style="display: none;"  id="buttonattr{{$probutt->id}}">
                                <?php $attnamee1 = App\Models\Attribute::where('id',$attribute->product_attr_id)->first();
                                    $varianttt1 = App\Models\Addsubvariationn::where('product_id',$product->id)->where('product_button_id',$probutt->id)->where('main_attr_id',$attribute->product_attr_id)->get();
                                    $variantt1 = $varianttt1->unique('main_attr_value');
                                    $probutt->id;
                                    // dd($variant);
                                    $fetchvarianttext1 = App\Models\AddSubVariation::where('product_id',$product->id)->where('product_button_id',$probutt->id)->where('main_attr_id',$attribute->product_attr_id)->first();
                                ?>
                            <div class="row">
                                @if($fetchvarianttext1)
                                @if($fetchvarianttext1->variation_text_field == 1)
                                <div class="col-lg-12">
                                    <h5 class="song">{{$fetchvarianttext1->variation_text_heading}}<span class="char">@if($fetchvarianttext1->variation_text_validation != "")(Max {{$fetchvarianttext1->variation_text_validation}} characters ) @endif</span></h5><br>
                                    <p style="display: flex;"><input type="text" class="inputclass11 addtext1{{$product->id}}" value="" id="variationaddtext1{{$probutt->id}}" name="variationaddtext1" maxlength="{{$fetchvarianttext1->variation_text_validation}}" placeholder="Type here" style="margin:0px 0px 0px 10px;"></p>
                                </div>
                                @endif
                                @endif
                            </div>
                                @if($attnamee1->attr_label == 'color')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="gst">Color </p>
                                        <div class="preview">
                                            @foreach($variantt1 as $variantt1)
                                             @if($variantt1->main_attr_id == $attribute->product_attr_id)
                                             <?php  $attvaluee1 = App\Models\AttributeValue::where('id',$variantt1->main_attr_value)->first();
                                                    $fetchvariantt1 = App\Models\AddSubVariation::where('id',$variantt1->var_id)->where('product_button_id',$probutt->id)->first();
                                                    $producimgss1 = App\Models\ProductImage::where('product_id',$fetchvariantt1->product_id)->where('variation_product_id',$fetchvariantt1->id)->first();
                                                ?>
                                                <label><!--name="attr_{{$attnamee1->attr_name}}"-->
                                                <input type="hidden" name="product_id" value="{{$product->id}}"/>
                                                <input type="hidden" name="buttonid" id="buttonid" class="buttonid{{$product->id}}" data-butt="{{$probutt->id}}" value="{{$probutt->id}}"/>
                                                <input style="background-color:{{$attvaluee1->attr_value_title}};" class="form-control cradio{{$attvaluee1->id}} product-filter-item colorradioo{{$product->id}}" value="{{$attvaluee1->id}}"  name="attname{{$probutt->id}}" type="radio" id="colorradio" data-butt="{{$probutt->id}}"  data-attr="{{$variantt1->var_id}}" data-attr-image="{{ asset('uploads/images/') }}/{{$producimgss1->images}}"  onclick="getattr(); getclass(); getimages();">
                                                <span  class="colorradio" data-name="{{$attnamee1->attr_name}}" data-bg-color="#{{$attvaluee1->attr_value_title}}" data-price="{{$fetchvariantt1->price}}"  data-skucode="{{$fetchvariantt1->skucode}}" data-quantity="{{$fetchvariantt1->quantity}}" data-stock="{{$fetchvariantt1->stock}}" class="size-code">
                                                </label>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @else

                        <?php $attnamee1 = App\Models\Attribute::where('id',$attribute->product_attr_id)->first();
                            $varianttt1 = App\Models\Addsubvariationn::where('product_id',$product->id)->where('main_attr_id',$attribute->product_attr_id)->get();
                            $variantt1 = $varianttt1->unique('main_attr_value');
                        // dd($variant);
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

            <div class="row">
                @if($product->imageuploadoption == 1)
                <div class="col-lg-6">
                    <h5>{{$product->imageuploadoption_heading}}</h5>
                    <p style="display: flex;"> <input type="file" name="imageupload" id="imageuploadd" class="imageupload{{$product->id}}" style="padding-left:10px;" accept="image/*"></p>
                </div>
                @endif
                @if($product->uploadlogo_option == 1)
                <div class="col-lg-6">
                    <h5>{{$product->uploadlogo_heading}}</h5>
                    <p style="display: flex;"> <input type="file" name="logoupload" id="logoupload" class="logoupload{{$product->id}}" style="padding-left:10px;" accept="image/*"></p>
                </div>
                @endif
            </div>

            <div class="row">
                @if($product->text_field == 1)
                <div class="col-lg-12">
                    <h5 class="song">{{$product->text_heading}}<span class="char">@if($product->text_validation != "")(Max {{$product->text_validation}} characters ) @endif</span></h5><br>
                    <p style="display: flex;"><input type="text" class="inputclass11 addtext1{{$product->id}}" name="addtext1" maxlength="{{$product->text_validation}}" placeholder="Type here" style="margin:0px 0px 0px 10px;"></p>
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
                    <p style="display: flex;"><input type="text" class="inputclass11 addtext2{{$product->id}}" name="addtext2" maxlength="{{$product->addatext_validation}}" placeholder="Type here" style="margin:0px 0px 0px 10px;"></p>
                </div>
                @endif
            </div>
            <div class="row">
                <?php  $optionheading = App\Models\ProductSelectHeading::where('product_id',$product->id)->get();?>
                @foreach($optionheading as $optionheading)
                <?php $option = App\Models\ProductSelectOption::where('product_id',$product->id)->where('product_select_id',$optionheading->id)->get(); ?>
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
            <div class="row">
                <div class="col-lg-10">
                    <form class="mb-30 loc" action="">
                        <div class="input-group">
                            <input type="text" class="form-control border-0 p-4 timecss location{{$product->id}}" name="location" placeholder="Pincode/Location (only Bangalore)" style="color:#000!important;">
                            <div class="input-group-append1">
                                <i class="fa-thin fa-location-dot fa-fw" aria-hidden="true"></i>
                            </div>
                        </div>
                    </form>
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
                    <input type="date"  name="datee" class="datecss datee{{$product->id}}" placeholder="Select Delivery Date"  onfocus = "(this.type = 'date')"  id = "date">
                </div>
                @endif
                @if($product->timee == 1)
                <div class="col-lg-6">
                    <input   type="time" name="timee" class="timecss timee{{$product->id}}" placeholder="Select Delivery Time"  onfocus = "(this.type = 'time')"  id = "time">
                </div>
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
                        <input type="radio" class="custom-control-input pickup_type{{$product->id}}" value="Ola"  id="ola" name="pickup_type">
                        <label class="custom-control-label" for="ola" style="color:#000;font-size:18px;">Ola</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input pickup_type{{$product->id}}" value="Uber" id="uber" name="pickup_type">
                        <label class="custom-control-label" for="uber" style="color:#000;font-size:18px;">Uber</label>
                    </div>

                </div>
            </div>
            @endif
            @if($product->anyspecificdesign_option == 1)
            <p>Any specific design?<a href="{{url('/contactus')}}" style="color:#33cfff">Contact Us</a></p>
            @endif
            @if($product->giftwrapper_option == 1)
            <div class="row">
                <div class="col-lg-12">
                    <h5>Gift-Wrap:</h5>
                    <p style="display: flex;"><input type="checkbox" name="giftwrap" class="giftwrap{{$product->id}}" style="width: 20px;"><span style="padding-left: 10px;">Add Gift wrap(+₹{{$product->giftwrapper_price}})</span></p>
                    <input type="hidden" class="giftwrap_price{{$product->id}}"  name="giftwrap_price" value="{{$product->giftwrapper_price}}">
                </div>
            </div>
            @endif
            @if($product->haveadesigninmind_option == 1)
            <button type = "button" class ="havedesign">Have a design in mind? WhatsApp Us!</button>
            @endif

            @if($product->textareaa == 1)
            <div class="form-group">
                <h5>{{$product->textarea_name}} <span class="text-danger1">@if($product->textarea_validation != "")(Max {{$product->textarea_validation}} characters) @endif</span></h5>
                <textarea class="form-control description{{$product->id}}" name="description" required id="message_popup" maxlength="{{$product->textarea_validation}}" cols="30" rows="4" tabindex="1" style="border: 1px solid #767676; "></textarea>
            </div>
            @endif

            @if($product->comment == 1)
            <div class="row">
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
                    <a href="" data-toggle="modal" data-target="#exampleModalCenter" style="color: darkturquoise;font-size: 23px;">
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
                <div class="col-lg-6">
            <button type = "button" class = "logbtn add-to-varcartt1{{$product->id}}"  style="background: #f2f2f2; color: black;  border: none;width: 100%;">ADD TO CART</button>
            </div>
            <div class="col-lg-6">
              <button type = "button" class = "logbtn" style="width: 100%; ">BUY NOW</button>
              </div>
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
         //   var imageupload = $('.imageupload<?php echo $product->id; ?>').val();
         //   var logoupload = $('.logoupload<?php echo $product->id; ?>').val();

    var imageupload = $('#imageuploadd').prop('files')?.[0];
    var logoupload = $('#logouploadd').prop('files')?.[0];
    var _token = $('meta[name="csrf-token"]').attr('content');

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


        </div>
    </div>

@else

<?php
$productimg = App\Models\ProductImage::where('product_id', $product->id)->whereNull('variation_product_id')->get();
$producimg = App\Models\ProductImage::where('product_id', $product->id)->whereNull('variation_product_id')->get();
$prodimg = App\Models\ProductImage::where('product_id', $product->id)->whereNull('variation_product_id')->first();
?>
    <div class="row">
        <!-- card left -->
    <div class = "col-lg-5 product-imgs mrtp">
        <div class = "img-display">
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
            <i class = "fas fa-star"></i>
            <i class = "fas fa-star"></i>
            <i class = "fas fa-star"></i>
            <i class = "fas fa-star"></i>
            <i class = "fas fa-star"></i>
        </div>
        </h2>
        <div class = "product-price">
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
                            <input type="radio" class="custom-control-input eggtype{{$product->id}}" id="size-1" value="Egg" name="egg_type">
                            <label class="custom-control-label" for="size-1"> <img src="{{ asset('img/egg.png')}}" class="egg">Egg</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input eggtype{{$product->id}}" id="size-2" value="Egg Less" name="egg_type">
                        <label class="custom-control-label" for="size-2">  <img src="{{ asset('img/eggless.png')}}" class="eggless">Eggless</label>
                        </div>
                        @endif
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @if($product->imageuploadoption == 1)
            <div class="col-lg-6">
                <h5>{{$product->imageuploadoption_heading}}</h5>
                <p style="display: flex;"> <input type="file" name="imageupload" id="imageuploadd" class="imageupload{{$product->id}}" style="padding-left:10px;" accept="image/*"></p>
            </div>
            @endif
            @if($product->uploadlogo_option == 1)
            <div class="col-lg-6">
                <h5>{{$product->uploadlogo_heading}}</h5>
                <p style="display: flex;"> <input type="file" name="logoupload" id="logouploadd" class="logoupload{{$product->id}}" style="padding-left:10px;" accept="image/*"></p>
            </div>
            @endif
        </div>
        <div class="row">
            @if($product->text_field == 1)
            <div class="col-lg-12">
                <h5 class="song">{{$product->text_heading}}<span class="char">@if($product->text_validation != "")(Max {{$product->text_validation}} characters ) @endif</span></h5><br>
                <p style="display: flex;"><input type="text" class="inputclass11 addtext1{{$product->id}}" name="addtext1" maxlength="{{$product->text_validation}}" placeholder="Type here" style="margin:0px 0px 0px 10px;"></p>
            </div>
            @endif
        </div>
        <div class="row">
            @if($product->addatext_option == 1)
            <div class="col-lg-12">
                <h5 class="song">{{$product->addatext_heading}}<span class="char">@if($product->addatext_validation != "")(Max {{$product->addatext_validation}} characters ) @endif</span></h5><br>
                <p style="display: flex;"><input type="text" class="inputclass11 addtext2{{$product->id}}" name="addtext2" maxlength="{{$product->addatext_validation}}" placeholder="Type here" style="margin:0px 0px 0px 10px;"></p>
            </div>
            @endif
        </div>
    <br>
    <div class="row">
        <?php  $optionheading = App\Models\ProductSelectHeading::where('product_id',$product->id)->get();?>
        @foreach($optionheading as $optionheading)
        <?php $option = App\Models\ProductSelectOption::where('product_id',$product->id)->where('product_select_id',$optionheading->id)->get(); ?>
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
        <div class="row">
            <div class="col-lg-10">
                <form class="mb-30 loc" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4 timecss location{{$product->id}}" name="location" placeholder="Pincode/Location (only Bangalore)" style="color:#000!important;">
                        <div class="input-group-append1">
                            <i class="fa-thin fa-location-dot fa-fw" aria-hidden="true"></i>
                        </div>
                    </div>
                </form>
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
                <input type="date"  name="datee" class="datecss datee{{$product->id}}" placeholder="Select Delivery Date"  onfocus = "(this.type = 'date')"  id = "date">
            </div>
            @endif
            @if($product->timee == 1)
            <div class="col-lg-6">
                <input   type="time" name="timee" class="timecss timee{{$product->id}}" placeholder="Select Delivery Time"  onfocus = "(this.type = 'time')"  id = "time">
            </div>
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
        <div class="row">
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
        <div class="row">
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
                <a href="" data-toggle="modal" data-target="#exampleModalCenter" style="color: darkturquoise;font-size: 23px;">
                    For any Queries - Get in Touch
                </a>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-6">
        <button type = "button" class = "logbtn add-to-procartt11{{$product->id}}"  style="background: #f2f2f2; color: black;  border: none;width: 100%;">ADD TO CART</button>
        </div>
        <div class="col-lg-6">
          <button type = "button" class = "logbtn" style="width: 100%; ">BUY NOW</button>
          </div>
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
   // var imageupload = $('.imageupload<?php echo $product->id; ?>').val();
    //var logoupload = $('.logoupload<?php echo $product->id; ?>').val();
    var imageupload = $('#imageuploadd').prop('files')?.[0];
    var logoupload = $('#logouploadd').prop('files')?.[0];
    var _token = $('meta[name="csrf-token"]').attr('content');

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
        url: "{{url('add-to-cart')}}",
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
    </div>
</div>

    @endif
</div>

<div class="row px-xl-5">
    <div class="col">
        <div class="bg-light p-30">
            <div class="nav nav-tabs mb-4">
                <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Specifications </a>
                <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Delivery Information</a>
                <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-4">Color Disclaimer </a>
                <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-5">Return Policy </a>
                <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-6">Reviews(1) </a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show" id="tab-pane-1">
                    <p>{!!$product->pro_long_desc!!}</p>

                </div>
                    <div class="tab-pane fade show " id="tab-pane-2">
                    <p>{!!$product->specification!!}</p>

                </div>
                    <div class="tab-pane fade show active" id="tab-pane-3">
                    <p>{!!$product->delivery_info!!}</p>

                </div>
                    <div class="tab-pane fade show " id="tab-pane-4">
                    <p>{!!$product->color_desclaimer!!}</p>

                </div>
                <div class="tab-pane fade" id="tab-pane-5">
                    <p>{!!$product->return_policy!!}</p>
                </div>
                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">1 review for "Product Name"</h4>
                            <div class="media mb-4">
                                <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                <div class="media-body">
                                    <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                    <div class="text-primary mb-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-4">Leave a review</h4>
                            <small>Your email address will not be published. Required fields are marked *</small>
                            <div class="d-flex my-3">
                                <p class="mb-0 mr-2">Your Rating * :</p>
                                <div class="text-primary">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
        var data = $.parseJSON($.ajax({
            url: "{{url('/charmloadd')}}",
            type: "POST",
            data: {'product':productdd, 'charmvalue': charm, _token: '{{csrf_token()}}' },
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
@endpush
@endsection
