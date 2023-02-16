@push('after-styles')
<link href="{{ URL::asset('/managercss/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@extends('manager.layouts.app')
@section('title', 'Manager')
@section('content')


        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Manager</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manager</li>
                        </ol>
                    </div>
                </div>

            <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Manager</h4>
                                <div class="text-right">
                                    <a href="{{ url('/manager/manager/create') }}" class="btn btn-primary btn-sm scroll-click"> create</a>
                                </div>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach ($data as $row)
                                            <?php $user = App\Models\User::where('id',$row->user_id)->first(); ?>

                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{ @$row->name }}</td>
                                                <td>{{ @$row->email }}</td>
                                                <td><span class="badge badge-primary">{{ @$user->status }}</span></td>
                                                <td class="color-primary"><a href="{{ route('manager.manager.edit', $row->id) }}" class="btn btn-primary"><i class="fa fa fa-pencil m-0"></i></a>
                                                <button form="resource-delete-{{ $row->id }}" class="btn btn-danger"><span><i class="fa fa fa-trash m-0"></i></span></button>

                                                <form id="resource-delete-{{ $row->id }}"
                                                    action="{{ route('manager.manager.destroy', $row->id) }}"
                                                    style="display: inline-block;"
                                                    onSubmit="return confirm('Are you sure you want to delete this item?');"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                </td>
                                            </tr>
                                              @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
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
    </div>

@push('after-scripts')
    <script src="{{ URL::asset('/managercss/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('/managercss/js/plugins-init/datatables.init.js')}}"></script>
@endpush
@endsection
