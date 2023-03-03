@push('after-styles')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('managercss/vendor/select2/css/select2.min.css')}}">

@endpush
@extends('manager.layouts.app')
@section('title', 'Corporate Products')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Edit Corporate Products</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Corporate Products</li>
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
                                <h4 class="card-title">Corporate Products</h4>
                                <div class="text-right">
                                    <a href="{{ url('/manager/corporate/') }}" class="btn btn-primary btn-sm scroll-click">View Corporate Products</a>
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
                          @if ($errors->has('category_id'))
                          <span class="text-danger">
                              <strong>{{ $errors->first('category_id') }}</strong>
                          </span>
                      @endif

                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Select subcategory </label><br>
                                    @if(count($subcategory))
                                    <select name="subcategory_id" id="subcategory_id" class="form-control" onchange="this.form.submit()">
                                         <option selected >Select Sub Category</option>
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
                                @if ($errors->has('subcategory_id'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('subcategory_id') }}</strong>
                                </span>
                            @endif

                            </div>
                    </form>
                      <form method="post" action="{{ route('manager.corporate.update',$data->id) }}" enctype="multipart/form-data">
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
                                        <label>Select childcategory </label><br>
                                        @if(count($childcategory))
                                        <select name="childcategory_id" id="childcategory_id" class="form-control" >
                                             <option selected>Select Sub Category</option>
                                            @foreach($childcategory as $childcategory)
                                            <option @if(@$data->childcategory_id == $childcategory->id) selected @endif value="{{$childcategory->id}}">{{$childcategory->childcat_name}}</option>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Corporate Product Name </label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" name="corp_product_name" id="corp_product_name" value="{{$data->corp_product_name}}" required>
                                            @if ($errors->has('corp_product_name'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('corp_product_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Description :</label>
                                            <textarea class="ckeditor form-control" placeholder="Enter Description" name="corp_product_desc">{{$data->corp_product_desc}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <label for="price">Status </label><br>
                                            <label for="chkYes">
                                                <input type="radio" class="status" value="Active" name="status" @if ($data->status == "Active") checked @endif/>
                                                @if ($errors->has('status'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('status') }}</strong>
                                                    </span>
                                                @endif
                                                Active
                                            </label>
                                            <label for="chkNo">
                                                <input type="radio" class="status" value="Inactive" name="status" @if ($data->status == 'Inactive') checked @endif/>
                                                @if ($errors->has('status'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('status') }}</strong>
                                                    </span>
                                                @endif
                                                Inactive
                                            </label>
                                    </div>
                                </div>

                            <div class="pd-20 card-box mb-30">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4>SEO </h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta title:</label>
                                            <input type="text" class="form-control" name="meta_title" placeholder="Enter Meta Title" value="{{$data->meta_title}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Meta description :</label>
                                            <textarea class="ckeditor form-control border-radius-0" placeholder="Enter Meta Description" name="meta_description">{!!$data->meta_description!!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Keywords :</label>
                                            <textarea class="ckeditor form-control border-radius-0" placeholder="Enter Meta Keyword" name="meta_keywords">{!!$data->meta_keywords!!}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                         </form>


                <div class="row">
                  <div class="col-sm-12">
                    <form enctype="multipart/form-data" method="post" action="{{url('manager/corporate/addcorporateImages')}}">
                      @csrf
                      <h3>Add More Images</h3>
                      <input type="hidden" name="corporate_id" value="{{$data->id}}">
                      <div class="form-group">
                        <label for="images">Choose Image <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="images[]" class="custom-file-input" id="images" accept="image/*"  multiple/>
                              @if ($errors->has('images'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('images') }}</strong>
                                </span>
                              @endif
                              <label class="custom-file-label" for="images">Choose image file</label>
                            </div>
                          </div>
                      </div>
                      <div class="form-group">
                        <button id="submit" type="submit" class="btn btn-primary">Upload Images</button>
                      </div>
                    </form>
                    <div class="row">
                        @foreach($images as $row)
                        <div class="col-sm-3">
                          <div style="position: relative;">
                            <img src="{{ asset('uploads/images/') }}/{{ @$row->images }}" style="width: 100%;" />
                            <button style="position: absolute; right: 0px;
                              font-size: 18px;" id="delete-multiple-image{{ $row->id }}" form="resource-delete-{{ $row->id }}"><i style="color: red;" class="fa fa-trash"></i>
                            </button>
                            </div>
                          <div>
                           <form action="{{url('manager/corporate/corporatedeleteimage')}}?id={{$row->id}}" id="resource-delete-{{ $row->id }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                            @csrf
                           </form>
                          </div>
                          <div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>








@push('after-scripts')

    <script src="{{ URL::asset('managercss/vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ URL::asset('managercss/js/plugins-init/select2-init.js')}}"></script>

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