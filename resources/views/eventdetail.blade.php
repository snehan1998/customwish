@push('after-styles')
@endpush
@extends('layouts.app')
@section('title', 'Event Details')
@section('content')

<div class="section-heading-page" >
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div align="center">
          <h1 class="heading-page text-center-xs">Event Detail</h1>
        </div>
      </div>
      <div class="col-sm-6"> </div>
    </div>
  </div>
</div>

  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-lg-8 entries">
          <article class="entry entry-single">
            <div class="entry-img"> <img src="{{asset('uploads/images/')}}/{{$event->event_images}}" alt="" class="img-fluid"></div>
            <h2 class="entry-title"> <a href="">{{$event->event_name}}</a></h2>
             <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="fa-thin fa-clock fa-fw"></i> <a href="">
                  <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($event->event_datee)->format('j F Y')}}</time>
                  </a></li>
              </ul>
            </div>
            <div class="entry-content">
              <p>{!!$event->event_long_desc!!} </p>
              </div>
          </article>
        </div>
        <div class="col-lg-4">
          <div class="sidebar">
            <h3 class="sidebar-title">Recent Posts</h3>
            <div class="sidebar-item recent-posts">
                @foreach ($recente as $recente)
                <div class="post-item clearfix"> <img src="{{asset('uploads/images/')}}/{{$recente->event_images}}" alt="">
                  <h4><a href="{{url('/event')}}/{{$recente->event_slug}}">{{$recente->event_name}}</a></h4>
                  <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($recente->event_datee)->format('j F Y')}}</time>
                </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@push('after-scripts')
@endpush
@endsection
