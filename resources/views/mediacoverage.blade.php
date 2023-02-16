@push('after-styles')
@endpush
@extends('layouts.app')
@section('title', 'Media')
@section('content')

<div class="section-heading-page" >
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div align="center">
          <h1 class="heading-page text-center-xs">Media</h1>
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
          @foreach($medias as $media)
          <article class="entry">
            <div class="entry-img"> <img src="{{asset('uploads/images/')}}/{{$media->media_images}}" alt="" class="img-fluid"></div>
            <h2 class="entry-title"> <a href="{{url('/media')}}/{{$media->media_slug}}">{{$media->media_name}}</a></h2>
            <div class="entry-meta">
              <ul>
               <li class="d-flex align-items-center"><i class="fa-thin fa-clock fa-fw"></i> <a href="{{url('/media')}}/{{$media->media_slug}}">
                  <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($media->media_datee)->format('j F Y')}}</time>
                  </a></li>
              </ul>
            </div>
            <div class="entry-content">
              <p>{!!$media->media_short_desc!!}</p>
              <div class="read-more"> <a href="{{url('/media')}}/{{$media->media_slug}}">Read More</a></div>
            </div>
          </article>
          @endforeach

          <div class="blog-pagination">
            <ul class="justify-content-center">
             {{$medias->links()}}
            </ul>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="sidebar">
            <h3 class="sidebar-title">Recent Posts</h3>
            <div class="sidebar-item recent-posts">
            @foreach ($recmedia as $recmedia)
              <div class="post-item clearfix"> <img src="{{asset('uploads/images/')}}/{{$recmedia->media_images}}" alt="">
                <h4><a href="{{url('/media')}}/{{$recmedia->media_slug}}">{{$recmedia->media_name}}</a></h4>
                <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($recmedia->media_datee)->format('j F Y')}}</time>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@push('after-scripts')
@endpush
@endsection
