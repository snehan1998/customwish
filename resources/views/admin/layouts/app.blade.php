
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title') | Custom Wish</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('/admincss//images/favicon.png')}}">
    <link rel="stylesheet" href="{{ URL::asset('/admincss/vendor/owl-carousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('/admincss/vendor/owl-carousel/css/owl.theme.default.min.css')}}">

    <link href="{{ URL::asset('/admincss/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('/admincss/css/style.css')}}" rel="stylesheet">


    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('after-styles')

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{url('/')}}" class="brand-logo">
              <!--  <img class="logo-abbr" src="{{ URL::asset('/img/l1.jpg')}}" alt="">-->
                <img class="logo-compact" src="{{ URL::asset('/img/l1.jpg')}}" alt="">
                <img class="brand-title" src="{{ URL::asset('/img/l1.jpg')}}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                      <div class="header-left">

                        </div>
                        <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                     <span class="label label-warning">0</span>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right scroll">
                                    <ul class="list-unstyled">

                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong></strong>
                                                    </p>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                    <a href="#" class="all-notification">See all notifications <i class="ti-arrow-right"></i></a>

                                </div>
                            </li>

                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a  href="{{url('/admin/dashboard')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-app-store"></i><span class="nav-text">Landing Page Sections</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{url('/admin/banners')}}">Banner</a></li>
                            <li><a href="{{url('/admin/section2')}}">Section2</a></li>
                            <li><a href="{{url('/admin/testimonial')}}">Testimonial</a></li>
                            <li><a href="{{url('/admin/section8')}}">Section8</a></li>
                            <li><a href="{{url('/admin/landingcake')}}">Fall In Love With Cake Section</a></li>
                         </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-app-store"></i><span class="nav-text">Product management</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{url('/admin/category')}}">Category</a></li>
                            <li><a href="{{url('/admin/subcategory')}}">Subcategory</a></li>
                            <li><a href="{{url('/admin/childcategory')}}">Childcategory</a></li>
                            <li><a href="{{url('/admin/subchildcategory')}}">SubChildcategory</a></li>
                            <li><a href="{{url('/admin/coupons')}}">Coupon</a></li>
                            <li><a href="{{url('/admin/attribute')}}">Attribute</a></li>
                            <li><a href="{{url('/admin/products')}}">Product</a></li>
                            <li><a href="{{url('/admin/productselectoption')}}">Product Charm</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-app-store"></i><span class="nav-text">About</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{url('/admin/about/1/edit')}}">AboutUs</a></li>
                            <li><a href="{{url('/admin/ourrecord')}}">Our Record</a></li>
                            <li><a href="{{url('/admin/ourteam')}}">Our Team</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-app-store"></i><span class="nav-text">Blog</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{url('/admin/blogcategory')}}">BlogCategory</a></li>
                            <li><a href="{{url('/admin/blog')}}">Blog</a></li>
                        </ul>
                    </li>
                    <li><a href="{{url('/admin/orders')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Orders</span></a></li>
                    <li><a href="{{url('/admin/manager')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Manager</span></a></li>
                    <li><a href="{{url('/admin/corporate')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Corporate</span></a></li>
                    <li><a href="{{url('/admin/careerlist')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Career List</span></a></li>
                    <li><a href="{{url('/admin/contactlist')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Contact List</span></a></li>
                    <li><a href="{{url('/admin/corporatelist')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Corporate Form List</span></a></li>
                    <li><a href="{{url('/admin/leavecomment')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Leave Comment List</span></a></li>
                    <li><a href="{{url('/admin/contact/1/edit')}}"aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Contact Us</a></li>
                    <li><a href="{{url('/admin/faq')}}"aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Faq</a></li>
                    <li><a href="{{url('/admin/pages')}}"aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Dynamic Pages</a></li>
                    <li><a href="{{url('/admin/review')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Review</span></a></li>
                    <li><a href="{{url('/admin/media')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Media</span></a></li>
                    <li><a href="{{url('/admin/event')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Event</span></a></li>
                    <li><a href="{{url('/admin/changepassword')}}"aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Change Password</a></li>
                </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
        <!--**********************************
            Content body start
        ***********************************-->
        @yield('content')

        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Custom Wish 2023 </p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ URL::asset('/admincss/vendor/global/global.min.js') }}"></script>
    <script src="{{ URL::asset('/admincss/js/quixnav-init.js') }}"></script>
    <script src="{{ URL::asset('/admincss/js/custom.min.js') }}"></script>


    <!-- Vectormap -->
    <script src="{{ URL::asset('/admincss/vendor/raphael/raphael.min.js') }}"></script>




    <!--  flot-chart js -->
    <script src="{{ URL::asset('/admincss/vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('/admincss/vendor/flot/jquery.flot.resize.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ URL::asset('/admincss/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

    <!-- Counter Up -->
    <script src="{{ URL::asset('/admincss/vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('/admincss/vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('/admincss/vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>


    <script src="{{ URL::asset('/admincss/js/dashboard/dashboard-1.js')}}"></script>




    @stack('after-scripts')
</body>

</html>
