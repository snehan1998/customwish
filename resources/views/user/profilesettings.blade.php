@push('after-styles')
@endpush
@extends('layouts.app')
@section('title', 'Custom wish | Profile Settings')
@section('content')

@if(Session::has('flash_success'))
<div class="alert alert-success">
{{ Session::get('flash_success') }}
</div>
@endif

@if(Session::has('flash_error'))
<div class="alert alert-danger">
{{ Session::get('flash_error') }}
</div>
@endif


<div class="shop-ccc">
    <h1 class="shopping-crt">Change Password</h1>
       <div class="container-fluid">
           <div class="row px-xl-5">
               @include('user.layouts.sidemenu')
            <div class="col-lg-9 col-md-8">
                    <div class="card">
                        <div class="card-body">
                      <div class="row">
                          <div class="col-12">
                              <div class="login-form-content">
                                <form action="{{url('user/changepassword')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                            <label class="control-label">Old Password </label><span class="text-danger">*</span>
                                            <input type="password" class="form-control" id="old_password" placeholder="Enter old Password" name="old_password" required>
                                            </div>
                                        </div>
                                        <br><br><br><br>
                                        <div class="col-12">
                                            <div class="form-group">
                                            <label class="control-label">New Password</label><span class="text-danger">*</span>
                                            <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" name="password" required>
                                            </div>
                                        </div>
                                        <br><br><br><br>
                                        <div class="col-12">
                                            <div class="form-group">
                                            <button type="submit" class="btn btn-primary-sub profile-login">
                                                Submit</button>
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
    </div>
</div>
@push('after-scripts')
@endpush
@endsection
