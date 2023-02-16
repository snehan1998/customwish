@push('after-styles')

@endpush
@extends('admin.layouts.app')
@section('title', 'Add Variations')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Attributes</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Attributes</li>

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
                    <h4 class="card-title">Attributes</h4>
                </div>
                <div class="card-body">
                    <div class="default-tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home">Add Variation Option</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile">Link Variants</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home" role="tabpanel">
                            <br>
                            <a data-toggle="modal" href="#optionModal" class="pull-right btn btn-md btn-primary">
                                <i class="fa fa-plus"></i> ADD Option
                            </a>
                            <br>
                            <div class="pt-4">
                                <table id="full_detail_table" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Option Names</th>
											<th>Option Value</th>
											<th>Action</th>
										</tr>
									</thead>
									<?php $i=0;?>
									<tbody>
										@foreach($getopts as $opt)
										<?php $i++; ?>
										<tr>
											<td>{{ $i }}</td>
											<td>
                                            <?php
                                            $attrnamess=App\Models\Attribute::where('id',$opt->attr_name)->first();
                                            ?>
                                            {{$attrnamess->attr_name}}{{$opt->id}}
											</td>
											<td>
                                            <?php $atrval = json_decode($opt->attr_value); ?>
                                            @if(is_array($atrval) || is_object($atrval))
                                            @foreach($atrval as $value)
                                			<?php
												$originalvalue = App\Models\AttributeValue::where('id',$value)->get();
                                               // dd($originalvalue);
                                            ?>
											@foreach($originalvalue as $valuee)
                                            <div class="inline-flex margin-left-minus-15">
                                                <div class="color-options">
                                                    <ul>
                                                        <li title="{{ $valuee->attr_value_name}}"
                                                            class="color varcolor active"><a href="#" title=""><i
                                                                    style="color: {{ $valuee->attr_value_title }}"
                                                                    class="fa fa-circle"></i></a>
                                                                    <span >{{ $valuee->attr_value_name}}</span>
                                                            <div class="overlay-image overlay-deactive">
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
											@endforeach
											@endforeach
                                            @endif
                                        </td>
											<td>
											<button data-toggle="modal" href="#edit{{ $opt->id }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button>
                                            <a data-toggle="modal" href="#var{{ $opt->id }}" class="btn btn-sm btn-danger"> <i class="fa fa-trash-o"></i></a>
                                            <div id="var{{ $opt->id }}" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog modal-sm">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <div class="delete-icon"></div>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h4 class="modal-heading">Are You Sure ?</h4>
                                                            <p>Do you really want to delete this variant? This process cannot be undone.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post" action="{{url('variations/delete/variant')}}/{{$opt->id}}" class="pull-right">
                                                                {{csrf_field()}}
                                                                {{method_field("DELETE")}}
                                                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                                                                <button type="submit" class="btn btn-danger">Yes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											</td>
									        </tr>
										@endforeach
									</tbody>
								</table>
                              </div>
                            </div>

<!-- Add Variant Modal -->
<div class="modal fade" id="optionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Add Product Attributes</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="{{ url('/admin/variations/addvariant') }}/{{$findpro->id}}" method="POST">
					{{ csrf_field() }}

					<div class="form-group">
						<label for="">Option Name:</label>


						<select class="form-control" name="attr_name" id="attr_name">
							<option>Please Choose</option>
                            <?php
                            $pro=App\Models\ProductVariation::where('product_id',$findpro->id)->get();
                            ?>

                            @foreach($pro as $t)
                            <?php
                            $attrb=App\Models\AttributeValue::where('id',$t->product_attr_id)->first();
                            $attrb1=App\Models\Attribute::where('id',$t->product_attr_id)->first();
                           ?>
							<option value="{{ $attrb1->id }}">
                            {{$attrb1->attr_name}}
                            </option>
                            @endforeach

                        </select>

					</div>

					<div class="form-group">
						<div id="sel_box">
						</div>
						    <label for="">Option Value:</label>
						<div id="attr_value">
                        </div>
					</div>
					<button class="btn btn-md btn-primary" type="submit">
						<i class="fa fa-plus"></i> ADD
					</button>
				</form>
			</div>

		</div>
	</div>
</div>
<!--- end add modal -->

<!---------------------------edit variation model------------------>

@foreach($getoptsss as $optt)


<div id="edit{{ $optt->id }}" class="delete-modal modal fade" role="dialog">
  <div class="modal-dialog modal-md">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-title">
                  Edit: <b> @php
                      $key = '_';
                      @endphp
                      @if (strpos($optt->attr_name, $key) == false)

                      {{ $optt->attr_name }}

                      @else

                      {{str_replace('_', ' ', $optt->attr_name)}}

                      @endif </b>
              </div>
          </div>
          <div class="modal-body">
              <form action="{{ url('admin/variations/update/variant')}}/{{$optt->id}}" method="POST">
                  {{ csrf_field() }}

                  <div class="form-group">
                      <label><i>Choosed Option:</i>
                          @php
                          $key = '_';
                          @endphp
                          @if (strpos($optt->attr_name, $key) == false)

                          {{ $optt->attr_name }}

                          @else

                          {{str_replace('_',' ', $optt->attr_name)}}

                          @endif
                      </label>

                      <?php
                      $pvalues = App\Models\AttributeValue::where('attr_id',$optt->attr_name)->get();
                      ?>
                      <br>
                      <!--<label><input type="checkbox" class="sel_all"> Select All</label>-->
                      <br>
                      <label for="">Choose Value:</label>
                      <br>


                      <?php

                      $all_values =
                      App\Models\AttributeValue::where("attr_id",$optt->attr_name)
                      ->pluck('id','attr_value_name')->toArray();
