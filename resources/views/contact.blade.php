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
                <h1 class="heading-page text-center-xs">Contact Us</h1>
            </div>
            </div>
		  <div class="col-sm-6">
		  </div>
        </div>
      </div>
    </div>
    @if (Session::has('flash_success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('flash_success') }}
    </div>
@endif
@if (Session::has('flash_error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('flash_error') }}
    </div>
@endif
<div class="inn-page">
   <!-- Contact Start -->
    <div class="container">
		<h3 class="get-in-touch">Get In Touch</h3><br>
		<p  class="get-in-touch">{!!$contact->content!!}</p>
		<div class="row">
			 <div class="col-sm-8"><br>
                <form method="post" action="{{url('/contactform')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="name" name="name" class="form-control" id="name" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="email1" aria-describedby="emailHelp" placeholder="Email"required>
                            </div>
                        </div>
                    </div>
				  <br>
        		   <div class="form-group">
                        <input type="text" name="experience" class="form-control" id="experience" placeholder="Subject" required>
                   </div><br>
        		   <div class="form-group">
                        <textarea class="form-control" name="message" id="message_popup" cols="30" rows="4" tabindex="1" placeholder="Message"  style="overflow: hidden; outline: none;" required></textarea>
                    </div><br>
                    <x-honey/>

                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                      <button type="submit" class="btn btn-primary-submit">Submit</button>
                    </div>
                </form>
			</div>
			<div class="col-sm-4">
                <p class="mb-2"> <i class="fa-thin fa-location-dot fa-fw text-primary mr-3"></i>
                <span class="lochd">Location :</span><br>{{$contact->address}}</p><br>
                <p class="mb-2"><i class="fa-thin fa-envelope fa-fw text-primary mr-3"></i>
                <span class="lochd">Email :</span> <br>{{$contact->email}}</p><br>
                <p class="mb-2"><i class="fa-thin fa-phone-volume fa-fw text-primary mr-3"></i>
                <span class="lochd">Phone :</span> <br>{{$contact->phone}}</p>
                <br>
                <p class="mb-2"><i class="fa-thin fa-clock fa-fw text-primary mr-3"></i>
                <span class="lochd">Opening Hours :</span> <br>{!!$contact->opening_hour !!}</p>
            </div>
        </div>
	</div>
</div>
    <!-- Contact End -->
<div class="bg-light p-30 mb-30">
    <iframe style="width: 100%; height: 300px;" src="{{$contact->map}}"
    frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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
