@push('after-styles')
<style>
    .default_checkbox input[type="checkbox"] {
        display: block;
    }
    </style>
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
    <h1 class="shopping-crt">Add Address</h1>
       <div class="container">
           <div class="row">
               @include('user.layouts.sidemenu')
                <div class="col-lg-9 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="login-form-content">
                                    <form method="post" action="{{url('user/updateaddress')}}/{{$data->id}}" class="needs-validation" >
                                    @csrf
                                    <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">Name</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{$data->name}}" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">Email</label><span class="text-danger">*</span>
                                            <input type="email" class="form-control" id="email" placeholder="Enter Email" value="{{$data->email}}" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">Phone</label><span class="text-danger">*</span>
                                            <input type="tel" pattern="[1-9]{1}[0-9]{9}"   class="form-control" id="phone" placeholder="Enter Phone" name="phone" required value="{{ $data->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">Country</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="country" placeholder="Enter Country" name="country" required  value="{{$data->country}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">State</label><span class="text-danger">*</span>
                                            <input type="text"  class="form-control" id="state" placeholder="Enter State" name="state" required value="{{$data->state}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">City</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="city" placeholder="Enter City" name="city" required value="{{$data->city}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">Address</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="address" placeholder="Enter Address" name="address" required>{{$data->address}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">Pincode</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="pincode" placeholder="Enter Pincode" name="pincode" required value="{{$data->pincode}}">
                                        </div>
                                    </div>
                                        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12"><span class="text-danger">*</span>
                                            <input type="radio" class="form-control" value="home"  placeholder="" name="address_type" id="home" @if($data->address_type == "home") checked @endif>
                                            <label for="home" class="mb-0"> Home</label>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                            <input type="radio" class="form-control" value="office" name="address_type" id="office"  @if($data->address_type == "office") checked @endif>
                                            <label for="office" class="mb-0"> Office </label>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                            <input type="radio" class="form-control" value="other" placeholder="" name="address_type" id="other" @if($data->address_type == "other") checked @endif>
                                            <label for="other" class="mb-0"> Other </label>
                                        </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <div class="form-group default_checkbox">
                                            <label class="control-label">Use this address as default</label>
                                            <input type="checkbox" class="form-control" id="default_address" name="default_address" @if($data->default_address == 1) checked @endif>
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
