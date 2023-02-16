@push('after-styles')
@endpush
@extends('admin.layouts.app')
@section('title', 'Pages')
@section('content')
<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Edit Pages</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pages</li>

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
                                <h4 class="card-title">Pages</h4>
                                <div class="text-right">
                                    <a href="{{ url('/admin/pages/') }}" class="btn btn-primary btn-sm scroll-click">View Coupons</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">

                                <form enctype="multipart/form-data" role="form" id="myform" method="post" action="{{ route('admin.pages.update', $data->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-12">

                                        <input type="hidden" id="id" value="{{ $data->id }}">
                                        <div class="form-group">
                                            <label for="title" class="control-label">Title</label><span class="text-danger">*</span>
                                            <input class="form-control" placeholder="Title" name="title" type="text" required id="title" value="{{ $data->title }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="content" class="control-label">Content</label>
                                            <textarea class="ckeditor" placeholder="" id="editor"  name="content" cols="50" rows="10">{{ $data->content }}</textarea>
                                        </div>
                                       <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                Submit
                                            </button>
                                        </div>
                                  </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('after-scripts')
    <!-- Jquery Validation -->
    <script src="{{ URL::asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- Form validate init -->
    <script src="{{ URL::asset('/admincss/js/plugins-init/jquery.validate-init.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
           $('.ckeditor').ckeditor();
        });
    </script>
@endpush
@endsection
