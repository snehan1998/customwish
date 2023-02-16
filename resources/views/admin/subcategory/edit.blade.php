
@push('after-styles')
@endpush
@extends('admin.layouts.app')
@section('title', 'SubCategory')
@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Edit SubCategory</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">SubCategory</li>

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
                                <h4 class="card-title">SubCategory</h4>
                                <div class="text-right">
                                    <a href="{{ url('/admin/subcategory/') }}" class="btn btn-primary btn-sm scroll-click">View SubCategory</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">
                                <form role="form" id="myform" method="post" action="{{ route('admin.subcategory.update', $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                    <div class="row">
                                        <div class="col-xl-12">
                                        <div class="form-group">
                                                <label for="parent_id">Select Category </label><span class="text-danger">*</span>
                                                    <select name="category_id" id="category_id" class="form-control" required>
                                                        <option value="" selected disabled>Select Category</option>
                                                        @foreach ($data1 as $category)
                                                    <option value="{{ $category->id }}" @if ($data->category_id == $category->id) selected  @endif>{{ $category->cat_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('category_id'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('category_id') }}</strong>
                                                    </span>
                                                @endif
                                             </div>

                                        <div class="form-group">
                                                <label for="price">SubCategory Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="subcat_name" id="subcat_name" class="form-control" placeholder="Enter SubCategory Name" value="{{ $data->subcat_name }}" required/>
                                                    @if ($errors->has('subcat_name'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('subcat_name') }}</strong>
                                                        </span>
                                                    @endif
                                               </div>

                                            <div class="form-group">
                                                <label for="percentage">Description </label>
                                                    <textarea placeholder="Enter Description" rows="5" class="ckeditor form-control" id="description" name="description">{{ $data->description }}</textarea>
                                                    @if ($errors->has('description'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('description') }}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                       <div class="form-group">
                                            <img src="{{ asset('uploads/images/') }}/{{ @$data->subcat_logo }}" style="width: 10%;" /><br>
                                            <label for="subcat_logo">Choose Image </label>
                                                <input type="file" name="subcat_logo" class="form-control" id="subcat_logo" accept="image/*" >
                                                @if ($errors->has('subcat_logo'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('subcat_logo') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox d-inline mr-3 pure-veg">
                                                <input type="checkbox" class="custom-control-input"  id="myCheck" name="top_subcategory" @if($data->top_subcategory == '1') checked @endif>
                                                <label class="custom-control-label" for="myCheck">Top Category</label>
                                            </div>
                                        </div>
                                        <br>
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
