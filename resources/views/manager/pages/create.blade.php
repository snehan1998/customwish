@push('after-styles')
@endpush
@extends('manager.layouts.app')
@section('title', 'Pages')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Create Pages</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
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
                            <a href="{{ url('/manager/pages/') }}" class="btn btn-primary btn-sm scroll-click">View Pages</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-validation">

                            <form role="form" id="myform" method="post" action="{{ route('manager.pages.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="title" class="control-label">Title</label><span class="text-danger">*</span>
                                    <input class="form-control" placeholder="Title" name="title" type="text" id="title" required>
                                </div>
                                <div class="form-group">
                                    <label for="content" class="control-label">Content</label>
                                    <textarea class="ckeditor" placeholder="" id="editor" name="content" cols="50" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary ">
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
</div>


@push('after-scripts')
<!-- Jquery Validation -->
<script src="{{ URL::asset('/managercss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
<!-- Form validate init -->
<script src="{{ URL::asset('/managercss/js/plugins-init/jquery.validate-init.js')}}"></script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endpush
@endsection
