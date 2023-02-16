@push('after-styles')
@endpush
@extends('manager.layouts.app')
@section('title', 'Category')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Create Category</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>

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
                                <h4 class="card-title">Category</h4>
                                <div class="text-right">
                                    <a href="{{ url('/manager/category/') }}" class="btn btn-primary btn-sm scroll-click">View Category</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">

                            <form role="form" id="myform" method="post" action="{{ route('manager.category.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                <label for="price">Category Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="cat_name" id="name" value="{{old('cat_name')}}" class="form-control" placeholder="Enter Category Name"  required/>
                                                    @if ($errors->has('cat_name'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('cat_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="percentage">Description </label>
                                                    <textarea placeholder="Enter Description" rows="5"  class="ckeditor form-control" name="description" id="description">{{ old('description') }}</textarea>
                                                        @if ($errors->has('description'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('description') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>

                                                <div class="form-group">
                                                <label for="images">Choose Image </label>
                                                            <input type="file" name="logo" class="form-control" id="logo"  accept="image/*" >
                                                            @if ($errors->has('logo'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('logo') }}</strong>
                                                                </span>
                                                            @endif
                                                </div>

                                                <br>
                                                <div class="form-group">
                                                    <label for="price">Status </label><br>
                                                        <label for="chkYes">
                                                            <input type="radio" class="status" value="Active" name="status" checked="" />
                                                            @if ($errors->has('status'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('status') }}</strong>
                                                                </span>
                                                            @endif
                                                            Active
                                                        </label>
                                                        <label for="chkNo">
                                                            <input type="radio" class="status" value="Inactive" name="status" />
                                                            @if ($errors->has('status'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('status') }}</strong>
                                                                </span>
                                                            @endif
                                                            Inactive
                                                        </label>
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
