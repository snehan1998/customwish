@push('after-styles')
@endpush
@extends('layouts.app')
@section('title', 'Blog Category List')
@section('content')

<div class="section-heading-page" >
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div align="center">
          <h1 class="heading-page text-center-xs">Blog</h1>
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
          @foreach($blogs as $blog)
        <?php $comment = App\Models\LeaveComment::where('blog_id',$blog->id)->where('status','Active')->count();?>
          <article class="entry">
            <div class="entry-img"> <img src="{{asset('uploads/images/')}}/{{$blog->images}}" alt="" class="img-fluid"></div>
            <h2 class="entry-title"> <a href="{{url('/blog')}}/{{$blog->slug}}">{{$blog->name}}</a></h2>
            <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="fa-thin fa-user fa-fw"></i> <a href="{{url('/blog')}}/{{$blog->slug}}">{{$blog->added_by}}</a></li>
                <li class="d-flex align-items-center"><i class="fa-thin fa-clock fa-fw"></i> <a href="{{url('/blog')}}/{{$blog->slug}}">
                  <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($blog->datee)->format('j F Y')}}</time>
                  </a></li>
                <li class="d-flex align-items-center"><i class="fa-thin fa-comment-dots fa-fw"></i> <a href="{{url('/blog')}}/{{$blog->slug}}">{{$comment}} Comments</a></li>
              </ul>
            </div>
            <div class="entry-content">
              <p>{!!$blog->short_desc!!}</p>
              <div class="read-more"> <a href="{{url('/blog')}}/{{$blog->slug}}">Read More</a></div>
            </div>
          </article>
          @endforeach

          <div class="blog-pagination">
            <ul class="justify-content-center">
             {{$blogs->links()}}
            </ul>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="sidebar">
            <h3 class="sidebar-title">Categories</h3>
            <div class="sidebar-item categories">
              <ul>
                @foreach($blogcat as $blogcat)
                <?php $bloo = App\Models\Blog::where('category_id',$blogcat->id)->count(); ?>
                <li><a href="{{url('/blogcat')}}/{{$blogcat->id}}">{{$blogcat->blog_name}} <span>({{$bloo}})</span></a></li>
                @endforeach
              </ul>
            </div>
            <h3 class="sidebar-title">Recent Posts</h3>
            <div class="sidebar-item recent-posts">
            @foreach ($recent as $recent)
              <div class="post-item clearfix"> <img src="{{asset('uploads/images/')}}/{{$recent->images}}" alt="">
                <h4><a href="{{url('/blog')}}/{{$blog->slug}}">{{$recent->name}}</a></h4>
                <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($recent->datee)->format('j F Y')}}</time>
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
