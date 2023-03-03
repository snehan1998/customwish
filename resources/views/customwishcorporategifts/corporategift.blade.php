@push('after-styles')
@endpush
@extends('layouts.app')
@section('title', 'Corporate Gift')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumb mb-30">
                    <a class="breadcrumb-item text-dark" href="{{url('/')}}">Home</a>
                    <span class="breadcrumb-item active">Corporate Gifts</span>
                </nav>
            </div>
        </div>
    </div>

    <div class="container pt-5 pb-3">
        <div class="product_list_section">
            <div class="row justify-content-center">
                @foreach ($corporates as $corporate)
                <?php $corimage = App\Models\CorporateGiftImage::where('corporate_id',$corporate->id)->first(); ?>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1 aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <a href="{{url('/co')}}/{{$corporate->corp_product_slug}}">
                                <img src="{{asset('uploads/images')}}/{{$corimage->images}}" alt="service-image2" class="img-fluid w-100">
                            </a>
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square bluey" href="{{url('/co')}}/{{$corporate->corp_product_slug}}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-outline-dark btn-square yehr wishlistproduct8"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-2">
                            <a class="h6 text-decoration-none text-truncate" href="{{url('/co')}}/{{$corporate->corp_product_slug}}">{{$corporate->corp_product_name}}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="text-center">
            {{$corporates->links()}}
        </div>
    </div>
</div>

@push('after-scripts')
@endpush
@endsection
