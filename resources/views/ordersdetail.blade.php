@extends('layouts.admin.app')
@section('content')
<section class="content-header">
<section class="content">
    <div class="container" id="canceldiv">
    <div class="row">
    @foreach ($orders as $order)
    @foreach ($order->payment as $item)
    @foreach ($products as $product)
    @php
    $productname;
    if($item->productname == $product->id){
      $productname = $product->name;
    }
    @endphp
    @endforeach
    @foreach ($order->cancell as $tt)
        @php
        $data = 'Pending';
        $cancel = 'Not Cancelled';
        $feedback = '';
            if($tt->billing_id == $item->billing_id){
                $data = "Cancelled";
                $cancel = $tt->created_at;
                $feedback = $tt->feedback;
            }
        @endphp
    @endforeach
    <div class="card" style="width: 18rem;">
    <img src="{{ asset('storage/images/products/'.$item->image) }}" class="card-img-top" alt="...">
    <div class="card-body">
      <p>Order ID: {{ $item->order_id }}</p>
      <h3 class="card-title">Product Name: {{ $productname ?? '' }}</h3>
      <h6 class="card-text">Product Price: ${{ number_format($item->price, 2) }}</h6>
      <h6 class="card-text">Order Date: {{ $item->created_at ?? ''}}</h6>
      @if ($data == 'Cancelled')
      <h6 class="card-text">Cancel Date: {{ $cancel ?? '' }}</h6>    
      <h6 class="card-text">Status: <span class="text-danger">{{ $data }}</span></h6>
      @else
      <h6 class="card-text">Status: <span class="text-primary">Pending</span></h6>
      @endif
      
      {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
    </div>
    </div>
    @endforeach
    @endforeach
    </div>
    @if ($data != 'Cancelled')
    <form action="" method="POST" id="cancelform">
    @csrf
    <input type="hidden" name="billingid" id="billingid" value="{{ $order->id }}">
    <div class="form-group">
        <label for="inputDescription">Cancel</label>
        <textarea id="feedback" name="feedback" class="form-control" rows="4"></textarea>
    </div>
    @error('feedback')
    <p class="error">{{ $message }}</p>
    @enderror
    <div class="card-footer">
        <button type="button" class="btn btn-primary cancel-btn">Submit</button>
    </div>
    </form>
    @endif
</div>
</section>
</section>
@push('script')
<script>
$(".cancel-btn").click(function(){
    let billid = $("#billingid").val();
    let feedback = $("#feedback").val();
    if(feedback != ''){
        $.ajax({
        type: "POST",
        url: "cancelorderadmin/"+ billid,
        data: {
            "billid":billid,
            "admintype": "admin",
            "feedback": feedback,
            "_token": "{{ csrf_token() }}"
        },
        success: function (response) {
            if(response.success){
              toastr.success(response.success)
              $("#cancelform")[0].reset();
              $("#cancelform").hide();
              $("#canceldiv").load(location.href + " #canceldiv")
            }else if(response.error){
                toastr.error(response.error)
            }
        },
        error: function(response){
                var errors = response.responseJSON;
                $.each(errors.error,function (k,v) {
                    console.log(v);
                    toastr.error(v)
            });
        }
    });
    }else{
        toastr.error("Cancel reason is required")
    }
    
})
</script>
@endpush
@endsection