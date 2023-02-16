
@push('after-styles')
@endpush
@extends('admin.layouts.app')
@section('title', 'Review')
@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Edit Review</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
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
                                    <a href="{{ url('/admin/review/') }}" class="btn btn-primary btn-sm scroll-click">View Review</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">
                                <form role="form" id="myform" method="post" action="{{ route('admin.review.update', $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                    <div class="row">
                                        <div class="col-xl-12">
                                                <div class="form-group">
                                                    <label>Select Product </label><span class="text-danger">*</span><br>
                                                    @if(count($product))
                                                    <select name="product_id" id="product_id" class="form-control" required>
                                                        <option selected disabled>Select Product</option>
                                                        @foreach($product as $product)
                                                        <option  value="{{$product->id}}" @if($product->id == $data->product_id) selected @endif>{{$product->product_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @endif
                                                </div>
                                            @if ($errors->has('product_id'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('product_id') }}</strong>
                                                </span>
                                            @endif
                                             <div class="form-group">
                                                <label for="price">Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="{{ $data->name }}" required/>
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                               </div>
                                               <div class="form-group">
                                                <label for="price">Email <span class="text-danger">*</span></label>
                                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter EMail" value="{{ $data->email }}" required/>
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                               </div>
                                               <div class="form-group">
                                                <label for="price">Rating<span class="text-danger">*</span></label>
                                                    <input type="text" pattern="[-+]?([0-9]*\.[0-9]+|[0-9]+)" name="rating" id="rating" class="form-control" placeholder="Enter Rating" value="{{ $data->rating }}" required/>
                                                    @if ($errors->has('rating'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('rating') }}</strong>
                                                        </span>
                                                    @endif
                                               </div>

                                            <div class="form-group">
                                                <label for="percentage">Comment </label>
                                                    <textarea placeholder="Enter Comment" rows="5" class="ckeditor form-control" id="comment" name="comment">{{ $data->comment }}</textarea>
                                                    @if ($errors->has('comment'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('comment') }}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                        <!--<div class="form-group">
                                            <img src="{{ asset('uploads/images/') }}/{{ @$data->review_image }}" style="width: 10%;" /><br>
                                            <label for="review_image">Choose Image </label>
                                                <input type="file" name="review_image" class="form-control" id="review_image" accept="image/*"  >
                                                @if ($errors->has('review_image'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('review_image') }}</strong>
                                                    </span>
                                                @endif
                                        </div>-->
                              <div class="form-group">
                                            <label for="price">Status </label><br>
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
                                                <input type="radio" class="status" value="Inactive" name="status" @if ($data->status == 'Inactive') checked @endif />
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
