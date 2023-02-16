@push('after-styles')
@endpush
@extends('admin.layouts.app')
@section('title', 'Banners')
@section('content')
<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Edit Banner</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Banner</li>

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
                                <h4 class="card-title">Banner</h4>
                                <div class="text-right">
                                    <a href="{{ url('/admin/banners/') }}" class="btn btn-primary btn-sm scroll-click">View Banner</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">

                                <form enctype="multipart/form-data" role="form" id="myform" method="post" action="{{ route('admin.banners.update', $data->id) }}">
                                @csrf
                                @method('PATCH')

                                        <div class="row">
                                            <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="price">Banner Name </label>
                                                <input type="text" name="banner_name" id="banner_name" class="form-control" placeholder="Enter Banner Name" value="{{ $data->banner_name }}" />
                                                @if ($errors->has('banner_name'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('banner_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                           <!-- <div class="form-group">
                                                <label for="price">Banner Name 2</label>
                                                <input type="text" name="banner_name2" id="banner_name2" class="form-control" placeholder="Enter Banner Name" value="{{ $data->banner_name2 }}" />
                                                @if ($errors->has('banner_name2'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('banner_name2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Banner URL </label>
                                                <input type="url" name="banner_url" id="banner_url" class="form-control" placeholder="Enter Banner URL" value="{{ $data->banner_url }}" />
                                                @if ($errors->has('banner_url'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('banner_url') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Sort Order <span class="text-danger">*</span></label>
                                                <input type="number" min="0" name="sort_order" id="sort_order" class="form-control" required placeholder="Enter Sort Order" value="{{ $data->sort_order }}" />
                                                @if ($errors->has('sort_order'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('sort_order') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Banner Content </label>
                                                <textarea class="ckeditor" name="content" rows="7"
                                                    placeholder="Enter Banner Content">{{ $data->content }}</textarea>
                                                @if ($errors->has('content'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('content') }}</strong>
                                                    </span>
                                                @endif
                                            </div>-->
                                            <div class="form-group">
                                                <div>
                                                <img src="{{ asset('uploads/images/') }}/{{ @$data->banner_image }}"
                                                style="width: 10%;" /><br>
                                                </div>
                                                <label for="banner_image">Banner Image</label>
                                                        <input type="file" name="banner_image" class="form-control" id="banner_image" accept="image/*">
                                                        @if ($errors->has('banner_image'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('banner_image') }}</strong>
                                                            </span>
                                                        @endif
                                            </div>
                                                <label for="chkYes">
                                                    <input type="radio" class="status" value="Active" name="status" @if ($data->status == 'Active') checked @endif />
                                                    @if ($errors->has('status'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('status') }}</strong>
                                                        </span>
                                                    @endif
                                                    Active
                                                </label>
                                                <label for="chkNo">
                                                    <input type="radio" class="status" value="InActive" name="status" @if ($data->status == 'InActive') checked @endif />
                                                    @if ($errors->has('status'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('status') }}</strong>
                                                        </span>
                                                    @endif
                                                    Inactive
                                                </label>
                                            </div>
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
