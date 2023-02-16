@push('after-styles')
@endpush
@extends('manager.layouts.app')
@section('title', 'About Us')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>About Us</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About Us</li>
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
                                <h4 class="card-title">About Us</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                <form method="post" action="{{ route('manager.about.update', $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" id="id" value="{{$data->id}}">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" value="{{ $data->name }}" name="name" type="text">
                                </div>
                                <div class="form-group">
                                    <label>Founder</label>
                                    <input class="form-control" value="{{ $data->founder }}" name="founder" type="text" >
                                </div>
                                 <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="ckeditor form-control border-radius-0" placeholder="Enter text ..."
                                        name="description">{{ $data->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label> Image</label>
                                    <img src="{{ URL::asset('/')}}uploads/images/{{$data->image }}" style="width: 5%;">
                                    <input type="file" name="image" class="form-control"  accept="image/*">
                                </div>
                                <div class="form-group">
                                    <label>Signature Image</label>
                                    <img src="{{ URL::asset('/')}}uploads/images/{{$data->sign_image }}" style="width: 5%;">
                                    <input type="file" name="sign_image" class="form-control"  accept="image/*">
                                </div>
                                 <button type="submit" class="btn btn-primary btn-sm scroll-click">Submit
                                </button>
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
