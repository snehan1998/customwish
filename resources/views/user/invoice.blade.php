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

    <link rel="stylesheet" href="{{asset('css/style_custom.css')}}" />


@stack('after-styles')
</head>
<body>
    <!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <a class="text-body mr-3" href="{{url('/contactus')}}">Contact Us</a>
            <a class="text-body mr-3" href="{{url('/blogs')}}">Blog</a>
            <a class="text-body mr-3" href="" style="border-right: none;"><i class="fa fa-gift" aria-hidden="true"></i> Corporate Gifts</a>
        </div>
    </div>
</div>
<div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
    <a href="{{url('/')}}" class="logo-head">
    <img src="{{asset('img/l1.jpg')}}">
        <!--<span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
        <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>-->
    </a>
    <div class="col-lg-4 serch">
        <form action="{{url('/searcha')}}" method="post">
        @csrf
            <div class="input-group">
                <input type="text" name="search" class="form-control search" placeholder="Search for products">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent text-primary">
                        <i class="fa fa-search"></i>&nbsp;Search
                    </span>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-3 loc-align">
        <div class="input-group-append1">
            <span class="input-group-text bg-transparent text-primary1">
                <i class="fa fa-map-marker-alt"></i>
            </span>
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control delivery" placeholder="Select Delivery Location">
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-3 col-6 text-right">
		<p class="nab laphone"><img src="{{asset('img/icons/p.png')}}" class="phone"><br>1234567898</p>
		@if(Auth::check())
        <?php $userr1= App\Models\User::where('id',Auth::user()->id)->first();
                $carr = App\Models\Cart::where('user_id',Auth::user()->id)->count(); ?>
            @if($userr1->role_id == '3')
                <a href="{{url('/cart')}}"><p class="nab"><img src="{{asset('img/icons/c.png')}}">
                    <span class="badge text-secondary border border-secondary rounded-circle"> {{$carr}}</span><br>Cart</p></a>
            @else
                <a href="{{url('login')}}"><p class="nab"><img src="{{asset('img/icons/c.png')}}">
                    <span class="badge text-secondary border border-secondary rounded-circle">0</span><br>Cart</p></a>
            @endif
        @else
            <a href="{{url('login')}}"><p class="nab"><img src="{{asset('img/icons/c.png')}}">
            <span class="badge text-secondary border border-secondary rounded-circle">0</span><br>Cart</p></a>
        @endif
        @guest
            @if(Auth::check())
              <?php $user= App\Models\User::where('id',Auth::user()->id)->first(); ?>
                 @if($user->role_id == '3')
                    <a href="{{url('user/dashboard')}}"><p class="nab des"><img src="{{asset('img/icons/a.png')}}" class="account"><br>Account</p></a>
                  @elseif($user->role_id == '2')
                    <a href="{{url('manager/dashboard')}}"><p class="nab des"><img src="{{asset('img/icons/a.png')}}" class="account"><br>Account</p></a>
                 @elseif($user->role_id == '1')
                    <a href="{{url('admin/dashboard')}}"><p class="nab des"><img src="{{asset('img/icons/a.png')}}" class="account"><br>Account</p></a>
                 @else
                    <a href="{{url('/')}}"><p class="nab des"><img src="{{asset('img/icons/a.png')}}" class="account"><br>Account</p></a>
                 @endif
             @else
                 <a href="{{url('login')}}"><p class="nab des"><img src="{{asset('img/icons/a.png')}}" class="account"><br>Account</p></a>
             @endif
         @else
              <?php $user= App\Models\User::where('id',Auth::user()->id)->first(); ?>
                @if($user->role_id == '3')
                <a href="{{url('user/dashboard')}}"><p class="nab des"><img src="{{asset('img/icons/a.png')}}" class="account"><br>Account</p></a>
                @elseif($user->role_id == '2')
                <a href="{{url('manager/dashboard')}}"><p class="nab des"><img src="{{asset('img/icons/a.png')}}" class="account"><br>Account</p></a>
                @elseif($user->role_id == '1')
                    <a href="{{url('admin/dashboard')}}"><p class="nab des"><img src="{{asset('img/icons/a.png')}}" class="account"><br>Account</p></a>
                @else
                    <a href="{{url('/')}}"><p class="nab des"><img src="{{asset('img/icons/a.png')}}" class="account"><br>Account</p></a>
                @endif
        @endguest
    </div>
</div>
    <!-- Topbar End -->



