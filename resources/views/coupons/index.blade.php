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
    <a href="{{ route('coupons.create') }}" class="btn btn-primary">ADD COUPON</a>
    <br/>
    <br/>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Coupons</h3>
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
                <th>Product</th>
                <th>Percentage</th>
                <th>Coupon</th>
                <th>Coupon Type</th>
                <th>Maximum Value</th>
                <th>Maximum Usage</th>
                <th>Expires At</th>
                <th>Description</th>
                <th>@sortablelink('is_active', 'Status')</th>
                {{-- <th>Created Date</th> --}}
                <th colspan="3">Action</th>
              </tr>
            </thead>
            <tbody>
            @forelse ($getCoupon as $item)
            @php
              $pro = [];
                $data = array_filter(explode(",",$item->product));
                foreach($data as $k => $v){
                        foreach($product as $kk => $prd){
                            if($v == $product[$kk]['id']){
                              $pro[] = $product[$kk]['name'];
                            }
                        }
                    }
            @endphp
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->name}}</td>
              <td>
              @foreach ($pro as $value)
                {{ $value }}
              @endforeach
              </td>
              <td>{{$item->percentage}}</td>
              <td>{{$item->discount}}</td>
              <td>{{$item->type}}</td>
              <td>{{$item->maximum_value}}</td>
              <td>{{$item->maximum_usage}}</td>
              <td>{{$item->expires_at}}</td>
              <td>{{ substr($item->description, 0, 60)}}</td>
              <td><input data-id="{{$item->id}}" class="toggle-classes" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $item->is_active ? 'checked' : '' }}></td>
              {{-- <td>{{$item->created_at}}</td> --}}
              {{-- <td><a href="{{ route('coupons.show',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-folder"></i> View</a></td> --}}
              <td><a href="{{ route('coupons.edit',$item->id) }}" class="btn btn-info btn-sm" title='Edit'><i class="fas fa-pencil-alt">
              </i> Edit</a></td>
              <td>
                <form method="POST" action="{{ route('coupons.destroy', $item->id) }}">
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
      {!! $getCoupon->links() !!}
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
          if(!confirm('Are you sure you want to delete this coupon?')) {
              e.preventDefault();
          }
      });
  });
  $(function() {
    $('.toggle-classes').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              toastr.success(data.success)
              console.log(data.success)
            }
        });
    })
  })
</script>
@endpush
@endsection