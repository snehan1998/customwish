@push('after-styles')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('managercss/vendor/select2/css/select2.min.css')}}">

@endpush
@extends('manager.layouts.app')
@section('title', 'Combo')
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
                        <li class="breadcrumb-item active" aria-current="page">Edit Combo</li>
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
                                <a href="{{ url('/manager/products/') }}" class="btn btn-primary btn-sm scroll-click">View Products</a>

                            </div>
<!-----------------------------Add Variations--------------------------------------------------->
                <div class="card-body">
                    <div class="form-validation">
                    <form method="post" action="{{ route('manager.combo.update',$data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                            <input type="hidden" name="product_id" value="{{$data->product_id}}">
                            <input type="hidden" name="combo_id" value="{{$data->combo_id}}">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Product Button Type</label>
                                       <input type="text" class="form-control" value="{{$data->button_name}}" name="button_name" id="button_name" placeholder="Button Name">
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
                                        <?php $valueattcombo = \App\Models\AttributeValue::where('attr_id',$attrcombo->id)->get(); ?>
                                        <select name="combo_attr_value[]" class="multi-select" required  multiple>
                                            <option  disabled>Select </option>
                                            @foreach($valueattcombo as $keyc =>$atrrc)
                                            @if (array_key_exists($atrrc->id, $item_attr_idsc))
                                               <option value="{{ $atrrc->id }}" selected>{{ $atrrc->attr_value_name }}</option>
                                            @else
                                                <option value="{{ $atrrc->id }}">{{ $atrrc->attr_value_name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                                <div class="custom-control custom-checkbox  pure-veggg">
                                    <div class="checkbox d-inline mr-3 pure-veggg">
                                        <input type="checkbox" class="custom-control-input" id="combo_text_field" name="combo_text_field"  @if($data->combo_text_field == 1) checked @endif>
                                        <label class="custom-control-label" for="combo_text_field">Add Text Option</label>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Add Text Heading</label>
                                    <input type="text" class="form-control" name="combo_text_heading" id="combo_text_heading" value="{{$data->combo_text_heading}}">
                                </div>
                                <div class="form-group">
                                    <label>Text Field Validation</label>
                                    <input type="number" class="form-control" name="combo_text_validation" id="combo_text_validation" value="{{$data->combo_text_validation}}">
                                </div>
                                <div class="custom-control custom-checkbox  pure-veggg">
                                    <div class="checkbox d-inline mr-3 pure-veggg">
                                        <input type="checkbox" class="custom-control-input" id="is_charm" name="is_charm"  @if($data->is_charm == 1) checked @endif>
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
