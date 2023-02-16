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

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        *{
          margin: 0;
          padding: 0;
          user-select: none;
          box-sizing: border-box;
          font-family: 'Poppins', sans-serif;
        }
        :root{
            --yellow-color:#ffc947;
            --black-color:#1b1b1b;
            --white-color:#fff;
        }
        nav{
          background:var(--black-color);
        }
        nav:after{
          content:'';
          clear:both;
          display:table;
        }
        nav .logo{
          float:left;
          color:var(--white-color);
          font-size: 27px;
          font-weight: 600;
          line-height: 70px;
          padding-left: 60px;
        }
        nav ul{
          float:right;
          margin-right:40px;
          list-style: none;
          position:relative;
        }
        nav ul li{
          float:left;
          display:inline-block;
          background:var(--black-color);
          margin:0 5px;
        }
        nav ul li a{
          color:var(--white-color);
          line-height: 70px;
          text-decoration: none;
          font-size: 18px;
          padding:8px 15px;
          transition: 0.3s all ease;
        }
        nav ul li a:hover{
          color:var(--yellow-color);
          border-radius: 5px;
          box-shadow: 0 0 5px var(--yellow-color), 0 0 10px var(--yellow-color);
        }
        nav ul ul li a:hover{
          box-shadow: none;
        }
        nav ul ul{
          position:absolute;
          top:90px;
          z-index: 100;
          border-top:3px solid var(--yellow-color);
          opacity:0;
          visibility:hidden;
          transition: top .3s;
        }
        nav ul ul ul{
          border-top:none;
        }
        nav ul li:hover > ul{
          top:70px;
          opacity:1;
          visibility:visible;
        }
        nav ul ul li{
          position:relative;
          margin:0px;
          width:150px;
          float:none;
          display:list-item;
          border-bottom:1px solid rgba(0,0,0,0.3);
        }
        nav ul ul li a{
          line-height: 50px;
        }
        nav ul ul ul li{
          position:relative;
          top:-60px;
          left:150px;
        }
        .show,.icon,input{
          display:none;
        }
        .fa-plus{
          font-size:15px;
          margin-left:40px;
        }
        .content{
          position:relative;
        }
        .content::before{
          content:'';
          position:absolute;
          top:0;
          left:0;
          right:0;
          bottom:0;
          background-image:url('images/bg.jpg');
          background-repeat:no-repeat;
          background-position:center;
          background-size: cover;
          width:100%;
          height:calc(100vh - 70px);
        }
        .content::after{
          content:'';
          position:absolute;
          top:0;
          left:0;
          right:0;
          bottom:0;
          width:100%;
          height:calc(100vh - 70px);
          background-color: rgba(0,0,0,.50);
        }

        @media all and (max-width:968px){
          nav ul{
            margin-right:0px;
            float:left;
          }
          nav .logo{
            padding-left:30px;
            width:100%;
          }
          .show + a, ul{
            display:none;
          }
          nav ul li, nav ul ul li{
            display:block;
            width:100%;
          }
          nav ul li a:hover{
            box-shadow: none;
          }
          .show{
            display:block;
            color:var(--white-color);
            font-size: 18px;
            padding:0 12px;
            line-height: 70px;
            cursor:pointer;
          }
          .show:hover{
            color:var(--yellow-color);
          }
          .icon{
            display:block;
            color:var(--white-color);
            position:absolute;
            top:0;
            right:40px;
            line-height: 70px;
            cursor:pointer;
            font-size: 25px;
          }
          nav ul ul{
            top:70px;
            border-top:0px;
            float:none;
            position:static;
            display:none;
            opacity:1;
            visibility:visible;
          }
          nav ul ul a{
            padding-left: 40px;
          }
          nav ul ul ul a{
            padding-left: 80px;
          }
          nav ul ul ul li{
            position:static;
          }
          [id^=btn]:checked + ul{
            display:block;
          }
          nav ul ul li{
            border-bottom:0px;
          }
          span.cancel:before{
            content:'\f00d';
          }
        }

              </style>

@stack('after-styles')
</head>

<body>
    <!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <a class="text-body mr-3" href="">Contact Us</a>
            <a class="text-body mr-3" href="">Blog</a>
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
        <form action="">
            <div class="input-group">
                <input type="text" class="form-control search" placeholder="Search for products">
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
		<p class="nab"><img src="{{asset('img/icons/c.png')}}">
        <span class="badge text-secondary border border-secondary rounded-circle">0</span><br>Cart</p>
		<p class="nab des"><img src="{{asset('img/icons/a.png')}}" class="account"><br>Account</p>
    </div>
