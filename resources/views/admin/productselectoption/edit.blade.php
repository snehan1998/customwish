@push('after-styles')
@endpush
@extends('admin.layouts.app')
@section('title', 'Product Select Option')
@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Edit Product Select Option</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product Select Option</li>

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
                                <h4 class="card-title">Product Select Option</h4>
                                <div class="text-right">
                                    <a href="{{ url('/admin/productselectoption/') }}" class="btn btn-primary btn-sm scroll-click">View </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">
                                    @if($check->is_combo == 1)
                                    <div class="form-group">
                                        <label for="price">Product Name </label>
                                            <input type="hidden" name="product_id" value="{{$data->product_id}}">
                                            <input type="text" name="product_name" readonly class="form-control" placeholder="Enter Name" value="{{ $check->product_name }}" />
                                       </div>

                                    @else

                                    <form method="get" action="">
                                        <div class="container">
                                          <div class="row">
                                            <div class="col-sm-12">
                                              <div class="form-group">
                                                <label for="product_id">Select Product <span class="text-danger">*</span></label>
                                                <select name="product_id" class="form-control" onchange="this.form.submit()" required>
                                                     <option selected disabled>Select Product</option>
                                                     @foreach($products as $products)
                                                     @if(isset($_REQUEST['product_id']) && $_REQUEST['product_id'] != '')
                                                        <option value="{{$products->id}}" @if(@$_REQUEST['product_id'] == $products->id) selected @endif >{{$products->product_name}}</option>
                                                    @else
                                                        <option value="{{$products->id}}" @if(@$data->product_id == $products->id) selected @endif >{{$products->product_name}}</option>
                                                    @endif
                                                  @endforeach
                                                </select>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </form>
                                    @endif
                                <form role="form" id="myform" method="post" action="{{ route('admin.productselectoption.update', $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                    <div class="row">
                                        <div class="col-xl-12">

                                           <!-- @if(isset($_REQUEST['product_id']) && $_REQUEST['product_id'] != '')
                                            <input type="hidden" name="product_id" value="{{@$_REQUEST['product_id']}}">
                                            @else-->
                                            <input type="hidden" name="product_id" value="{{@$data->product_id}}">
                                         <!--   @endif-->
                                        <input type="hidden" id="id" value="{{$data->id}}">


                                        @if($check->is_combo == 1)
                                        <div class="form-group">
                                            <label for="price">Combo Name </label>
                                                <input type="hidden" name="combo_id" value="{{$data->combo_id}}">
                                                <?php $comboooo = App\Models\ProductCombo::where('id',$data->combo_id)->first(); ?>
                                                <input type="text" name="combo_name" class="form-control" placeholder="Enter Name" readonly value="{{ $comboooo->button_name }}" />
                                           </div>
                                        @else


                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Select Combo </label><br>
                                                    <select name="combo_id" class="form-control">
                                                        <option selected disabled>Select Combo</option>
                                                        @foreach($combo as $combo)
                                                        <option @if(@$data->combo_id == $combo->id) selected @endif value="{{$combo->id}}">{{$combo->button_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                </div>
                                            </div>
                                        @endif

                                             <div class="form-group">
                                                <label for="price">Name </label>
                                                    <input type="text" name="product_select_title" id="product_select_title" class="form-control" placeholder="Enter Name" value="{{ $data->product_select_title }}" />
                                                    @if ($errors->has('product_select_title'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('product_select_title') }}</strong>
                                                        </span>
                                                    @endif
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


                            <form enctype="multipart/form-data" method="post" action="{{url('admin/productselectoption/addMoreselection')}}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$data->product_id}}">
                                <input type="hidden" name="combo_id" value="{{$data->combo_id}}">
                                <input type="hidden" name="product_select_id" value="{{$data->id}}">
                                <h3>Add More Selection Option</h3>
                                <div class="form-group">
                                <div class="dynamicRadiosection5">
                                 <div class="row">
                                    <div class="col-md-2"><label></label>
                                        <input name="product_select_option[]" type="text"  class="form-control" Placeholder="Enter Name" />
                                    </div>
                                    <div class="col-md-2"><label></label>
                                        <input name="product_select_option_price[]" type="text"  class="form-control" Placeholder="Enter Price" />
                                    </div>
                                   <div class="col-md-2">
                                        <label>&nbsp;</label><br>
                                        <input id="btnCakePricesection5" class="btn-primary" type="button" value="Add More" />
                                    </div>
                                    <div>
                                </div>
                                </div>
                                <div id="ProductContainersection5"></div>
                                <br>
                                <div class="form-group">
                                <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <h3>Update Selection Option</h3>
                                <label>&nbsp;</label>
                                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>Selection Option</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($service as $serv)
                                    <tr>
                                    <td>{{$serv->product_select_option}}</td>
                                    <td><button form="resource-delete-{{ $serv->id }}" class="btn btn-danger">Delete</button>
                                        <form id="resource-delete-{{ $serv->id }}" action="{{ url('admin/productselectoption/deleteselection') }}?id={{$serv->id}}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                                        @csrf
                                        </form></td>
                                    </tr>

                                    @endforeach
                                </tbody>
                                </table>














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

<script type="text/javascript">

    $("#btnCakePricesection5").bind("click", function () {
        var div = $("<div />");
        div.html(GetDynamicProductPriceWeighttsection5(""));
        $("#ProductContainersection5").append(div);
    });
    $("body").on("click", ".removeRadiosection5", function () {
        $(this).closest(".dynamicRadiosection5").remove();
    });
    function GetDynamicProductPriceWeighttsection5(value) {
        return '<div class="dynamicRadiosection5"> <div class="row"> <div class="col-md-2"> <br> <input name ="product_select_option[]" type="text"  class="form-control" Placeholder="Enter Name" /></div> <div class="col-md-2"> <br> <input name ="product_select_option_price[]" type="text"  class="form-control" Placeholder="Enter Price" /></div><div class="col-md-2"> <br> <input type="button" value="Remove" class="removeRadiosection5 btn btn-danger"></div> </div></div>'
    }
  </script>
@endpush

@endsection
