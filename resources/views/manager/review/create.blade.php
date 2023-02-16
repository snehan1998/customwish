@push('after-styles')
@endpush
@extends('manager.layouts.app')
@section('title','Review')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Create Review</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Review</li>

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
                                <h4 class="card-title">Review</h4>
                                <div class="text-right">
                                    <a href="{{ url('/manager/review/') }}" class="btn btn-primary btn-sm scroll-click">View Review</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">

                            <form role="form" id="myform" method="post" action="{{ route('manager.review.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Select Product </label><span class="text-danger">*</span><br>
                                                    @if(count($product))
                                                    <select name="product_id" id="product_id" class="form-control" required>
                                                        <option selected disabled>Select Product</option>
                                                        @foreach($product as $product)
                                                        <option  value="{{$product->id}}">{{$product->product_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @endif
                                                </div>
                                            </div>
                                            @if ($errors->has('product_id'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('product_id') }}</strong>
                                                </span>
                                            @endif
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                <label for="price">Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control" placeholder="Enter Name"  required/>
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                 <div class="form-group">
                                                <label for="price">Email <span class="text-danger">*</span></label>
                                                    <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="Enter Email"  required/>
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Rating <span class="text-danger">*</span></label>
                                                        <input type="text"  pattern="[-+]?([0-9]*\.[0-9]+|[0-9]+)" name="rating" id="rating" value="{{old('rating')}}" class="form-control" placeholder="Enter Rating"  required/>
                                                        @if ($errors->has('rating'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('rating') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                <div class="form-group">
                                                    <label for="percentage">Comment </label>
                                                    <textarea placeholder="Enter Comment" rows="5"  class="ckeditor form-control" name="comment" id="comment">{{ old('comment') }}</textarea>
                                                        @if ($errors->has('comment'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('comment') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                            <!--    <div class="form-group">
                                                <label for="images">Choose Image </label>
                                                    <input type="file" name="review_image" class="form-control" id="review_image"  accept="image/*" >
                                                    @if ($errors->has('review_image'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('review_image') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>-->
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
