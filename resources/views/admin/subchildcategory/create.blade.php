@push('after-styles')
@endpush
@extends('admin.layouts.app')
@section('title', 'SubChildCategory')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Create SubChildCategory</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">SubChildCategory</li>

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
                                <h4 class="card-title">SubChildCategory</h4>
                                <div class="text-right">
                                    <a href="{{ url('/admin/subchildcategory/') }}" class="btn btn-primary btn-sm scroll-click">View SubChildCategory</a>
                                </div>
                            </div>

                        <div class="card-body">
                            <div class="form-validation">
                                <form method="get" action="">
                                    <div class="container">
                                        <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                            <label for="category_id">Select Category <span class="text-danger">*</span></label>
                                            <select name="category_id" id="category_id" class="form-control" onchange="this.form.submit()" required>
                                                <option selected disabled>Select Main Category</option>
                                                @foreach($maincategory as $main)
                                                <option value="{{$main->id}}" @if(@$_REQUEST['category_id'] == $main->id) selected @endif >{{$main->cat_name}}</option>
                                                @endforeach
                                            </select>
                                            </div>

                                        </div>
                                        @if ($errors->has('category_id'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('category_id') }}</strong>
                                        </span>
                                    @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Select subcategory </label><br>
                                            @if(count($subcategory))
                                            <select name="subcategory_id" id="subcategory_id" class="form-control" onchange="this.form.submit()">
                                                    <option selected disabled>Select Sub Category</option>
                                                    @foreach($subcategory as $subcategory)
                                                    <option value="{{$subcategory->id}}" @if(@$_REQUEST['subcategory_id'] == $subcategory->id) selected @endif >{{$subcategory->subcat_name}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                        @if ($errors->has('subcategory_id'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('subcategory_id') }}</strong>
                                        </span>
                                    @endif
                                        </div>
                                    </div>
                                </form>
                                <form enctype="multipart/form-data"  method="post" action="{{ route('admin.subchildcategory.store') }}">
                                        @csrf
                                        @if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != '')
                                        <input type="hidden" name="category_id" value="{{@$_REQUEST['category_id']}}">
                                        <input type="hidden" name="subcategory_id" value="{{@$_REQUEST['subcategory_id']}}">
                                        @else
                                        <input type="hidden" name="category_id" value="{{@$firstcategory->id}}">
                                        <input type="hidden" name="subcategory_id" value="{{@$_REQUEST['subcategory_id']}}">
                                        @endif

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Select ChildCategory </label><br>
                                                @if(count($childcategory))
                                                <select name="childcategory_id" id="childcategory" class="form-control">
                                                    <option selected disabled>Select Child Category</option>
                                                    @foreach($childcategory as $childcategory)
                                                    <option  value="{{$childcategory->id}}">{{$childcategory->childcat_name}}</option>
                                                    @endforeach
                                                </select>
                                                @endif
                                            </div>
                                            @if ($errors->has('childcategory_id'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('childcategory_id') }}</strong>
                                            </span>
                                        @endif
                                            </div>
                                        </div>

                                <div class="form-group">
                                    <label for="price">SubChildCategory Name <span class="text-danger">*</span></label>
                                        <input type="text" name="subchildcat_name" id="subchildcat_name" value="{{old('subchildcat_name')}}" class="form-control" placeholder="Enter SubChildCategory Name"  />
                                        @if ($errors->has('subchildcat_name'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('subchildcat_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="percentage">Description </label>
                                        <textarea placeholder="Enter Description" rows="5"  class="ckeditor form-control" name="subchilddescription" id="subchilddescription">{{ old('subchilddescription') }}</textarea>
                                            @if ($errors->has('subchilddescription'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('subchilddescription') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox d-inline mr-3 pure-veg">
                                            <input type="checkbox" class="custom-control-input"  id="myCheck" name="top_subchildcategory">
                                            <label class="custom-control-label" for="myCheck">Top Category</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="subchildcat_logo">Choose Image </label>
                                        <input type="file" name="subchildcat_logo" class="form-control" id="subchildcat_logo" accept="image/*" >
                                        @if ($errors->has('subchildcat_logo'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('subchildcat_logo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="price">Status </label><br>
                                            <label for="chkYes">
                                                <input type="radio" class="status" value="Active" name="subchildstatus" checked="" />
                                                @if ($errors->has('status'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('status') }}</strong>
                                                    </span>
                                                @endif
                                                Active
                                            </label>
                                            <label for="chkNo">
                                                <input type="radio" class="status" value="InActive" name="subchildstatus" />
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
