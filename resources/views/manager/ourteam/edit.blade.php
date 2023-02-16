@push('after-styles')
<link rel="stylesheet" href="{{asset('adminassets/assets/vendors/summernote/summernote-lite.min.css')}}">
@endpush
@extends('manager.layouts.app')
@section('title', 'Our Team')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Edit Our Team</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Our Team</li>

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
                        <h4 class="card-title">Our Team</h4>
                        <div class="text-right">
                            <a href="{{ url('/manager/ourteam/') }}" class="btn btn-primary btn-sm scroll-click">View Our Team</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form enctype="multipart/form-data" role="form" id="myform" method="post" action="{{ route('manager.ourteam.update', $data->id) }}">
                                    @csrf
                                    @method('PATCH')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="basicInput"> Name</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}" required placeholder="Enter Name">
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="basicInput">Designation</label>
                                                    <input type="text" class="form-control" id="designation" name="designation" value="{{$data->designation}}"  placeholder="Enter Designation">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label><span class="text-danger">*</span>
                                                    <textarea class="ckeditor" name="description" placeholder="Enter  Description" required>{!!$data->desc!!}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="basicInput">Facebook</label>
                                                    <input type="url" class="form-control" id="facebook" name="facebook" value="{{$data->facebook}}"  placeholder="Enter Facebook">
                                                </div>
                                                <div class="form-group">
                                                    <label for="basicInput">Instagram</label>
                                                    <input type="url" class="form-control" id="instagram" name="instagram" value="{{$data->instagram}}"  placeholder="Enter Instagram">
                                                </div>
                                                <div class="form-group">
                                                    <label for="basicInput">Twitter</label>
                                                    <input type="url" class="form-control" id="twitter" name="twitter" value="{{$data->twitter}}"  placeholder="Enter Twitter">
                                                </div>
                                                <div class="form-group">
                                                <img src="{{ asset('uploads/images/') }}/{{ @$data->team_image }}" style="width: 10%;" />
                                                    <label for="team_image"> Image (size : )</label>
                                                        <input type="file" name="team_image" class="form-control" id="team_image" accept="image/*" >
                                                        @if ($errors->has('team_image'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('team_image') }}</strong>
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
<script src="{{ URL::asset('/managercss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
<!-- Form validate init -->
<script src="{{ URL::asset('/managercss/js/plugins-init/jquery.validate-init.js')}}"></script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endpush
@endsection
