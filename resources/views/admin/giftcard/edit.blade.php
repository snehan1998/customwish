
@push('after-styles')
@endpush
@extends('admin.layouts.app')
@section('title', 'Gift Card')
@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Edit Gift Card</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Gift Card</li>

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
                                <h4 class="card-title">Gift Card</h4>
                                <div class="text-right">
                                    <a href="{{ url('/admin/giftcard/') }}" class="btn btn-primary btn-sm scroll-click">View Gift Card</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">
                                <form role="form" id="myform" method="post" action="{{ route('admin.giftcard.update', $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                    <div class="row">
                                        <div class="col-xl-12">
                                             <div class="form-group">
                                                <label for="price">Gift Card Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="giftvoucher_name" id="giftvoucher_name" class="form-control" placeholder="Enter Gift Card Name" value="{{ $data->giftvoucher_name }}" required/>
                                                    @if ($errors->has('giftvoucher_name'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('giftvoucher_name') }}</strong>
                                                        </span>
                                                    @endif
                                               </div>
                                               <div class="form-group">
                                                <label for="price">Gift Card Price <span class="text-danger">*</span></label>
                                                    <input type="text" name="giftvoucher_price" id="giftvoucher_price" class="form-control" placeholder="Enter Gift Card Price" value="{{ $data->giftvoucher_price }}" required/>
                                                    @if ($errors->has('giftvoucher_price'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('giftvoucher_price') }}</strong>
                                                        </span>
                                                    @endif
                                               </div>

                                        <div class="form-group">
                                            <img src="{{ asset('uploads/images/') }}/{{ @$data->giftvoucher_image }}" style="width: 10%;" /><br>
                                            <label for="giftvoucher_image">Choose Image </label>
                                                <input type="file" name="giftvoucher_image" class="form-control" id="giftvoucher_image" accept="image/*"  >
                                                @if ($errors->has('giftvoucher_image'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('giftvoucher_image') }}</strong>
                                                    </span>
                                                @endif
                                        </div>

                                        <br>

                                        <div class="form-group">
                                            <label for="price">Status </label><br>
                                            <label for="chkYes">
                                                <input type="radio" class="status" value="Active" name="giftvoucher_status" @if ($data->giftvoucher_status == 'Active') checked @endif />
                                                @if ($errors->has('giftvoucher_status'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('giftvoucher_status') }}</strong>
                                                    </span>
                                                @endif
                                                Active
                                            </label>
                                            <label for="chkNo">
                                                <input type="radio" class="status" value="Inactive" name="giftvoucher_status" @if ($data->giftvoucher_status == 'Inactive') checked @endif />
                                                @if ($errors->has('giftvoucher_status'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('giftvoucher_status') }}</strong>
                                                    </span>
                                                @endif
                                                Inactive
                                            </label>
                                        </div>
                                              <div class="form-group">
                                                    <div class="col-lg-12 ml-auto">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
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


@push('after-scripts')
 <!-- Jquery Validation -->
 <script src="{{ URL::asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- Form validate init -->
<script src="{{ URL::asset('/admincss/js/plugins-init/jquery.validate-init.js')}}"></script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endpush

@endsection
