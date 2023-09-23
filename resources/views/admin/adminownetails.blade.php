@extends('layouts.admin.app')
@section('content')
<section class="content-header">
<section class="content">
<div class="row">
    <div class="container-fluid">
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
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Admin Details</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
            @forelse ($getData as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->email}}</td>
              <td><a href="{{ route('edit',$item->id) }}"><i class="fa fa-edit" style="color:red" aria-hidden="true" title="edit"></i></a></td>
              <td><i class="fa fa-trash" style="color:red" aria-hidden="true" title="delete"></i></td>
            </tr>              
            @empty
              <td colspan="5">No users found</td>
            @endforelse 
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>
</section>
</section>
@endsection