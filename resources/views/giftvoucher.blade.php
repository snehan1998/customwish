@push('after-styles')
@endpush
@extends('layouts.app')
@section('title', 'Gift Voucher')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-12">
            <nav class="breadcrumb mb-30">
                <a class="breadcrumb-item text-dark" href="{{url('/')}}">Home</a>
                <span class="breadcrumb-item active">Gift Voucher</span>
            </nav>
        </div>
    </div>
</div>

<div class="container pt-5 pb-3">
    <div class="product_list_section">
        <div class="row justify-content-center">
            @foreach($gifts as $gift)
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1 aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <a href="{{url('/gif')}}/{{$gift->id}}">
                            <img src="{{asset('uploads/images')}}/{{$gift->giftvoucher_image}}" alt="service-image2" class="img-fluid w-100">
                        </a>
                    </div>
                    <div class="text-center py-2">
                        <a class="h6 text-decoration-none text-truncate" href="{{url('/gif')}}/{{$gift->id}}">{{$gift->giftvoucher_name}}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>₹{{$gift->giftvoucher_price}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="text-center">
        {{$gifts->links()}}
    </div>
</div>
</div>





@push('after-scripts')
@endpush
@endsection
