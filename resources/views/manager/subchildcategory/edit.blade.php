
@push('after-styles')
@endpush
@extends('manager.layouts.app')
@section('title', 'SubChildCategory')
@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Edit SubChildCategory</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
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
                                    <a href="{{ url('/manager/subchildcategory/') }}" class="btn btn-primary btn-sm scroll-click">View SubChildCategory</a>
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
                                                <select name="category_id" class="form-control" onchange="this.form.submit()" required>
                                                     <option selected disabled>Select Main Category</option>
                                                  @foreach($maincategory as $maincategory)
                                                    @if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != '')
                                                        <option value="{{$maincategory->id}}" @if(@$_REQUEST['category_id'] == $maincategory->id) selected @endif >{{$maincategory->cat_name}}</option>
                                                    @else
                                                        <option value="{{$maincategory->id}}" @if(@$data->category_id == $maincategory->id) selected @endif >{{$maincategory->cat_name}}</option>
                                                    @endif
                                                  @endforeach
                                                </select>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Select subcategory </label><br>
                                                    @if(count($subcategory))
                                                    <select name="subcategory_id" class="form-control" onchange="this.form.submit()">
                                                         <option selected disabled>Select Sub Category</option>
                                                        @foreach($subcategory as $subcategory)
                                                        @if(isset($_REQUEST['subcategory_id']) && $_REQUEST['subcategory_id'] != '')
                                                            <option value="{{$subcategory->id}}" @if(@$_REQUEST['subcategory_id'] == $subcategory->id) selected @endif >{{$subcategory->subcat_name}}</option>
                                                        @else
                                                            <option value="{{$subcategory->id}}" @if(@$data->subcategory_id == $subcategory->id) selected @endif >{{$subcategory->subcat_name}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @endif
                                                </div>
                                                </div>
                                            </div>
                                    </form>
                                    <form method="post" action="{{ route('manager.subchildcategory.update',$data->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                        @if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != '')
                                            <input type="hidden" name="category_id" value="{{@$_REQUEST['category_id']}}">
                                            <input type="hidden" name="subcategory_id" value="{{@$_REQUEST['subcategory_id']}}">
                                            @else
                                            <input type="hidden" name="category_id" value="{{@$data->category_id}}">
                                            <input type="hidden" name="subcategory_id" value="{{@$data->subcategory_id}}">
                                            @endif
                                        <input type="hidden" id="id" value="{{$data->id}}">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Select ChildCategory </label><br>
                                                        <select name="childcategory_id" class="form-control">
                                                            <option selected disabled>Select ChildCategory</option>
                                                            @foreach($childcategory as $childcategory)
                                                            <option @if(@$data->childcategory_id == $childcategory->id) selected @endif value="{{$childcategory->id}}">{{$childcategory->childcat_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    </div>
                                                </div>
                                        <div class="form-group">
                                                <label for="price">SubChildCategory Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="subchildcat_name" id="subchildcat_name" class="form-control" placeholder="Enter SubChildCategory Name" value="{{ $data->subchildcat_name }}" required/>
                                                    @if ($errors->has('subchildcat_name'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('subchildcat_name') }}</strong>
                                                        </span>
                                                    @endif
                                               </div>

                                            <div class="form-group">
                                                <label for="percentage">Description </label>
                                                    <textarea placeholder="Enter Description" rows="5" class="ckeditor form-control" id="subchilddescription" name="subchilddescription">{{ $data->subchilddescription }}</textarea>
                                                    @if ($errors->has('subchilddescription'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('subchilddescription') }}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                            <div class="form-group">
                                                <div class="checkbox d-inline mr-3 pure-veg">
                                                    <input type="checkbox" class="custom-control-input"  id="myCheck" name="top_subchildcategory" @if($data->top_subchildcategory == '1') checked @endif>
                                                    <label class="custom-control-label" for="myCheck">Top Category</label>
                                                </div>
                                            </div>
                                        <div class="form-group">
                                            <img src="{{ asset('uploads/images/') }}/{{ @$data->subchildcat_logo }}" style="width: 10%;" /><br>
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
                                                <input type="radio" class="status" value="Active" name="subchildstatus" @if ($data->subchildstatus == 'Active') checked @endif />
                                                @if ($errors->has('subchildstatus'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('subchildstatus') }}</strong>
                                                    </span>
                                                @endif
                                                Active
                                            </label>
                                            <label for="chkNo">
                                                <input type="radio" class="status" value="Inactive" name="subchildstatus" @if ($data->subchildstatus == 'Inactive') checked @endif />
                                                @if ($errors->has('subchildstatus'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('subchildstatus') }}</strong>
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
