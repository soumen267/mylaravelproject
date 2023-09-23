@extends('layouts.app')
@section('content')
@push('style_css')
<style>
.pagination {
    display: inline-block!important;
}
.pagination li a {
    height: 38px;
    line-height: 17px;
}
</style>
@endpush
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper"><h1 class="page-width">Wish List</h1></div>
          </div>
    </div>
    <!--End Page Title-->
    
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                <form action="#">
                    <div class="wishlist-table table-content table-responsive">
                        <table class="table table-bordered" id="wishlistdata">
                            <thead>
                                <tr>
                                    <th class="product-name text-center alt-font">Remove</th>
                                    <th class="product-price text-center alt-font">Images</th>
                                    <th class="product-name alt-font">Product</th>
                                    <th class="product-price text-center alt-font">Unit Price</th>
                                    <th class="stock-status text-center alt-font">Stock Status</th>
                                    <th class="product-subtotal text-center alt-font">Add to Cart</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Auth::user()->wishlist->count() )
                                @foreach ($wishlists as $item)
                                <tr class="mytr" id="row{{ $item->id }}">
                                    <td class="product-remove text-center" valign="middle"><a class="removewish" href="javascript:void(0)" data-id="{{ $item->id }}"><i class="icon icon anm anm-times-l"></i></a></td>
                                    <td class="product-thumbnail text-center">
                                        <a href="javascript:void(0)"><img src="{{ asset('storage/images/products/'.$item->product->image) }}" alt="" title="" /></a>
                                    </td>
                                    <td class="product-name"><h4 class="no-margin"><a href="#">{{ $item->product->name }}</a></h4></td>
                                    <td class="product-price text-center"><span class="amount">${{ number_format($item->product->price,2) }}</span></td>
                                    <td class="stock text-center">
                                        <span class="in-stock">in stock</span>
                                    </td>
                                    <td class="product-subtotal text-center"><button type="button" data-id="{{ $item->id }}" data-productid="{{ $item->product->id }}" class="btn btn-small addcart">Add To Cart</button></td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td style="border:none">No product found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </form>
                {{ $wishlists->links() }}
               </div>
        </div>
    </div>
@push('script')
<script>
$("body").on("click", ".removewish", function(e){
    e.preventDefault()
    var id = $(this).closest('.mytr').find('.removewish').data('id');
    $.ajax({
        type: "POST",
        url: "wishlist/" + id,
        data: {
            "_token" : "{{ csrf_token() }}",
            _method: 'DELETE'
        },
        success: function (response) {
            $("#row"+id).remove();
            refreshDiv();
            loadWish();
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'You have successfully remove product from wishlist.',
            })
            console.log(response);
        }
    });
})
function refreshDiv(){
    $("#wishlistdata").load(location.href + " #wishlistdata");
}
$("body").on("click", ".addcart", function(e){
    e.preventDefault()
    var id = $(this).closest('.mytr').find('.addcart').data('id');
    var productid = $(this).closest('.mytr').find('.addcart').data('productid');
    $.ajax({
        type: "POST",
        url: "cartadd",
        data: {
            "_token" : "{{ csrf_token() }}",
            "id": id,
            "productid": productid
        },
        success: function (response) {
            $("#row"+id).remove();
            refreshDiv();
            loadWish();
            loadCart();
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Cart added Successfully!.',
            })
            console.log(response);
        }
    });
})
</script>
@endpush
@endsection