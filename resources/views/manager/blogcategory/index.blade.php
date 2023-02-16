@push('after-styles')
<link href="{{ URL::asset('/managercss/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@extends('manager.layouts.app')
@section('title', 'Blog Category')
@section('content')


<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Blog Category</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog Category</li>
                        </ol>
                    </div>
                </div>
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
                <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Blog Category</h4>
                                <div class="text-right">
                            <a href="{{ route('manager.blogcategory.create') }}" data-toggle="modal" data-target="#addRowModal"
                            class="btn btn-primary btn-sm scroll-click" >
                                create</a>
                            </div>
                            </div>

            <!-- Modal -->
            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header no-bd">
                            <h4 class="modal-title">
                                <b>Category</b>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form enctype="multipart/form-data"  method="post" action="{{ route('manager.blogcategory.store') }}">
                                    @csrf
                        <div class="modal-body">
                            <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Name</label>
                                            <input id="blog_name" type="text" required name="blog_name" class="form-control" placeholder="Name">
                                        </div>
                                      </div>
                                </div>
                            </div>
                        <div class="modal-footer no-bd">
                            <button type="submit"  class="btn btn-primary">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-sm">
                                    <thead>
                                        <tr>
                                        <th>Name</th>
                                        <th colspan='2'>Action</th>
                                        </tr>
                                    </thead>
                                    @foreach($city as $row)

                                    <tr>

                                        <td>{{$row->blog_name}}</td>
                                        <td>
                                        <a   class="btn btn-icon btn-icon-circle btn-secondary btn-icon-style-2" data-toggle="modal" data-target="#addRowModal{{$row->id}}">
                                            <span class="btn-icon-wrap"><i class="fa fa-pencil"></i></span></a>
                                          <button form="resource-delete-{{ $row->id }}"class="btn btn-icon btn-icon-circle btn-danger btn-icon-style-2">
                                        <i class="fa fa-trash"></i></span></button>
                                        <form id="resource-delete-{{ $row->id }}" action="{{ route('manager.blogcategory.destroy', $row->id) }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>


                                        <!-- Modal -->
                                        <div class="modal fade" id="addRowModal{{$row->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h4 class="modal-title">
                                                            <b>Edit Category</b>
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form enctype="multipart/form-data"  method="post" action="{{ route('manager.blogcategory.update',$row->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{$row->id}}">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Name</label>
                                                                <input id="blog_name" type="text" required name="blog_name" value="{{$row->blog_name}}" class="form-control" placeholder="Name">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                    </form>
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
