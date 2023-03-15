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
    <h1 class="shopping-crt">Profile Details</h1>
       <div class="container">
           <div class="row">
               @include('user.layouts.sidemenu')
                <div class="col-lg-9 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="login-form-content">
                                    <form method="post" action="{{url('user/updateuserprofile')}}" class="needs-validation" >
                                    @csrf
                                    <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">Name</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{$user->name}}" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">Email</label><span class="text-danger">*</span>
                                            <input type="email" readonly class="form-control" readonly id="email" placeholder="Enter Email" value="{{$user->email}}" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">Phone</label><span class="text-danger">*</span>
                                            <input type="tel" pattern="[1-9]{1}[0-9]{9}"   class="form-control" id="phone" placeholder="Enter Phone" name="phone" required value="{{ $user->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 mb-3">
                                        <label class="control-label">Date of Birth</label><span class="text-danger">*</span>
                                        <input class="form-control" type="date" name="dob" value="{{$user->dob}}" required/>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 mb-3">
                                        <label class="control-label">Anniversary</label>
                                        <input class="form-control" type="date" name="anniversary" value="{{$user->anniversary}}"/>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <label>Male
                                        <input class="form-control" type="radio" name="gender" value="male" required @if($user->gender == 'male') checked @endif/>
                                        </label>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 mb-2">
                                        <label>Female
                                        <input class="form-control" type="radio" name="gender" value="female" @if($user->gender == 'female') checked @endif/>
                                        </label>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 mb-2">
                                        <label>Others
                                        <input class="form-control" type="radio" name="gender" value="others" @if($user->gender == 'others') checked @endif/>
                                        </label>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">Country</label>
                                            <input type="text" class="form-control" id="country" placeholder="Enter Country" name="country"  value="{{$user->country}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">State</label>
                                            <input type="text"  class="form-control" id="state" placeholder="Enter State" name="state" value="{{$user->state}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">City</label>
                                            <input type="text" class="form-control" id="city" placeholder="Enter City" name="city" value="{{$user->city}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <textarea class="form-control" id="address" placeholder="Enter Address" name="address">{{$user->address}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">Pincode</label>
                                            <input type="text" class="form-control" id="pincode" placeholder="Enter Pincode" name="pincode" value="{{$user->pincode}}">
                                        </div>
                                    </div>
                                </div><br>
                                <button class="btn btn-primary-sub" type="submit" >Submit</button>
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
