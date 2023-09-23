<!--Top Header-->

<!--End Top Header-->
<!--Header-->
<div class="header-wrap @stack('body-header-class') animated d-flex">
    <div class="container-fluid">        
        <div class="row align-items-center">
            <!--Desktop Logo-->
            <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                @if (!empty($logo))
                <a href="javascript:void(0)">
                    <img src="{{ asset('storage/images/logo/'.$logo->url) }}" alt="Belle Multipurpose Html Template" title="Belle Multipurpose Html Template" />
                </a>                    
                @endif
            </div>
            <!--End Desktop Logo-->
            <div class="col-2 col-sm-3 col-md-3 col-lg-8">
                <div class="d-block d-lg-none">
                    <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                        <i class="icon anm anm-times-l"></i>
                        <i class="anm anm-bars-r"></i>
                    </button>
                </div>
                <!--Desktop Menu-->
                <nav class="grid__item" id="AccessibleNav"><!-- for mobile -->
                    <ul id="siteNav" class="site-nav medium center hidearrow">
                        <li class="lvl1 parent megamenu"><a href="{{ url('/') }}" class="{{ Request::segment(1) === '/' ? 'active' : '' }}">Home <i class="anm anm-angle-down-l"></i></a>
                        </li>
                        <li class="lvl1 parent megamenu"><a href="{{ route('shop') }}" class="{{ Request::segment(1) === 'shop' ? 'active' : '' }}">Shop <i class="anm anm-angle-down-l"></i></a>
                        </li>
                        <li class="lvl1 parent megamenu"><a href="{{ url('faq') }}" class="{{ Request::segment(1) === 'faq' ? 'active' : '' }}">Faq <i class="anm anm-angle-down-l"></i></a>
                        </li>
                        <li class="lvl1 parent megamenu"><a href="{{ url('about') }}" class="{{ Request::segment(1) === 'about' ? 'active' : '' }}">About Us <i class="anm anm-angle-down-l"></i></a>
                        </li>
                        <li class="lvl1 parent megamenu"><a href="{{ url('contact') }}" class="{{ Request::segment(1) === 'contact' ? 'active' : '' }}">Contact Us <i class="anm anm-angle-down-l"></i></a>
                        </li>
                    {{-- <li class="lvl1 parent megamenu"><a href="#">Product <i class="anm anm-angle-down-l"></i></a> --}}
                    </li>
                    {{-- <li class="lvl1"><a href="#"><b>Buy Now!</b> <i class="anm anm-angle-down-l"></i></a></li> --}}
                  </ul>
                </nav>
                <!--End Desktop Menu-->
            </div>
            <!--Mobile Logo-->
            <div class="col-6 col-sm-6 col-md-6 col-lg-2 d-block d-lg-none mobile-logo">
                <div class="logo">
                    <a href="javascript:void(0)">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="Belle Multipurpose Html Template" title="Belle Multipurpose Html Template" />
                    </a>
                </div>
            </div>
            <!--Mobile Logo-->
            <div class="col-4 col-sm-3 col-md-3 col-lg-2">
                <div class="site-cart">
                    <a href="javascript:void(0)" class="site-header__cart" title="Cart">
                        <i class="icon anm anm-bag-l"></i>
                        <span id="CartCount" class="site-header__cart-count countcart" data-cart-render="item_count">
                            {{-- @if (Session::get('cart'))
                               {{ count(Session::get('cart')) }}
                            @else
                            0
                            @endif --}}
                        </span>
                    </a>
                    <a href="{{ route('wishlist.index') }}" class="" style="text-decoration: none" title="wishlist">
                        <i class="icon anm anm-heart-l" style="font-size: 22px"></i>
                        <span id="wishlist" class="site-header__cart-count wishcount" data-cart-render="item_count">
                            {{-- @if($data)
                            {{ count($data) }}
                            @else
                            0
                            @endif --}}
                        </span>
                    </a>
                    <!--Minicart Popup-->
                    {{-- @if (Session::get('cart')) --}}
                    <div id="header-cart" class="block block-cart">
                            <ul class="mini-products-list mycart">
                            
                            </ul>
                            
                        <div class="total">
                            <div class="total-in">
                                <span class="label">Cart Subtotal:</span><span class="product-price"><span class="money subtotal-price"></span></span>
                            </div>
                             <div class="buttonSet text-center">
                                <a href="{{ route('show') }}" class="btn btn-secondary btn--small">View Cart</a>
                                <a href="{{ route('checkout') }}" class="btn btn-secondary btn--small">Checkout</a>
                            </div>
                        </div>
                    </div>
                    {{-- @endif --}}
                    <!--EndMinicart Popup-->
                </div>
                {{-- <div class="site-header__search">
                    <button type="button" class="search-trigger"><i class="icon anm anm-search-l"></i></button>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
$(document).ready(function () {
    var cartdata = {{ Js::from(session()->get('cart')) }};
    // console.log(cartdata);
    createData(cartdata)
    totalcalculate(cartdata)
});
function totalcalculate(cartdata){
        var price = 0;
	    var quantity = 0;
	    var subTotal = 0;
        $.each(cartdata, function (indexInArray, item) {
            price = parseFloat(item.price);
			quantity = parseInt(item.qty);
            subTotal += price * quantity;
        });
        $('.subtotal-price').html("$" + subTotal.toFixed(2));
        $('.grandtotal-price').html("$" + subTotal.toFixed(2));
}

function minus(){
$(".minuss").click(function(){
            var id = $(this).closest(".product-details .qtyField").find(".minuss").attr('data-id');
            var qty = $(this).closest(".product-details .qtyField").find(".minuss").attr('data-qty');
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
                    createData(response);
                    totalcalculate(response)
                }
            });
        })
}
function plus(){
$(".pluss").click(function(){
            var id = $(this).closest(".product-details .qtyField").find(".pluss").attr('data-id');
            console.log(id);
            var qty = $(this).closest(".product-details .qtyField").find(".pluss").attr('data-qty');
            console.log(qty)
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
                    createData(response);
                    totalcalculate(response);
                }
            });
        })
}
function cardataremove(){
    $(".cart__remove").click(function(){
        var id = $(this).closest(".item").find(".cart__remove").attr('data-id');
        $.ajax({
            type: "delete",
            url: "cartDelete/"+id,
            data: {
                "id":id,
                "_token": "{{ csrf_token() }}",
            },
            success: function (response) {
                console.log(response)
                createData(response);
                totalcalculate(response)
                loadCart()
            }
        });
    })
}
</script>
@endpush
<!--End Header-->