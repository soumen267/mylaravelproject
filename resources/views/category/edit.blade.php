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
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Category</h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-primary">
                        <form action="{{ route('updatecategory', $getCategoryById->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category Name</label>
                                    <input type="text" name="name" class="form-control @error ('name') is-invalid @enderror" value="{{ $getCategoryById->name }}"
                                        placeholder="Category Name">
                                    @error('name')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="image" value="{{ $getCategoryById->image }}">
                                        <input type="file" name="image" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <img src="{{ asset('storage/images/category/'.$getCategoryById->image) }}" alt="CategoryImage" style="height:58px; width:65px;">
                                    <div id="preview"></div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">Description</label>
                                    <textarea id="inputDescription" name="description" class="form-control  @error ('description') is-invalid @enderror" rows="4">{{ $getCategoryById->description }}</textarea>
                                    @error('description')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@push('script')
<script>
    function imagePreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (event) {
            $('#preview').html('<img src="'+event.target.result+'" width="89" height="80"/>');
        };
        fileReader.readAsDataURL(fileInput.files[0]);
    }
}
$("#customFile").change(function () {
    imagePreview(this);
});
</script>    
@endpush
@endsection