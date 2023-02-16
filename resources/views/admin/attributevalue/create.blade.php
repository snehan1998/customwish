@push('after-styles')
<link href="{{ URL::asset('/admincss/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endpush
@extends('admin.layouts.app')
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
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
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
                                    <a href="{{ route('admin.attribute.index') }}" class="btn btn-primary btn-sm scroll-click" >
                                View</a>
                            </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">

                            <form role="form" id="myform" method="post" action="{{ route('admin.attributevalue.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                <input type="hidden" name="attr_id" value="{{$attr->id}}">

                                                <label for="price">Attribute Value Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="attr_value_name" id="attr_value_name" value="{{old('attr_value_name')}}" class="form-control" placeholder="Enter Attribute Value Name" required/>
                                                    @if ($errors->has('attr_value_name'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('attr_value_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label>Attribute Type</label>
                                                    <input type="text" class="form-control"  value="{{$attr->attr_label}}" readonly>
                                                </div>
                                                @if($attr->attr_label=="color")
                                                    <div class="form-group">
                                                        <label>Values</label>
                                                        <input type="color" name="attr_value_title" value="" class="form-control">
                                                    </div>
                                                @elseif($attr->attr_label=="label")
                                                    <div class="form-group">
                                                        <label>Values</label>
                                                        <input type="text"  name="attr_value_title" value="" class="form-control">
                                                    </div>
                                                @elseif($attr->attr_label=="selectoption")
                                                    <div class="form-group">
                                                        <label>Values</label>
                                                        <input type="text"  name="attr_value_title" value="" class="form-control">
                                                    </div>
                                                @elseif($attr->attr_label=="button")
                                                    <div class="form-group">
                                                        <label>Values</label>
                                                        <input type="text"  name="attr_value_title" value="" class="form-control">
                                                    </div>
                                                @endif
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

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Attribute Values</h4>
                                <div class="text-right">
                            </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Attribute Name</th>
                                                <th>Attribute Value  Name</th>
                                                <th>Attribute Value </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach ($data as $row)
                                            <?php $atr =  App\Models\Attribute::where('id',$row->attr_id)->first(); ?>
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{ @$atr->attr_name }}</td>
                                                <td>{{ @$row->attr_value_name }}</td>
                                                <td>{{ @$row->attr_value_title }}</td>
                                                <td>
                                                    <button form="resource-delete-{{ $row->id }}" class="btn btn-danger btn-icon-style-2"><span>Delete</span></button>
                                                    <form id="resource-delete-{{ $row->id }}" action="{{ route('admin.attributevalue.destroy', $row->id) }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
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
                                                <th>Attribute Name</th>
                                                <th>Attribute Value  Name</th>
                                                <th>Attribute Value </th>
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


    <!-- Jquery Validation -->
    <script src="{{ URL::asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- Form validate init -->
    <script src="{{ URL::asset('/admincss/js/plugins-init/jquery.validate-init.js')}}"></script>
 <!-- Datatable -->
 <script src="{{ URL::asset('/admincss/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('/admincss/js/plugins-init/datatables.init.js')}}"></script>

@endpush

@endsection
