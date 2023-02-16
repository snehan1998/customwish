
@push('after-styles')
@endpush
@extends('manager.layouts.app')
@section('title', 'Manager')
@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Edit Manager</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manager</li>

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
                                <h4 class="card-title">Manager</h4>
                                <div class="text-right">
                                    <a href="{{ url('/manager/manager/') }}" class="btn btn-primary btn-sm scroll-click">View Manager</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">
                                <form role="form" id="myform" method="post" action="{{ route('manager.manager.update', $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                    <div class="row">
                                        <div class="col-xl-12">
                                             <div class="form-group">
                                                <label for="price">Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter  Name" value="{{ $data->name }}" required/>
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                               </div>
                                               <div class="form-group">
                                                <label for="price">Email <span class="text-danger">*</span></label>
                                                    <input type="email" readonly name="email" id="email" class="form-control" placeholder="Enter  Email" value="{{ $data->email }}" required/>
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                               </div>
                                               <div class="form-group">
                                                <label for="price">Phone <span class="text-danger">*</span></label>
                                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter  Phone" value="{{ $data->phone }}" required/>
                                                    @if ($errors->has('phone'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                    @endif
                                               </div>
                                               <div class="form-group">
                                                <label for="price">Password <span class="text-danger">*</span></label>
                                                    <input type="text" name="password" id="password" class="form-control" placeholder="Enter  Password" value="{{ $data->password }}" required/>
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                               </div>
                                        <div class="form-group">
                                            <img src="{{ asset('uploads/images/') }}/{{ @$data->id_proof }}" style="width: 10%;" /><br>
                                            <label for="id_proof">Choose Id Proof </label>
                                                <input type="file" name="id_proof" class="form-control" id="id_proof" accept="image/*"  >
                                                @if ($errors->has('id_proof'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('id_proof') }}</strong>
                                                    </span>
                                                @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Status </label><br>
                                            <label for="chkYes">
                                                <input type="radio" class="status" value="Active" name="status" @if ($user->status == 'Active') checked @endif />
                                                @if ($errors->has('status'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('status') }}</strong>
                                                    </span>
                                                @endif
                                                Active
                                            </label>
                                            <label for="chkNo">
                                                <input type="radio" class="status" value="Inactive" name="status" @if ($user->status == 'Inactive') checked @endif />
                                                @if ($errors->has('status'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('status') }}</strong>
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
 <script src="{{ URL::asset('/managercss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- Form validate init -->
<script src="{{ URL::asset('/managercss/js/plugins-init/jquery.validate-init.js')}}"></script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endpush

@endsection