//dd($all_values);
                      $old_values = $optt->attr_value;
                      //dd(($old_values));
                      $da = json_decode($old_values);

                    //  $array = explode(' ', $old_values);
                    //  dd($array);
                      if ((is_array($all_values)) && (is_array($da))) {
                          $diff_values = array_diff($all_values, $da);
                      }
                      ?>

                      @if(isset($da) && count($da) > 0)
                      @foreach($da as $old_valuee)
                      <label>
                          <input checked type="checkbox" name="attr_value[]" value="{{ $old_valuee }}">
                          <?php
                          //dd($old_valuee);
                          $getvalname = App\Models\AttributeValue::where('id',$old_valuee)
                          ->first();
                          //dd($getvalname);
                          ?>
                          @if(($getvalname->attr_value_name) != null)
                          {{ $getvalname->attr_value_name}}
                          @endif
                      </label>
                      @endforeach
                      @endif

                      @if(isset($diff_values))
                      @foreach($diff_values as $orivalue)
                      <label>
                          <input type="checkbox"
                          value="{{ $orivalue }}" name="attr_value[]">
                          @php
                          $getvalname = App\Models\AttributeValue::where('id',$orivalue)
                          ->first();
                          @endphp

                          {{ $getvalname->attr_value_name }}

                      </label>
                      @endforeach
                      @endif

                      <p>

                      </p>
                  </div>

                  <button class="btn btn-md btn-primary" type="submit">
                      <i class="fa fa-save"></i> Update
                  </button>
              </form>


          </div>

      </div>
  </div>
</div>


@endforeach
<!----------------------------end variation model---------------------->





<div id="profile" class="tab-pane fade">
<p>
<form enctype="multipart/form-data" action="{{ url('/admin/variations/product') }}" method="POST">

{{ csrf_field() }}
<input type="hidden" name="id" value="{{$findpro->id}}">
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4>Attribute Variations add</h4>
            </div>
    <!--         <div class="pull-right">
                <a href="{{ url('/admin/attribute/') }}"
                    class="btn btn-primary btn-sm scroll-click">View
                    attribute</a>
            </div>--->
        </div>
        <div class="row">
            <div class="col-md-10">
            <?php
                $attr=App\Models\ProductVariation::where('product_id',$findpro->id)->get();
                $proval=App\Models\AddProductVariation::where('product_id',$findpro->id)->get();
                ?>
                    @foreach($proval as $att)
                    <?php
                    $attribut=App\Models\Attribute::where('id',$att->attr_name)->first();
                    ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <label>
                                                <input required="" class="categories"  required type="checkbox"
                                                name="main_attr_id[]" id="categories_1" child_id="0" value="{{$attribut->id}}">
                                                {{$attribut->attr_name}}
                                            </label>
                                        </div>
                                        <div class="panel-body">
                                            <?php
                                                $all_values = App\Models\AttributeValue::where('attr_id',$opt->attr_name)
                                                ->pluck('id','attr_value_name')->toArray();
                                                $old_valuess = $att->attr_value;
                                                $old_values = json_decode($old_valuess);
                                               //isset($old_values) under is_array($old_values) || is_object($old_values)  this line
                                            ?>
                                       @if(is_array($old_values) || is_object($old_values) )
                                        @foreach($old_values as $orivalue)
                                    <?php
                                        $getvalname = App\Models\AttributeValue::where('id',$orivalue)->first();
                                        ?>
                                            <label>
                                                <input required="" class="a a_1" parents_id="1"
                                                value="{{$getvalname->id}}" type="radio" required
                                                name="main_attr_value[{{$att->attr_name}}]" id="_">
                                                <div class="color-options">
                                                        <ul>
                                                        <span class="tx-color">{{ $getvalname->attr_value_name}}</span>
                                                            <li title="Black" class="color varcolor active">
                                                                <a href="#" title=""><i style="color:{{$getvalname->attr_value_title}}"
                                                                class="fa fa-circle"></i></a>
                                                                    <div class="overlay-image overlay-deactive">
                                                                    </div>
                                                            </li>
                                                        </ul>
                                                        </div>
                                                </div>
                                        </label>
                                    @endforeach
                                    @endif
                                    </div>
                                    @endforeach
                                    </div>

                                <div>
                                    <label>Set Default Variant :
                                    <input type="checkbox" name="def">
                                    </label>
                                </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>price:</label>
                                                    <input type="text" class="form-control" name="price">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> strike price:</label>
                                                    <input type="text" class="form-control"
                                                    name="strike_price">
                                                </div>
                                            </div>
                                        </div>

                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Single image:</label>
                                                    <input type="file" class="form-control"
                                                    name="image">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Multiple image:</label>
                                                    <input type="file" class="form-control"
                                                        name="images[]" multiple>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Stock:</label>
                                                    <select name="stock" class="form-control">
                                                        <option value="Instock">InStock</option>
                                                        <option value="Outofstock">OutofStock</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
        </div>



        <button type="submit" class="btn btn-primary btn-sm scroll-click">Submit
        </button>

    </form>
