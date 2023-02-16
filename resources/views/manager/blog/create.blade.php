@push('after-styles')
@endpush
@extends('manager.layouts.app')
@section('title', 'Blog')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Create Blog</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>

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
                                <h4 class="card-title">Blog</h4>
                                <div class="text-right">
                                    <a href="{{ url('/manager/blog/') }}" class="btn btn-primary btn-sm scroll-click">View Blog</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">

                            <form role="form" id="myform" method="post" action="{{ route('manager.blog.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                <label for="price"> Category<span class="text-danger">*</span></label>
                                                <select name="category_id" class="form-control" required >
                                                    <option value="" selected disabled>Select Category</option>
                                                        @foreach ($cat as $category)
                                                        <option value="{{ $category->id }}">{{ $category->blog_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                <label for="price"> Title <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control" placeholder="Enter  Name" required />
                                                    @if ($errors->has('name'))
                                                        <span class="required">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                <label for="price"> Posted by<span class="text-danger">*</span></label>
                                                    <input type="text" name="added_by" id="added_by" value="{{old('added_by')}}" class="form-control" placeholder="Enter Posted By"  required/>
                                                    @if ($errors->has('added_by'))
                                                        <span class="required">
                                                            <strong>{{ $errors->first('added_by') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                <label for="price"> Date </label>
                                                    <input type="date" name="datee" id="datee" value="{{old('datee')}}" class="form-control" placeholder="Enter Date"  >
                                                    @if ($errors->has('datee'))
                                                        <span class="required">
                                                            <strong>{{ $errors->first('datee') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                <label for="price">Short Description</label></label>
                                                    <textarea class="form-control ckeditor" name="short_desc" id="short_desc" value="{{old('short_desc')}}"  placeholder="Enter Short Description"></textarea>
                                                    @if ($errors->has('short_desc'))
                                                        <span class="required">
                                                            <strong>{{ $errors->first('short_desc') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                <label for="price">Long Description</label></label>
                                                    <textarea class="form-control ckeditor" name="long_desc" id="long_desc" value="{{old('long_desc')}}"  placeholder="Enter Long Description"></textarea>
                                                    @if ($errors->has('long_desc'))
                                                        <span class="required">
                                                            <strong>{{ $errors->first('long_desc') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                <label for="images">Choose Image </label>
                                                    <div class="input-group">
                                                            <input type="file" name="images" class="form-control" id="images" >
                                                            @if ($errors->has('images'))
                                                                <span class="required">
                                                                    <strong>{{ $errors->first('images') }}</strong>
                                                                </span>
                                                            @endif
                                                            <label class="custom-file-label" for="images">Choose Image</label>
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
    <script src="{{ URL::asset('/manager/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- Form validate init -->
    <script src="{{ URL::asset('/manager/js/plugins-init/jquery.validate-init.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>

@endpush

@endsection
