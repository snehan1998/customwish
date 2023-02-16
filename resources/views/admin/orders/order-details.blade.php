@extends('admin.layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Create Order</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order</li>
                </ol>
            </div>
        </div>

  <div class="card">
    <h3 class="head-title pb-3 text-center">My Order Summary</h3>
      <!-- /.card-header -->
      <div class="card-body">
      <a href="{{ url('/prnpriview') }}/{{$order->order_id}}" class="btnprn btn"><i class="fa fa-print mr-1"></i>Print Preview </a></center>
                            <script type="text/javascript">
                            $(document).ready(function(){
                            $('.btnprn').printPage();
                            });
                            </script>
      <table class="table table-bordered">
          <thead>
            <tr>
              <th>Order Id</th>
              <th>{{$order->order_id}}</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Amount Paid</td>
              <td>&#8377; {{$order->payable_price}}</td>
            </tr>
            <tr>
              <td>Status</td>
              <td>{{$order->status}}</td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>

  <div class="card">
     <h3 class="head-title pb-3 text-center">Order Items</h3>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Image</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total</th>
              <th>Change Status</th>
              <th>Reason</th>
              <th>Image</th>
              <th>Extra Fields</th>
              <th>Any Other Comments</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orderitems as $row)
            <?php
            $product = App\Models\Product::where('id',$row->product_id)->first();
            if($product->is_variation == 1){
                $provar = App\Models\AddSubVariation::where('id',$row->variation_id)->where('product_id',$row->product_id)->first();
                $product_images = App\Models\ProductImage::where('variation_product_id',$row->variation_id)->where('product_id',$row->product_id)->first();
                $price = $provar->price;
                $image = $product_images->images;
            }else{
                $price = $product->price;
                $product_image = App\Models\ProductImage::where('product_id',$row->product_id)->first();
                $image = $product_image->images;
            }
          ?>
            <tr>
            	<td>
                  <img style="width:20%" src="{{ asset('uploads/images/') }}/{{ @$product_image->images }}">
              	</td>
              	<td>{{ @$product->product_name }}</td>
                  <td>&#8377;{{$price}}</td>
              	<td>{{ @$row->quantity }}</td>
                  <td>&#8377;@if($row->quantity != "undefined") {{$price * $row->quantity}} @else  {{$price}} @endif</td>
                  <td> @if($row->status == "Processing") Processing @endif @if($row->status == "Packed") Packed @endif  @if($row->status == "Shipped") Shipped @endif @if($row->status == "Delivered") Delivered @endif @if($row->status == "Cancelled") Cancelled @endif @if($row->status == "CancelledbyUser") Order Canceled By User  @endif @if($row->status == "Refund") Refund @endif @if($row->status == "Return") Return @endif @if($row->status == "ReturnNotAcceptedByAdmin") ReturnNotAcceptedByAdmin @endif
                 <button type="button" class="text-theme btn btn-lg btn-primary" data-catid="{{$row->id}}"  data-toggle="modal" data-target="#modal{{$row->id}}">
                         Change Status
                 </button>
                    <div class="modal fade" id="modal{{$row->id}}">
                        <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Change Status</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <div class="col-sm-12">
                                <form method="post" action="{{url('/admin/changeOrderStatus')}}">
                                @csrf
                                <?php $orders = App\Models\Order::orderBy('id','desc')->paginate(20); ?>
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select class="form-control" name="order_status">
                                    <option @if($row->status == "Processing") selected @endif value="Processing">Processing</option>
                                    <option @if($row->status == "Packed") selected @endif value="Packed">Packed</option>
                                    <option @if($row->status == "Shipped") selected @endif value="Shipped">Shipped</option>
                                    <option @if($row->status == "Delivered") selected @endif value="Delivered">Delivered</option>
                                    <option @if($row->status == "Cancelled") selected @endif value="Cancelled">Cancel</option>
                                    <option @if($row->status == "Refund") selected @endif value="Refund">Refund</option>
                                    <option @if($row->status == "Return") selected @endif value="Return">Return</option>
                                    <option @if($row->status == "ReturnNotAcceptedByAdmin") selected @endif value="ReturnNotAcceptedByAdmin">ReturnNotAcceptedByAdmin</option>
                                    </select>
                                    <input type="hidden" name="orderr_id" value="{{$row->order_id}}">
                                    <input type="hidden" name="order_id" id="cat_id" value="{{$row->id}}">
                                </div>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                            </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                    </div>
                <!-- /.modal -->
                </td>
                <td>{{$row->return_reason}}</td>
                <td><img style="width:20%" src="{{ asset('uploads/images/') }}/{{ @$row->image }}"></td>
                <td>
                    @if($row->giftwrap == 1)
                    <p><strong> Gift Wrap Price</strong></p>
                    <p>{{$row->giftwrap_price}}</p>
                    @endif
                    @if($product->textareaa == 1)
                    <p><strong>{{$product->textarea_name}}</strong></p>
                    <p>{{$row->description}}</p>
                    @endif
                    @if($product->text_field == 1)
                    <p><strong>{{$product->text_heading}}</strong></p>
                    <p>{{$row->addtext1}}</p>
                    @endif
                    @if($product->location == 1)
                    <p><strong>Location</strong></p>
                    <p>{{$row->location}}</p>
                    @endif
                    @if($product->eggoreggless == 1)
                    <p><strong>Egg Type</strong></p>
                    <p>{{$row->egg_type}}</p>
                    @endif
                    @if($product->datee == 1)
                    <p><strong>Date</strong></p>
                    <p>{{$row->datee}}</p>
                    @endif
                    @if($product->timee == 1)
                    <p><strong>Time</strong></p>
                    <p>{{$row->timee}}</p>
                    @endif
                    @if($product->self_pickup == 1)
                    <p><strong>Pickup Type</strong></p>
                    <p>{{$row->pickup_type}}</p>
                    @endif
                    @if($product->flower_type_option == 1)
                    <p><strong>Flower Type</strong></p>
                    <p>{{$row->flowerss_type}}</p>
                    @endif
                    @if($product->addatext_option == 1)
                    <p><strong>{{$product->addatext_heading}}</strong></p>
                    <p>{{$row->addtext2}}</p>
                    @endif
                    @if($product->frontandbackprint_option == 1)
                    <p><strong>Front and Back Print</strong></p>
                    <p>{{$row->printside}}</p>
                    @endif
                    @if($product->single_option == 1)
                    <p><strong>Single Color</strong></p>
                    <p>{{$row->colortype}}</p>
                    @endif
                    @if($product->imageuploadoption == 1)
                    <?php
                        $image = explode(',',$row->product_images_id);?>
                        <p><strong>{{$product->imageuploadoption_heading}}</strong></p>
                        @foreach($image as $image)
                        <?php $proimg = App\Models\StoreProductCartImage::where('id',$image)->first();?>
                        <a href="{{asset('uploads/images')}}/{{$proimg->cart_images}}" download>{{$proimg->cart_images}}</a>
                       @endforeach
                    @endif
                    @if($product->uploadlogo_option == 1)
                    <?php
                        $logo = explode(',',$row->product_logos_id);?>
                        <p><strong>{{$product->uploadlogo_heading}}</strong></p>
                        @foreach($logo as $logo)
                        <?php $prolog = App\Models\StoreProductCartLogo::where('id',$logo)->first();?>
                        <a href="{{asset('uploads/images')}}/{{$prolog->cart_logo}}" download>{{$prolog->cart_logo}}</a>
                        @endforeach
                    @endif
                    @if($row->variation_id != null)
                    <?php $provar = App\Models\AddSubVariation::where('id',$row->variation_id)->first();
                        $var = App\Models\Addsubvariationn::where('var_id',$row->variation_id)->get();
                    ?>
                        @foreach($var as $var)
                        <?php $attribute = App\Models\Attribute::where('id',$var->main_attr_id)->first();
                             $attributevalue = App\Models\AttributeValue::where('id',$var->main_attr_value)->first();
                        ?>
                        <p><strong>{{$attribute->attr_name}}</strong></p>
                        <p>{{$attributevalue->attr_value_name}}</p>
                        @endforeach
                    @endif
                    @if($row->cart_combo_id != null)
                        <?php $exp =explode(',',$row->cart_combo_id); ?>
                        @foreach($exp as $cart_combo_id)
                        <?php $ccom= App\Models\StoreCartCombo::where('id',$cart_combo_id)->first();
                            $procomm = App\Models\ProductCombo::where('id',$ccom->combo_id)->first();
                            $attributevalue = App\Models\AttributeValue::where('id',$ccom->att_id)->first();
                            $attribute=App\Models\Attribute::where('id',$ccom->attribute)->first();
                        ?>
                        @if($procomm != null)<p><strong>{{$procomm->button_name}}</strong></p>@endif
                        @if($procomm != null)<p><strong>{{$procomm->combo_text_heading}}</strong></p>@endif
                        <p>{{$ccom->comboaddtext1}}</p>
                        <p><strong>{{$attribute->attr_name}}</strong></p>
                        <p>{{$attributevalue->attr_value_name}}</p>
                        @endforeach
                    @endif
                    @if($row->charm_id != null)
                        <?php $expchar =explode(',',$row->charm_id); ?>
                        @foreach($expchar as $charm_id)7
                        <?php
                              $prcharop = App\Models\ProductSelectOption::where('id',$charm_id)->first();
                              $prchar = App\Models\ProductSelectHeading::where('id',$prcharop->product_select_id)->first();
                              $procom1 = App\Models\ProductCombo::where('id',$prcharop->combo_id)->first();
                        ?>
                        @if($procom1 != null)<p><strong>{{$procom1->button_name}}</strong></p>@endif
                        @if($procom1 != null)<p><strong>{{$procom1->comboaddtext1}}</strong></p>@endif
                        <p><strong>{{$prchar->product_select_title}}</strong></p>
                        <p>{{$prcharop->product_select_option}}
                        @if($prcharop->product_select_option_price != null)
                        &#8377;&nbsp;{{$prcharop->product_select_option_price}}</p>
                        @endif
                        @endforeach
                    @else
                        @if($row->charm_id != null)
                        <?php $charm = explode(',',$row->charm_id)?>
                        @foreach($charm as $charm)
                        @php $prcharop = App\Models\ProductSelectOption::where('id',$charm)->first();
                        $prchar = App\Models\ProductSelectHeading::where('id',$prcharop->product_select_id)->first();  @endphp
                        <p><strong>{{$prchar->product_select_title}}</strong></p>
                        <p>{{$prcharop->product_select_option}}
                        @if($prcharop->product_select_option_price != null)
                        &#8377;&nbsp;{{$prcharop->product_select_option_price}}</p>
                        @endif
                        @endforeach
                        @endif
                    @endif
                </td>
                <td>
                    @if($product->comment == 1)
                    <p><strong>{{$product->comment_heading}}</strong></p>
                    <p>{{$row->comment}}</p>
                    @endif
                </td>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>
    <div class="card">
      <h3 class="head-title pb-3 text-center">Shipping Address</h3>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered">

        <tbody>
          <tr>
            <td>Name</td>
            <td>{{$order->firstname }}</td>
          </tr>
          <tr>
            <td>Email</td>
            <td>{{$order->email}}</td>
          </tr>
          <tr>
            <td>Phone</td>
            <td>{{$order->phone}}</td>
          </tr>
          <tr>
            <td>Address</td>
            <td>{{$order->address}}</td>
          </tr>
          <tr>
            <td>Country</td>
            <td>{{$order->country}}</td>
          </tr>
          <tr>
            <td>state</td>
            <td>{{$order->state}}</td>
          </tr>
           <tr>
            <td>City</td>
            <td>{{$order->city}}</td>
          </tr>
           <tr>
            <td>Pincode</td>
            <td>{{$order->pincode}}</td>
          </tr>
          <tr>
            <td>Address Type</td>
            <td>{{$order->address_type}}</td>
          </tr>
        </tbody>
        </table>
      </div>
    </div>


</div>
</div>
</div>
@push('after-scripts')

  <script>

  $('#modal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var cat_id = button.data('catid')
      var modal = $(this)
      modal.find('.modal-body #cat_id ').val(cat_id);

});

</script>

@endpush
@endsection
