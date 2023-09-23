@extends('layouts.app')
@section('content')
@push('style_css')
<style>
.product-template__container .product-form__item--submit .btn {
    width: 13%!important;
    margin-left: 13px!important;
}
</style>
@endpush
<div class="page section-header text-center mb-0">
<div class="page-title">
    <div class="wrapper"><h1 class="page-width">Order Details</h1></div>
</div>
</div>
<br/>
<div class="container">
{{-- <div id="pre-loader">
<img src="{{ asset('assets/images/loader.gif') }}" alt="Loading..." />
</div> --}}
<!--Main Content-->
<div class="col-12 col-sm-9 col-md-9 col-lg-9">
    <div class="blog--list-view" id="blog--list-view">
        <div class="row">
        @forelse ($orderview as $value)
        @foreach ($value->payment as $row)
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 article"> 
                <!-- Article Image -->
                 <a class="article_featured-image" href="#"><img class="blur-up lazyload" data-src="{{ asset('storage/images/products/'.$row->image) }}" src="{{ asset('storage/images/products/'.$row->image) }}" alt="It's all about how you wear"></a> 
                 <h3 class="h3">Order ID: <a href="blog-left-sidebar.html">{{ $row->order_id ?? '' }}</a></h3>
                 <h3 class="h3">Product Name: <a href="blog-left-sidebar.html">{{ $row->product->name ?? '' }}</a></h3>
                 <h3 class="h3">Price: <a href="blog-left-sidebar.html">${{ number_format($row->price, 2) ?? '' }}</a></h3>
                <ul class="publish-detail">
                    <li><i class="anm anm-user-al" aria-hidden="true"></i>  {{ $row->user_id ?? '' }}</li>
                    <li><i class="icon anm anm-clock-r"></i> <time datetime="2017-05-02">{{-- May02,2017 --}}{{ Carbon\Carbon::parse($row->created_at)->format('F j, Y') ?? '' }}</time></li>
                </ul>
        @foreach ($value->cancell as $tt)
        @php
        $data = 'Pending';
        $cancel = 'Not Cancelled';
        $feedback = '';
            if($tt->billing_id == $value->id){
                $data = "Cancelled";
                $cancel = Carbon\Carbon::parse($tt->created_at)->format('F j, Y');
                $reason = $tt->feedback;
            }
        @endphp
        @endforeach                
                @php
                $date = Carbon\Carbon::parse($row->created_at)->format('F j, Y');
                $newdate = date('Y-m-d', strtotime($date . " +4 days"));
                @endphp
                <ul class="publish-detail">
                <li><b>Delivery Date:</b> {{ Carbon\Carbon::parse($newdate)->format('F j, Y') ?? '' }}</li>
                @if($data == 'Cancelled')
                <li><b>Cancellation Date:</b> {{ $cancel ?? '' }}</li>
                @endif
                </ul>
                @if($data == 'Cancelled')
                <div class="rte"> 
                    <p><b>Cancel Reason:</b> {{ $reason ?? '' }}</p>
                </div>
                <p><a href="javascript:void(0)" class="btn btn-secondary btn--small" style="color:white; background-color:red;">Cancelled</a></p>
                @else
                <p><a href="javascript:void(0)" data-orderid="{{ $row->order_id }}" data-productid="{{  $row->productname }}" data-billingid="{{  $row->billing_id }}" class="btn btn-secondary btn--small cancel-order" data-toggle="modal" data-backdrop="static" data-keyboard="false">Cancel Order <i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
                @endif
                
            </div>
        @endforeach
        @empty
        <p>No product found</p>
        @endforelse
        </div>
        <hr/>
        <div class="pagination">
            <ul>
                <li class="active">{!! $orderview->links() !!}</li>
                {{-- <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li class="next"><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i></a></li> --}}
            </ul>
        </div>
    </div>
</div>
<div class="modal fade quick-view-popup" id="content_quickview">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="ProductSection-product-template" class="product-template__container prstyle1">
            <div class="product-single">
            <!-- Start model close -->
            <a href="javascript:void(0)" data-dismiss="modal" class="model-close-btn pull-right" title="close"><span class="icon icon anm anm-times-l"></span></a>
            <!-- End model close -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <input type="hidden" class="orderid" value="">
                        <input type="hidden" class="productid" value="">
                        <input type="hidden" class="billingid" value="">
                        <div class="form-group">
                        <textarea rows="10" cols="30" id="ContactFormMessage" name="feedback" placeholder="Reason for cancellation" style="width: 218%;"></textarea>
                        @error('feedback')
                          <p class="error">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-form__item--submit">
                <button type="button" name="cancel" class="btn product-form__cart-submit">
                    <span>Submit</span>
                </button>
            </div>
            <!--End-product-single-->

            </div>
        </div>
            </div>
        </div>
    </div>
</div>
<!--End Main Content-->    
</div>
@push('script')
<script>
$(".cancel-order").click(function(){
    $("#content_quickview").modal('show')
    var prdid = $(this).data('productid');
    var ordid = $(this).data('orderid');
    var billid = $(this).data('billingid');
    $(".orderid").val(ordid);
    $(".productid").val(prdid);
    $(".billingid").val(billid);
})
$(".product-form__cart-submit").click(function(e){
    e.preventDefault();
    $("#pre-loader").css('display','block');
    var productid = $('.productid').val();
    var orderid = $('.orderid').val();
    var billid = $('.billingid').val();
    var feedback = $('#ContactFormMessage').val();

    if(feedback != ''){
    $.ajax({
        type: "post",
        url: "cancelorder/"+billid,
        data: {
            "productid": productid,
            "orderid": orderid,
            "billid": billid,
            "feedback": feedback,
            "_token": "{{ csrf_token() }}"
        },
        success: function (response) {
            console.log(response)
            $("#pre-loader").css('display','none');
            if(response.success){
                Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'You have successfully cancel this product.',
                })
            }else if(response.error)
            {
                Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Already cancelled this product.',
                })
            }
            $("#content_quickview").modal('hide')
            $("#blog--list-view").load(location.href + " #blog--list-view");
        }
        });
    }else{
        Swal.fire({
                icon: 'error',
                text: 'Please add some feedback',
        })
    }

})
</script>
@endpush
@endsection