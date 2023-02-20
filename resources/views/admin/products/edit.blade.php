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
                            <h4>Edit Products</h4>
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

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select childcategory </label><br>
                                        @if(count($childcategory))
                                        <select name="childcategory_id" id="childcategory_id" class="form-control" onchange="this.form.submit()">
                                             <option selected>Select Sub Category</option>
                                            @foreach($childcategory as $childcategory)
                                            @if(isset($_REQUEST['childcategory_id']) && $_REQUEST['childcategory_id'] != '')
                                                <option value="{{$childcategory->id}}" @if(@$_REQUEST['childcategory_id'] == $childcategory->id) selected @endif >{{$childcategory->childcat_name}}</option>
                                            @else
                                                <option value="{{$childcategory->id}}" @if(@$data->childcategory_id == $childcategory->id) selected @endif >{{$childcategory->childcat_name}}</option>
                                            @endif
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
                      <form method="post" action="{{ route('admin.products.update',$data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        @if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != '')
                        <input type="hidden" name="category_id" value="{{@$_REQUEST['category_id']}}">
                        <input type="hidden" name="subcategory_id" value="{{@$_REQUEST['subcategory_id']}}">
                        <input type="hidden" name="childcategory_id" value="{{@$_REQUEST['childcategory_id']}}">
                        @else
                        <input type="hidden" name="category_id" value="{{@$data->category_id}}">
                        <input type="hidden" name="subcategory_id" value="{{@$data->subcategory_id}}">
                        <input type="hidden" name="childcategory_id" value="{{@$data->childcategory_id}}">
                        @endif
                        <input type="hidden" id="id" value="{{$data->id}}">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select SubChildCategory </label><br>
                                        <select name="subchildcategory_id" class="form-control" id="subchildcategory_id">
                                            <option selected disabled>Select ChildCategory</option>
                                            @foreach($subchildcategory as $subchildcategory)
                                            <option @if(@$data->subchildcategory_id == $subchildcategory->id) selected @endif value="{{$subchildcategory->id}}">{{$subchildcategory->subchildcat_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                @if ($errors->has('subchildcategory_id'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('subchildcategory_id') }}</strong>
                                </span>
                            @endif
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Name </label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" name="product_name" id="product_name" value="{{$data->product_name}}" required>
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
                                            <textarea class="ckeditor form-control" placeholder="Enter Short Description" name="pro_short_desc">{{$data->pro_short_desc}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Long Description :</label>
                                            <textarea class="ckeditor form-control" placeholder="Enter Long Description" name="pro_long_desc">{{$data->pro_long_desc}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Specification</label>
                                            <textarea class="ckeditor form-control" placeholder="Enter Specification" name="specification">{{$data->specification}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Delivery Info :</label>
                                            <textarea class="ckeditor form-control" placeholder="Enter Delivery Info" name="delivery_info">{{$data->delivery_info}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Color Desclaimer :</label>
                                            <textarea class="ckeditor form-control" placeholder="Enter Color Disclaimer" name="color_desclaimer">{{$data->color_desclaimer}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Return Policy :</label>
                                            <textarea class="ckeditor form-control" placeholder="Enter Return Policy" name="return_policy">{{$data->return_policy}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Review :</label>
                                            <textarea class="ckeditor form-control" placeholder="Enter Review" name="review">{{$data->review}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Price</label><span class="text-danger">*</span>
                                            <input type="number" class="form-control" name="price" id="price" value="{{$data->price}}" required>
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
                                            <input type="number" class="form-control" name="strick_price" id="strick_price" value="{{$data->strick_price}}">
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
                                            <input type="text" class="form-control" name="discount" id="discount" value="{{$data->discount}}">
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
                                            <input type="checkbox" class="custom-control-input" id="quantity_show" name="quantity_show"  @if($data->quantity_show == '1') checked @endif>
                                            <label class="custom-control-label" for="quantity_show">Quantity Section</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="text" class="form-control" name="quantity" id="quantity"value="{{$data->quantity}}">
                                            @if ($errors->has('quantity'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('quantity') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Stock Status</label><span class="text-danger">*</span>
                                            <select name="stock_status" class="form-control" required>
                                                <option value="" selected disabled>Select</option>
                                                <option value="instock" @if($data->stock_status == "instock") selected @endif>In Stock</option>
                                                <option value="outofstock" @if($data->stock_status == "outofstock") selected @endif>Out of Stock</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--<div class="col-md-6">
                                        <div class="form-group">
                                            <label>SKU Code</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" name="skucode" placeholder="Enter SKU Code" id="skucode" value="{{$data->skucode}}" required>
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
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <div class="custom-control custom-checkbox  pure-veg">
                                            <div class="checkbox d-inline mr-3 pure-veg">
                                                <input type="checkbox" class="custom-control-input"  id="trending" name="trending" @if($data->trending == '1') checked @endif>
                                                <label class="custom-control-label" for="trending">Trending</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veg">
                                            <div class="checkbox d-inline mr-3 pure-veg">
                                                <input type="checkbox" class="custom-control-input"  id="youmayalsolike" name="youmayalsolike" @if($data->youmayalsolike == '1') checked @endif>
                                                <label class="custom-control-label" for="youmayalsolike">You May Also Like</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veg">
                                            <div class="checkbox d-inline mr-3 pure-veg">
                                                <input type="checkbox" class="custom-control-input"  id="newarrivalgift" name="newarrivalgift" @if($data->newarrivalgift == '1') checked @endif>
                                                <label class="custom-control-label" for="newarrivalgift">New Arrival Gifts</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="location" name="location"  @if($data->location == '1') checked @endif>
                                                <label class="custom-control-label" for="location">Location Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="location_required" name="location_required"  @if($proreq->location_required == '1') checked @endif>
                                                <label class="custom-control-label" for="location_required">Location Section Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="datee" name="datee"  @if($data->datee == '1') checked @endif>
                                                <label class="custom-control-label" for="datee">Date Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="datee_required" name="datee_required"  @if($proreq->datee_required == '1') checked @endif>
                                                <label class="custom-control-label" for="datee_required">Date Section Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="timee" name="timee"  @if($data->timee == '1') checked @endif>
                                                <label class="custom-control-label" for="timee">Time Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="timee_required" name="timee_required"  @if($proreq->timee_required == '1') checked @endif>
                                                <label class="custom-control-label" for="timee_required">Time Section Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="comment" name="comment"  @if($data->comment == '1') checked @endif>
                                                <label class="custom-control-label" for="comment">Comment Section</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>Comment Heading Name</label>
                                            <input type="text" class="form-control" name="comment_heading" id="comment_heading" value="{{$data->comment_heading}}">
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="query" name="queryy"  @if($data->query == '1') checked @endif>
                                                <label class="custom-control-label" for="query">Any Query Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="self_pickup" name="self_pickup"  @if($data->self_pickup == '1') checked @endif>
                                                <label class="custom-control-label" for="self_pickup">Self Pickup Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="selfpickup_required" name="selfpickup_required"  @if($proreq->selfpickup_required == '1') checked @endif>
                                                <label class="custom-control-label" for="selfpickup_required">Self Pickup Section Is Mandatory Field</label>
                                            </div>
                                        </div>

                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="frontandbackprint_option" name="frontandbackprint_option" @if($data->frontandbackprint_option == '1') checked @endif>
                                                <label class="custom-control-label" for="frontandbackprint_option">Front and Back Print</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="single_option" name="single_option" @if($data->single_option == '1') checked @endif>
                                                <label class="custom-control-label" for="single_option">Single Color</label>
                                            </div>
                                        </div>

                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="textareaa" name="textareaa"  @if($data->textareaa == '1') checked @endif>
                                                <label class="custom-control-label" for="textareaa">Text Area Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="textarea_required" name="textarea_required"  @if($proreq->textarea_required == '1') checked @endif>
                                                <label class="custom-control-label" for="textarea_required">Textarea Is Mandatory Field</label>
                                            </div>
                                        </div>

                                        <br>
                                        <div class="form-group">
                                            <label>Textarea Heading</label>
                                            <input type="text" class="form-control" name="textarea_name" id="textarea_name" value="{{$data->textarea_name}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Textarea Field Validation</label>
                                            <input type="number" class="form-control" name="textarea_validation" id="textarea_validation" value="{{$data->textarea_validation}}">
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="eggoreggless" name="eggoreggless" @if($data->eggoreggless == '1') checked @endif >
                                                <label class="custom-control-label" for="eggoreggless">Egg or Eggless Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="eggoreggless_required" name="eggoreggless_required"  @if($proreq->eggoreggless_required == '1') checked @endif>
                                                <label class="custom-control-label" for="eggoreggless_required">Eggor Eggless Is Mandatory Field</label>
                                            </div>
                                        </div>

                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="imageuploadoption" name="imageuploadoption"  @if($data->imageuploadoption == '1') checked @endif>
                                                <label class="custom-control-label" for="imageuploadoption">Image Upload Option</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="imageupload_required" name="imageupload_required"  @if($proreq->imageupload_required == '1') checked @endif>
                                                <label class="custom-control-label" for="imageupload_required">Image Upload Is Mandatory Field</label>
                                            </div>
                                        </div>

                                        <br>
                                        <div class="form-group">
                                            <label>Image Upload Option Heading</label>
                                            <input type="text" class="form-control" name="imageuploadoption_heading" id="imageuploadoption_heading" value="{{$data->imageuploadoption_heading}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Image Upload Option Validation</label>
                                            <input type="text" class="form-control" name="imageuploadoption_validation" id="imageuploadoption_validation" value="{{$data->imageuploadoption_validation}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Image Upload Option Size</label>
                                            <input type="text" class="form-control" name="imageuploadoption_size" id="imageuploadoption_size" value="{{$data->imageuploadoption_size}}">
                                        </div>

                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="text_field" name="text_field"  @if($data->text_field == '1') checked @endif>
                                                <label class="custom-control-label" for="text_field">Text Field Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="textfield_required" name="textfield_required"  @if($proreq->textfield_required == '1') checked @endif>
                                                <label class="custom-control-label" for="textfield_required">Textfield Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>Text Field Heading</label>
                                            <input type="text" class="form-control" name="text_heading" id="text_heading" value="{{$data->text_heading}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Text Field Validation</label>
                                            <input type="number" class="form-control" name="text_validation" id="text_validation" value="{{$data->text_validation}}">
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="giftwrapper_option" name="giftwrapper_option"  @if($data->giftwrapper_option == '1') checked @endif>
                                                <label class="custom-control-label" for="giftwrapper_option">Gift Wrapper Option</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>Gift Wrapper Price</label>
                                            <input type="text" class="form-control" name="giftwrapper_price" id="giftwrapper_price" value="{{$data->giftwrapper_price}}">
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="anyspecificdesign_option" name="anyspecificdesign_option"  @if($data->anyspecificdesign_option == '1') checked @endif>
                                                <label class="custom-control-label" for="anyspecificdesign_option">Any Specific Design Option</label>
                                            </div>
                                        </div>

                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="haveadesigninmind_option" name="haveadesigninmind_option"  @if($data->haveadesigninmind_option == '1') checked @endif>
                                                <label class="custom-control-label" for="haveadesigninmind_option">Have A Design In Mind Option</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="uploadlogo_option" name="uploadlogo_option"  @if($data->uploadlogo_option == '1') checked @endif>
                                                <label class="custom-control-label" for="uploadlogo_option">Upload logo</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="logoupload_required" name="logoupload_required"  @if($proreq->logoupload_required == '1') checked @endif>
                                                <label class="custom-control-label" for="logoupload_required">Logoupload Is Mandatory Field</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Logo Upload Option Heading</label>
                                            <input type="text" class="form-control" name="uploadlogo_heading" id="uploadlogo_heading" value="{{$data->uploadlogo_heading}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Logo Upload Option Validation</label>
                                            <input type="text" class="form-control" name="uploadlogo_validation" id="uploadlogo_validation" value="{{$data->uploadlogo_validation}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Logo Upload Option Size</label>
                                            <input type="text" class="form-control" name="uploadlogo_size" id="uploadlogo_size" value="{{$data->uploadlogo_size}}">
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="addatext_option" name="addatext_option"  @if($data->addatext_option == '1') checked @endif>
                                                <label class="custom-control-label" for="addatext_option">Add Text Option</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="addtext_required" name="addtext_required"  @if($proreq->addtext_required == '1') checked @endif>
                                                <label class="custom-control-label" for="addtext_required">Addtext Is Mandatory Field</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>Add Text Heading</label>
                                            <input type="text" class="form-control" name="addatext_heading" id="addatext_heading" value="{{$data->addatext_heading}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Text Field Validation</label>
                                            <input type="number" class="form-control" name="addatext_validation" id="addatext_validation" value="{{$data->addatext_validation}}">
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="flower_type_option" name="flower_type_option"  @if($data->flower_type_option == '1') checked @endif>
                                                <label class="custom-control-label" for="flower_type_option">Flower Type Section</label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox  pure-vegg">
                                            <div class="checkbox d-inline mr-3 pure-vegg">
                                                <input type="checkbox" class="custom-control-input" id="flowertype_required" name="flowertype_required"  @if($proreq->flowertype_required == '1') checked @endif>
                                                <label class="custom-control-label" for="flowertype_required">Flower Type Is Mandatory Field</label>
                                            </div>
                                        </div>

                                        <br>
                                        <!--<div class="custom-control custom-checkbox  pure-veggg">
                                            <div class="checkbox d-inline mr-3 pure-veggg">
                                                <input type="checkbox" class="custom-control-input" id="button_type_option" name="button_type_option"  @if($data->button_type_option == '1') checked @endif>
                                                <label class="custom-control-label" for="button_type_option">Button Type Section</label>
                                            </div>
                                        </div>-->
                                        <br>
                                        <div class="custom-control custom-checkbox">
                                            <div class="checkbox d-inline mr-3">
                                                <input type="checkbox" class="custom-control-input"  id="myCheck" name="is_variation" @if($data->is_variation == '1') checked @endif/>
                                                <label class="custom-control-label" for="myCheck">Is Variation</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="nonvegprice">
                                        <div class="form-group"  id="text" >
                                            <label>Select Product Attributes</label>
                                            <?php
                                            $atrr = App\Models\Attribute::all();
                                            ?>
                                           <select class="multi-select form-control" multiple="multiple" name="pro_attributes[]">
                                                <optgroup label="">
                                                    @foreach($atrr as $key =>$atrr)
                                                    @if (array_key_exists($atrr->id, $item_attr_ids))
                                                       <option value="{{ $atrr->id }}" selected>{{ $atrr->attr_name }}</option>
                                                    @else
                                                        <option value="{{ $atrr->id }}">{{ $atrr->attr_name }}</option>
                                                    @endif
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="custom-control custom-checkbox  pure-veg">
                                        <div class="checkbox d-inline mr-3 pure-veg">
                                            <input type="checkbox" class="custom-control-input"  id="is_combo" name="is_combo" @if($data->is_combo == '1') checked @endif>
                                            <label class="custom-control-label" for="is_combo">Combo Part</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="nonvegprice">
                                        <div class="form-group"  id="text" >
                                            <label>Select Product Attributes</label>
                                            <?php $atrrc = App\Models\Attribute::all(); ?>
                                           <select class="multi-select form-control" multiple="multiple" name="pro_combo_attributes[]">
                                                <optgroup label="">
                                                    @foreach($atrrc as $keyc =>$atrrc)
                                                    @if (array_key_exists($atrrc->id, $item_attr_idsc))
                                                       <option value="{{ $atrrc->id }}" selected>{{ $atrrc->attr_name }}</option>
                                                    @else
                                                        <option value="{{ $atrrc->id }}">{{ $atrrc->attr_name }}</option>
                                                    @endif
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-12" id="nonvegprice">
                                        <div class="form-group"  id="text" >
                                            <label>Select Cake In Landing Page</label>
                                            <?php $cakee = App\Models\LandingCakes::all(); ?>
                                           <select class="multi-select form-control" name="cake_id[]" multiple="multiple" >
                                                <optgroup label="">
                                                    @foreach($cakee as $cake =>$cak)
                                                    @if (array_key_exists($cak->id, $cake_desc))
                                                       <option value="{{ $cak->id }}" selected>{{ $cak->cake_name }}</option>
                                                    @else
                                                        <option value="{{ $cak->id }}">{{ $cak->cake_name }}</option>
                                                    @endif
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
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
                                                <?php $rel = App\Models\Product::where('category_id',$data->category_id)->get(); ?>
                                            @endif
                                           <select class="multi-select form-control" multiple="multiple"
                                                name="related_products[]" style="width: 100%; height: 38px;">
                                                <optgroup label="">
                                                    @foreach($rel as $key => $rel)
                                                    @if (array_key_exists($rel->id, $item_rel_ids))
                                                       <option value="{{ $rel->id }}" selected>{{ $rel->product_name }}</option>
                                                    @else
                                                        <option value="{{ $rel->id }}">{{ $rel->product_name }}</option>
                                                    @endif
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

                         <form enctype="multipart/form-data" method="post" action="{{url('admin/products/addflower')}}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$data->id}}">
                            <h3>Add </h3>
                            <div class="form-group">
                            <div class="dynamicRadioo">
                                <div class="row">
                                <div class="col-md-2"><label>Flower Name</label>
                                    <input name = "product_flower_name[]" type="text"  class="form-control" Placeholder="Enter Flower Name" />
                                </div>
                               <div class="col-md-2">
                                    <label>&nbsp;</label><br>
                                    <input id="btnCakePricee" class="btn-primary" type="button" value="Add More" />
                                </div>
                                <div>
                            </div>
                            </div>
                            <div id="ProductContainerr"></div>
                            <br>
                            <div class="form-group">
                            <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <h3>Update Flower</h3>
                            <label>&nbsp;</label>
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th>Flower Name</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($treat as $treat)
                                <tr>
                                <td>{{$treat->product_flower_name}}</td>
                                <td>
                                    <button form="resource-delete-{{ $treat->id }}" class="btn btn-danger">Deleted</button>
                                    <form id="resource-delete-{{ $treat->id }}" action="{{ url('admin/products/flowerdelete') }}?id={{$treat->id}}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                                    @csrf
                                    </form></td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>








                            <form enctype="multipart/form-data" method="post" action="{{url('admin/products/addmorebuttons')}}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$data->id}}">
                                <h3>Add </h3>
                                <div class="form-group">
                                <div class="dynamicRadioobutton">
                                    <div class="row">
                                    <div class="col-md-2"><label>Time slot</label>
                                        <input name = "button_name[]" type="text"  class="form-control" Placeholder="Enter Time slot" />
                                    </div>
                                   <div class="col-md-2">
                                        <label>&nbsp;</label><br>
                                        <input id="btnCakePriceebutton" class="btn-primary" type="button" value="Add More" />
                                    </div>
                                    <div>
                                </div>
                                </div>
                                <div id="ProductContainerrbutton"></div>
                                <br>
                                <div class="form-group">
                                <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <h3>Update Time slot</h3>
                                <label>&nbsp;</label>
                                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>Time Slot</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($butt as $butt)
                                    <tr>
                                    <td>{{$butt->button_name}}</td>
                                    <td>
                                        <button form="resource-delete-{{ $butt->id }}" class="btn btn-danger">Deleted</button>
                                        <form id="resource-delete-{{ $butt->id }}" action="{{ url('admin/products/buttondelete') }}?id={{$butt->id}}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                                        @csrf
                                        </form></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>












                <div class="row">
                  <div class="col-sm-12">
                    <form enctype="multipart/form-data" method="post" action="{{url('admin/products/addMoreImages')}}">
                      @csrf
                      <h3>Add More Images</h3>
                      <input type="hidden" name="product_id" value="{{$data->id}}">
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
                           <form action="{{url('admin/products/delete-multiple-image')}}?id={{$row->id}}" id="resource-delete-{{ $row->id }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
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

<script src="{{ URL::asset('admincss/vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ URL::asset('admincss/js/plugins-init/select2-init.js')}}"></script>

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

<script type="text/javascript">
  $("#btnCakePricee").bind("click", function () {
      var div = $("<div />");
      div.html(GetDynamicProductPriceWeightt(""));
      $("#ProductContainerr").append(div);
  });
  $("body").on("click", ".removeRadioo", function () {
      $(this).closest(".dynamicRadioo").remove();
  });
  function GetDynamicProductPriceWeightt(value) {
      return '<div class="dynamicRadioo"> <div class="row"> <div class="col-md-6"> <br> <input name ="product_flower_name[]" type="text"  class="form-control" Placeholder="Enter Name" /></div><div class="col-md-2"> <br> <input type="button" value="Remove" class="removeRadioo btn btn-danger"></div> </div></div>'
  }
</script>

<script type="text/javascript">
    $("#btnCakePriceebutton").bind("click", function () {
        var div = $("<div />");
        div.html(GetDynamicProductPriceWeight(""));
        $("#ProductContainerrbutton").append(div);
    });
    $("body").on("click", ".removeRadioobutton", function () {
        $(this).closest(".dynamicRadioobutton").remove();
    });
    function GetDynamicProductPriceWeight(value) {
        return '<div class="dynamicRadioobutton"> <div class="row"> <div class="col-md-6"> <br> <input name ="button_name[]" type="text"  class="form-control" Placeholder="Enter Time Slot" /></div><div class="col-md-2"> <br> <input type="button" value="Remove" class="removeRadioobutton btn btn-danger"></div> </div></div>'
    }
  </script>
@endpush

@endsection
