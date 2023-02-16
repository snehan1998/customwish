
@push('after-styles')
@endpush
@extends('admin.layouts.app')
@section('title', 'Media')
@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Edit Media</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Media</li>

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
                                <h4 class="card-title">Media</h4>
                                <div class="text-right">
                                    <a href="{{ url('/admin/media/') }}" class="btn btn-primary btn-sm scroll-click">View Media</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">
                                <form role="form" id="myform" method="post" action="{{ route('admin.media.update', $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                    <div class="row">
                                        <div class="col-xl-12">
                                                <div class="form-group">
                                                <label for="price"> Media Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="media_name" id="media_name" value="{{$data->media_name}}" class="form-control" placeholder="Enter  Name" required />
                                                    @if ($errors->has('media_name'))
                                                        <span class="required">
                                                            <strong>{{ $errors->first('media_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                <label for="price"> Date </label>
                                                    <input type="date" name="media_datee" id="media_datee" value="{{$data->media_datee}}" class="form-control" placeholder="Enter Date"  >
                                                    @if ($errors->has('media_datee'))
                                                        <span class="required">
                                                            <strong>{{ $errors->first('media_datee') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            <div class="form-group">
                                            <label for="price">Short Description</label></label>
                                                <textarea class="form-control ckeditor" name="media_short_desc" id="media_short_desc"   placeholder="Enter Short Description">{{$data->media_short_desc}}</textarea>
                                                @if ($errors->has('media_short_desc'))
                                                    <span class="required">
                                                        <strong>{{ $errors->first('media_short_desc') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                            <label for="price">Long Description</label></label>
                                                <textarea class="form-control ckeditor" name="media_long_desc" id="media_long_desc"   placeholder="Enter Long Description">{{$data->media_long_desc}}</textarea>
                                                @if ($errors->has('media_long_desc'))
                                                    <span class="required">
                                                        <strong>{{ $errors->first('media_long_desc') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                            <img src="{{ asset('uploads/images/') }}/{{ @$data->media_images }}" style="width: 10%;" /><br>
                                            <label for="images">Choose Image </label>
                                                <input type="file" name="media_images" class="form-control" id="media_images" accept="images/*">
                                                @if ($errors->has('media_images'))
                                                    <span class="required">
                                                        <strong>{{ $errors->first('media_images') }}</strong>
                                                    </span>
                                                @endif
                                        </div>

                                              <div class="form-group">
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
