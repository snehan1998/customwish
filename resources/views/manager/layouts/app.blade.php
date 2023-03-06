<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CustomWish | @yield('title')</title>
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
<style>

</style>
@stack('after-styles')
</head>
<body>

    <!-- Topbar Start -->

    <div class="bg-secondary">
        <div class="container">
            <div class="row py-0 justify-content-end mx-0">
                <!-- <div class="col-lg-6 d-none d-lg-block">
                </div> -->
                <div class="col-lg-12 text-lg-right pr-0 align-self-end">
                    <a class="text-body mr-3" href="{{url('/contactus')}}">Contact Us</a>
                    <a class="text-body mr-3" href="{{url('/blogs')}}">Blog</a>
                    <a class="text-body pr-0" href="{{url('/corporategift')}}" style="border-right: none;"><i class="fa fa-gift" aria-hidden="true"></i> Corporate Gifts</a>
                </div>
            </div>
        </div>
    </div>
    <div class="header_main">
        <div class="container">
            <div class="row mx-0 align-items-center justify-content-between bg-light py-2 d-lg-flex">
                <div class="logo_sec">
                    <a href="{{url('/')}}" class="logo-head">
                    <img src="{{asset('img/l1.jpg')}}">
                        <!--<span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                        <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>-->
                    </a>
                </div>
                <div class="search_product pl-0 serch">
                    <form action="{{url('/searcha')}}" method="get">
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
                <div class="pincode_sec px-0 loc-align">
                    <div class="input-group-append1">

                        <form action="">
                            <div class="input-group">
                            <span class="input-group-text bg-transparent text-primary1">
                            <i class="fa fa-map-marker-alt"></i>
                        </span>
                                <input type="text" class="form-control delivery" placeholder="Select Delivery Location">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="cart_sec text-right">
                    <p class="nab laphone"><img src="{{asset('img/icons/p.png')}}" class="phone"><br>1234567898</p>
                    @if(Auth::check())
                    <?php $userr1= App\Models\User::where('id',Auth::user()->id)->first();
                            $carr = App\Models\Cart::where('user_id',Auth::user()->id)->count(); ?>
                        @if($userr1->role_id == '3')
                            <a href="{{url('/cart')}}"><p class="nab"><img src="{{asset('img/icons/c.png')}}">
                                <span class="badge text-secondary border border-secondary rounded-circle cart_count"> {{$carr}}</span><br>Cart</p></a>
                        @else
                            <a href="{{url('login')}}"><p class="nab"><img src="{{asset('img/icons/c.png')}}">
                                <span class="badge text-secondary border border-secondary rounded-circle cart_count">0</span><br>Cart</p></a>
                        @endif
                    @else
                        <a href="{{url('login')}}"><p class="nab"><img src="{{asset('img/icons/c.png')}}">
                        <span class="badge text-secondary border border-secondary rounded-circle cart_count">0</span><br>Cart</p></a>
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
        </div>
    </div>
    <!-- Topbar End -->



    <div class="container" style="display:none;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            </nav>
    </div>
<div class="nav_header">
    <div class="container d-flex justify-content-center align-items-center">

    <nav id="navbar" class="custom navbar" >
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
            <a href="{{url('/')}}/cat/{{$maincategory->id}}">{{$maincategory->cat_name}} <span class="fa-thin fa-chevron-down" ></span></a>
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
</div>
</div>


    @yield('content')



    <!-- Footer Start -->
<div class="footer_section">
    <div class="container text-secondary pt-5">
        <div class="row pt-5">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-sm-3 com">
                        <h5 class="text-secondary text-Capitallise mb-4">Our Company</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary foottext mb-2" href="{{url('/aboutus')}}"><!--<i class="fa fa-angle-right mr-2"></i>-->About Us</a>
                            <a class="text-secondary foottext mb-2" href="{{url('/media')}}">Media Coverage</a>
                            <a class="text-secondary foottext mb-2" href="#">Customer Reviews</a>
                            <a class="text-secondary foottext mb-2" href="{{url('/corporategift')}}">Corporate Gifts</a>
                            <a class="text-secondary foottext mb-2" href="{{url('/event')}}">Events</a>
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
                            <a class="text-secondary mb-2 foottext" href="{{url('/offers')}}">Offers</a>
                            <a class="text-secondary mb-2 foottext" href="{{url('/giftvoucher')}}">Gift Vochers</a>
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
        <a href="https://wa.me/9886888572" target="_blank" class="float1" id="myDIV" style="display: none;"><img src="{{asset('img/wt.svg')}}" width="100%"></a>
        <a href="sms:+919886888572" class="float2"  id="myDIV1"><img src="{{asset('img/icon-phone-png-8.jpg')}}" width="100%" style="border-radius:5px;"></a>
        <a class="float" id="exampleRadios1" style="font-size: 30px;color: black;">
        <i class="fa fa-bars my-float"></i>
        </a>

    </div>
</div>
<div class="footer_bottom">
    <div class="container">
        <div class="row border-top">
            <div class="col-md-12 px-xl-0">
                <div class="text-center">
                    <p class="mb-md-0 text-center text-secondary py-2">&copy; 2022 Customwish All Rights Reserved. </p>
                </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
         $("#myDIV").hide();
         $("#myDIV1").hide();
     $("#exampleRadios1").click(function(){
       $("#myDIV").toggle();
        $("#myDIV1").toggle();
     });
    });
    </script>
@stack('after-scripts')

</body>

</html>
