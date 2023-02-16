<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CustomWish | Order Details</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset('img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href='https://fonts.googleapis.com/css?family=Mulish' rel='stylesheet'>
    <!-- <link rel="canonical" href="https://8font.com/quimera-font/" />-->

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

	<link rel="stylesheet" href="{{asset('css/aos.css')}}" />
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">

@stack('after-styles')
</head>
<body>

  <div class="shop-ccc">
    <h1 class="shopping-crt">Order Details</h1>
        <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
            	<div class="dashboard-box">
        		<div><div class="card-box">
                    <div class="card-body p-0">
                        <div class="row p-4">
                            <div class="col-md-6">
                                <img src="{{asset('img/l1.jpg')}}" class="text-left" style="
                                width: 150px;
                                height: 72px;
                            "><br>
                                    <?php $coo = App\Models\Contact::where('id','1')->first(); ?>
                                    <p>{{$coo->address}}</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p class="font-weight-bold mb-1">Invoice : </p> {{$order->order_id}}
                                <p class="text-muted font-weight-bold">Order Date : </p> {{$order->created_at}}
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
                    <div class="row p-4">
                        <div class="col-md-12">
                            <div class="table-responsive">
                             <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th style="width: 100px;">Image</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Extra fields</th>
                                        <th>Any Other Comments</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>                                                                                                                                                        <tr>
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
                                            <img style="width:92%" src="{{asset('uploads/images/') }}/{{$image}}">
                                        </td>
                                        <td>{{$product->product_name}}</td>
                                        <td>&#8377;{{$price}}</td>
                                        <td>{{$row->quantity}}</td>
                                        <td>&#8377;@if($row->quantity != "undefined") {{$price * $row->quantity}} @else  {{$price}} @endif</td>
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
                                                @foreach($expchar as $charm_id)
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
                                        <td>
                                        {{$row->status}}
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="p-r-20 p-l-20 text-right">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2 font-weight-light">₹{{$order->payable_price}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb-3"><button class="btn btn-danger btn-sm mr-5" type="button" onclick="window.print()">Print</button></div>

	</article>


  </div>
</div>
</div>
</div>
  </div>


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('lib/easing/easing.min.js') }}"></script>
        <script src="{{asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

        <!-- Contact Javascript File -->
        <script src="{{asset('mail/jqBootstrapValidation.min.js') }}"></script>
        <script src="{{asset('mail/contact.js') }}"></script>

        <!-- Template Javascript -->
        <script src="{{asset('js/main.js')}}"></script>
        <script src="{{asset('js/aos.js') }}"></script>
    <script>
      AOS.init();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
        $('.icon').click(function(){
          $('span').toggleClass('cancel');
        })
      </script>
    @stack('after-scripts')
  </body>

</html>