<nav class="custom">
    <ul>
    <!--    <li><a href="#">Home</a></li>
        <li>
            <label for="btn-1" class="show">Features +</label>
            <a href="#">Features</a>
            <input type="checkbox" id="btn-1">
            <ul>
              <li><a  href="#">Pages</a></li>
              <li><a  href="#">Members</a></li>
              <li><a  href="#">Offers</a></li>
            </ul>
          </li>-->
          <?php $maincategory = App\Models\Category::where('status','Active')->get(); ?>
          @foreach($maincategory as $maincategory)
          <?php $subcategory = App\Models\SubCategory::where('category_id',$maincategory->id)->where('status','Active')->get(); ?>
          @if($subcategory->count() > 0)
          <li>
            <a href="{{url('/')}}/cat/{{$maincategory->id}}">{{$maincategory->cat_name}}</a>
            <ul>
            @if($subcategory->count() > 0)
            @foreach($subcategory as $subcategory)
              <li>
                <?php $cate = App\Models\ChildCategory::where('subcategory_id',$subcategory->id)->whereNotNull('subcategory_id')->where('status','Active')->get(); ?>
                @if($cate->count() > 0)
                <a href="{{url('/')}}/sub/{{$subcategory->id}}">{{$subcategory->subcat_name}} <span class="fa-thin fa-chevron-right arrowcss" ></span></a>
                <ul>
                  <li>
                    @foreach($cate as $cate)
                    <li><a href="{{url('/')}}/p/{{$cate->id}}">{{$cate->childcat_name}}</a></li>
                    @endforeach
                  </li>
                </ul>
                @else
                <a href="{{url('/')}}/sp/{{$subcategory->id}}">{{$subcategory->subcat_name}} </a>
                @endif
              </li>
              @endforeach
              @endif
            </ul>
          </li>
          @endif
          @endforeach
        </ul>
      </nav>


  <div class="shop-ccc">
    <h1 class="shopping-crt">Order Details</h1>
        <div class="container">
        <div class="row">
            @include('user.layouts.sidemenu')
            <div class="col-xl-9 col-lg-9">
            	<div class="dashboard-box">
        		<div><div class="card-box">
                    <div class="card-body p-0">
                        <div class="row p-4 justify-content-between">
                            <div class="col-md-6">
                                <img src="{{asset('img/l1.jpg')}}" class="text-left" ><br>
                                    <?php $coo = App\Models\Contact::where('id','1')->first(); ?>
                                    <p class="add_text">{{$coo->address}}</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p class="inv_text ">Invoice <span>{{$order->order_id}}</span></p>
                                <p class="inv_text ">Order Date <span> {{$order->created_at}}</span> </p>
                                <p>
                                <a href="{{ url('/prnpriview') }}/{{$order->order_id}}" class="btnprn btn"><i class="fa fa-print mr-1"></i> Print Preview </a></center>
                                <script type="text/javascript">
                                $(document).ready(function(){
                                $('.btnprn').printPage();
                                });
                                </script>
                            </p>
                            </div>
                        </div>
                    <hr class="my-3">
                    <div class="row pb-5 p-4">
                        <div class="col-md-6">
                            <div class="ship_info">
                                <p class="font-weight-bold mb-4">Shipping Information</p>
                                <p class="mb-1">{{$order->firstname}}</p>
                                <p>{{$order->address}} </p>
                                <p class="mb-1">{{$order->city}}</p>
                                <p class="mb-1">{{$order->state}}</p>
                                <p class="mb-1">{{$order->pincode}}</p>
                                <p><strong>Address Type:</strong>{{$order->address_type}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="payment_info">
                                <p class="font-weight-bold mb-4">Payment Details</p>
                                <p class="mb-1"><span class="text-muted">Payment Type: </span> {{$order->payment_type}}</p>
                            </div>
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
                                        <td>&#8377;{{$price * $row->quantity}}</td>
                                        <td>
                                            @if($row->giftwrap == 1 )
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
                                                @if($proimg != null)
                                                <a href="{{asset('uploads/images')}}/{{$proimg->cart_images}}" download>{{$proimg->cart_images}}</a>
                                                @endif
                                                @endforeach
                                            @endif
                                            @if($product->uploadlogo_option == 1)
                                            <?php $logo = explode(',',$row->product_logos_id); ?>
                                                <p><strong>{{$product->uploadlogo_heading}}</strong></p>
                                                @foreach($logo as $logo)
                                                <?php $prolog = App\Models\StoreProductCartLogo::where('id',$logo)->first();?>
                                                @if($prolog != null)
                                                <a href="{{asset('uploads/images')}}/{{$prolog->cart_logo}}" download>{{$prolog->cart_logo}}</a>
                                                @endif
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
                                        @if($row->status == 'Processing' || $row->status == 'Packed' || $row->status == 'Shipped'|| $row->status == 'Delivered' || $row->status == 'ReturnByUser'  || $row->status == 'Return')
                                        <button type="button" class="text-theme btn btn-lg btn-primary" data-catid="{{$row->id}}"  data-toggle="modal" data-target="#modal{{$row->id}}">
                                            Change Status
                                        </button>
                                            <div class="modal fade" id="modal{{$row->id}}">
                                                <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Change Status</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="col-sm-12">
                                                        <form method="post" action="{{url('/user/changeOrderStatus')}}">
                                                        @csrf
                                                        <?php $orders = App\Models\Order::orderBy('id','desc')->paginate(20); ?>
                                                        <div class="form-group">
                                                            <label>Select Status</label>
                                                            <select class="form-control" name="order_status">

                                                            <option @if($row->status == "CancelledbyUser") selected @endif value="CancelledbyUser">Cancell</option>
                                                            <option @if($row->status == "Return") selected @endif value="Return">Return</option>
                                                            </select>
                                                            <input type="hidden" name="orderr_id" value="{{$row->order_id}}">
                                                            <input type="hidden" name="order_id" id="cat_id" value="{{$row->id}}">

                                                        </div>
                                                        <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                                </div>
                                            </div>
                                        <!-- /.modal -->
                                        @endif
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    <div class="d-flex flex-row-reverse bg-dark p-2 grand_total">
                        <div class="p-r-20 p-l-20 text-right ">
                            <p class="mb-2">Grand Total: <span>₹{{$order->payable_price}}</span></p>
                            <!-- <div class="h2 font-weight-light"></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</article>
  </div>
</div>
</div>
</div>
  </div>
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5" style="background-color: #002a5c !important;">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-sm-3 com">
                        <h5 class="text-secondary text-Capitallise mb-4">Our Company</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary foottext mb-2" href="{{url('/aboutus')}}"><!--<i class="fa fa-angle-right mr-2"></i>-->About Us</a>
                            <a class="text-secondary foottext mb-2" href="#">Media Coverage</a>
                            <a class="text-secondary foottext mb-2" href="#">Customer Reviews</a>
                            <a class="text-secondary foottext mb-2" href="#">Corporate Gifts</a>
                            <a class="text-secondary foottext mb-2" href="#">Events</a>
                        </div>
                    </div>
                    <div class="col-sm-3 help">
                        <h5 class="text-secondary text-Capitallise mb-4">Help</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary foottext mb-2" href="#">My Account</a>
                            <?php $pagess = App\Models\Page::get(); ?>
                            @foreach ($pagess as $pagess)
                            <a class="text-secondary foottext mb-2" href="{{url('/pages')}}/{{$pagess->id}}">{{$pagess->title}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-3 what">
                        <h5 class="text-secondary text-Capitallise mb-4">Whats News</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2 foottext" href="#">Offers</a>
                            <a class="text-secondary mb-2 foottext" href="#">Gift Vochers</a>
                        </div><br>
                            <h5 class="text-secondary text-Capitallise mb-4">Spead The Love</h5>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-sm-3 other">
                        <h5 class="text-secondary text-Capitallise mb-4">Other</h5>
                         <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary foottext mb-2" href="{{url('/blogs')}}">Blogs</a>
                            <a class="text-secondary foottext mb-2" href="{{url('/client')}}">Client</a>
                            <a class="text-secondary  foottext mb-2" href="{{url('/careeropportunity')}}">Career Opportunity</a>
                            <a class="text-secondary foottext mb-2" href="{{url('/contactus')}}">Contact Us</a>
                                <a class="text-secondary foottext mb-2" href="#">Shopping Cart</a>
                            <a class="text-secondary foottext mb-2" href="{{url('/faq')}}">FAQ</a>

                            <a  href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                         </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br>

        <div class="row border-top" style="border-color: rgba(256, 256, 256, .1) !important; background:black;">
            <div class="col-md-12 px-xl-0">
            <div align="center">
                <p class="mb-md-0 text-center text-secondary">&copy; 2022 Customwish All Rights Reserved. </p>
            </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


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
