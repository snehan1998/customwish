@push('after-styles')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('admincss/vendor/select2/css/select2.min.css')}}">

@endpush
@extends('admin.layouts.app')
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
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
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
                                <a href="{{ url('/admin/products/') }}" class="btn btn-primary btn-sm scroll-click">View Products</a>

                            </div>
<!-----------------------------Add Variations--------------------------------------------------->
                <div class="card-body">
                    <div class="form-validation">
                    <form method="post" action="{{ route('admin.variations.update',$data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                            <input type="hidden" name="product_id" value="{{$data->product_id}}">
                            <input type="hidden" name="variation_id" value="{{$data->variation_product_id}}">
                   <!--         <div class="row">
                                @foreach($provarit as $provarit)
                                <?php $attr = App\Models\Attribute::where('id', $provarit->product_attr_id)->first(); ?>
                                <div class="col-sm-6">
                                    <input type="hidden" name="main_attr_id[]" value="{{$attr->id}}">
                                    <div class="form-group">
                                        <label>{{$attr->attr_name}} <span class="text-danger">*</span></label><br>
                                        <select name="main_attr_value[]" class="form-control" required>
                                            <option selected disabled>Select </option>
                                            <?php $valueatt = \App\Models\AttributeValue::where('attr_id',$attr->id)->get(); ?>
                                            @foreach($valueatt as $valueatt)
                                            <option value="{{$valueatt->id}}" @if($valueatt->id == $item_val_ids) selected @endif>{{$valueatt->attr_value_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                            </div>-->

                                <div class="row">
                                    <div class="col-md-12">
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
                               <!--     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Strick Price</label>
                                            <input type="number" class="form-control" name="strick_price" id="strick_price" value="{{$data->strike_price}}">
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
                                  <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quantity</label><span class="text-danger">*</span>
                                            <input type="number" class="form-control" required name="quantity" id="quantity"value="{{$data->quantity}}" >
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
                                            <select name="stock" class="form-control" required>
                                                <option value="" selected disabled>Select</option>
                                                <option value="Instock" @if($data->stock == "Instock") selected @endif>In Stock</option>
                                                <option value="Outofstock" @if($data->stock == "Outofstock") selected @endif>Out of Stock</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-control custom-checkbox  pure-veggg">
                                    <div class="checkbox d-inline mr-3 pure-veggg">
                                        <input type="checkbox" class="custom-control-input" id="variation_text_field" name="variation_text_field"  @if($data->variation_text_field == '1') checked @endif>
                                        <label class="custom-control-label" for="variation_text_field">Add Text Option</label>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Add Text Heading</label>
                                    <input type="text" class="form-control" name="variation_text_heading" id="variation_text_heading" value="{{$data->variation_text_heading}}">
                                </div>
                                <div class="form-group">
                                    <label>Text Field Validation</label>
                                    <input type="number" class="form-control" name="variation_text_validation" id="variation_text_validation" value="{{$data->variation_text_validation}}">
                                </div>
                            <!--    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>SKU Code</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" name="skucode" placeholder="Enter SKU Code" id="skucode" value="{{$data->skucode}}" required>
                                            @if ($errors->has('skucode'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('skucode') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>-->
                                <br>
                            <button type="submit" class="btn btn-primary"> Submit </button>
                        </form>



                <div class="row">
                  <div class="col-sm-12">
                    <form enctype="multipart/form-data" method="post" action="{{url('admin/variations/addMoreImagesvar')}}">
                      @csrf
                      <h3>Add More Images</h3>
                      <input type="hidden" name="product_id" value="{{$data->product_id}}">
                      <input type="hidden" name="variation_id" value="{{$data->id}}">
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
                           <form action="{{url('admin/variations/delete-multiplevar-image')}}?id={{$row->id}}" id="resource-delete-{{ $row->id }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
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
@endpush
@endsection
