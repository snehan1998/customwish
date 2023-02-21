@push('after-styles')
<link rel="stylesheet" href="{{asset('css/swiper.css')}}">
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">
<style>
.media-body, .media-left, .media-right {
display: table-cell;
vertical-align: top;
}
.media-body {
width: 10000px;
}
.text-center {
text-align:center;

}
h2,h1 {
margin:0;
padding-top:30px;
}

.bg-color {
background: var(--bg-color);
}

.half-color-box {
background: var(--gradient);
height: 300px;
margin-bottom: 100px;
}

.text-whtie {
color: #fff !important;
}

.bold {
font-weight: bolder;
padding: 100px 0 0 0;
}
.por {
position: relative;
}

.review-box .quote {
position: absolute;
width: 40px;
right: 10px;
bottom: 10px;
}

.test-arrowbox {
position: absolute;
right: 20px;
display: flex;
top: 70px;
}

.review-box {
border-radius: 10px;
background: #fff;
box-shadow: 0px 3px 20px rgba(0, 0, 0, 0.1);
padding: 30px;
}

.review-box h5 {
margin: 50px 0 0 20px;
}

.review-box p {
margin-bottom: 0;
margin-top: 38px;
color: #7d8597;
}

.user-post {
font-size: 14px;
margin: 0 !important;

}

.swiper-testimonial {
padding: 60px 20px;
padding-top: 30px;
}

.half-color-box {
background: linear-gradient(#dc354542, #f9cbcf);
height: 300px;
margin-bottom: 360px;
}

.test-arrowbox .swiper-button-next-test,
.test-arrowbox .swiper-button-prev-test {
margin-right: 20px;
/* background: var(--comp-color);2 */
border-radius: 50%;
--size: 55px;
width: var(--size);
height: var(--size);
display: flex;
align-items: center;
justify-content: center;
}

.arrow-right {
transform: rotate(180deg);
margin-top: -8px;
}

.arrow {
cursor: pointer;
transition: all 0.2s ease-in;
}

.arrow:hover {
transform: translateX(-15px);
}
</style>


@endpush
@extends('layouts.app')
@section('title', 'Testimonial')
@section('content')


<section class="half-color-box hidden-xs hidden-sm">
    <div class="container spacer por">
        <div class="text-whtie text-center ml-3">
            <h1 class="bold">What People are saying?</h1>
           <p class="lead">
               <!--  Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, at!-->
            </p>
        </div><br><br>
        <div class="test-arrowbox">
            <div class="swiper-button-prev-test">
                <svg fill="#0d0862" height="34" class="arrow left">
                    <use xlink:href="#arrow" />
                </svg>
            </div>
            <div class="swiper-button-next-test">
                <div class="arrow-right">
                    <svg fill="#0d0862" height="60" width="60" class="arrow">
                        <use xlink:href="#arrow" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="swiper-container swiper-testimonial ">
            <div class="swiper-wrapper">
                @foreach($testi as $testi)
                <div class="swiper-slide">
                    <div class="test-img" >
                        <div class="d-flex align-items-center justify-content-start">
                            <span class="aname">{{$testi->letter}}</span>
                            <p class="clicl"><a href="">{{$testi->name}}</a></p>
                        </div>
                        <p class="tes">{!!$testi->description!!}</p>
                        <div class="d-flex align-items-center justify-content-left mb-1">
                            @if($testi->rating != null)
                            @for($i=1; $i<=$testi->rating; $i++)
                            <small class="fa fa-star text-primary mr-1"></small>
                            @endfor
                            @endif
                        </div>
                    </div>
                    <div class="review-box" style="display:none" >
                        <div class="media">
                            
                            <div class="test-img">
                                <span class="aname">{{$testi->letter}}</span>
                            </div>
                            <div class="media-body">
                                <h5><a href="">{{$testi->name}}</a></h5>
                            </div>
                        </div>
                        <div class="read">
                            <p>{!!$testi->description!!}</p>
                            <div class="d-flex align-items-center justify-content-left mb-1">
                                @if($testi->rating != null)
                                @for($i=1; $i<=$testi->rating; $i++)
                                <small class="fa fa-star text-primary mr-1"></small>
                                @endfor
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
		</div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>
</section>


<div class="foot-top">
    <div class="container">
        <div class="row justify-content-center align-items-center" >
            @foreach($section8 as $section8)
            <div class="col-md-3 text-center">
                <img src="{{asset('uploads/images')}}/{{$section8->section_image}}">
                <p class="event">{{$section8->section_name}}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>


@push('after-scripts')


  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>


	<script>
	var swiper = new Swiper('.swiper-container.swiper-testimonial', {
    slidesPerView: 3,
    spaceBetween: 30,
	  autoplay: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next-test',
        prevEl: '.swiper-button-prev-test',
    },
});
</script>
@endpush
@endsection
