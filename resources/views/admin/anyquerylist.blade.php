@push('after-styles')
<link href="{{ URL::asset('/admincss/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@extends('admin.layouts.app')
@section('title', 'Any Query')
@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Any Query</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Any Query List</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Any Query List</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach($data as $row)

                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ @$row->name }}</td>
                                        <td>{{ @$row->email }}</td>
                                        <td>{{ @$row->phone }}</td>
                                        <td>{{ @$row->message }}</td>
                                        <td><button form="resource-delete-{{ $row->id }}" class="btn btn-danger btn-icon-style-2"><span>Delete</span></button>
                                            <form id="resource-delete-{{ $row->id }}" action="{{url('/admin/anyquerylistdestroy')}}/{{$row->id}}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
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
<script src="{{ URL::asset('/admincss/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('/admincss/js/plugins-init/datatables.init.js')}}"></script>
@endpush
@endsection
