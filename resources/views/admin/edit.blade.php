@extends('layouts.admin.app')
@section('content')
<section class="content-header">
<section class="content">
    <div class="row">
        <div class="container-fluid">
        <div class="col-6">
        <div class="card-header">
            <h3 class="card-title">Edit Details</h3>
        </div>
        <form action="{{ route('update',$getData->id) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $getData->name }}" placeholder="Enter name">
            @error('name')
            <p>{{ $message }}</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" value="{{ $getData->email }}" placeholder="Enter email">
            @error('email')
            <p>{{ $message }}</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" value="{{ $getData->password }}" placeholder="Password">
            @error('password')
            <p>{{ $message }}</p>
            @enderror
          </div>
          {{-- <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text">Upload</span>
              </div>
            </div>
          </div> --}}
          {{-- <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div> --}}
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
        </div>
    </div>
</div>
</section>
</section>
@endsection