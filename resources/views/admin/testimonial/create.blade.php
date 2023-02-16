@push('after-styles')
@endpush
@extends('admin.layouts.app')
@section('title', 'Testimonial')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Create Testimonial</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Testimonial</li>

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
                                <h4 class="card-title">Testimonial</h4>
                                <div class="text-right">
                                    <a href="{{ url('/admin/testimonial/') }}" class="btn btn-primary btn-sm scroll-click">View Testimonial</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">

                            <form role="form" id="myform" method="post" action="{{ route('admin.testimonial.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                            <div class="form-group">
                                            <label for="price">Name </label>
                                                <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control" placeholder="Enter  Name"  />
                                                @if ($errors->has('name'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                            <label for="price">Designation</label>
                                                <input type="text" name="designation" id="designation" value="{{old('designation')}}" class="form-control" placeholder="Enter Designation"/>
                                                @if ($errors->has('designation'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('designation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Rating Name </label>
                                                    <input type="text" name="rating" id="rating" value="{{old('rating')}}" class="form-control" placeholder="Enter Rating"/>
                                                    @if ($errors->has('rating'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('rating') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                            <div class="form-group">
                                                <label for="percentage">Description <span class="text-danger">*</span></label>
                                                <textarea placeholder="Enter Description" rows="5"  class="ckeditor form-control" required name="description" id="description">{{ old('description') }}</textarea>
                                                    @if ($errors->has('description'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('description') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Letter </label>
                                                    <input type="text" name="letter" id="letter" value="{{old('letter')}}" class="form-control" placeholder="Enter Letter"  />
                                                    @if ($errors->has('letter'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('letter') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>image1</label>
                                                    <input type="file" name="image1" class="form-control" accept="image/*">
                                                </div>
                                                <div class="form-group">
                                                    <label>image2</label>
                                                    <input type="file" name="image2" class="form-control" accept="image/*">
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
