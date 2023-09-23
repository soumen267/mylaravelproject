@push('body-class', 'template-collection belle')
@push('body-header-class', 'animated')
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
.price-filter input[type="text"] {
    width: 106px!important;
}
</style>
    @endpush
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
    <!--Collection Banner-->
    <div class="collection-header">
        <div class="collection-hero">
            <div class="collection-hero__image"><img class="blur-up lazyload" data-src="assets/images/cat-women2.jpg" src="assets/images/cat-women2.jpg" alt="Women" title="Women" /></div>
            <div class="collection-hero__title-wrapper"><h1 class="collection-hero__title page-width">Shop</h1></div>
          </div>
    </div>
    <!--End Collection Banner-->
    
    <div class="container">
        <div class="row">
            <!--Sidebar-->
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar">
                <div class="closeFilter d-block d-md-none d-lg-none"><i class="icon icon anm anm-times-l"></i></div>
                <div class="sidebar_tags">
                    <!--Categories-->
                    <div class="sidebar_widget categories filter-widget">
                        <div class="widget-title"><h2>Categories</h2></div>
                        <div class="widget-content">
                            <ul class="sidebar_categories">
                                @forelse ($category as $key => $item)
                                {{-- <li class="level1 sub-level"><a href="#;" class="site-nav">Clothing</a>
                                    <ul class="sublinks">
                                        <li class="level2"><a href="#;" class="site-nav">Men</a></li>
                                        <li class="level2"><a href="#;" class="site-nav">Women</a></li>
                                        <li class="level2"><a href="#;" class="site-nav">Child</a></li>
                                        <li class="level2"><a href="#;" class="site-nav">View All Clothing</a></li>
                                    </ul>
                                </li>
                                <li class="level1 sub-level"><a href="#;" class="site-nav">Jewellery</a>
                                    <ul class="sublinks">
                                        <li class="level2"><a href="#;" class="site-nav">Ring</a></li>
                                        <li class="level2"><a href="#;" class="site-nav">Neckalses</a></li>
                                        <li class="level2"><a href="#;" class="site-nav">Eaarings</a></li>
                                        <li class="level2"><a href="#;" class="site-nav">View All Jewellery</a></li>
                                    </ul>
                                </li> --}}
                                <li class="lvl-1"><a href="javascript:void(0)" data-id="{{ $item->id }}" class="site-nav categoryitem">{{ strtoupper($item->name) ?? '' }}</a></li>
                                @empty
                                <p>No category found</p>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <!--Categories-->
                    <!--Price Filter-->
                    <div class="sidebar_widget filterBox filter-widget">
                        <div class="widget-title">
                            <h2>Price</h2>
                        </div>
                            <form action="" method="post" class="price-filter">
                            <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p class="no-margin"><input id="amount" type="text"></p>
                                </div>
                                {{-- <div class="col-6 text-right margin-25px-top">
                                    <button class="btn btn-secondary btn--small">filter</button>
                                </div> --}}
                            </div>
                        </form>
                    </div>
                    <!--End Price Filter-->
                    <!--Size Swatches-->
                    {{-- <div class="sidebar_widget filterBox filter-widget size-swacthes">
                        <div class="widget-title"><h2>Size</h2></div>
                        <div class="filter-color swacth-list">
                            <ul>
                                <li><span class="swacth-btn checked">X</span></li>
                                <li><span class="swacth-btn">XL</span></li>
                                <li><span class="swacth-btn">XLL</span></li>
                                <li><span class="swacth-btn">M</span></li>
                                <li><span class="swacth-btn">L</span></li>
                                <li><span class="swacth-btn">S</span></li>
                                <li><span class="swacth-btn">XXXL</span></li>
                                <li><span class="swacth-btn">XXL</span></li>
                                <li><span class="swacth-btn">XS</span></span></li>
                            </ul>
                        </div>
                    </div> --}}
                    <!--End Size Swatches-->
                    <!--Color Swatches-->
                    {{-- <div class="sidebar_widget filterBox filter-widget">
                        <div class="widget-title"><h2>Color</h2></div>
                        <div class="filter-color swacth-list clearfix">
                            <span class="swacth-btn black"></span>
                            <span class="swacth-btn white checked"></span>
                            <span class="swacth-btn red"></span>
                            <span class="swacth-btn blue"></span>
                            <span class="swacth-btn pink"></span>
                            <span class="swacth-btn gray"></span>
                            <span class="swacth-btn green"></span>
                            <span class="swacth-btn orange"></span>
                            <span class="swacth-btn yellow"></span>
                            <span class="swacth-btn blueviolet"></span>
                            <span class="swacth-btn brown"></span>
                            <span class="swacth-btn darkGoldenRod"></span> 
                            <span class="swacth-btn darkGreen"></span> 
                            <span class="swacth-btn darkRed"></span> 
                            <span class="swacth-btn dimGrey"></span>
                            <span class="swacth-btn khaki"></span> 
                        </div>
                    </div> --}}
                    <!--End Color Swatches-->
                    <!--Brand-->
                    {{-- <div class="sidebar_widget filterBox filter-widget">
                        <div class="widget-title"><h2>Brands</h2></div>
                        <ul>
                            <li>
                              <input type="checkbox" value="allen-vela" id="check1">
                              <label for="check1"><span><span></span></span>Allen Vela</label>
                            </li>
                            <li>
                              <input type="checkbox" value="oxymat" id="check3">
                              <label for="check3"><span><span></span></span>Oxymat</label>
                            </li>
                            <li>
                              <input type="checkbox" value="vanelas" id="check4">
                              <label for="check4"><span><span></span></span>Vanelas</label>
                            </li>
                            <li>
                              <input type="checkbox" value="pagini" id="check5">
                              <label for="check5"><span><span></span></span>Pagini</label>
                            </li>
                            <li>
                              <input type="checkbox" value="monark" id="check6">
                              <label for="check6"><span><span></span></span>Monark</label>
                            </li>
                        </ul>
                    </div> --}}
                    <!--End Brand-->
                    <!--Popular Products-->
                    <div class="sidebar_widget">
                        <div class="widget-title"><h2>Popular Products</h2></div>
                        <div class="widget-content">
                            <div class="list list-sidebar-products">
                              <div class="grid">
                                @if($popularProduct)
                                @foreach ($popularProduct as $popular)
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image">
                                        <a class="grid-view-item__link" href="javascript:void(0)">
                                            <img class="grid-view-item__image" src="{{ asset('storage/images/products/'.$popular['image']) }}" alt="" style="height:71px;width:100px;"/>
                                        </a>
                                    </div>
                                    <div class="details"> <a class="grid-view-item__title" href="javascript:void(0)" style="text-decoration: none;">{{ $popular->name }}</a>
                                      <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">${{ number_format($popular->price,2) }}</span></span></div>
                                    </div>
                                  </div>
                                </div>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                    </div>
                    <!--End Popular Products-->
                    <!--Banner-->
                    <div class="sidebar_widget static-banner">
                        <img src="assets/images/side-banner-2.jpg" alt="" />
                    </div>
                    <!--Banner-->
                    <!--Information-->
                    {{-- <div class="sidebar_widget">
                        <div class="widget-title"><h2>Information</h2></div>
                        <div class="widget-content"><p>Use this text to share information about your brand with your customers. Describe a product, share announcements, or welcome customers to your store.</p></div>
                    </div> --}}
                    <!--end Information-->
                    <!--Product Tags-->
                    {{-- <div class="sidebar_widget">
                      <div class="widget-title">
                        <h2>Product Tags</h2>
                      </div>
                      <div class="widget-content">
                        <ul class="product-tags">
                          <li><a href="#" title="Show products matching tag $100 - $400">$100 - $400</a></li>
                          <li><a href="#" title="Show products matching tag $400 - $600">$400 - $600</a></li>
                          <li><a href="#" title="Show products matching tag $600 - $800">$600 - $800</a></li>
                          <li><a href="#" title="Show products matching tag Above $800">Above $800</a></li>
                          <li><a href="#" title="Show products matching tag Allen Vela">Allen Vela</a></li>
                          <li><a href="#" title="Show products matching tag Black">Black</a></li>
                          <li><a href="#" title="Show products matching tag Blue">Blue</a></li>
                          <li><a href="#" title="Show products matching tag Cantitate">Cantitate</a></li>
                          <li><a href="#" title="Show products matching tag Famiza">Famiza</a></li>
                          <li><a href="#" title="Show products matching tag Gray">Gray</a></li>
                          <li><a href="#" title="Show products matching tag Green">Green</a></li>
                          <li><a href="#" title="Show products matching tag Hot">Hot</a></li>
                          <li><a href="#" title="Show products matching tag jean shop">jean shop</a></li>
                          <li><a href="#" title="Show products matching tag jesse kamm">jesse kamm</a></li>
                          <li><a href="#" title="Show products matching tag L">L</a></li>
                          <li><a href="#" title="Show products matching tag Lardini">Lardini</a></li>
                          <li><a href="#" title="Show products matching tag lareida">lareida</a></li>
                          <li><a href="#" title="Show products matching tag Lirisla">Lirisla</a></li>
                          <li><a href="#" title="Show products matching tag M">M</a></li>
                          <li><a href="#" title="Show products matching tag mini-dress">mini-dress</a></li>
                          <li><a href="#" title="Show products matching tag Monark">Monark</a></li>
                          <li><a href="#" title="Show products matching tag Navy">Navy</a></li>
                          <li><a href="#" title="Show products matching tag new">new</a></li>
                          <li><a href="#" title="Show products matching tag new arrivals">new arrivals</a></li>
                          <li><a href="#" title="Show products matching tag Orange">Orange</a></li>
                          <li><a href="#" title="Show products matching tag oxford">oxford</a></li>
                          <li><a href="#" title="Show products matching tag Oxymat">Oxymat</a></li>
                        </ul>
                        <span class="btn btn--small btnview">View all</span> </div>
                    </div> --}}
                    <!--end Product Tags-->
                </div>
            </div>
            <!--End Sidebar-->
            <!--Main Content-->
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                <div class="category-description">
                    <h3></h3>
                    <p class="description"></p>
                </div>
                <hr>
                <div class="productList">
                    <!--Toolbar-->
                    <button type="button" class="btn btn-filter d-block d-md-none d-lg-none"> Product Filters</button>
                    <div class="toolbar">
                        <div class="filters-toolbar-wrapper">
                            <div class="row">
                                <div class="col-4 col-md-4 col-lg-4 filters-toolbar__item collection-view-as d-flex justify-content-start align-items-center">
                                    {{-- <a href="shop-left-sidebar.html" title="Grid View" class="change-view change-view--active">
                                        <img src="assets/images/grid.jpg" alt="Grid" />
                                    </a>
                                    <a href="shop-listview.html" title="List View" class="change-view">
                                        <img src="assets/images/list.jpg" alt="List" />
                                    </a> --}}
                                </div>
                                <div class="col-4 col-md-4 col-lg-4 text-center filters-toolbar__item filters-toolbar__item--count d-flex justify-content-center align-items-center">
                                    {{-- <span class="filters-toolbar__product-count">Showing: {{ $getProduct->total() }}</span> --}}
                                </div>
                                <div class="col-4 col-md-4 col-lg-4 text-right">
                                    {{-- <div class="filters-toolbar__item">
                                          <label for="SortBy" class="hidden">Sort</label>
                                          <select name="SortBy" id="SortBy" class="filters-toolbar__input filters-toolbar__input--sort">
                                            <option value="title-ascending" selected="selected">Sort</option>
                                            <option>Best Selling</option>
                                            <option>Alphabetically, A-Z</option>
                                            <option>Alphabetically, Z-A</option>
                                            <option>Price, low to high</option>
                                            <option>Price, high to low</option>
                                            <option>Date, new to old</option>
                                            <option>Date, old to new</option>
                                          </select>
                                          <input class="collection-header__default-sort" type="hidden" value="manual">
                                    </div> --}}
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--End Toolbar-->
                    <div class="grid-products grid--view-items">
                        <div class="row productrow">
                            
                        </div>
                    </div>
                    <p class="error" style="display:none"></p>
                </div>
                <hr class="clear">
                <div class="pagination">
                    {{-- <ul>
                      <li class="active"><a href="1">1</a></li>
                      <li><a href="2">2</a></li>
                      <li class="next"><a href="3"><i class="fa fa-caret-right" aria-hidden="true"></i></a></li>
                    </ul> --}}
                </div>
            </div>
            <!--End Main Content-->
        </div>
    <!--Quick View popup-->
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
                        <div class="product-details-img">
                            <div class="pl-20">
                                <img src="" class="pimage" style="height:302px; width: 335px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="product-single__meta">
                                <h2 class="product-single__title name"></h2>
                                <div class="prInfoRow">
                                    <div class="product-stock"> <span class="instock ">In Stock</span> <span class="outstock hide">Unavailable</span> </div>
                                    <div class="product-sku">SKU: <span class="variant-sku"></span></div>
                                </div>
                                <p class="product-single__price product-single__price-product-template">
                                    <span class="visually-hidden">Regular price</span>
                                    <s id="ComparePrice-product-template"><span class="money original"></span></s>
                                    <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                        <span id="ProductPrice-product-template"><span class="money price"></span></span>
                                    </span>
                                </p>
                                <div class="product-single__description rte description">
                                    
                                </div>
                                
                            <form method="post" action="#" id="product_form_10508262282" accept-charset="UTF-8" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">
                                @csrf
                                <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                    <div class="product-form__item">
                                      {{-- <label class="header">Color: <span class="slVariant">Red</span></label> --}}
                                      <div data-value="Red" class="swatch-element color red available">
                                        <input class="swatchInput" id="swatch-0-red" type="radio" name="option-0" value="Red">
                                        <label class="swatchLbl color medium rectangle small-img" for="swatch-0-red" style="" title="Red"></label>
                                      </div>
                                      <div data-value="Blue" class="swatch-element color blue available">
                                        <input class="swatchInput" id="swatch-0-blue" type="radio" name="option-0" value="Blue">
                                        <label class="swatchLbl color medium rectangle small-img" for="swatch-0-blue" style="" title="Blue"></label>
                                      </div>
                                      <div data-value="Green" class="swatch-element color green available">
                                        <input class="swatchInput" id="swatch-0-green" type="radio" name="option-0" value="Green">
                                        <label class="swatchLbl color medium rectangle small-img" for="swatch-0-green" style="" title="Green"></label>
                                      </div>
                                      <div data-value="Gray" class="swatch-element color gray available">
                                        <input class="swatchInput" id="swatch-0-gray" type="radio" name="option-0" value="Gray">
                                        <label class="swatchLbl color medium rectangle small-img" for="swatch-0-gray" style="" title="Gray"></label>
                                      </div>
                                    </div>
                                </div>
                                {{-- <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                    <div class="product-form__item">
                                      <label class="header">Size: <span class="slVariant">XS</span></label>
                                      <div data-value="XS" class="swatch-element xs available">
                                        <input class="swatchInput" id="swatch-1-xs" type="radio" name="option-1" value="XS">
                                        <label class="swatchLbl medium rectangle" for="swatch-1-xs" title="XS">XS</label>
                                      </div>
                                      <div data-value="S" class="swatch-element s available">
                                        <input class="swatchInput" id="swatch-1-s" type="radio" name="option-1" value="S">
                                        <label class="swatchLbl medium rectangle" for="swatch-1-s" title="S">S</label>
                                      </div>
                                      <div data-value="M" class="swatch-element m available">
                                        <input class="swatchInput" id="swatch-1-m" type="radio" name="option-1" value="M">
                                        <label class="swatchLbl medium rectangle" for="swatch-1-m" title="M">M</label>
                                      </div>
                                      <div data-value="L" class="swatch-element l available">
                                        <input class="swatchInput" id="swatch-1-l" type="radio" name="option-1" value="L">
                                        <label class="swatchLbl medium rectangle" for="swatch-1-l" title="L">L</label>
                                      </div>
                                    </div>
                                </div> --}}
                                <!-- Product Action -->
                                <div class="product-action clearfix">
                                    <div class="product-form__item--quantity">
                                        <div class="wrapQtyBtn">
                                            <div class="qtyField">
                                                <a class="qtyBtn minus aincr" href="javascript:void(0);"><i class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                                <input type="text" id="Quantity" name="qty" value="1" class="product-form__input qty myqty">
                                                <a class="qtyBtn plus adecr" href="javascript:void(0);"><i class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="product-id" name="id" value="">
                                    <div class="product-form__item--submit">
                                        <button type="button" name="add" class="btn product-form__cart-submit">
                                            <span>Add to cart</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- End Product Action -->
                            </form>
                            <div class="display-table shareRow">
                                    {{-- <div class="display-table-cell">
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="javascript:void(0)" title="Add to Wishlist"><i class="icon anm anm-heart-l" aria-hidden="true"></i> <span>Add to Wishlist</span></a>
                                        </div>
                                    </div> --}}
                            </div>
                        </div>
                </div>
            </div>
                <!--End-product-single-->
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Quick View popup-->
    </div>
