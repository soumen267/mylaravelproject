@extends('layouts.admin.app')
@section('content')
<section class="content-header">
    <section class="content">
    <div class="row">
        <div class="container">
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
        {{-- <a href="{{ route('products.create') }}" class="btn btn-primary">ADD PRODUCT</a> --}}
        <br/>
        <br/>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Orders</h3>
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
                    <th>Bill ID</th>
                    <th>@sortablelink('order_id','Order ID')</th>
                    {{-- <th>Product</th>
                    <th>Price</th>
                    <th>Image</th> --}}
                    <th>Status</th>
                    <th>@sortablelink('created_at','Order Date')</th>
                    <th>Cancelled Date</th>
                    {{-- <th>Cancelled By</th> --}}
                    <th>Payment Status</th>
                    <th>Reason</th>
                    <th>Details<th>
                  </tr>
                </thead>
                <tbody>
                @if($orders)
                @forelse ($orders as $item)
                @foreach ($item->payment->unique('order_id') as $val)
                @foreach ($products as $product)
                @php
                $price = 0;
                $price += $val->price;
                $productname;
                if($val->productname == $product->id){
                  $productname = $product->name;
                }
                @endphp
                @endforeach
                <tr>
                  <td>{{ $val->id }}</td>
                  <td>{{ $val->order_id ?? '' }}</td>
                  {{-- <td>{{ $productname ?? '' }}</td>
                  <td>{{ number_format($price, 2) }}</td>
                  <td><img src="{{ asset('storage/images/products/'.$val['image']) }}" alt="UserImage" style="height:38px; width:45px;"></td> --}}
                  @foreach ($item->cancell as $tt)

                     @php
                     $data = $tt->order_id;
                     $cancelledby = $tt->user_id;
                     $cancel = 'Not Cancelled';
                     $feedback = '';
                        if($tt->order_id == $val->order_id){
                            $cancellationDate = $tt->created_at;
                            $feedback = $tt->feedback;
                        }
                     @endphp
                  @endforeach
                  @if ($data == $val->order_id)
                  <td><span class="text-danger" style="font-weight: bolder">Cancelled</span></td>
                  @else
                  <td>Pending</td>
                  @endif
                  <td>{{ $val->created_at }}</td>
                  @if($data == $val->order_id)
                  <td>{{ $cancellationDate }}</td>
                  @else
                  <td>---</td>
                  @endif
                  <td>{{ $val->paymentstatus }}</td>
                  {{-- @if($data == $val->order_id)
                  <td>{{ $cancelledby }}</td>
                  @else
                  <td>---</td>
                  @endif --}}
                  <td>
                  @if($data == $val->order_id)
                  <a href="javascript:void(0)" class="tooltipdata hover" data-feed="{{ $feedback }}" data-toggle="tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
                  @else
                  <a href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true"></i></a>
                  @endif
                 </td>
                  <td><a href="{{ route('ordersdetails', $item->id) }}">Details</a></td>
                </tr>
                @endforeach
                @empty
                  <td colspan="11">No products found</td>
                @endforelse 
                @endif
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          {!! $orders->links() !!}
          <!-- /.card -->
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Cancellation Reason</h4>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p></p>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    </section>
    </section>
    @push('script')
    <script type="text/javascript">
      $(document).ready(function () {
        $('.tooltipdata').on('click', function(e){
        e.preventDefault()
        let feedback = $(this).closest("tr").find(".tooltipdata").data("feed");
        if(feedback != ''){
          $("#modal-default").modal('show')
          $(".modal-body p").html(feedback)
        }
      })  
      });
  </script>
  @endpush
@endsection