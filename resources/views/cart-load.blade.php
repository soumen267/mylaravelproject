<div class="row" id="productview">
    @forelse ($getProduct as $product)
    <div class="col-6 col-sm-6 col-md-4 col-lg-4 item">
        <!-- start product image -->
        <div class="product-image">
            <!-- start product image -->
            <a href="#">
                <!-- image -->
                <img class="primary blur-up lazyload"
                    data-src="{{ asset('storage/images/products/'.$product['image']) }}"
                    src="{{ asset('storage/images/products/'.$product['image']) }}" alt="image" title="product">
                <!-- End image -->
                <!-- Hover image -->
                <img class="hover blur-up lazyload" data-src="{{ asset('storage/images/products/'.$product['image']) }}"
                    src="{{ asset('storage/images/products/'.$product['image']) }}" alt="image" title="product">
                <!-- End hover image -->
                <!-- product label -->
                <div class="product-labels rectangular"><span class="lbl on-sale">-16%</span> <span
                        class="lbl pr-label1">new</span></div>
                <!-- End product label -->
            </a>
            <!-- end product image -->

            <!-- Start product button -->
            <form class="variants add" action="#" onclick="window.location.href='{{ route('single', $product['id']) }}'"
                method="post">
                <input type="hidden" name="id" value="{{ $product['id'] }}">
                <button class="btn btn-addto-cart" type="button">Select Options</button>
            </form>
            <div class="button-set">
                <a href="javascript:void(0)" title="Quick View" data-id="{{ $product->id ?? '' }}"
                    class="quick-view-popup quick-view show-product" data-toggle="modal"
                    data-target="#content_quickview">
                    <i class="icon anm anm-search-plus-r"></i>
                </a>
                <div class="wishlist-btn">
                    <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                        <i class="icon anm anm-heart-l"></i>
                    </a>
                </div>
                <div class="compare-btn">
                    <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                        <i class="icon anm anm-random-r"></i>
                    </a>
                </div>
            </div>
            <!-- end product button -->
        </div>
        <!-- end product image -->

        <!--start product details -->
        <div class="product-details text-center">
            <!-- product name -->
            <div class="product-name">
                <a href="#">{{ $product->name ?? '' }}</a>
            </div>
            <!-- End product name -->
            <!-- product price -->
            <div class="product-price">
                <span class="old-price">$500.00</span>
                <span class="price">${{ number_format($product->price, 0) ?? '' }}</span>
            </div>
            <!-- End product price -->

            <div class="product-review">
                <i class="font-13 fa fa-star"></i>
                <i class="font-13 fa fa-star"></i>
                <i class="font-13 fa fa-star"></i>
                <i class="font-13 fa fa-star-o"></i>
                <i class="font-13 fa fa-star-o"></i>
            </div>
            <!-- Variant -->
            <ul class="swatches">
                <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$product['image']) }}"
                        alt="image" /></li>
                <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$product['image']) }}"
                        alt="image" /></li>
                <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$product['image']) }}"
                        alt="image" /></li>
                <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$product['image']) }}"
                        alt="image" /></li>
                <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$product['image']) }}"
                        alt="image" /></li>
                <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$product['image']) }}"
                        alt="image" /></li>
            </ul>
            <!-- End Variant -->
        </div>
        <!-- End product details -->
    </div>
    @empty
    <p>No products.</p>
    @endforelse
</div>