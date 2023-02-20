@push('after-styles')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('admincss/vendor/select2/css/select2.min.css')}}">
@endpush
@extends('admin.layouts.app')
@section('title', 'Products')
@section('content')

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Create Products</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
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
                <h4 class="card-title">Products</h4>
                <div class="text-right">
                    <a href="{{ url('/admin/products/') }}" class="btn btn-primary btn-sm scroll-click">View Products</a>
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

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Select childcategory </label><br>
                                    @if(count($childcategory))
                                    <select name="childcategory_id" id="childcategory_id" class="form-control" onchange="this.form.submit()">
                                            <option selected disabled>Select Sub Category</option>
                                            @foreach($childcategory as $childcategory)
                                            <option value="{{$childcategory->id}}" @if(@$_REQUEST['childcategory_id'] == $childcategory->id) selected @endif >{{$childcategory->childcat_name}}</option>
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
                        </form>
                        <form enctype="multipart/form-data"  method="post" action="{{ route('admin.products.store') }}">
                        @csrf
                        @if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != '')
                        <input type="hidden" name="category_id" value="{{@$_REQUEST['category_id']}}">
                        <input type="hidden" name="subcategory_id" value="{{@$_REQUEST['subcategory_id']}}">
                        <input type="hidden" name="childcategory_id" value="{{@$_REQUEST['childcategory_id']}}">
                        @else
                        <input type="hidden" name="category_id" value="{{@$firstcategory->id}}">
                        <input type="hidden" name="subcategory_id" value="{{@$_REQUEST['subcategory_id']}}">
                        <input type="hidden" name="childcategory_id" value="{{@$_REQUEST['childcategory_id']}}">
                        @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Select ChildCategory </label><br>
                                    @if(count($subchildcategory))
                                    <select name="subchildcategory_id" id="subchildcategory_id" class="form-control">
                                        <option selected disabled>Select Child Category</option>
                                        @foreach($subchildcategory as $subchildcategory)
                                        <option  value="{{$subchildcategory->id}}">{{$subchildcategory->subchildcat_name}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                @if ($errors->has('subchildcategory_id'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('subchildcategory_id') }}</strong>
                                </span>
                            @endif
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Name </label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" name="product_name" id="product_name" value="{{old('product_name')}}" required>
                                            @if ($errors->has('product_name'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('product_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Short Description :</label>
                                            <textarea class="ckeditor form-control" placeholder="Enter Short Description" name="pro_short_desc"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Long Description :</label>
                                            <textarea class="ckeditor form-control" placeholder="Enter Long Description" name="pro_long_desc"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Specification</label>
                                            <textarea class="ckeditor form-control" placeholder="Enter Specification" name="specification"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Delivery Info :</label>
                                            <textarea class="ckeditor form-control" placeholder="Enter Delivery Info" name="delivery_info"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Color Desclaimer :</label>
                                            <textarea class="ckeditor form-control" placeholder="Enter Color Disclaimer" name="color_desclaimer"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Return Policy :</label>
                                            <textarea class="ckeditor form-control" placeholder="Enter Return Policy" name="return_policy"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Review :</label>
                                            <textarea class="ckeditor form-control" placeholder="Enter Review" name="review"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Price</label><span class="text-danger">*</span>
                                            <input type="number" class="form-control" name="price" id="price" value="{{old('price')}}" required>
                                            @if ($errors->has('price'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--<div class="col-md-4">
                                        <div class="form-group">
                                            <label>Strick Price</label>
                                            <input type="number" class="form-control" name="strick_price" id="strick_price" value="{{old('strick_price')}}">
                                            @if ($errors->has('strick_price'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('strick_price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <input type="text" class="form-control" name="discount" id="discount" value="{{old('discount')}}">
                                            @if ($errors->has('discount'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('discount') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>-->
                                </div>
                                <div class="row">
                                    <div class="custom-control custom-checkbox  pure-veggg">
                                        <div class="checkbox d-inline mr-3 pure-veggg">
                                            <input type="checkbox" class="custom-control-input" id="quantity_show" name="quantity_show" >
                                            <label class="custom-control-label" for="quantity_show">Quantity Section</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="number" class="form-control" name="quantity" id="quantity"value="{{old('quantity')}}">
                                            @if ($errors->has('quantity'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('quantity') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Stock Status</label>
                                            <select name="stock_status" class="form-control">
                                                <option value="" selected disabled>Select</option>
                                                <option value="instock">In Stock</option>
                                                <option value="outofstock">Out of Stock</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                 <!--   <div class="col-md-6">
                                        <div class="form-group">
                                            <label>SKU Code</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" name="skucode" placeholder="Enter SKU Code" id="skucode" value="{{old('skucode')}}" required>
                                            @if ($errors->has('skucode'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('skucode') }}</strong>
                                                </span>
                                            @endif
                                        </div>
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
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <div class="custom-control custom-checkbox  pure-veg">
                                            <div class="checkbox d-inline mr-3 pure-veg">
                                                <input type="checkbox" class="custom-control-input"  id="trending" name="trending">
                                                <label class="custom-control-label" for="trending">Trending Products</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veg">
                                            <div class="checkbox d-inline mr-3 pure-veg">
                                                <input type="checkbox" class="custom-control-input"  id="youmayalsolike" name="youmayalsolike">
                                                <label class="custom-control-label" for="youmayalsolike">You May Also Like</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veg">
                                            <div class="checkbox d-inline mr-3 pure-veg">
                                                <input type="checkbox" class="custom-control-input"  id="newarrivalgift" name="newarrivalgift">
                                                <label class="custom-control-label" for="newarrivalgift">New Arrival Gifts</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="location" name="location" >
                                                <label class="custom-control-label" for="location">Location Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="location_required" name="location_required" >
                                                <label class="custom-control-label" for="location_required">Location Section Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="datee" name="datee" >
                                                <label class="custom-control-label" for="datee">Date Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="datee_required" name="datee_required" >
                                                <label class="custom-control-label" for="datee_required">Date Section Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="timee" name="timee" >
                                                <label class="custom-control-label" for="timee">Time Section</label>
                                            </div>
                                        </div>
                                        <br>
                                     <div class="row">
                                        <div class="form-group">
                                            <div class="dynamicRadioobutton">
                                            <div class="row">
                                                <div class="col-md-6"><label>Time</label>
                                                    <input name="button_name[]" type="text"  class="form-control" Placeholder="Enter Time" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>&nbsp;</label><br>
                                                    <input id="btnCakePriceebutton" class="btn-primary" type="button" value="Add More" />
                                                </div>
                                                <div>
                                                </div>
                                            </div>
                                            <div id="ProductContainerrbutton"></div>
                                            <br>
                                        </div>
                                     </div>
                                    </div>

                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="timee_required" name="timee_required" >
                                                <label class="custom-control-label" for="timee_required">Time Section Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="comment" name="comment" >
                                                <label class="custom-control-label" for="comment">Comment Section</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>Comment Heading Name</label>
                                            <input type="text" class="form-control" name="comment_heading" id="comment_heading" value="{{old('comment_heading')}}">
                                        </div>

                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="query" name="queryy" >
                                                <label class="custom-control-label" for="query">Any Query Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="self_pickup" name="self_pickup" >
                                                <label class="custom-control-label" for="self_pickup">Self Pickup Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="selfpickup_required" name="selfpickup_required" >
                                                <label class="custom-control-label" for="selfpickup_required">Seft Pickup Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="textarea_required" name="textarea_required" >
                                                <label class="custom-control-label" for="textarea_required">Textarea Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="textareaa" name="textareaa" >
                                                <label class="custom-control-label" for="textareaa">Text Area Section</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>Textarea Heading</label>
                                            <input type="text" class="form-control" name="textarea_name" id="textarea_name" value="{{old('textarea_name')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Textarea Field Validation</label>
                                            <input type="number" class="form-control" name="textarea_validation" id="textarea_validation" value="{{old('textarea_validation')}}">
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="eggoreggless_required" name="eggoreggless_required" >
                                                <label class="custom-control-label" for="eggoreggless_required">Eggoreggless Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="eggoreggless" name="eggoreggless" >
                                                <label class="custom-control-label" for="eggoreggless">Egg or Eggless Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="imageuploadoption" name="imageuploadoption" >
                                                <label class="custom-control-label" for="imageuploadoption">Image Upload Option</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="imageupload_required" name="imageupload_required" >
                                                <label class="custom-control-label" for="imageupload_required">Image upload Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>Image Upload Option Heading</label>
                                            <input type="text" class="form-control" name="imageuploadoption_heading" id="imageuploadoption_heading" value="{{old('imageuploadoption_heading')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Image Upload Option Validation</label>
                                            <input type="text" class="form-control" name="imageuploadoption_validation" id="imageuploadoption_validation" value="{{old('imageuploadoption_validation')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Image Upload Option Size</label>
                                            <input type="text" class="form-control" name="imageuploadoption_size" id="imageuploadoption_size" value="{{old('imageuploadoption_size')}}">
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="textfield_required" name="textfield_required" >
                                                <label class="custom-control-label" for="textfield_required">Textfield Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="text_field" name="text_field" >
                                                <label class="custom-control-label" for="text_field">Text Field Section</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>Text Field Heading</label>
                                            <input type="text" class="form-control" name="text_heading" id="text_heading" value="{{old('text_heading')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Text Field Validation</label>
                                            <input type="number" class="form-control" name="text_validation" id="text_validation" value="{{old('text_validation')}}">
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="giftwrapper_option" name="giftwrapper_option" >
                                                <label class="custom-control-label" for="giftwrapper_option">Gift Wrapper Option</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>Gift Wrapper Price</label>
                                            <input type="text" class="form-control" name="giftwrapper_price" id="giftwrapper_price" value="{{old('giftwrapper_price')}}">
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="anyspecificdesign_option" name="anyspecificdesign_option" >
                                                <label class="custom-control-label" for="anyspecificdesign_option">Any Specific Design Option</label>
                                            </div>
                                        </div>

                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="frontandbackprint_option" name="frontandbackprint_option" >
                                                <label class="custom-control-label" for="frontandbackprint_option">Front and Back Print</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="single_option" name="single_option" >
                                                <label class="custom-control-label" for="single_option">Single Color</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="haveadesigninmind_option" name="haveadesigninmind_option" >
                                                <label class="custom-control-label" for="haveadesigninmind_option">Have A Design In Mind Option</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="logoupload_required" name="logoupload_required" >
                                                <label class="custom-control-label" for="logoupload_required">Upload Logo Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="uploadlogo_option" name="uploadlogo_option" >
                                                <label class="custom-control-label" for="uploadlogo_option">Upload logo</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Logo Upload Option Heading</label>
                                            <input type="text" class="form-control" name="uploadlogo_heading" id="uploadlogo_heading" value="{{old('uploadlogo_heading')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Logo Upload Option Validation</label>
                                            <input type="text" class="form-control" name="uploadlogo_validation" id="uploadlogo_validation" value="{{old('uploadlogo_validation')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Logo Upload Option Size</label>
                                            <input type="text" class="form-control" name="uploadlogo_size" id="uploadlogo_size" value="{{old('uploadlogo_size')}}">
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="addatext_option" name="addatext_option" >
                                                <label class="custom-control-label" for="addatext_option">Add Text Option</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="addtext_required" name="addtext_required" >
                                                <label class="custom-control-label" for="addtext_required">Add Text Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>Add Text Heading</label>
                                            <input type="text" class="form-control" name="addatext_heading" id="addatext_heading" value="{{old('addatext_heading')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Text Field Validation</label>
                                            <input type="number" class="form-control" name="addatext_validation" id="addatext_validation" value="{{old('addatext_validation')}}">
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="flower_type_option" name="flower_type_option" >
                                                <label class="custom-control-label" for="flower_type_option">Flower Type Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="flowertype_required" name="flowertype_required" >
                                                <label class="custom-control-label" for="flowertype_required">Flower Type Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <div class="dynamicRadioo">
                                            <div class="row">
                                                <div class="col-md-6"><label>Flower Name</label>
                                                    <input name="product_flower_name[]" type="text"  class="form-control" Placeholder="Enter Flower Name" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>&nbsp;</label><br>
                                                    <input id="btnCakePricee" class="btn-primary" type="button" value="Add More" />
                                                </div>
                                                <div>
                                                </div>
                                            </div>
                                            <div id="ProductContainerr"></div>
                                            <br>
                                        </div>
                                     </div>


                                     <!--<div class="custom-control custom-checkbox  pure-veggg">
                                        <div class="checkbox d-inline mr-3 pure-veggg">
                                            <input type="checkbox" class="custom-control-input" id="button_type_option" name="button_type_option" >
                                            <label class="custom-control-label" for="button_type_option">Button Type Section</label>
                                        </div>
                                    </div>-->
                                    <br>


                                     <div class="custom-control custom-checkbox  pure-veg">
                                        <div class="checkbox d-inline mr-3 pure-veg">
                                            <input type="checkbox" class="custom-control-input"  id="myCheck" name="is_variation" onclick="myFunction()">
                                            <label class="custom-control-label" for="myCheck">Is Variation</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12" id="nonvegprice">
                                        <div class="form-group"  id="text" style="display:none">
                                            <label>Select Product Attributes</label>
                                            <?php $atrr = App\Models\Attribute::all(); ?>
                                            <select class="multi-select" name="pro_attributes[]"  multiple="multiple">
                                                <optgroup label="">
                                                @foreach ($atrr as $attr)
                                                    <option value="{{ $attr->id }}">{{ $attr->attr_name }}</option>
                                                @endforeach
                                                </optgroup>
                                            </select>
                                       </div>
                                    </div>

                                    <div class="custom-control custom-checkbox pure-veg">
                                        <div class="checkbox d-inline mr-3 pure-veg">
                                            <input type="checkbox" class="custom-control-input"  id="is_combo" name="is_combo" onclick="mycomboFunction()">
                                            <label class="custom-control-label" for="is_combo">Combo Part</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12" id="nonvegprice">
                                        <div class="form-group"  id="textt" style="display:none">
                                            <label>Select Product Attributes For Combo</label>
                                            <?php $atrrc = App\Models\Attribute::all(); ?>
                                            <select class="multi-select" name="pro_combo_attributes[]"  multiple="multiple">
                                                <optgroup label="">
                                                @foreach ($atrrc as $attrc)
                                                    <option value="{{ $attrc->id }}">{{ $attrc->attr_name }}</option>
                                                @endforeach
                                                </optgroup>
                                            </select>
                                       </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Select Cake In Landing Page</label>
                                            <?php $cakee = App\Models\LandingCakes::all(); ?>
                                            <select class="multi-select" name="cake_id[]"  multiple="multiple">
                                                <optgroup label="">
                                                @foreach ($cakee as $cakee)
                                                    <option value="{{ $cakee->id }}">{{ $cakee->cake_name }}</option>
                                                @endforeach
                                                </optgroup>
                                            </select>
                                       </div>
                                    </div>


                                </div>
                            </div>
                        <br>
                                <div class="form-group">
                                <label for="images">Choose Image </label>
                                        <input type="file" name="images[]" class="form-control" id="images" accept="image/*" multiple>
                                        @if ($errors->has('images'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('images') }}</strong>
                                            </span>
                                        @endif
                                 </div>
                            </div>
                            <!-- Form grid End -->
                            <div class="pd-20 card-box mb-30">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4>Related produccts </h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Related products</label>
                                            @if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != '')
                                            <?php $rel = App\Models\Product::where('category_id',$_REQUEST['category_id'])->get(); ?>
                                            @else
                                            <?php $rel = App\Models\Product::all(); ?>
                                            @endif
                                            <select class="multi-select form-control" multiple="multiple" name="related_products[]" style="width: 100%; height: 38px;">
                                                <optgroup label="">
                                                    @foreach ($rel as $rel)
                                                        <option value="{{ $rel->id }}">{{ $rel->product_name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
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
                                            <input type="text" class="form-control" name="meta_title" placeholder="Enter Meta Title">
                                        </div>
                                        <div class="form-group">
                                            <label>Meta description :</label>
                                            <textarea class="ckeditor form-control border-radius-0" placeholder="Enter Meta Description" name="meta_description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Keywords :</label>
                                            <textarea class="ckeditor form-control border-radius-0" placeholder="Enter Meta Keyword" name="meta_keywords"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"> Submit </button>

                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('after-scripts')

<script src="{{ URL::asset('admincss/vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ URL::asset('admincss/js/plugins-init/select2-init.js')}}"></script>

    <!-- Jquery Validation -->
    <script src="{{ URL::asset('admin/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- Form validate init -->
    <script src="{{ URL::asset('/admincss/js/plugins-init/jquery.validate-init.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>

<script>
function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("text");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>

<script>
function mycomboFunction(){
    var checkBoxx = document.getElementById("is_combo");
  var textt = document.getElementById("textt");
  if (checkBoxx.checked == true){
    textt.style.display = "block";
  } else {
     textt.style.display = "none";
  }
}
</script>
<script type="text/javascript">
    $("#btnCakePricee").bind("click", function () {
        var div = $("<div />")
        div.html(GetDynamicProductPriceWeight(""));
        $("#ProductContainerr").append(div);
    });
    $("body").on("click", ".removeRadioo", function () {
        $(this).closest(".dynamicRadioo").remove();
    });
    function GetDynamicProductPriceWeight(value) {
        return '<div class="dynamicRadioo"> <div class="row"> <div class="col-md-6"> <br> <input name ="product_flower_name[]" type="text"  class="form-control" Placeholder="Enter Flower Name" /></div><div class="col-md-2"> <br> <input type="button" value="Remove" class="removeRadioo btn btn-danger"></div> </div></div>'
    }
  </script>
    <script type="text/javascript">
        $("#btnCakePriceebutton").bind("click", function () {
            var div = $("<div />");
            div.html(GetDynamicProductPriceWeightbutton(""));
            $("#ProductContainerrbutton").append(div);
        });
        $("body").on("click", ".removeRadioobutton", function () {
            $(this).closest(".dynamicRadioobutton").remove();
        });
        function GetDynamicProductPriceWeightbutton(value) {
            return '<div class="dynamicRadioobutton"> <div class="row"> <div class="col-md-6"> <br> <input name ="button_name[]" type="text"  class="form-control" Placeholder="Enter Time Slot" /></div><div class="col-md-2"> <br> <input type="button" value="Remove" class="removeRadioobutton btn btn-danger"></div> </div></div>'
        }
      </script>
@endpush
@endsection
