@extends('layouts.admin.app')
@section('content')
@push('css_style')
<style>
span.online {
  display: block;
  width: 15px;
  height: 15px;
  margin-top: 4px;
  background-color: #0fcc45;
  opacity: 0.7;
  border-radius: 50%;
  animation: blink 1s linear infinite;
}
.offline{
  display: inline-block;
  width: 15px;
  height: 15px;
  margin-right: 10px;
  background-color: red;
  border-radius: 50%;
  position: relative;
  margin-top: 4px;
}
@keyframes online {
  100% { transform: scale(2, 2); 
          opacity: 0;
        }
}
</style>
@endpush
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
    <a href="{{ route('create') }}" class="btn btn-primary">ADD USER</a>
    <br/>
    <br/>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">User Details</h3>
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
                <th>@sortablelink('name','Name')</th>
                <th>@sortablelink('email','Email')</th>
                <th>Image</th>
                <th>@sortablelink('status','Status')</th>
                <th>Status</th>
                <th>Created Date</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
            @forelse ($getUser as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->email}}</td>
              <td>
              @if ($item['image'])
              <img src="{{ asset('storage/images/users/'.$item['image']) }}" alt="UserImage" style="height:38px; width:45px;">  
              @else
              <img src="{{ asset('assets/admin/dist/img/avatar.png') }}" alt="UserImage" style="height:38px; width:45px;">  
              @endif
              </td>
              <td>
                <input data-id="{{$item->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $item->status ? 'checked' : '' }}>
              </td>
              <td>
                @if(Cache::has('user-online' . $item->id))
                <span class="text-gray-500 online"></span>
                @else
                <span class="text-gray-500 offline"></span>
                @endif
              </td>
              <td>{{$item->created_at}}</td>
              <td><a href="{{ route('edituser',$item->id) }}" class="btn btn-primary" title='Edit'>Edit</a></td>
              <td>
                <form method="POST" action="{{ route('deleteuser', $item->id) }}">
                  @csrf
                  <input name="_method" type="hidden" value="DELETE">
                  <button type="submit" class="btn btn-danger delete" title='Delete'>Delete</button>
                </form>
              {{-- <a href="{{ route('deleteuser',$item->id) }}"><i class="fa fa-trash" style="color:red" aria-hidden="true" title="delete"></i></a> --}}
              </td>
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
    $('.toggle-class').change(function() {
        var status = $(this).closest("tr").find(".toggle-class").prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeUserStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              if(data.success){
                toastr.success(data.success)
              }else if(data.error){
                toastr.error(data.error)
              }              
              console.log(data)
            }
        });
    })
  })
</script>
@endpush
@endsection