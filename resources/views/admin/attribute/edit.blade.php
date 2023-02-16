@push('after-styles')
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

                                <form enctype="multipart/form-data" role="form" id="myform" method="post" action="{{ route('admin.attribute.update', $data->id) }}">
                                @csrf
                                @method('PATCH')
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                <label for="price">Attribute Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="attr_name" id="attr_name" value="{{$data->attr_name}}" class="form-control" placeholder="Enter Attribute Name" required/>
                                                    @if ($errors->has('attr_name'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('attr_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            <div class="form-group">
                                                    <label>Attribute Type</label><span class="text-danger">*</span>
                                                    <select class="form-control" name="attr_label">
                                                            <option selected disabled>Select</option>
                                                            <option value="color" @if($data->attr_label == 'color') selected @endif>Color</option>
                                                            <option value="label" @if($data->attr_label == 'label') selected @endif>Label</option>
                                                            <option value="selectoption" @if($data->attr_label == 'selectoption') selected @endif>Select option</option>
                                                            <option value="button"  @if($data->attr_label == 'button') selected @endif>Button</option>
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
                </div>
            </div>


@push('after-scripts')


    <!-- Jquery Validation -->
    <script src="{{ URL::asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- Form validate init -->
    <script src="{{ URL::asset('/admincss/js/plugins-init/jquery.validate-init.js')}}"></script>

@endpush

@endsection
