@push('after-styles')
@endpush
@extends('layouts.app')
@section('title', 'Corporate Gift')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumb mb-30">
                    <a class="breadcrumb-item text-dark" href="https://websitedemos.co.in/customwish">Home</a>
                    <span class="breadcrumb-item active">Corporate Gifts</span>
                </nav>
            </div>
        </div>
    </div>

    <!-- <div class="container">
        <div class="row mb-3">
            <div class="sort">
                <h1 class="birth">Personalized  &nbsp;&nbsp;<span class="rate">4.6 <i class="fa fa-star"></i></span> &nbsp;&nbsp;<span class="review">1200 Reviews</span></h1>
                <p class="sortb">Sort By:
                    <button class="sortbar_tab__3Bhn- sortbar_active__3Tw7A" data-att="1" data-sortsel="Recommended" value="Recommended" type="button">Recommended</button>
                    <button class="sortbar_tab__3Bhn- false" data-sortsel="New" value="New" type="button">New</button>
                    <button class="sortbar_tab__3Bhn- false" data-sortsel="Price: Low to High" value="Price: Low to High" type="button">Price: Low to High</button>
                    <button class="sortbar_tab__3Bhn- false" data-sortsel="Price: High to Low" value="Price: High to Low" type="button">Price: High to Low</button>
                </p>
			</div>
		</div>
	</div> -->

    <div class="container pt-5 pb-3">

        <div class="product_list_section">
            <div class="row justify-content-center">

                <div class="col-lg-3 col-md-4 col-sm-6 pb-1 aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <a href="{{url('/corporateproductdetails')}}">
                                <img src="https://websitedemos.co.in/customwish/public/uploads/images/167455698463cfb6381d43a.capture - Copy.PNG" alt="service-image2" class="img-fluid w-100">
                            </a>

                            <input type="hidden" name="product_id" value="8" class="product_id8">
                            <input type="hidden" name="product_name" class="product_name8" value="Wanderlust - Travel Journal For Short Journey(15 Days)">
                            <input type="hidden" name="product_price" class="product_price8" value="1000">
                            <input type="hidden" class="session_id" name="session_id" value="BL6k58kVCWidb7ttoXCLhzOWYzsmf0Vj06bEBRvW">

                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square bluey" href="{{url('/corporateproductdetails')}}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-outline-dark btn-square yehr wishlistproduct8"><i class="far fa-heart"></i></a>
                            
                                <!-- <a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->
                            </div>
                        </div>
                        <div class="text-center py-2">
					        <div class="d-flex align-items-center justify-content-center review_star mb-1">
                            <p>
                                <span class="fa-stack" style="width:1em">
                                    <i class="far fa-star fa-stack-1x"></i>
                                    <i class="fas fa-star fa-stack-1x"></i>
                                </span>
                                <span class="fa-stack" style="width:1em">
                                    <i class="far fa-star fa-stack-1x"></i>
                                    <i class="fas fa-star fa-stack-1x"></i>
                                </span>
                                <span class="fa-stack" style="width:1em">
                                    <i class="far fa-star fa-stack-1x"></i>
                                    <i class="fas fa-star fa-stack-1x"></i>
                                </span>
                                <span class="fa-stack" style="width:1em">
                                    <i class="far fa-star fa-stack-1x"></i>
                                    <i class="fas fa-star-half fa-stack-1x"></i>
                                </span>
                                <span class="fa-stack" style="width:1em">
                                    <i class="far fa-star fa-stack-1x"></i>
                                </span>
                                                    
                            </p>  
                        </div>
                        <a class="h6 text-decoration-none text-truncate" href="{{url('/corporateproductdetails')}}">Wanderlust - Travel Journal For Short Journey(15 Days)</a>
                        <!-- <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>₹1000</h5>
                        </div> -->
                    </div>
                </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1 aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <a href="{{url('/corporateproductdetails')}}"  >
                                <img src="https://websitedemos.co.in/customwish/public/uploads/images/167455698463cfb6381d43a.capture - Copy.PNG" alt="service-image2" class="img-fluid w-100">
                            </a>

                            <input type="hidden" name="product_id" value="8" class="product_id8">
                            <input type="hidden" name="product_name" class="product_name8" value="Wanderlust - Travel Journal For Short Journey(15 Days)">
                            <input type="hidden" name="product_price" class="product_price8" value="1000">
                            <input type="hidden" class="session_id" name="session_id" value="BL6k58kVCWidb7ttoXCLhzOWYzsmf0Vj06bEBRvW">

                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square bluey" href="{{url('/corporateproductdetails')}}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-outline-dark btn-square yehr wishlistproduct8"><i class="far fa-heart"></i></a>
                            
                                <!-- <a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->
                            </div>
                        </div>
                        <div class="text-center py-2">
					        <div class="d-flex align-items-center justify-content-center review_star mb-1">
                            <p>
                                <span class="fa-stack" style="width:1em">
                                    <i class="far fa-star fa-stack-1x"></i>
                                    <i class="fas fa-star fa-stack-1x"></i>
                                </span>
                                <span class="fa-stack" style="width:1em">
                                    <i class="far fa-star fa-stack-1x"></i>
                                    <i class="fas fa-star fa-stack-1x"></i>
                                </span>
                                <span class="fa-stack" style="width:1em">
                                    <i class="far fa-star fa-stack-1x"></i>
                                    <i class="fas fa-star fa-stack-1x"></i>
                                </span>
                                <span class="fa-stack" style="width:1em">
                                    <i class="far fa-star fa-stack-1x"></i>
                                    <i class="fas fa-star-half fa-stack-1x"></i>
                                </span>
                                <span class="fa-stack" style="width:1em">
                                    <i class="far fa-star fa-stack-1x"></i>
                                </span>
                                                    
                            </p>  
                        </div>
                        <a class="h6 text-decoration-none text-truncate" href="{{url('/corporateproductdetails')}}">Wanderlust - Travel Journal For Short Journey(15 Days)</a>
                        <!-- <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>₹1000</h5>
                        </div> -->
                    </div>
                </div>
                </div>
            

                <div class="col-lg-3 col-md-4 col-sm-6 pb-1 aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <a href="{{url('/corporateproductdetails')}}">
                                <img src="https://websitedemos.co.in/customwish/public/uploads/images/167455718563cfb701a6c13.acrylic - Copy.PNG" alt="service-image2" class="img-fluid w-100">
                            </a>

                            <input type="hidden" name="product_id" value="9" class="product_id9">
                            <input type="hidden" name="product_name" class="product_name9" value="Fram name here Acrylic Stand">
                            <input type="hidden" name="product_price" class="product_price9" value="100">
                            <input type="hidden" class="session_id" name="session_id" value="BL6k58kVCWidb7ttoXCLhzOWYzsmf0Vj06bEBRvW">

                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square bluey" href="{{url('/corporateproductdetails')}}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-outline-dark btn-square yehr wishlistproduct9"><i class="far fa-heart"></i></a>
                                <!--   <a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->
                            </div>
                        </div>
                        <div class="text-center py-2">
					        <div class="d-flex align-items-center justify-content-center review_star mb-1">
                        </div>
                        <a class="h6 text-decoration-none text-truncate" href="{{url('/corporateproductdetails')}}">Fram name here Acrylic Stand</a>
                        <!-- <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>₹100</h5>
                        </div> -->
                    </div>
                </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1 aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <a href="{{url('/corporateproductdetails')}}">
                                <img src="https://websitedemos.co.in/customwish/public/uploads/images/167455796263cfba0a23dbf.passport-cover.png" alt="service-image2" class="img-fluid w-100">
                            </a>

                            <input type="hidden" name="product_id" value="11" class="product_id11">
                            <input type="hidden" name="product_name" class="product_name11" value="Passport Cover name here">
                            <input type="hidden" name="product_price" class="product_price11" value="1000">
                            <input type="hidden" class="session_id" name="session_id" value="BL6k58kVCWidb7ttoXCLhzOWYzsmf0Vj06bEBRvW">

                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square bluey" href="{{url('/corporateproductdetails')}}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-outline-dark btn-square yehr wishlistproduct11"><i class="far fa-heart"></i></a>
                            <!--   <a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->
                            </div>
                        </div>
                        <div class="text-center py-2">
					        <div class="d-flex align-items-center justify-content-center review_star mb-1">

                            </div>
                        <a class="h6 text-decoration-none text-truncate" href="{{url('/corporateproductdetails')}}">Passport Cover name here</a>
                        <!-- <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>₹1000</h5>
                        </div> -->
                    </div>
                </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1 aos-init" data-aos="fade-left" data-aos-delay="200">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <a href="{{url('/corporateproductdetails')}}">
                                <img src="https://websitedemos.co.in/customwish/public/uploads/images/167455934263cfbf6e04812.thank - Copy.PNG" alt="service-image2" class="img-fluid w-100">
                            </a>

                            <input type="hidden" name="product_id" value="17" class="product_id17">
                            <input type="hidden" name="product_name" class="product_name17" value="Thankyou Card">
                            <input type="hidden" name="product_price" class="product_price17" value="1000">
                            <input type="hidden" class="session_id" name="session_id" value="BL6k58kVCWidb7ttoXCLhzOWYzsmf0Vj06bEBRvW">

                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square bluey" href="{{url('/corporateproductdetails')}}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-outline-dark btn-square yehr wishlistproduct17"><i class="far fa-heart"></i></a>
                        
                            <!--   <a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->
                            </div>
                        </div>
                        <div class="text-center py-2">
					        <div class="d-flex align-items-center justify-content-center review_star mb-1">
                            </div>
                            <a class="h6 text-decoration-none text-truncate" href="{{url('/corporateproductdetails')}}">Thankyou Card</a>
                            <!-- <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>₹1000</h5>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1 aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <a href="{{url('/corporateproductdetails')}}">
                                <img src="https://websitedemos.co.in/customwish/public/uploads/images/167455796263cfba0a23dbf.passport-cover.png" alt="service-image2" class="img-fluid w-100">
                            </a>

                            <input type="hidden" name="product_id" value="11" class="product_id11">
                            <input type="hidden" name="product_name" class="product_name11" value="Passport Cover name here">
                            <input type="hidden" name="product_price" class="product_price11" value="1000">
                            <input type="hidden" class="session_id" name="session_id" value="BL6k58kVCWidb7ttoXCLhzOWYzsmf0Vj06bEBRvW">

                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square bluey" href="{{url('/corporateproductdetails')}}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-outline-dark btn-square yehr wishlistproduct11"><i class="far fa-heart"></i></a>
                            <!--   <a class="btn btn-outline-dark btn-square botadd" href="">Add To Cart</a>-->
                            </div>
                        </div>
                        <div class="text-center py-2">
					        <div class="d-flex align-items-center justify-content-center review_star mb-1">

                            </div>
                        <a class="h6 text-decoration-none text-truncate" href="{{url('/corporateproductdetails')}}">Passport Cover name here</a>
                        <!-- <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>₹1000</h5>
                        </div> -->
                    </div>
                </div>
                </div>
                
                
</div>
                
            
            </div>
            <div class="text-center"> 
                <a href="" class="btn btn-primary mx-0">Show More Products</a>
            </div>
            </div>
        </div>	



        


@push('after-scripts')
@endpush
@endsection
