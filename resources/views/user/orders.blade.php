@push('after-styles')
<link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
@endpush
@extends('layouts.app')
@section('title', 'Pow Store | Order')
@section('content')

<div class="shop-ccc">
    <h1 class="shopping-crt">Orders</h1>
       <div class="container">
           <div class="row">
               @include('user.layouts.sidemenu')
                <div class="col-lg-9 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="login-form-content">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                <th scope="col">Order</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($orders))
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td scope="row">{{$order->order_id}}</td>
                                                        <td>{{$order->order_date}}</td>
                                                        <!--<td>{{$order->payment_status}}</td>-->
                                                        <td>{{$order->status}}</td>
                                                        <td>&#8377;&nbsp; {{$order->payable_price}}</td>
                                                        <td><a href="{{url('user/order')}}/{{$order->order_id}}">View</a></td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                <td>No Order Found</td>
                                                @endif
                                            </tbody>
                                        </table>
                                        {{$orders->links()}}
                                    </div>
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
