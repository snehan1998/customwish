@push('after-styles')
@endpush
@extends('layouts.app')
@section('title', 'Blog Details')
@section('content')

<div class="section-heading-page" >
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div align="center">
          <h1 class="heading-page text-center-xs">Blog Detail</h1>
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
            <div class="entry-img"> <img src="{{asset('uploads/images/')}}/{{$blog->images}}" alt="" class="img-fluid"></div>
            <h2 class="entry-title"> <a href="">{{$blog->name}}</a></h2>
             <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="fa-thin fa-user fa-fw"></i> <a href="">{{$blog->added_by}}</a></li>
                <li class="d-flex align-items-center"><i class="fa-thin fa-clock fa-fw"></i> <a href="">
                  <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($blog->datee)->format('j F Y')}}</time>
                  </a></li>
                <li class="d-flex align-items-center"><i class="fa-thin fa-comment-dots fa-fw"></i> <a href="">{{$comment}} Comments</a></li>
              </ul>
            </div>
            <div class="entry-content">
              <p>{!!$blog->long_desc!!} </p>
              </div>
          </article>
          <div class="blog-comments">
            <h4 class="comments-count">{{$comment}} Comments</h4>
            <?php $com = App\Models\LeaveComment::where('blog_id',$blog->id)->where('status','Active')->get(); ?>
            @foreach($com as $com)
            <div id="comment-1" class="comment">
              <div class="d-flex">
                <div>
                  <h5><a href="">{{$com->name}}</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> </a></h5>
                  <time datetime="2020-01-01">{{$com->created_at}}</time>
                  <p>{{$com->comment}}</p>
                </div>
              </div>
            </div>
            @endforeach
            <div class="reply-form">
              <h4>Leave a Reply</h4>
              <p>Your email address will not be published. Required fields are marked *</p><br>

              <form action="{{url('/leaveacomment')}}" method="post">
                @csrf
                <input type="hidden" name="blog_id" value="{{$blog->id}}">
                <input type="hidden" name="blog_name" value="{{$blog->name}}">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input name="name" type="text" class="form-control" placeholder="Your Name*" required>
                  </div>
                  <div class="col-md-6 form-group">
                    <input name="email" type="text" class="form-control" placeholder="Your Email*" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col form-group">
                    <input name="website" type="url" class="form-control" placeholder="Your Website" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col form-group">
                    <textarea name="comment" class="form-control" placeholder="Your Comment*" required></textarea>
                  </div>
                </div><br>
                <x-honey/>

                <button type="submit" class="btn btn-primary">Post Comment</button>
              </form>
            </div>
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
                  <h4><a href="{{url('/blog')}}/{{$recent->slug}}">{{$recent->name}}</a></h4>
                  <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($recent->datee)->format('j F Y')}}</time>
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