<br><hr>


    <div class="row">
        <div class="col-md-12">
            <div class="card-box mb-30">

                    <table id="full_detail_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Attribute</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php $i=0;?>
                        <tbody>
                            <?php $i++; ?>
                            @foreach($sub_variant as $subva)


                            <tr>
                                <td>{{ $i }}</td>
                                <td>
                                @foreach($subva->main_attr_value as $key => $val)
                            <?php
                                $attri=App\Models\Attribute::where('id',$key)->first();
                                $valat=App\Models\AttributeValue::where('id',$val)->first();

                            ?>
                                {{$attri->attr_name}}:{{$valat->attr_value_name	}}
                                <br>
                                @endforeach
                                </td>
                                <td>{{$subva->price}}</td>
                                <td> <img src="{{ asset('uploads/images/') }}/{{ $subva->image }}" width="20"
                                    height="20">
                                </td>
                                <td>{{$subva->stock}}</td>
                                <td><a class="dropdown-item"
                                        href="{{ url('/admin/variations/variationedit', $subva->id) }}"><i
                                            class="dw dw-edit2"></i> Edit</a>
                                            <button class="dropdown-item"
                                            form="resource-delete-{{ $subva->id }}"><i
                                                class="dw dw-delete-3"></i>
                                            Delete</button>
                                        <form id="resource-delete-{{ $subva->id }}"
                                            action="{{ url('/admin/variations/variationdestroy', $subva->id) }}"
                                            style="display: inline-block;"
                                            onSubmit="return confirm('Are you sure you want to delete this item?');"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                </td>
                            </tr>
                            <?php $i++; ?>

                            @endforeach
                        </tbody>
                    </table>
        </div>
        </div>
        </div>

</div>

                            <!-- Form grid End -->
                </p>

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
                        </div>
                    </div>
                </div>
            </div>


@push("after-scripts")


    <!-- Jquery Validation -->
    <script src="{{ URL::asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- Form validate init -->
    <script src="{{ URL::asset('/admincss/js/plugins-init/jquery.validate-init.js')}}"></script>

<script>
    var baseUrl = "<?= url('/') ?>";
</script>
<script>
    function checkall() {
  if ($('#sel_all').is(':checked')) {
    $('input:checkbox').each(function () {
      $(this).prop('checked', true);
    });
  } else {
    $('input:checkbox').each(function () {
      $(this).prop('checked', false);
    });
  }
}
$('.sel_all').on('click', 'td-text', function () {
  $('input:checkbox').not(this).prop('checked', this.checked);
});

    $('#attr_name').on('change', function () {
        var get = $('#attr_name').val();
       // alert(get);
        var getoptiontext = $('#attr_name option:selected').html();
        getoptiontext = $.trim(getoptiontext);
        var up = $('#attr_value');
        up.html($(''));
        $.ajax({
          method: "GET",
          data: "sendval=" + get,
          datatype: "json",
          url: baseUrl + "/admin/variations/get/productvalues",
          success: function (data) {
            $('#sel_box').html('');
            $('#sel_box').append('<label><input onclick="checkall()" type="checkbox" id="sel_all"/> Select All</label><br>');
            $('#sel_all').prop('checked', false);
            $.each(data, function (i) {
              if (data[i].unit_value != null && data[i].values.toUpperCase() != data[i].unit_value.toUpperCase()) {
                if (getoptiontext == "Color" || getoptiontext == "Colour") {
                  up.append($('<label> <input class="margin-left-8" type="checkbox" name="attr_value[]" value="' + data[i].id + '"><div class="inline-flex margin-left-minus-15"><div class="color-options"><ul><li title="' + data[i].attr_value_name + '" class="color varcolor active"><a href="#" title=""></a><div class="overlay-image overlay-deactive"></div></li></ul></div></div><span class="tx-color">' + data[i].attr_value_name + '</span></label>'));
                } else {
                  up.append($('<input class="margin-left-8" type="checkbox" name="attr_value[]" value="' + data[i].id + '">&nbsp' + data[i].attr_value_name + '</label>'));
                }
              } else {
                up.append($('<label> <input class="margin-left-8" type="checkbox" name="attr_value[]" value="' + data[i].id + '">&nbsp' + data[i].attr_value_name + '</label>'));
              }
            });
          }
        });
      });
</script>

@endpush

@endsection
