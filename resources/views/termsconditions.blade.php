@push('after-styles')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link href="{{asset('css/custstyle.css')}}" rel="stylesheet"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

@endpush
@extends('layouts.app')
@section('title', 'Page')
@section('content')
<!--    <div class="container-fluid breadcolor" style="background-image: linear-gradient(#c2272d,#002A5C)">-->
    <div class="container-fluid breadcolor" style="background-image:radial-gradient(#c2272d,#002A5C)">
    	<div class="row">
    		<div class="col-lg-12">
       		<center><h3 class="breadh">{{$page->title}}</h3></center>
    		</div>
    	</div>
    </div>
<br>
<br>
<div class="container">
	<div class="row">
		<div class="col-lg-12 shadowbox">
			<p class="pjustify">
				{!!$page->content!!}
			</p>
		</div>
	</div>
</div>




<form id="submitform">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
    </div>

    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" name="photo" id="photo">
    </div>


    <button class="btn btn-primary" id="submitBtn" type="submit">
        <span class="d-none spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        <span class="">Submit</span>
    </button>

</form>
@push('after-scripts')

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {
    $('#submitBtn').on('click', (e) => {
        e.preventDefault();
        var formData = new FormData();

        let name = $("input[name=name]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        var photo = $('#photo').prop('files')[0];

        formData.append('photo', photo);
        formData.append('name', name);
        alert(formData);
        $.ajax({
            url: '{{url('storerr')}}',
            type: 'POST',
            contentType: 'multipart/form-data',
            cache: false,
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            contentType: false,
            processData: false,
            data: formData,
            success: (response) => {
                // success
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    });


});

</script>

@endpush
@endsection
