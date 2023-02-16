@push('after-styles')
@endpush
@extends('admin.layouts.app')
@section('title', 'FAQ')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Create FAQ</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQ</li>

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
                                <h4 class="card-title">FAQ</h4>
                                <div class="text-right">
                                    <a href="{{ url('/admin/faq/') }}" class="btn btn-primary btn-sm scroll-click">View FAQ</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">
                            <form role="form" id="myform" method="post" action="{{ route('admin.faq.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                <label for="price">Question</label><span class="text-danger">*</span>
                                                    <input type="text" name="question" id="question" required value="{{old('question')}}" class="form-control" placeholder="Enter Question" />
                                                    @if ($errors->has('question'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('question') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="percentage">Answer</label><span class="text-danger">*</span>
                                                    <textarea placeholder="Enter Answer" rows="5" required class="ckeditor form-control" name="answer" id="answer">{{ old('answer') }}</textarea>
                                                        @if ($errors->has('answer'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('answer') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12 ml-auto">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                                </div>
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
