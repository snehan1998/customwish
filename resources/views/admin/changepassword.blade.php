@push('after-styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ URL::asset('/admincss/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @endpush

@extends('admin.layouts.app')
@section('title', 'Change Password')

@section('content')
	<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Change Password</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>

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
                            <h4 class="card-title">Change Password</h4>
                        </div>

                        <div class="card-body">
                            <div class="form-validation">

                            <form method="post" action="{{url('admin/changepasswordd')}}" class="form-password-change">
			                            {{csrf_field()}}

                                <div class="row">
                                    <!--<div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">Old Password </label><span class="text-danger">*</span>
                                            <input type="password" class="form-control" id="old_password" placeholder="Enter old Password" name="old_password" >
                                        </div>
                                    </div>-->
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">New Password</label><span class="text-danger">*</span>
                                            <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" name="password" required>
                                        </div>
                                    </div>

                                </div>
                                <button class="btn btn-primary" type="submit" data-btntext-sending="Sending...">Submit</button>
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
      <script src="{{ URL::asset('/admincss/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('/admincss/js/plugins-init/datatables.init.js')}}"></script>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">

function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';

}

</script>

 <script>
    var msg = '{{Session::get("alert")}}';
    var exist = '{{Session::has("alert")}}';
    if(exist){
      alert(msg);
    }
  </script>

@endpush
@endsection

