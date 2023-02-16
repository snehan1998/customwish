@push('after-styles')
@endpush
@extends('layouts.app')
@section('title', 'Career')
@section('content')

   <div class="section-heading-page" >
      <div class="container">
        <div class="row">
		<div class="col-sm-12">
          <div align="center">
            <h1 class="heading-page text-center-xs">Career opportunity</h1>
          </div></div>
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

	<div class="container">
	    <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <form method="post" action="{{url('/careerform')}}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="name">Name</label><span class="text-danger">*</span>
                        <input type="name" name="name" class="form-control" id="name" placeholder="" required>
                    </div><br>
                    <div class="form-group">
                        <label for="phone">Phone</label><span class="text-danger">*</span>
                        <input type="phone" name="phone" class="form-control" id="phone" pattern="[1-9]{1}[0-9]{9}" required>
                    </div><br>
                    <div class="form-group">
                        <label for="email1">Email Address</label><span class="text-danger">*</span>
                        <input type="email" name="email" class="form-control" id="email1" aria-describedby="emailHelp" required>
                    </div><br>
                    <div class="form-group">
                        <label for="position">Position</label><span class="text-danger">*</span>
                        <input type="text" name="position" class="form-control" id="position" required>
                    </div><br>
                    <div class="form-group">
                        <label for="experience">Experience</label><span class="text-danger">*</span>
                        <input type="text" name="experience" class="form-control" id="experience" required>
                    </div><br>
                    <div class="form-group">
                        <label for="CV">Upload CV</label><span class="text-danger">*</span>
                        <input type="file" name="resume" class="form-control-chos" id="CV" required accept="application/pdf,application/doc,application/vnd.ms-excel">
                    </div><br>
                    <div class="form-group">
                        <label>Message</label><span class="text-danger">*</span>
                        <textarea class="form-control" name="message" id="message_popup" cols="30" rows="4" tabindex="1" style="overflow: hidden; outline: none;" required></textarea>
                    </div><br>
                    <x-honey/>
                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary-submit">Submit</button>
                    </div>
                </form>
                <div class="col-sm-2"></div>
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


@push('after-scripts')
@endpush
@endsection
