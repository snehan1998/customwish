@push('after-styles')
@endpush
@extends('admin.layouts.app')
@section('title', 'Event')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Create Event</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Event</li>

                        </ol>
                    </div>
                </div>
                <!-- row -->
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Event</h4>
                                <div class="text-right">
                                    <a href="{{ url('/admin/event/') }}" class="btn btn-primary btn-sm scroll-click">View Event</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">

                            <form role="form" id="myform" method="post" action="{{ route('admin.event.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                <label for="price"> Event Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="event_name" id="event_name" value="{{old('event_name')}}" class="form-control" placeholder="Enter  Name" required />
                                                    @if ($errors->has('event_name'))
                                                        <span class="required">
                                                            <strong>{{ $errors->first('event_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                <label for="price">Event Date </label>
                                                    <input type="date" name="event_datee" id="event_datee" value="{{old('event_datee')}}" class="form-control" placeholder="Enter Date"  >
                                                    @if ($errors->has('event_datee'))
                                                        <span class="required">
                                                            <strong>{{ $errors->first('event_datee') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                <label for="price">Short Description</label></label>
                                                    <textarea class="form-control ckeditor" name="event_short_desc" id="event_short_desc" value="{{old('event_short_desc')}}"  placeholder="Enter Short Description"></textarea>
                                                    @if ($errors->has('event_short_desc'))
                                                        <span class="required">
                                                            <strong>{{ $errors->first('event_short_desc') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                <label for="price">Long Description</label></label>
                                                    <textarea class="form-control ckeditor" name="event_long_desc" id="event_long_desc" value="{{old('event_long_desc')}}"  placeholder="Enter Long Description"></textarea>
                                                    @if ($errors->has('event_long_desc'))
                                                        <span class="required">
                                                            <strong>{{ $errors->first('event_long_desc') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                <label for="images">Choose Image </label>
                                                    <div class="input-group">
                                                            <input type="file" name="event_images" class="form-control" id="event_images" >
                                                            @if ($errors->has('event_images'))
                                                                <span class="required">
                                                                    <strong>{{ $errors->first('event_images') }}</strong>
                                                                </span>
                                                            @endif
                                                            <label class="custom-file-label" for="event_images">Choose Image</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-lg-12 ml-auto">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


@push('after-scripts')


    <!-- Jquery Validation -->
    <script src="{{ URL::asset('/admin/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- Form validate init -->
    <script src="{{ URL::asset('/admin/js/plugins-init/jquery.validate-init.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>

@endpush

@endsection
