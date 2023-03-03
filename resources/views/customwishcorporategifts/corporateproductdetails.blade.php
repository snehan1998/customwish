@push('after-styles')
<link href="{{asset('css/custstyle.css')}}" rel="stylesheet"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<style>
  .img-select  img {
    width: 100%;
    display: block;
}

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
@section('title', 'Corporate Product Details')
@section('content')

<div class="container mt-5 mb-5">
    <div class="row align-items-start">
        <!-- card left -->
        <?php
            $corporateimgs = App\Models\CorporateGiftImage::where('corporate_id', $corporate->id)->get();
            $corporateimg = App\Models\CorporateGiftImage::where('corporate_id', $corporate->id)->get();
        ?>

        <div class="col-lg-5 product-imgs">
            <div class="img-display">
                <div class="img-showcase">
                @foreach($corporateimgs as $img)
                    <img src="{{asset('uploads/images')}}/{{$img->images}}">
                @endforeach
                </div>
            </div>
            <div class="img-select">
                <?php $i = 1; ?>
                @foreach($corporateimg as $imgs)
                <div class="img-item">
                    <a href="#" data-id="{{$i}}">
                        <img src="{{asset('uploads/images')}}/{{$imgs->images}}">
                    </a>
                </div>
                <?php $i++; ?>
                @endforeach
            </div>
            <br>

	        <p>Share with loved ones </p>
	        <div class="social-links">

                <a href="#">
                    <img src="img/icons/fb.png">
                </a>
                <a href="#">
                    <img src="img/icons/tw.png">
                </a>
                <a href="#">
                    <img src="img/icons/ins.png">
                </a>
                <a href="#">
                    <img src="img/icons/ln.png">
                </a>
                <a href="#">
                    <img src="img/icons/pin.png">
                </a>
            </div>
        </div>

        <div class="col-lg-7 product-content">
            <h2 class="product-title">{{$corporate->corp_product_name}}</h2>
            <div class="product_desc">
                <p>{!!$corporate->corp_product_desc!!}</p>
            </div>
            <form method="post" action="{{url('customwishcorporategifts/corpenquiry')}}" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="form_title">Please fill the form for product enquiry:</h3>
                </div>
                <input type="hidden" name="corporate_id" value="{{$corporate->id}}">
                <div class="col-lg-12">
                    <h5 class="song">Name</h5><br>
                    <p style="display: flex;"><input type="text" class="inputclass11 addtext18" name="name" placeholder="Enter Name" required style=""></p>
                </div>
                <div class="col-lg-12">
                    <h5 class="song">Email</h5><br>
                    <p style="display: flex;"><input type="email" class="inputclass11 email" name="email" required placeholder="Enter Email" style=""></p>
                </div>
                <div class="col-lg-12">
                    <h5 class="song">Mobile Number</h5><br>
                    <p style="display: flex;"><input type="tel" class="inputclass11 addtext18" pattern="[1-9]{1}[0-9]{9}" required name="phone" placeholder="Enter Phone number" style=""></p>
                </div>
                <div class="col-lg-12">
                    <h5 class="song">Quantity of Products</h5><br>
                    <p style="display: flex;"><input type="number" class="inputclass11 addtext18" name="quantity" requiredplaceholder="Type here" style=""></p>
                </div>
                <div class="col-lg-12">
                    <h5 class="song">Message</h5><br>
                    <p style="display: flex;"><textarea type="text" class="inputclass11 addtext18" name="message" placeholder="Enter Message" style=""></textarea></p>
                </div>
                <x-honey/>

                <div class="col-lg-6">
                <button type="submit" class="logbtn checkadd-to-procart32" style="width: 100%; ">Enquire</button>
                </div>
            </div>
        </form>
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
@endpush
@endsection
