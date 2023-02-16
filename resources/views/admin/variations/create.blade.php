@push('after-styles')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('admincss/vendor/select2/css/select2.min.css')}}">
<link href="{{ URL::asset('/admincss/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                                <div class="text-right">
                                    <a href="{{ url('/admin/products/') }}" class="btn btn-primary btn-sm scroll-click">View Products</a>
                                </div>
                            </div>
            <!-----------------------------Add Variations--------------------------------------------------->
                <div class="card-body">
                    <div class="form-validation">
                          <form enctype="multipart/form-data"  method="post" action="{{ route('admin.variations.store') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$idd}}">

                            @if($productb->button_type_option == 1)
                            <div class="row">
                                <?php $buttonpro = App\Models\ProductVariationButton::where('product_id', $productb->id)->get();?>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Product Button Type</label>
                                        <select name="product_button_id[]" class="form-control" required>
                                            <option selected disabled>Select Button</option>
                                            @foreach($buttonpro as $buttonpro)
                                            <option value="{{$buttonpro->id}}">{{$buttonpro->button_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="row">
                                @foreach($provarit as $provarit)
                                <?php $attr = App\Models\Attribute::where('id', $provarit->product_attr_id)->first();?>
                                <div class="col-sm-12">
                                    <input type="hidden" name="main_attr_id[]" value="{{$attr->id}}">
                                    <div class="form-group">
                                        <label>{{$attr->attr_name}} <span class="text-danger">*</span></label><br>
                                        <select name="main_attr_value[]" class="form-control" required>
                                            <option selected disabled>Select </option>
                                            <?php $valueatt = \App\Models\AttributeValue::where('attr_id',$attr->id)->get(); ?>
                                            @foreach($valueatt as $valueatt)
                                            <option value="{{$valueatt->id}}">{{$valueatt->attr_value_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endforeach
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
                            <!--        <div class="col-md-4">
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
                              <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="number" class="form-control" name="quantity" id="quantity"value="{{old('quantity')}}" >
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
                                                <option value="Instock">In Stock</option>
                                                <option value="Outofstock">Out of Stock</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <!--    <div class="row">
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
                                </div>-->

                                <div class="custom-control custom-checkbox  pure-veggg">
                                    <div class="checkbox d-inline mr-3 pure-veggg">
                                        <input type="checkbox" class="custom-control-input" id="variation_text_field" name="variation_text_field" >
                                        <label class="custom-control-label" for="variation_text_field">Add Text Option</label>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Add Text Heading</label>
                                    <input type="text" class="form-control" name="variation_text_heading" id="variation_text_heading" value="{{old('variation_text_heading')}}">
                                </div>
                                <div class="form-group">
                                    <label>Text Field Validation</label>
                                    <input type="number" class="form-control" name="variation_text_validation" id="variation_text_validation" value="{{old('variation_text_validation')}}">
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


                            <button type="submit" class="btn btn-primary"> Submit </button>

                        </form>
                        </div>
                    </div>
                </div>
            </div>
<!---------------------------------------------End add variation-------------------------------------------------------->


                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                @foreach($var as $var)
                                                <?php $varat = App\Models\Attribute::where('id', $var->product_attr_id)->first(); ?>
                                                <th>{{$varat->attr_name}}</th>
                                                @endforeach
                                                <th>Price</th>
                                                <th>SKU Code</th>
                                                <!--<th>Is Default</th>-->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach ($data as $row)
                                            <?php
                                                    $item_val_ids = explode(',',$row->main_attr_value);
                                                    $item_val_ids =[];
                                                   // dd($item_val_ids);
                                                    if($row->main_attr_value != null){
                                                        foreach (explode(',',$row->main_attr_value) as $val) {
                                                            $item_val_ids[$val] = $val;
                                                        }
                                                    }
                                                  //  dd($item_rel_ids);
                                                  $proimg = App\Models\ProductImage::where('product_id',$row->product_id)->where('variation_product_id',$row->id)->first();
                                             ?>
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$row->product_button_id}}</td>
                                                <td><img src="{{ asset('uploads/images/') }}/{{ @$proimg->images }}" style="width: 25%;height:10%" /></td>
                                                    @foreach($item_val_ids as $item_val_ids)
                                                    <td>
                                                 <?php  $attrribu = App\Models\Attribute::where('id', $item_val_ids)->first();
                                                       $attrvalues = App\Models\AttributeValue::where('id', $item_val_ids)->first();
                                                 ?>
                                                    {{$attrvalues->attr_value_name}}
                                                    </td>
                                                    @endforeach

                                                <td>{{@$row->price}}</td>
                                                <td>{{@$row->skucode}}</td>
                                                <!--<td></td>-->
                                                <td>
                                                    <a href="{{ route('admin.variations.edit', $row->id) }}" class="btn btn-primary"><i class="fa fa fa-pencil m-0"></i></a>
                                                    <button form="resource-delete-{{ $row->id }}" class="btn btn-danger btn-icon-style-2"><span><i class="fa fa-trash"></i></span></button>
                                                    <form id="resource-delete-{{ $row->id }}" action="{{ route('admin.variations.destroy', $row->id) }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    </form>
                                                    @if($row->is_variation	== '1')
                                                    <a  href="{{ url('/') }}/admin/variations/addvariants/{{ $row->id }}" class="btn btn-primary">Add Variation</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                                @foreach($varr as $varr)
                                                <?php $varat = App\Models\Attribute::where('id', $varr->product_attr_id)->first(); ?>
                                                <th>{{$varat->attr_name}}</th>
                                                @endforeach
                                                <th>Price</th>
                                                <th>Is Default</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
<script src="{{ URL::asset('/admincss/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('/admincss/js/plugins-init/datatables.init.js')}}"></script>



@endpush
@endsection