@push('script')
<script>
$(".qtyBtn").on("click", function() {
      var qtyField = $(this).parent(".qtyField"),
         oldValue = $(qtyField).find(".qty").val(),
          newVal = 1;

      if ($(this).is(".aincr")) {
        newVal = parseInt(oldValue) + 1;
      } else if (oldValue > 1) {
        newVal = parseInt(oldValue) - 1;
      }
      $(qtyField).find(".qty").val(newVal);
});
$(document).ready(function () {
    $(".error").hide();
    var getData = {{ Js::from($getProduct) }};
    var data = getData.data;
    var links = `{!! $getProduct->links() !!}`;
    $(".pagination").html(links)
    showshopdata(data)
});
function showlinks(links){
    $(".pagination").html(links)
}

function showshopdata(data){
var shopHTML = "";
var userid = "{{ Auth::id() }}";
$.each(data, function (arr, elem) {
    shopHTML +=`<div class="col-6 col-sm-6 col-md-4 col-lg-4 item grid-products" id="grid-products">
        <!-- start product image -->
        <div class="product-image">
            <!-- start product image -->
            <a href="#">
                <!-- image -->
                <img class="primary blur-up lazyload" data-src="storage/images/products/${elem.image}"
                    src="storage/images/products/${elem.image}" alt="image" title="product"
                    style="height: 350px;">
                <!-- End image -->
                <!-- Hover image -->
                <img class="hover blur-up lazyload" data-src="storage/images/products/${elem.image}"
                    src="storage/images/products/${elem.image}" alt="image" title="product">
                <!-- End hover image -->
                <!-- product label -->
                <div class="product-labels rectangular"><span class="lbl on-sale">${Math.round(((elem.originalprice - elem.price) / elem.originalprice) * 100)}%</span> <span
                        class="lbl pr-label1">new</span></div>
                <!-- End product label -->
            </a>
            <!-- end product image -->
    
            <!-- Start product button -->
            <form class="variants add" action="#" onclick="" method="post">
                <input type="hidden" name="id" value="${elem.id}">
                <button class="btn btn-addto-cart" data-id="${elem.id}" data-userid="${userid}"
                    type="button">Select Options</button>
            </form>
            <div class="button-set">
                <a href="javascript:void(0)" title="Quick View" data-id="${elem.id}"
                    class="quick-view-popup quick-view show-product" data-toggle="modal" data-target="#content_quickview">
                    <i class="icon anm anm-search-plus-r"></i>
                </a>
                <div class="wishlist-btn">
                    <a class="wishlist add-to-wishlist" data-id="${elem.id}" data-userid="${userid}"
                        href="javascript:void(0)" title="Add to Wishlist">
                        <i class="icon anm anm-heart-l"></i>
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
                <a href="#">${elem.name}</a>
            </div>
            <!-- End product name -->
            <!-- product price -->
            <div class="product-price">
                <span class="old-price">${Number(elem.originalprice).toFixed(2)}</span>
                <span class="price">${Number(elem.price).toFixed(2)}</span>
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
                <li class="swatch medium rounded"><img src="storage/images/products/${elem.image}"
                        alt="image" /></li>
                <li class="swatch medium rounded"><img src="storage/images/products/${elem.image}"
                        alt="image" /></li>
                <li class="swatch medium rounded"><img src="storage/images/products/${elem.image}"
                        alt="image" /></li>
                <li class="swatch medium rounded"><img src="storage/images/products/${elem.image}"
                        alt="image" /></li>
                <li class="swatch medium rounded"><img src="storage/images/products/${elem.image}"
                        alt="image" /></li>
                <li class="swatch medium rounded"><img src="storage/images/products/${elem.image}"
                        alt="image" /></li>
            </ul>
            <!-- End Variant -->
        </div>
        <!-- End product details -->
    </div>`;
});
$('.productrow').html(shopHTML);
showProduct()
add()
loadCart()
addwish()
}
</script>
<script>
    function showProduct(){
    $(".show-product").click(function(){
        $("#my-loader").css('display','block');
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: "/getProductById/"+id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function (response) {
                    $("#my-loader").css('display','none');
                    var desc = (response.description).substring(1,400);
                    $(".product-id").val(response.id);
                    $(".prdname").html(response.name);
                    $(".variant-sku").html(response.sku);
                    $(".price").html(Number(response.price).toFixed(2));
                    $(".original").html(Number(response.originalprice).toFixed(2));
                    $(".pimage").attr('src', 'storage/images/products/'+response.image+'');
                    $(".small-img").attr('style', 'background-image:url(/storage/images/products/'+response.image+')');
                    $(".description").html(desc);
                },
            });
        })
        }
        </script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
        <script>
        $( function() {
        var minprice = "<?php echo $minprice;?>";
        var maxprice = "<?php echo $maxprice;?>";
        $("#slider-range" ).slider({
            range: true,
            min: parseFloat(minprice),
            max: parseFloat(maxprice),
            values: [ parseFloat(minprice), parseFloat(maxprice) ],
            slide: function( event, ui ) {
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            var value1 = ui.values[0];
            var value2 = ui.values[1];
            $('.productrow').html("");
            //$(".grid--view-items").html("");
            $.ajax({
                type: "GET",
                url: "shop",
                data: "min="+value1+"&max="+value2,
                cache: false,
                success: function(data){
                   showshopdata(data.getProduct.data)
                }
            });
            }
        });
        $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range" ).slider( "values", 1 ) );
        });
    $(".categoryitem").click(function(){
        let catid = $(this).attr("data-id");
        if(catid){
            $.ajax({
                type: "GET",
                url: "shop",
                data: {
                    "id": catid
                },
                dataType: "Json",
                success: function(data){
                    showlinks(data.getProduct.links)
                    showshopdata(data.getProduct.data)
                    $(".error").hide();
                    $(".error").show();
                    $(".error").html(data.message);
                    $(".description").html(data.desc)
                    $(".category-description h3").html(data.catname + " Description")
                }
            });
        }
    });
    function addwish(){
    $(".add-to-wishlist").on("click", function(){
        console.log('Hi');
        let prodid = $(this).attr("data-id");
        let userid = $(this).attr("data-userid");
        if(prodid != '' && userid != ''){
            $.ajax({
                type: "POST",
                url: "{{route('wishlist.store')}}",
                data: {
                    "product_id": prodid,
                    "user_id": userid,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response){
                    console.log(response);
                    loadWish();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Wishlist added Successfully!.',
                    })
                }
            });
        }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please Login first.',
                })        
        }
    })
    }
    $(".product-form__cart-submit").on("click", function(e){
        e.preventDefault();
        let productId = $(this).closest("#content_quickview").find(".product-id").val();
        let qty = $(this).closest("#content_quickview").find(".myqty").val();
        $.ajax({
            type: "POST",
            url: "addcart/"+productId,
            data: { 
                "id": productId,
                "qty": qty,
                "_token": "{{ csrf_token() }}"
             },
            success: function (response) {
                if(response.error){
                    $(".model-close-btn").click();
                    Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please Login first.',
                    })
                }
                if(response.success){
                    loadCart()
                    createData(response.product);
                    totalcalculate(response.product);
                    $(".model-close-btn").click();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Add to Cart Succesfully!!.',
                    })
                }                
            }
        });
    })
function add(){
    $('.btn-addto-cart').click(function (e) { 
    e.preventDefault();
    var prodid = $(this).attr("data-id");
    let userid = $(this).attr("data-userid");
    let url = "single/"+ prodid;
    if(prodid != '' && userid != ''){
    $.ajax({
        type: "post",
        url: "{{ route('recentview') }}",
        data: {
            "product_id": prodid,
            "user_id": userid,
            "_token": "{{ csrf_token() }}"
        },
        success: function (response) {
            //window.history.replaceState(null,null, url);
            window.location.href=url;
            console.log(response);
        }
    });
    }else{
        Swal.fire({
           icon: 'error',
           title: 'Error',
           text: 'Please Login first to view this product.',
        })
    }
});
}

// ajax
</script>
@endpush
@endsection