</div>
    <!-- Topbar End -->



<nav>
    <label for="btn" class="icon">
        <span class="fas fa-bars"></span>
    </label>
    <input type="checkbox" id="btn">
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
            <label for="btn-2" class="show">{{$maincategory->cat_name}}</label>
            <a href="#">{{$maincategory->cat_name}}</a>
            <input type="checkbox" id="btn-2">
            <ul>
            @if($subcategory->count() > 0)
            @foreach($subcategory as $subcategory)
              <li>
                <label for="btn-3" class="show">{{$subcategory->subcat_name}}</label>
                <a href="#">{{$subcategory->subcat_name}} <span class="fa fa-plus"></span></a>
                <input type="checkbox" id="btn-3">
                <ul>
                   <?php $cate = App\Models\ChildCategory::where('subcategory_id',$subcategory->id)->whereNotNull('subcategory_id')->where('status','Active')->get(); ?>
                  <li>
                    @foreach($cate as $cate)
                    <li><a href="{{url('/')}}/p/{{$cate->id}}">{{$cate->childcat_name}}</a></li>
                    @endforeach
                  </li>
                </ul>
              </li>
              @endforeach
              @endif
            </ul>
          </li>
          @endif
          @endforeach
          <li><a href="#">Portfolio</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>


    <!-- Navbar Start -->
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="{{url('/')}}" class="text-decoration-none d-block d-lg-none">
                        <img src="{{asset('img/l1.jpg')}}">
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                    <!-- <a href="index.html" class="nav-item nav-link active">Home</a>-->
                    <?php $maincategory = App\Models\Category::where('status','Active')->get(); ?>
                    @foreach($maincategory as $maincategory)
                    <?php $subcategory = App\Models\SubCategory::where('category_id',$maincategory->id)->where('status','Active')->get(); ?>
                    @if($subcategory->count() > 0)
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{$maincategory->cat_name}}   <i class="fa fa-angle-down mt-1"></i></a>
                            <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                @if($subcategory->count() > 0)
                                @foreach($subcategory as $subcategory)
                                <a href="{{url('/sub')}}/{{$subcategory->id}}" class="dropdown-item">{{$subcategory->subcat_name}}</a>
                                <?php $cate = App\Models\ChildCategory::where('subcategory_id',$subcategory->id)->whereNotNull('subcategory_id')->where('status','Active')->get(); ?>
                                <ul class="dropdown-menu">
                                    @foreach($cate as $cate)
                                    <li><a href="{{url('/')}}/p/{{$cate->id}}">{{$cate->childcat_name}}</a></li>
                                    @endforeach
                                </ul>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
    <!-- Navbar End -->



    @yield('content')



    <!-- Footer Start -->
<div class="container-fluid bg-dark text-secondary mt-5 pt-5" style="background-color: #002a5c !important;">
    <div class="row px-xl-5 pt-5">
	    <div class="col-lg-12 col-md-12">
            <div class="row">
                <div class="col-sm-3">
                    <h5 class="text-secondary text-Capitallise mb-4">Our Company</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary foottext mb-2" href="#"><!--<i class="fa fa-angle-right mr-2"></i>-->About Us</a>
                        <a class="text-secondary foottext mb-2" href="#">Media Coverage</a>
                        <a class="text-secondary foottext mb-2" href="#">Customer Reviews</a>
                        <a class="text-secondary foottext mb-2" href="#">Corporate Gifts</a>
                        <a class="text-secondary foottext mb-2" href="#">Events</a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <h5 class="text-secondary text-Capitallise mb-4">Help</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary foottext mb-2" href="#">My Account</a>
                        <?php $pagess = App\Models\Page::get(); ?>
                        @foreach ($pagess as $pagess)
                        <a class="text-secondary foottext mb-2" href="{{url('/pages')}}/{{$pagess->id}}">{{$pagess->title}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-3">
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
                <div class="col-sm-3">
                    <h5 class="text-secondary text-Capitallise mb-4">Other</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary foottext mb-2" href="#">Blogs</a>
                        <a class="text-secondary foottext mb-2" href="#">Client</a>
                        <a class="text-secondary  foottext mb-2" href="#">Career Opportunity</a>
                        <a class="text-secondary foottext mb-2" href="#">Contact Us</a>
                            <a class="text-secondary foottext mb-2" href="#">Shopping Cart</a>
                        <a class="text-secondary foottext mb-2" href="#">FAQ</a>
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
