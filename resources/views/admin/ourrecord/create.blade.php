@push('after-styles')
@endpush
@extends('admin.layouts.app')
@section('title', 'Our Record')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Create Our Record</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Our Record</li>
                </ol>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Our Record</h4>
                        <div class="text-right">
                            <a href="{{ url('/admin/ourrecord/') }}" class="btn btn-primary btn-sm scroll-click">View Our Record</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                        <form method="post" action="{{ route('admin.ourrecord.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Title</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" required placeholder="Enter  Title">
                                    @if ($errors->has('title'))
                                        <span  class="text-danger">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="basicInput">Year</label>
                                    <input type="text" class="form-control" id="yearr" name="yearr" value="{{old('yearr')}}" required placeholder="Enter Year">
                                    @if ($errors->has('yearr'))
                                        <span  class="text-danger">
                                            <strong>{{ $errors->first('yearr') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label><span class="text-danger">*</span>
                                    <textarea class="ckeditor" name="desc" placeholder="Enter Short Description" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="our_image"> Image (size : )<span class="text-danger">*</span></label>
                                        <input type="file" name="our_image" class="form-control" id="our_image" required accept="image/*">
                                        @if ($errors->has('our_image'))
                                            <span  class="text-danger">
                                                <strong>{{ $errors->first('our_image') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-lg-12 ml-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
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

@push('after-scripts')
<!-- Jquery Validation -->
<script src="{{ URL::asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
<!-- Form validate init -->
<script src="{{ URL::asset('/admincss/js/plugins-init/jquery.validate-init.js')}}"></script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>

@endpush
@endsection
