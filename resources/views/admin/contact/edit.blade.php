@push('after-styles')

@endpush
@extends('admin.layouts.app')
@section('title', 'Contact Us')
@section('content')

<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Contact Us</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>

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
                                <h4 class="card-title">Contact Us</h4>

                            </div>
                            <div class="card-body">
                                <div class="form-validation">

                                <form method="post" action="{{ route('admin.contact.update', $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" id="id" value="{{$data->id}}">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" value="{{ $data->email }}" name="email" type="email">
                                </div>

                                <div class="form-group">
                                    <label>phone</label>
                                    <input class="form-control" value="{{ $data->phone }}" name="phone" type="tel" >
                                </div>
                                 <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="textarea_editor form-control border-radius-0" placeholder="Enter text ..."
                                        name="address">{{ $data->address }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Opening Hours</label>
                                    <textarea class="form-control border-radius-0" placeholder="Enter text ..."
                                        name="opening_hour">{{ $data->opening_hour }}</textarea>
                                 </div>
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea class="ckeditor form-control border-radius-0" placeholder="Enter text ..."
                                        name="content">{{ $data->content }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input class="form-control" value="{{ $data->facebook }}" name="facebook" type="url">
                                </div>
                                <div class="form-group">
                                    <label>Twitter</label>
                                    <input class="form-control" value="{{ $data->twitter }}" name="twitter" type="url">
                                </div>
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input class="form-control" value="{{ $data->instagram }}" name="instagram" type="url">
                                </div>
                                <div class="form-group">
                                    <label>Linkedin</label>
                                    <input class="form-control" value="{{ $data->linkedin }}" name="linkedin" type="url">
                                </div>

                                <div class="form-group">
                                    <label for="lastName">Map</label>
                                    <textarea class="form-control" id="lastName" rows="5" type="url" name="map">{{ $data->map }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Banner Image</label>
                                    <img src="{{ URL::asset('/')}}uploads/images/{{$data->contact_banner_image }}" style="width: 5%;">
                                    <input type="file" name="contact_banner_image" class="form-control"  accept="image/*">
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
