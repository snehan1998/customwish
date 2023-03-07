@push('after-styles')
@endpush
@extends('layouts.app')
@section('title', 'Wishlist')
@section('content')


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



<div class="shop-ccc">
    <h1 class="shopping-crt">Address</h1>
    <div class="container">
        <div class="row">
@include('user.layouts.sidemenu')

                <div class="col-lg-9 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach($data as $data)
                                <div class="col-lg-6">
                                    <div class="saved_address">
                                        <div class="saved_head">
                                            <p>{{$data->name}}@if($data->default_address == 1)<span>Default</span> @endif</p>
                                        </div>
                                        <div class="saved_body">
                                            <p>
                                                <span>{{$data->address}},{{$data->city}},{{$data->state}},{{$data->country}} ,{{$data->pincode}}</span>
                                                <span><label>Phone: </label>{{$data->phone}}</span>
                                                <span><label>Email: </label>{{$data->email}}</span>
                                            </p>
                                        </div>
                                        <div class="saved_footer">
                                            <a href="{{url('/user/editaddress/')}}/{{$data->id}}">Edit</a>
                                            <button form="resource-delete-{{ $data->id }}" class="btn btn-danger btn-icon-style-2"><span>Remove</span></button>
                                            <form id="resource-delete-{{ $data->id }}" action="{{url('/user/deleteuseraddress')}}/{{$data->id}}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                                            @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            <a href="{{url('/user/addnewaddress')}}" class="add_new_add">+ Add a new address </a>
                        </div>
                    </div>
                </div>









        </div>
    </div>
</div>
@push('after-scripts')
@endpush
@endsection
