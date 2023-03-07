@push('after-styles')
<link href="{{ URL::asset('/managercss/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@extends('manager.layouts.app')
@section('title', 'Gift Voucher Purchased List')
@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Gift Voucher Purchased List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Gift Voucher Purchased List</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Corporate List</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Purchase Code</th>
                                            <th>From Name</th>
                                            <th>To Email</th>
                                            <th>GiftVoucher Name</th>
                                            <th>GiftVoucher Price</th>
                                            <th>Delivery Date</th>
                                            <th>Message</th>
                                            <th colspan="2">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach($data as $row)
                                    <?php $gi = App\Models\GiftCard::where('id',$row['giftcard_id'])->first(); ?>
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ @$row->generated_code }}</td>
                                        <td>{{ @$row->from_name }}</td>
                                        <td>{{ @$row->to_email }}</td>
                                        <td>{{ @$gi->giftvoucher_name }}</td>
                                        <td>{{ @$gi->giftvoucher_price }}</td>
                                        <td>{{ @$row->delivery_date }}</td>
                                        <td>{{ @$row->message }}</td>
                                        <td><button form="resource-delete-{{ $row->id }}" class="btn btn-danger btn-icon-style-2"><span>Delete</span></button>
                                            <form id="resource-delete-{{ $row->id }}" action="{{url('/manager/deletegiftpurchased')}}/{{$row->id}}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                                            @csrf
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                <tfoot>
                                    <tr>
                                        <tr>

                                            <th>#</th>
                                            <th>Purchase Code</th>
                                            <th>From Name</th>
                                            <th>To Email</th>
                                            <th>GiftVoucher Name</th>
                                            <th>GiftVoucher Price</th>
                                            <th>Delivery Date</th>
                                            <th>Message</th>
                                            <th colspan="2">Action</th>
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
 <!-- Datatable -->
<script src="{{ URL::asset('/managercss/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('/managercss/js/plugins-init/datatables.init.js')}}"></script>
@endpush
@endsection
