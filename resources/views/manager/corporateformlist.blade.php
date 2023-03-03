@push('after-styles')
<link href="{{ URL::asset('/managercss/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@extends('manager.layouts.app')
@section('title', 'Corporate List')
@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Corporate List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Corporate  List</li>
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
                                            <th>Product Name</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Quantity</th>
                                            <th>Message</th>
                                            <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach($data as $row)
                                    <?php $pr = App\Models\CorporateGift::where('id',$row->corporate_id)->first(); ?>
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ @$pr->corp_product_name }}</td>
                                        <td>{{ @$row->name }}</td>
                                        <td>{{ @$row->email }}</td>
                                        <td>{{ @$row->phone }}</td>
                                        <td>{{ @$row->quantity }}</td>
                                        <td>{{ @$row->message }}</td>
                                        <td><button form="resource-delete-{{ $row->id }}" class="btn btn-danger btn-icon-style-2"><span>Delete</span></button>
                                            <form id="resource-delete-{{ $row->id }}" action="{{url('/manager/corporatedestroy')}}/{{$row->id}}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                                            @csrf
                                            @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                <tfoot>
                                    <tr>
                                        <tr>

                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Quantity</th>
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
