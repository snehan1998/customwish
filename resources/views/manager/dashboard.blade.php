@push('after-styles')
    <!-- Testimonial Sections -->
@endpush
@extends('manager.layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <a href="{{url('admin/category')}}">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Category</div>
                                    <?php $category = App\Models\Category::count(); ?>
                                    <div class="stat-digit"> {{$category}}</div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <a href="{{url('admin/subcategory')}}">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Subcategory</div>
                                    <?php $sub = App\Models\SubCategory::count(); ?>
                                    <div class="stat-digit"> {{$sub}}</div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <a href="{{url('admin/childcategory')}}">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Child Category</div>
                                    <?php $child = App\Models\ChildCategory::count(); ?>
                                    <div class="stat-digit"> {{$child}}</div>
                                </div>
                            </div>
                        </div>
                        </a>
                        <!-- /# card -->
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <a href="{{url('admin/products')}}">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Products</div>
                                    <?php $product = App\Models\Product::count(); ?>
                                    <div class="stat-digit"> {{$product}}</div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <!-- /# column -->
                </div>
                </div>
        </div>

@push('after-scripts')
@endpush

@endsection
