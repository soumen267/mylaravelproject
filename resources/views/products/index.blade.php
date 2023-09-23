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
    <a href="{{ route('products.create') }}" class="btn btn-primary">ADD PRODUCT</a>
    <br/>
    <br/>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Products</h3>
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
                <th>Category</th>
                <th>@sortablelink('name', 'Name')</th>
                <th>@sortablelink('sku', 'SKU')</th>
                <th>Original Price</th>
                <th>Price</th>
                <th>Image</th>
                <th>Description</th>
                <th>@sortablelink('status')</th>
                <th>Feature Product</th>
                {{-- <th>Created Date</th> --}}
                <th colspan="3">Action</th>
              </tr>
            </thead>
            <tbody>
            @forelse ($getProduct as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->categories->name}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->sku}}</td>
              <td>{{$item->originalprice}}</td>
              <td>{{$item->price}}</td>
              <td><img src="{{ asset('storage/images/products/'.$item['image']) }}" alt="UserImage" style="height:38px; width:45px;"></td>
              <td>{{ substr($item->description, 0, 60)}}</td>
              <td><input data-id="{{$item->id}}" class="toggle-class productstatus" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $item->status ? 'checked' : '' }}></td>
              <td><input data-id="{{$item->id}}" class="toggles-class feature" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Yes" data-off="No" {{ $item->feature ? 'checked' : '' }}></td>
              {{-- <td>{{$item->created_at}}</td> --}}
              <td><a href="{{ route('products.show',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-folder"></i> View</a></td>
              <td><a href="{{ route('products.edit',$item->id) }}" class="btn btn-info btn-sm" title='Edit'><i class="fas fa-pencil-alt">
              </i> Edit</a></td>
              <td>
                <form method="POST" action="{{ route('products.destroy', $item->id) }}">
                  @csrf
                  <input name="_method" type="hidden" value="DELETE">
                  <button type="submit" class="delete btn btn-danger btn-sm" title='Delete'><i class="fas fa-trash">
                  </i> Delete</button>
                </form>
              </td>
            </tr>              
            @empty
              <td colspan="11">No products found</td>
            @endforelse 
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      {!! $getProduct->links() !!}
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
  $(function() {
    $('.productstatus').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeProductStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              if(data.success){
                toastr.success(data.success)
              }else if(data.error){
                toastr.error(data.error)
              }
            }
        });
    })
  })
  $(function() {
    $('.feature').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeFeatureProductStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              if(data.success){
                toastr.success(data.success)
              }else if(data.error){
                toastr.error(data.error)
              }
            }
        });
    })
  })
</script>
@endpush
@endsection