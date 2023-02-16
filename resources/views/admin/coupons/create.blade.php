@push('after-styles')
@endpush
@extends('admin.layouts.app')
@section('title', 'Coupons')
@section('content')
<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Create Coupons</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Coupons</li>

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
                <h4 class="card-title">Coupons</h4>
                <div class="text-right">
                    <a href="{{ url('/admin/coupons/') }}" class="btn btn-primary btn-sm scroll-click">View Coupons</a>
                </div>
            </div>

            <div class="card-body">
                <div class="form-validation">

                    <form role="form" id="myform" method="post" action="{{ route('admin.coupons.store') }}">
                        @csrf
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
                                <label for="price">Coupon Code <span class="text-danger">*</span></label>
                                <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Enter Coupon Code" />
                                @if ($errors->has('coupon_code'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('coupon_code') }}</strong>
                                    </span>
                                @endif
                               </div>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
							    <label for="percentage">Discount Amount <span class="text-danger">*</span></label>
                                <input type="number" name="discount_amount" id="discount_amount" class="form-control" min="1" placeholder="Enter Discount Amount"  />
                                @if ($errors->has('discount_amount'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('discount_amount') }}</strong>
                                </span>
                            @endif
							    </div>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
                                <label for="flat">Apply On Minimum Order Amount <span class="text-danger">*</span></label>
                                <input type="number" id="minimum_order" name="minimum_order" class="form-control" min="1" style="background: white;" placeholder="Enter Minimum Order Amount"/>
                                @if ($errors->has('minimum_order'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('minimum_order') }}</strong>
                                </span>
                            @endif

                                </div>
							</div>
						</div>
						<div class="row">
                        <div class="col-md-6 col-sm-12">
								<div class="form-group">
                                <label for="price">Valid From <span class="text-danger">*</span></label>
                              <input type="date" name="validity_from" class="form-control" id="datepicker" placeholder="Vaild From" />
                              @if ($errors->has('validity_from'))
                                  <span class="text-danger">
                                      <strong>{{ $errors->first('validity_from') }}</strong>
                                  </span>
                              @endif
								</div>
							</div>

                        <div class="col-md-6 col-sm-12">
								<div class="form-group">
                                <label for="price">Valid Till <span class="text-danger">*</span></label>
                              <input type="date" name="validity_till" class="form-control" id="datepicker1" placeholder="Vaild Till" />
                              @if ($errors->has('validity_till'))
                                  <span class="text-danger">
                                      <strong>{{ $errors->first('validity_till') }}</strong>
                                  </span>
                              @endif
								</div>
							</div>
						</div>
                        <div class="row">
							<div class="col-md-3 col-sm-12">
								<div class="form-group">
                                <label for="price">Coupon Reusable <span class="text-danger">*</span></label><br>
                                <label for="chkYes">
                                  <input type="radio" class="allow_multiple_use" value="YES" name="allow_multiple_use" checked />
                                  @if ($errors->has('allow_multiple_use'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('allow_multiple_use') }}</strong>
                                    </span>
                                  @endif
                                  YES
                                </label>
                              <label for="chkNo">
                                  <input type="radio" class="allow_multiple_use" value="NO" name="allow_multiple_use" />
                                  @if ($errors->has('allow_multiple_use'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('allow_multiple_use') }}</strong>
                                    </span>
                                  @endif
                                  NO
                              </label>
								</div>
							</div>
							<div class="col-md-3 col-sm-12">
								<div class="form-group">
                                <label for="discount_type">Discount Type <span class="text-danger">*</span></label><br>
                            <label for="chkYes">
                              <input type="radio" class="discount_type" value="Percentage" name="discount_type" checked />
                              @if ($errors->has('discount_type'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('discount_type') }}</strong>
                                </span>
                              @endif
                              Percentage
                            </label>
                            <label for="chkNo">
                              <input type="radio" class="discount_type" value="Flat" name="discount_type" />
                              @if ($errors->has('discount_type'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('discount_type') }}</strong>
                                </span>
                              @endif
                              Flat
                            </label>
								</div>
							</div>
							<div class="col-md-3 col-sm-12">
								<div class="form-group">
                                <label for="price">Status <span class="text-danger">*</span></label><br>
                                <label for="chkYes">
                                  <input type="radio" class="status" value="Active" name="status" checked />
                                  @if ($errors->has('status'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                  @endif
                                  Active
                                </label>
                              <label for="chkNo">
                                  <input type="radio" class="status" value="InActive" name="status" />
                                  @if ($errors->has('status'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                  @endif
                                  InActive
                              </label>

                            	</div>
							</div>

						</div>

                        <div>
                            <button type="submit" class="btn btn-primary btn-sm scroll-click">Submit
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



    <!-- Jquery Validation -->
    <script src="{{ URL::asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- Form validate init -->
    <script src="{{ URL::asset('/admincss/js/plugins-init/jquery.validate-init.js')}}"></script>

            @push('after-scripts')


@endpush

@endsection
