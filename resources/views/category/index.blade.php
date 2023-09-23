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
    <a href="{{ route('createcategory') }}" class="btn btn-primary">ADD CATEGORY</a>
    <br/>
    <br/>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Category</h3>
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
                <th>Description</th>
                <th>Image</th>
                <th>Created Date</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
            @forelse ($getCategory as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->name}}</td>
              <td>{{ substr($item->description, 0, 60)}}</td>
              <td><img src="{{ asset('storage/images/category/'.$item['image']) }}" alt="CategoryImage" style="height:38px; width:45px;"></td>
              <td>{{$item->created_at}}</td>
              <td><a href="{{ route('editcategory',$item->id) }}" class="btn btn-info btn-sm" title='Edit'><i class="fas fa-pencil-alt">
              </i> Edit</a></td>
              <td>
                <form method="POST" action="{{ route('deletecategory', $item->id) }}">
                  @csrf
                  <input name="_method" type="hidden" value="DELETE">
                  <button type="submit" class="delete btn btn-danger btn-sm" title='Delete'><i class="fas fa-trash">
                  </i> Delete</button>
                </form>
              </td>
            </tr>              
            @empty
              <td colspan="5">No category found</td>
            @endforelse 
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      {!! $getCategory->links() !!}
      <!-- /.card -->
    </div>
  </div>
</div>
</section>
</section>
@push('script')
<script type="text/javascript">
  $(document).ready(function() {
      $('.delete').click(function(e) {
          if(!confirm('Are you sure you want to delete this post?')) {
              e.preventDefault();
          }
      });
  });
  // $(function() {
  //   $('.toggle-class').change(function() {
  //       var status = $(this).prop('checked') == true ? 1 : 0;
  //       var user_id = $(this).data('id'); 
         
  //       $.ajax({
  //           type: "GET",
  //           dataType: "json",
  //           url: '/changeStatus',
  //           data: {'status': status, 'user_id': user_id},
  //           success: function(data){
  //             console.log(data.success)
  //           }
  //       });
  //   })
  // })
</script>
@endpush
@endsection