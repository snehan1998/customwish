@push('after-styles')
<link href="{{ URL::asset('/managercss/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endpush
@extends('manager.layouts.app')
@section('title', 'Attributes')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Create Attributes</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
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
                                <div class="text-right">
                                    <a href="{{ route('manager.attribute.index') }}" class="btn btn-primary btn-sm scroll-click" >
                                View</a>
                            </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">

                            <form role="form" id="myform" method="post" action="{{ route('manager.attribute.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                <label for="price">Attribute Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="attr_name" id="attr_name" value="{{old('attr_name')}}" class="form-control" placeholder="Enter Attribute Name" required/>
                                                    @if ($errors->has('attr_name'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('attr_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                 <div class="form-group">
                                                    <label>Attribute Type</label>
                                                    <select class="form-control" name="attr_label">
                                                            <option selected disabled>Select</option>
                                                            <option value="color">Color</option>
                                                            <option value="label">Label</option>
                                                            <option value="selectoption">Select option</option>
                                                            <option value="button">Button</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-lg-12 ml-auto">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
              <!--      <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Attributes</h4>

                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach ($data as $row)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{ @$row->attr_name }}</td>
                                                <td>
                                                    <a href="{{ route('manager.attribute.edit', $row->id) }}" class="btn btn-primary">Edit</a>
                                                    <button form="resource-delete-{{ $row->id }}" class="btn btn-danger btn-icon-style-2"><span>Delete</span></button>
                                                    <form id="resource-delete-{{ $row->id }}" action="{{ route('manager.attribute.destroy', $row->id) }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
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
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                    </div>-->
            </div>
                </div>
            </div>


@push('after-scripts')


    <!-- Jquery Validation -->
    <script src="{{ URL::asset('/managercss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- Form validate init -->
    <script src="{{ URL::asset('/managercss/js/plugins-init/jquery.validate-init.js')}}"></script>
 <!-- Datatable -->
 <script src="{{ URL::asset('/managercss/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('/managercss/js/plugins-init/datatables.init.js')}}"></script>

@endpush

@endsection
