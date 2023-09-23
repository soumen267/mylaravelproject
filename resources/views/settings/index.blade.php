@extends('layouts.admin.app')
@section('content')
@if(Session::has('success'))
<div class="alert alert-primary mt-2">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
{{Session::get('success')}}
</div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger mt-2">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    {{Session::get('error')}}
    </div>
@endif
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Settings</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Setting</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-primary">
                    <form action="{{ route('bannerupdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Banner Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="bannerimage">
                                    <label class="custom-file-label" for="customFile"></label>
                                </div>
                                @error('bannerimage')
                                  <p class="error">{{ $message }}</p>
                                @enderror
                                @if (!empty($banner))
                                  <img src="{{ asset('storage/images/banner/'.$banner['url']) }}" width="550" height="80" id="bimage"/>
                                @endif
                                <div id="preview"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Logo Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="logoFile" name="logo">
                                    <label class="custom-file-label" for="customFile"></label>
                                    @error('logo')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                @if (!empty($logo))
                                  <img src="{{ asset('storage/images/logo/'.$logo['url']) }}" width="89" height="80" id="limage"/>
                                @endif
                                <div id="lpreview"></div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Create or Update setting</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@push('script')
<script>
    function bannerPreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (event) {
            $('#preview').html('<img src="'+event.target.result+'" width="550" height="80"/>');
        };
        fileReader.readAsDataURL(fileInput.files[0]);
    }
}
$("#customFile").change(function () {
    $("#bimage").hide();
    bannerPreview(this);
});
function logoPreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (event) {
            $('#lpreview').html('<img src="'+event.target.result+'" width="89" height="80"/>');
        };
        fileReader.readAsDataURL(fileInput.files[0]);
    }
}
$("#logoFile").change(function () {
    $("#limage").hide();
    logoPreview(this);
});
</script>    
@endpush
@endsection