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
                    <h1>Edit Coupon</h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Coupon</li>
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
                        <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Coupon Code</label>
                                    <input type="text" name="name" class="form-control @error ('name') is-invalid @enderror" value="{{ $coupon->name }}"
                                        placeholder="Coupon Code">
                                    @error('name')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Discount Amount</label>
                                    <input type="text" name="percentage" class="form-control @error ('percentage') is-invalid @enderror" value="{{ $coupon->percentage }}"
                                        placeholder="Percentage">
                                    @error('percentage')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Coupon Type</label>
                                    <select class="form-control" name="discount">
                                        <option {{ $coupon->discount == 'Percent' ? 'selected' : '' }} value="Percent">Percentage</option>
                                        <option {{ $coupon->discount == 'Doller' ? 'selected' : '' }} value="Doller">Dollar</option>
                                    </select>
                                    @error('discount')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Type</label>
                                    <select class="form-control" name="type" id="type">
                                        <option value="Free">Free</option>
                                        <option value="Product">Product</option>
                                    </select>
                                    @error('type')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Maximum Value</label>
                                    <input type="text" name="maximum_value" class="form-control @error ('maximum_value') is-invalid @enderror" value="{{ $coupon->maximum_value }}"
                                        placeholder="Maximum Value">
                                    @error('maximum_value')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group" style="width: 22rem;">
                                    <label for="exampleInputEmail1">Maximum Usage</label>
                                    <input min="1" max="20" type="number" id="typeNumber" name="maximum_usage" class="form-control  @error ('maximum_usage') is-invalid @enderror" value="{{ $coupon->maximum_usage }}"/>
                                    @error('maximum_usage')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Expires at</label>
                                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                          <input name="expires_at" type="text" class="form-control datetimepicker-input @error ('expires_at') is-invalid @enderror" data-target="#reservationdate" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $coupon->expires_at)->format('m/d/Y') }}">
                                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                      </div>
                                      @error('expires_at')
                                      <p class="error">{{ $message }}</p>
                                      @enderror
                                </div>
                                <div class="form-group">
                                    <label>Apply Product</label>
                                    <select class="select2 @error ('product') is-invalid @enderror" multiple="multiple" name="product[]" data-placeholder="Select product" style="width: 100%;">
                                    @foreach ($getProduct as $key => $product)
                                        <option {{is_array($products) && in_array($product->id, $products) ? 'selected' : '' }} value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                    </select>
                                    @error('product')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                  </div>
                                <div class="form-group">
                                    <label for="inputDescription">Description</label>
                                    <textarea id="inputDescription" name="description" class="form-control  @error ('description') is-invalid @enderror" rows="4">{{ $coupon->description }}</textarea>
                                    @error('description')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Update Coupon</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@push('script')
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
})
</script>
@endpush
@endsection