
@push('after-styles')
@endpush
@extends('manager.layouts.app')
@section('title', 'ChildCategory')
@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Edit ChildCategory</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ChildCategory</li>

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
                                <h4 class="card-title">ChildCategory</h4>
                                <div class="text-right">
                                    <a href="{{ url('/manager/childcategory/') }}" class="btn btn-primary btn-sm scroll-click">View ChildCategory</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">
                                    <form method="get" action="">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="category_id">Select Category <span class="text-danger">*</span></label>
                                                <select name="category_id" id="category_id" class="form-control" onchange="this.form.submit()" required>
                                                @foreach($category as $category)
                                                    @if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != '')
                                                        <option value="{{$category->id}}" @if(@$_REQUEST['category_id'] == $category->id) selected @endif >{{$category->cat_name}}</option>
                                                    @else
                                                        <option value="{{$category->id}}" @if(@$data->category_id == $category->id) selected @endif >{{$category->cat_name}}</option>
                                                    @endif
                                                @endforeach
                                                </select>
                                                @if ($errors->has('category_id'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                            </div>
                                        </div>
                                        </form>

                                <form role="form" id="myform" method="post" action="{{ route('manager.childcategory.update', $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                        @if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != '')
                        <input type="hidden" name="category_id" value="{{@$_REQUEST['category_id']}}">
                        @else
                        <input type="hidden" name="category_id" value="{{@$data->category_id}}">
                        @endif
                            <input type="hidden" id="id" value="{{$data->id}}">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select subcategory <span class="text-danger">*</span></label><br>
                                        @if(count($subcategory))
                                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                                            @foreach($subcategory as $subcategory)
                                            <option @if(@$data->subcategory_id == $subcategory->id) selected @endif value="{{$subcategory->id}}">{{$subcategory->subcat_name}}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        No Subcategory Found.  Please Create a Subcategory for this category <a target="_blank" href="{{url('/')}}/manager/subcategory/create">Here</a>
                                        @endif
                                        @if ($errors->has('subcategory_id'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('subcategory_id') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                                        <div class="form-group">
                                                <label for="price">ChildCategory Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="childcat_name" id="childcat_name" class="form-control" placeholder="Enter ChildCategory Name" value="{{ $data->childcat_name }}" required/>
                                                    @if ($errors->has('childcat_name'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('childcat_name') }}</strong>
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
                                                <div class="checkbox d-inline mr-3 pure-veg">
                                                    <input type="checkbox" class="custom-control-input"  id="myCheck" name="top_childcategory" @if($data->top_category == '1') checked @endif>
                                                    <label class="custom-control-label" for="myCheck">Top Category</label>
                                                </div>
                                            </div>
                                        <div class="form-group">
                                            <img src="{{ asset('uploads/images/') }}/{{ @$data->childcat_logo }}" style="width: 10%;" /><br>
                                            <label for="childcat_logo">Choose Image </label>
                                                <input type="file" name="childcat_logo" class="form-control" id="childcat_logo" accept="image/*" >
                                                @if ($errors->has('childcat_logo'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('childcat_logo') }}</strong>
                                                    </span>
                                                @endif
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
