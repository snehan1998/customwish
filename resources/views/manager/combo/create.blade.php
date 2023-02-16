@push('after-styles')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('managercss/vendor/select2/css/select2.min.css')}}">
<link href="{{ URL::asset('/managercss/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endpush
@extends('manager.layouts.app')
@section('title', 'Add Combo')
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
                        <li class="breadcrumb-item active" aria-current="page">Add Combo</li>
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
                                <h4 class="card-title">Add Combo</h4>
                                <div class="text-right">
                                    <a href="{{ url('/manager/products/') }}" class="btn btn-primary btn-sm scroll-click">View Products</a>
                                </div>
                            </div>
            <!-----------------------------Add Variations--------------------------------------------------->
                <div class="card-body">
                    <div class="form-validation">
                          <form enctype="multipart/form-data"  method="post" action="{{ route('manager.combo.store') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$idd}}">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Product Button Type</label>
                                       <input type="text" class="form-control" name="button_name" id="button_name" placeholder="Button Name">
                                       @if ($errors->has('button_name'))
                                       <span class="text-danger">
                                           <strong>{{ $errors->first('button_name') }}</strong>
                                       </span>
                                       @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($procombo as $procombo)
                                <?php $attrcombo = App\Models\Attribute::where('id', $procombo->product_combo_attr_id)->first();?>
                                <div class="col-sm-12">
                                    <input type="hidden" name="combo_attr_id[]" value="{{$attrcombo->id}}">
                                    <div class="form-group">
                                        <label>{{$attrcombo->attr_name}} </label><span class="text-danger">*</span><br>
                                        <select name="combo_attr_value[]" class="multi-select" required  multiple>
                                            <option  disabled>Select </option>
                                            <?php $valueattcombo = \App\Models\AttributeValue::where('attr_id',$attrcombo->id)->get(); ?>
                                            @foreach($valueattcombo as $valueattcombo)
                                            <option value="{{$valueattcombo->id}}">{{$valueattcombo->attr_value_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                                <div class="custom-control custom-checkbox  pure-veggg">
                                    <div class="checkbox d-inline mr-3 pure-veggg">
                                        <input type="checkbox" class="custom-control-input" id="combo_text_field" name="combo_text_field" >
                                        <label class="custom-control-label" for="combo_text_field">Add Text Option</label>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Add Text Heading</label>
                                    <input type="text" class="form-control" name="combo_text_heading" id="combo_text_heading" value="{{old('combo_text_heading')}}">
                                </div>
                                <div class="form-group">
                                    <label>Text Field Validation</label>
                                    <input type="number" class="form-control" name="combo_text_validation" id="combo_text_validation" value="{{old('combo_text_validation')}}">
                                </div>
                                <div class="custom-control custom-checkbox  pure-veggg">
                                    <div class="checkbox d-inline mr-3 pure-veggg">
                                        <input type="checkbox" class="custom-control-input" id="is_charm" name="is_charm" >
                                        <label class="custom-control-label" for="is_charm">Add Charm</label>
                                    </div>
                                </div>
                                <br>
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
                                                <th>Combo Name</th>
                                                <th>Text Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach ($data as $row)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$row->button_name}}</td>
                                                <td>{{@$row->combo_text_heading}}</td>

                                                <td>
                                                    <a href="{{ route('manager.combo.edit', $row->id) }}" class="btn btn-primary"><i class="fa fa fa-pencil m-0"></i></a>
                                                    <button form="resource-delete-{{ $row->id }}" class="btn btn-danger btn-icon-style-2"><span><i class="fa fa-trash"></i></span></button>
                                                    <form id="resource-delete-{{ $row->id }}" action="{{ route('manager.combo.destroy', $row->id) }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    </form>
                                                    @if($row->is_combo	== '1')
                                                    <a  href="{{ url('/') }}/manager/combo/addcombo/{{ $row->id }}" class="btn btn-primary">Add Combo</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>#</th>
                                            <th>Combo Name</th>
                                            <th>Text Name</th>
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
<script src="{{ URL::asset('/managercss/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('/managercss/js/plugins-init/datatables.init.js')}}"></script>



@endpush
@endsection
