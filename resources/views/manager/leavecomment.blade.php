@push('after-styles')
<link href="{{ URL::asset('/managercss/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush
@extends('manager.layouts.app')
@section('title', 'Leave Comment')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Leave Comment</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Leave Comment List</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Leave Comment List</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Blog Id</th>
                                        <th>Blog Name</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Website</th>
                                        <th>Comment</th>
                                        <th>Status</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach($data as $row)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ @$row->blog_id }}</td>
                                        <td>{{ @$row->blog_name }}</td>
                                        <td>{{ @$row->name }}</td>
                                        <td>{{ @$row->email }}</td>
                                        <td>{{ @$row->website }}</td>
                                        <td>{{ @$row->comment }}</td>
                                        <td> @if($row->status == "Active") Active @endif @if($row->status == "Inactive") Inactive @endif
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
                                                            <form method="post" action="{{url('/manager/changeStatus')}}">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Select Status</label>
                                                                <select class="form-control" name="status">
                                                                <option @if($row->status == "Active") selected @endif value="Active">Active</option>
                                                                <option @if($row->status == "Inactive") selected @endif value="Inactive">Inactive</option>
                                                                </select>
                                                                <input type="hidden" name="leave_id" value="{{$row->id}}">
                                                                <input type="hidden" name="leave_id" id="cat_id" value="{{$row->id}}">
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
                                            <td><button form="resource-delete-{{ $row->id }}" class="btn btn-danger btn-icon-style-2"><span>Delete</span></button>
                                            <form id="resource-delete-{{ $row->id }}" action="{{url('/manager/leavecommentdestroy')}}/{{$row->id}}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
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
                                            <th>Experience</th>
                                            <th>Position</th>
                                            <th>Message</th>
                                            <th>Resume</th>
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
