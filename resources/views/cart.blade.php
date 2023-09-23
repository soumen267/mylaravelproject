@push('body-class', 'template-collection belle')
@push('body-header-class', 'animated')
@extends('layouts.app')
@section('content')
    {{-- <div id="pre-loader">
    <img src="{{ asset('assets/images/loader.gif') }}" alt="Loading..." />
    </div> --}}
    <!--Page Title-->   
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper"><h1 class="page-width">Shopping Cart</h1></div>
          </div>
    </div>
    <!--End Page Title-->
    
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
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
                <div class="alert alert-success text-uppercase" role="alert">
                    <i class="icon anm anm-truck-l icon-large"></i> &nbsp;<strong>Congratulations!</strong> You've got free shipping!
                </div>
                <form action="javascript:void(0)" method="post" class="cart style2">
                    <table id="mydata">
                        <thead class="cart__row cart__header">
                            <tr>
                                <th colspan="2" class="text-center">Product</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-right">Total</th>
                                <th class="action">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody class="mycartdata">
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-left"><a href="{{ route('shop') }}" class="btn btn-secondary btn--small cart-continue">Continue shopping</a></td>
                                @if(!empty($cartdata))
                                <td colspan="3" class="text-right">
                                    <button type="button" name="clear" class="btn btn-secondary btn--small  small--hide delete">Clear Cart</button>
                                    {{-- <button type="submit" name="update" class="btn btn-secondary btn--small cart-continue ml-2">Update Cart</button> --}}
                                </td>
                                @endif
                            </tr>
                        </tfoot>
                </table> 
                </form>
               </div>
            
            @if(!empty($cartdata))
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                        {{-- <h5>Discount Codes</h5>
                        <form action="{{ route('applyCoupon') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="address_zip">Enter your coupon code if you have one.</label>
                                <input type="text" name="name" id="name" class="@error ('name') is-invalid @enderror">
                            </div>
                            @error('name')
                               <p class="error">{{ $message }}</p>
                            @enderror
                            <div class="actionRow">
                                <div><input type="submit" class="btn btn-secondary btn--small" value="Apply Coupon" id="couponBtn"></div>
                            </div>
                        </form> --}}
                    </div>
                    {{-- Shipping --}}
                    <div class="col-12 col-sm-12 col-md-4 col-lg-8 cart__footer">
                        <div class="solid-border">	
                          <div class="row border-bottom pb-2">
                            <span class="col-12 col-sm-6 cart__subtotal-title">Subtotal</span>
                            <span class="col-12 col-sm-6 text-right"><span class="money subtotal-price">$0.00</span></span>
                          </div>
                          @if (session()->get('coupon'))
                          @php
                              $coupon = 0;
                              if(session()->get('coupon')){
                                $coupon = session()->get('coupon.percentage');
                              }else{
                                $coupon = 0;
                              }
                          @endphp
                          <div class="row border-bottom pb-2 pt-2">
                            <span class="col-12 col-sm-6 cart__subtotal-title">Coupon <span class="btn btn-secondary btn--small">{{ session()->get('coupon.name') }}</span></span>
                            <span class="col-12 col-sm-6 text-right coupon-price"></span>
                          </div>                              
                          @endif
                          <div class="row border-bottom pb-2 pt-2">
                            <span class="col-12 col-sm-6 cart__subtotal-title">Tax</span>
                            <span class="col-12 col-sm-6 text-right">$0.00</span>
                          </div>
                          <div class="row border-bottom pb-2 pt-2">
                            <span class="col-12 col-sm-6 cart__subtotal-title">Shipping</span>
                            <span class="col-12 col-sm-6 text-right">Free shipping</span>
                          </div>
                          <div class="row border-bottom pb-2 pt-2">
                            <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Grand Total</strong></span>
                            <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money grandtotal-price"></span></span>
                          </div>
                          <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div>
                          <p class="cart_tearm">
                            <label>
                              <input type="checkbox" name="tearm" class="checkbox tearm">
                              I agree with the terms and conditions
                            </label>
                            <p class="checkterm" style="display:none; color:red"></p>
                          </p>
                          <button type="button" name="checkout" id="cartCheckout" class="btn btn--small-wide checkout">Proceed To Checkout</button>
                          <div class="paymnet-img"><img src="assets/images/payment-img.jpg" alt="Payment"></div>
                          <p><a href="#;">Checkout with Multiple Addresses</a></p>
                        </div>
    
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@push('script')
<script>
    function pre_loader(){
		$("#load").fadeOut();
		$('#pre-loader').delay(0).fadeOut('slow');
	}
    
    $(document).ready(function(){
        var product = {{ Js::from(session()->get('cart')) }};
        showcartData(product)
        calculateTotal(product)
    })
    function calculateTotal(product){
        var price = 0;
	    var quantity = 0;
	    var subTotal = 0;
        $.each(product, function (indexInArray, item) {
            price = parseFloat(item.price);
			quantity = parseInt(item.qty);
            subTotal += price * quantity;
        });
        $('.subtotal-price').html("$" + subTotal.toFixed(2));
        $('.grandtotal-price').html("$" + subTotal.toFixed(2));
    }
    
    function showcartData(product){
        
        var productHTML = "";
        $.each(product, function (indexInArray, item) {
            productHTML += `<tr class="cart__row border-bottom line1 cart-flex border-top" id="row${item.id}">
                                <td class="cart__image-wrapper cart-flex-item">
                                    <a href="#"><img class="cart__image" src="storage/images/products/${item.image}" alt="Elastic Waist Dress - Navy / Small"></a>
                                </td>
                                <td class="cart__meta small--text-left cart-flex-item">
                                    <div class="list-view-item__title">
                                        <a href="#">${item.name}</a>
                                    </div>
                                    
                                    <div class="cart__meta-text">
                                        Color: Navy<br>Size: Small<br>
                                    </div>
                                </td>
                                <td class="cart__price-wrapper cart-flex-item">
                                    <span class="money">${item.price}</span>
                                </td>
                                <td class="cart__update-wrapper cart-flex-item text-right">
                                    <div class="cart__qty text-center">
                                        <div class="qtyField">
                                            <a class="qtyBtn minus" href="javascript:void(0);" data-id="${item.id}" data-qty="${item.qty}"><i class="icon icon-minus"></i></a>
                                            <input class="cart__qty-input qty" type="text" name="updates[]" id="qty" data-id="${item.id}" value="${item.qty}" pattern="[0-9]*">
                                            <a class="qtyBtn plus" href="javascript:void(0);" data-id="${item.id}" data-qty="${item.qty}"><i class="icon icon-plus"></i></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right small--hide cart-price">
                                    <div><span class="money">$${(item.qty * item.price).toFixed(2)}</span></div>
                                </td>
                                <td class="text-center small--hide"><a href="javascript:void(0)" class="btn btn--secondary cart__remove" data-id="${item.id}" title="Remove tem"><i class="icon icon anm anm-times-l"></i></a></td>
                            </tr>`;
            });
            $('.mycartdata').html(productHTML);
            qnt_incre();
            cartminus();
            cartplus();
    }
    function cartminus(){
        $(".minus").click(function(){
            var id = $(this).closest('.qtyField').find('.minus').attr('data-id');
            var qty = $(this).closest('.qtyField').find('.minus').attr('data-qty');
                $.ajax({
                type: "post",
                url: "/cartUpdate/"+id,
                data: {
                    "id": id,
                    "qty":qty,
                    "data": "decrement",
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    console.log(response)
                    createData(response)
                    showcartData(response);
                    calculateTotal(response)
                }
            });
        })
    }
    function cartplus(){
            $(".plus").click(function(){
             var id = $(this).closest('.qtyField').find('.plus').attr('data-id');
             var qty = $(this).closest('.qtyField').find('.plus').attr('data-qty');
                $.ajax({
                type: "post",
                url: "/cartUpdate/"+id,
                data: {
                    "id": id,
                    "data": "increment",
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    console.log(response)
                    createData(response)
                    showcartData(response);
                    calculateTotal(response)
                }
            });
        })
    }
    $(document).on('click', '.cart__remove', function(){
            var id = $(this).attr('data-id');
            $.ajax({
                type: "delete",
                url: "cartDelete/"+id,
                data: {
                    "id":id,
                    "_token": "{{ csrf_token() }}",
                },
                cache: false,
                dataType: "json",
                success: function (response) {
                    showcartData(response);
                    createData(response)
                    calculateTotal(response)
                    $("#row"+id).remove();
                    loadCart();
                    //$(".style2").load(location.href + " .style2")
                }
            });
        })
        $(document).on('click', '.delete', function(){
            $.ajax({
                type: "delete",
                url: "deletecart",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    showcartData(response)
                    calculateTotal(response)
                    loadCart();
                }
            });
        })
    $("#cartCheckout").click(function(){
        if($(".tearm").is(":checked")){
            window.location.href = "{{ route('checkout') }}";
        }else{
            $(".checkterm").show();
            $(".checkterm").html("Please check the term");
            console.log("no")
        }
    })
</script>
@endpush
@endsection