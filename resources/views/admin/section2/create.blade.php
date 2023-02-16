@push('after-styles')
@endpush
@extends('admin.layouts.app')
@section('title', 'Section2')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Create Section2</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Section2</li>

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
                                <h4 class="card-title">Section2</h4>
                                <div class="text-right">
                                    <a href="{{ url('/admin/section2/') }}" class="btn btn-primary btn-sm scroll-click">View Section2</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">

                            <form role="form" id="myform" method="post" action="{{ route('admin.section2.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                            <div class="form-group">
                                            <label for="price">Name </label><span class="text-danger">*</span>
                                                <input type="text" name="title" required id="title" value="{{old('title')}}" class="form-control" placeholder="Enter  Name"  />
                                                @if ($errors->has('title'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                            <label for="price">Button Name</label>
                                                <input type="text" name="button_name" id="button_name" value="{{old('button_name')}}" class="form-control" placeholder="Enter Button Name"/>
                                                @if ($errors->has('button_name'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('button_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Button URL</label>
                                                    <input type="url" name="button_url" id="button_url" value="{{old('button_url')}}" class="form-control" placeholder="Enter Button URL"/>
                                                    @if ($errors->has('button_url'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('button_url') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label>image</label>
                                                    <input type="file" name="image" class="form-control" accept="image/*">
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
