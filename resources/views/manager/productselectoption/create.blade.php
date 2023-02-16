@push('after-styles')
@endpush
@extends('manager.layouts.app')
@section('title', 'Product Select Option')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Create Product Select Option</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
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
                                    <a href="{{ url('/manager/productselectoption/') }}" class="btn btn-primary btn-sm scroll-click">View Product Select Option</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">


                                    <form method="get" action="">
                                        <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                            <label for="product_id">Select Product <span class="text-danger">*</span></label>
                                            @if(count($products))
                                            <select name="product_id" id="product_id" class="form-control" onchange="this.form.submit()" required>
                                                <option selected disabled>Select Product</option>
                                                @foreach($products as $products)
                                                <option  value="{{$products->id}}"  @if(@$_REQUEST['product_id'] == $products->id) selected @endif>{{$products->product_name}}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                        </div>
                                        </div>
                                    </div>
                                </form>


                            <form role="form" id="myform" method="post" action="{{ route('manager.productselectoption.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @if(isset($_REQUEST['product_id']) && $_REQUEST['product_id'] != '')
                                <input type="hidden" name="product_id" value="{{@$_REQUEST['product_id']}}">
                                @else
                                <input type="hidden" name="product_id" value="{{@$firstcategory->id}}">
                                @endif

                                <div class="row">
                                    <div class="col-sm-12">

                                        <div class="form-group">
                                            <label>Select Combo </label><br>
                                            @if(count($combo))
                                            <select name="combo_id" id="combo_id" class="form-control">
                                                <option selected disabled>Select Child Category</option>
                                                @foreach($combo as $combo)
                                                <option  value="{{$combo->id}}">{{$combo->button_name}}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                        <div class="row">
                                            <div class="col-xl-12">
                                            <div class="form-group">
                                            <label for="price">Product Select Option Title</label>
                                                <input type="text" name="product_select_title" id="product_select_title" value="{{old('product_select_title')}}" class="form-control" placeholder="Enter  Name"  />
                                                @if ($errors->has('product_select_title'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('product_select_title') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
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
                                            </div>
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
    <script src="{{ URL::asset('/managercss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- Form validate init -->
    <script src="{{ URL::asset('/managercss/js/plugins-init/jquery.validate-init.js')}}"></script>
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
