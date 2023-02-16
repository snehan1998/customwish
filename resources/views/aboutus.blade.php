@push('after-styles')
@endpush
@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
<div class="section-heading-page" >
    <div class="container">
        <div class="row">
        <div class="col-sm-12">
            <div align="center">
                <h1 class="heading-page text-center-xs">About Us</h1>
            </div></div>
            <div class="col-sm-6"></div>
        </div>
    </div>
</div>
<div class="ps-section pdb0 page-about">
    <div id="shopify-section-template-about-us" class="shopify-section"><div class="ps-about-features">
        <div class="section1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 ">
                        <div class="header-title">
                            <h4>{{$about->name}}</h4>
                        </div>
                        <div class="ps-section__content text-center">
                            <p>{!!$about->description!!}</p>
                            <div class="ps-about__sign text-center mb-30 mt-40">
                               <img src="{{asset('uploads/images/')}}/{{$about->sign_image}}" class="" alt="">
                            </div>
                            <p class="ps-about-sign">{{$about->founder}}</p>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <img class="img-responsive" alt="nou-bakery" src="{{asset('uploads/images')}}/{{$about->image}}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="shopify-section-nou-awards" class="shopify-section home-section">
    <div class="ps-section--award">
        <div class="container">
            <div class="row">
                <div class="col-md-12 members">
                    <div class="ps-section__header a-center no-af">
                    <h4 class="ps-section__top">Our Record</h4>
                    <h3 class="ps-section__title ps-section__title--full">WINNER AWARDS</h3>
                    </div>
                    <div class="row">
                        @foreach($ourrecord as $record)
                        <div class="col-sm-4">
                            <div class="ps-award text-center">
                                <div class="ps-award__icon">
                                    <img src="{{asset('uploads\images')}}/{{$record->our_image}}" class="" alt="">
                                </div>
                                <div class="ps-award__content">
                                    <h3>{{$record->title}}</h3>
                                    <span>{{$record->yearr}}</span>
                                    <p>{!!$record->desc!!}</p>
                                    <!--<a class="ps-btn ps-btn--xs" href="">Read more</a>-->
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="shopify-section-nou-member" class="shopify-section home-section">
    <div class="nou-section home-our-store nou-members">
        <div class="container">
            <div class="row">
                <div class="col-md-12 members">
                    <div class="ps-section__header a-center">
                        <h4 class="ps-section__top">Golden Hand</h4>
                        <h3 class="ps-section__title ps-section__title--full">OUR TEAM</h3>
                    </div>
                    <div class="row">
                        @foreach ($ourteam as $team)
                        <div class="col-sm-4">
                            <div class="ps-post--vertical">
                                <div class="ps-post__thumbnail">
                                    <a href="" class="ps-post__overlay"></a>
                                    <img src="{{asset('uploads/images/')}}/{{$team->team_image}}" alt="" class="article-image">
                                </div>
                                <div class="ps-people__content">
                                    <h4>{{$team->name}}</h4><span class="ps-people__position">{{$team->designation}}</span>
                                    <p>{!!$team->description!!}</p>
                                    <ul class="ps-people__social">
                                        <li><a href="{{$team->facebook}}"><i class="fab fa-facebook-f" style="color:black"></i></a></li>
                                        <li><a href="{{$team->instagram}}"><i class="fab fa-instagram" style="color:black"></i></a></li>
                                        <li><a href="{{$team->twitter}}"><i class="fab fa-twitter" style="color:black"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
</div>


<div class="foot-top">
    <div class="row" style="text-align: center;">
        <div class="col-sm-2"></div>
            @foreach($section8 as $section8)
            <div class="col-sm-3">
                <img src="{{asset('uploads/images')}}/{{$section8->section_image}}">
                <p class="event">{{$section8->section_name}}</p>
            </div>
            @endforeach
        </div>
        <div class="col-sm-1"></div>
    </div>
</div>
</div>
@push('after-scripts')
@endpush
@endsection
