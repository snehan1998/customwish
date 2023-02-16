@push('after-styles')
<link href="{{ URL::asset('/managercss/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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
                                        <td>
                                            <input data-id="{{$row->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $row->status ? 'checked' : '' }}>
                                        </td>
                                            <td><button form="resource-delete-{{ $row->id }}" class="btn btn-danger btn-icon-style-2"><span>Delete</span></button>
                                            <form id="resource-delete-{{ $row->id }}" action="{{url('/manager/careerdestroy')}}/{{$row->id}}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
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
    $(function() {
      $('.toggle-class').change(function() {
        alert('sdf');
          var status = $(this).prop('checked') == true ? 1 : 0;
          var user_id = $(this).data('id');

          $.ajax({
              type: "GET",
              dataType: "json",
              url: '/changeStatus',
              data: {'status': status, 'user_id': user_id},
              success: function(data){
                console.log(data.success)
              }
          });
      })
    })
  </script>
@endpush
@endsection
