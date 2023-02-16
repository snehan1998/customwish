@push('after-styles')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('managercss/vendor/select2/css/select2.min.css')}}">
@endpush
@extends('manager.layouts.app')
@section('title', 'Add Variations')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Variations</li>
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
                                <h4 class="card-title">Add Variations</h4>
                            </div>

                <div class="card-body">
                    <div class="form-validation">
                    <form method="get" action="">
                        <div class="pd-20 card-box mb-30">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="category_id">Select Category <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-control" onchange="this.form.submit()" required>
                                    <option selected disabled>Select Category</option>
                                    @foreach($category as $category)
                                    <option @if(@$_REQUEST['category_id'] == $category->id) selected @endif value="{{$category->id}}">{{$category->cat_name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                </div>
                            </div>
                            </div>
                        </form>
                          <form enctype="multipart/form-data"  method="post" action="{{ route('manager.products.store') }}">
                            @csrf
                            @if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != '')
                            <input type="hidden" name="category_id" value="{{@$_REQUEST['category_id']}}">
                            @else
                            <input type="hidden" name="category_id" value="{{@$firstcategory->id}}">
                            @endif

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select Subcategory <span class="text-danger">*</span></label><br>
                                        @if(count($subcategory))
                                        <select name="subcategory_id" class="form-control" required>
                                            <option selected disabled>Select Subcategory</option>
                                            @foreach($subcategory as $subcategory)
                                            <option @if(@$_REQUEST['subcategory_id'] == $subcategory->id) selected @endif value="{{$subcategory->id}}">{{$subcategory->subcat_name}}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        No Subcategory Found.  Please Create a Subcategory for this category <a target="_blank" href="{{url('/')}}/manager/subcategory/create">Here</a>
                                        @endif
                                    </div>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Base Material</label>
                                            <input type="text" class="form-control" name="base_material" id="base_material" value="{{old('base_material')}}" >
                                            @if ($errors->has('base_material'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('base_material') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Body Material </label>
                                            <input type="text" class="form-control" name="body_material" id="body_material" value="{{old('body_material')}}" >
                                            @if ($errors->has('body_material'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('body_material') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Packing</label>
                                            <input type="text" class="form-control" name="packing" id="packing" value="{{old('packing')}}" >
                                            @if ($errors->has('packing'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('packing') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Printing </label>
                                            <input type="text" class="form-control" name="printing" id="printing" value="{{old('printing')}}" >
                                            @if ($errors->has('printing'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('printing') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Engraving </label>
                                            <input type="text" class="form-control" name="engraving" id="engraving" value="{{old('engraving')}}" >
                                            @if ($errors->has('engraving'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('engraving') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Base Color </label>
                                            <input type="text" class="form-control" name="base_color" id="base_color" value="{{old('base_color')}}" >
                                            @if ($errors->has('base_color'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('base_color') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Dimension</label>
                                            <input type="number" class="form-control" name="dimension" id="dimension" value="{{old('dimension')}}" >
                                            @if ($errors->has('dimension'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('dimension') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Length </label>
                                            <input type="number" class="form-control" name="length" id="length" value="{{old('length')}}" >
                                            @if ($errors->has('length'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('length') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
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
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quantity</label><span class="text-danger">*</span>
                                            <input type="number" class="form-control" name="quantity" id="quantity"value="{{old('quantity')}}" required>
                                            @if ($errors->has('quantity'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('quantity') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Stock Status</label><span class="text-danger">*</span>
                                            <select name="stock_status" class="form-control" required>
                                                <option value="" selected disabled>Select</option>
                                                <option value="Instock">In Stock</option>
                                                <option value="Outofstock">Out of Stock</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>SKU Code</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" name="skucode" placeholder="Enter SKU Code" id="skucode" value="{{old('skucode')}}" required>
                                            @if ($errors->has('skucode'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('skucode') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
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
                                                <input type="checkbox" class="custom-control-input "  id="myCheck" name="is_variation" onclick="myFunction()">
                                                <label class="custom-control-label" for="myCheck">Is Variation</label>
                                            </div>
                                        </div>
                                            <div class="col-md-12" id="nonvegprice">
                                                <div class="form-group"  id="text" style="display:none">
                                                    <label>Select Product Attributes</label>
                                                    <?php
                                                    $atrr = App\Models\Attribute::all();
                                                    ?>
                                                     <select class="multi-select" name="pro_attributes[]"  multiple="multiple">
                                                    <optgroup label="">
                                                        @foreach ($atrr as $attr)
                                                            <option value="{{ $attr->id }}">{{ $attr->attr_name }}</option>
                                                        @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <br>
                                <div class="form-group">
                                <label for="images">Choose Image <span class="text-danger">*</span></label>
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
                                            <?php
                                            $rel = App\Models\Product::all();
                                            ?>
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

<script src="{{ URL::asset('managercss/vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ URL::asset('managercss/js/plugins-init/select2-init.js')}}"></script>

    <!-- Jquery Validation -->
    <script src="{{ URL::asset('manager/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
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
