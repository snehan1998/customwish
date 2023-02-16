
@push('after-styles')
@endpush
@extends('manager.layouts.app')
@section('title', 'FAQ')
@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Edit FAQ</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
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
                                    <a href="{{ url('/manager/faq/') }}" class="btn btn-primary btn-sm scroll-click">View FAQ</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-validation">
                                <form role="form" id="myform" method="post" action="{{ route('manager.faq.update', $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                            <label for="price">Question<span class="text-danger">*</span></label>
                                                <input type="text" name="question" id="question" class="form-control" placeholder="Enter Question" value="{{ $data->question }}" />
                                                @if ($errors->has('question'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('question') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="percentage">Answer</label><span class="text-danger">*</span>
                                                <textarea placeholder="Enter Answer" rows="5" required  class="ckeditor form-control" name="answer" id="answer">{{$data->answer}}</textarea>
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
