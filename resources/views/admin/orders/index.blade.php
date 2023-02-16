@push('after-styles')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link href="{{ URL::asset('/admincss/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush
@extends('admin.layouts.app')
@section('title', 'Orders')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Orders</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Orders</li>
                        </ol>
                    </div>
                </div>

            <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Orders</h4>
                           </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order id</th>
                                                <th>Payable Price</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                            <!--    <th>Refund</th>
                                            <th>Order Status</th>-->
                                                <th>Ordered Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach($orders as $row)
                                        <tr>
                                        <td>{{$i++}}</td>
                                        <td><a href="{{url('admin/order')}}/{{$row->order_id}}">{{$row->order_id}}</a></td>
                                        <td>₹ {{ @$row->payable_price}}</td>
                                        <td>{{ @$row->firstname}}</td>
                                        <td>{{ @$row->email}}</td>
                                        <td>{{ @$row->phone}}</td>
                                    <!--      <td>@if($row->status == "received") Received @endif @if($row->status == "packed") Packed @endif  @if($row->status == "Cancle") Cancle @endif @if($row->status == "Order Canceled By User") Order Canceled By User         @endif @if($row->status == "shipped") Shipped @endif @if($row->status == "delivered") Delivered @endif

                                        <button type="button" class="btn btn-info" data-catid="{{$row->order_id}}" data-toggle="modal" data-target="#modal">
                                            Change Status
                                        </button></td>-->
                                        <td>{{ \Carbon\Carbon::parse($row->created_at)->format('jS M Y') }}</td>
                                        <!--<td>
                                          <form method="post" action="{{url('/orders/refund')}}/{{$row->payment_id}}">
                                              @csrf
                                              <button type="submit">Refund</button>
                                          </form>
                                        </td>-->
                                    </tr>
                                        </tr>
                                        <div class="modal fade" id="modal">
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
                                                    <?php
                                                    $orders = App\Models\Order::orderBy('id','desc')->paginate(20);
                                                    ?>
                                                    <div class="form-group">
                                                        <label>Select Status</label>
                                                        <select class="form-control" name="order_status">
                                                        <option @if($row->status == "received") selected @endif value="received">Received</option>
                                                        <option @if($row->status == "packed") selected @endif value="packed">Packed</option>
                                                            <option @if($row->status == "Cancle") selected @endif value="Cancle">Cancle</option>
                                                        <option @if($row->status == "shipped") selected @endif value="shipped">Shipped</option>
                                                        <option @if($row->status == "delivered") selected @endif value="delivered">Delivered</option>

                                                        </select>
                                                        <input type="hidden" name="order_id" id="cat_id" value="">

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
                                        @endforeach
                                    </tbody>
                                <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Order id</th>
                                                <th>Payable Price</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                            <!--<th>Order Status</th>-->
                                                <th>Ordered Date</th>
                                              </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>

@push('after-scripts')
    <script src="{{ URL::asset('/admincss/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('/admincss/js/plugins-init/datatables.init.js')}}"></script>


<script>
  $( function() {
    $( "#txtFromDate" ).datepicker();
    $( "#txtToDate" ).datepicker();
  } );
  </script>
  <script>

  $('#modal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var cat_id = button.data('catid')
       var modal = $(this)
      modal.find('.modal-body #cat_id').val(cat_id);

});

</script>

@endpush
@endsection
