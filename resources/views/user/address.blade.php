@push('after-styles')
@endpush
@extends('layouts.app')
@section('title', 'Wishlist')
@section('content')




<div class="shop-ccc">
    <h1 class="shopping-crt">Address</h1>
    <div class="container">
        <div class="row">
@include('user.layouts.sidemenu')

                <div class="col-lg-9 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="saved_address">
                                        <div class="saved_head">
                                            <p>Jagadeesh <span>Default</span></p>
                                        </div>
                                        <div class="saved_body">
                                            <p>
                                                <span>Bangalore, Bangalore, Karnataka, India , 572109</span>
                                                <span><label>Phone: </label>9876543210</span>
                                                <span><label>Email: </label>jags@customwish.com</span>
                                            </p>
                                        </div>
                                        <div class="saved_footer">
                                            <a href="">Edit</a>
                                            <a href="">Remove</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="saved_address">
                                        <div class="saved_head">
                                            <p>Sneha</p>
                                        </div>
                                        <div class="saved_body">
                                            <p>
                                                <span>Bangalore, Bangalore,<br> Karnataka, India , 572109</span>
                                                <span><label>Phone: </label>9876543210</span>
                                                <span><label>Email: </label>jags@customwish.com</span>
                                            </p>
                                        </div>
                                        <div class="saved_footer">
                                            <a href="">Edit</a>
                                            <a href="">Remove</a>
                                        </div>
                                    </div>
                                </div>

                                
                                
                            </div>
                            <a href="" class="add_new_add">+ Add a new address </a>
                        </div>
                    </div>
                </div>









        </div>
    </div>
</div>
@push('after-scripts')
@endpush
@endsection
