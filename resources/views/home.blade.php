@push('body-class', 'template-index belle template-index-belle')
@push('body-header-class', 'classicHeader')
@extends('layouts.app')
@section('content')
<!--Search Form Drawer-->
	
    <!--End Search Form Drawer-->
    <!--Top Header-->
    
    <!--End Top Header-->
    <!--Header-->
    
    <!--End Header-->
    <!--Mobile Menu-->
    
	<!--End Mobile Menu-->
    
    <!--Body Content-->
        <div class="collection-header">
            <div class="collection-hero">
                @if (!empty($banner))
                <div class="collection-hero__image"><img class="blur-up ls-is-cached lazyloaded" data-src="{{ asset('storage/images/banner/'.$banner->url) }}" src="{{ asset('storage/images/banner/'.$banner->url ?? '') }}" alt="Women" title="Women"></div>
                @endif
                {{-- <div class="collection-hero__title-wrapper"><h1 class="collection-hero__title page-width">Shop Grid 3 Column</h1></div> --}}
            </div>
        </div>
    	<!--Home slider-->
    	{{-- <div class="slideshow slideshow-wrapper pb-section sliderFull">
        	<div class="home-slideshow">
            	<div class="slide">
                	<div class="blur-up lazyload bg-size">
                        <img class="blur-up lazyload bg-img" data-src="{{ asset('storage/images/banner/Black_Friday_top_new.png') }}" src="{{ asset('storage/images/banner/Black_Friday_top_new.png') }}" alt="Shop Our New Collection" title="Shop Our New Collection" style="height: 100%;"/>
                        <img class="blur-up lazyload bg-img" data-src="{{ asset('storage/images/belle-banner1.jpg') }}" src="{{ asset('storage/images/belle-banner1.jpg') }}" alt="Shop Our New Collection" title="Shop Our New Collection" />
                        <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                            <div class="slideshow__text-content bottom">
                                <div class="wrap-caption center">
                                        <h2 class="h1 mega-title slideshow__title">Shop Our New Collection</h2>
                                        <span class="mega-subtitle slideshow__subtitle">From Hight to low, classic or modern. We have you covered</span>
                                        <a href="{{ route('shop') }}"><span class="btn">Shop now</span></a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide">
                	<div class="blur-up lazyload bg-size">
                        <img class="blur-up lazyload bg-img" data-src="{{ asset('storage/images/belle-banner2.jpg') }}" src="{{ asset('storage/images/belle-banner2.jpg') }}" alt="Summer Bikini Collection" title="Summer Bikini Collection" />
                        <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                            <div class="slideshow__text-content bottom">
                                <div class="wrap-caption center">
                                    <h2 class="h1 mega-title slideshow__title">Summer Bikini Collection</h2>
                                    <span class="mega-subtitle slideshow__subtitle">Save up to 50% off this weekend only</span>
                                    <a href="{{ route('shop') }}"><span class="btn">Shop now</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--End Home slider-->
        <!--Collection Tab slider-->
        <div class="tab-slider-product section">
        	<div class="container">
            	<div class="row">
                	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="section-header text-center">
                            <h2 class="h2">New Arrivals</h2>
                            <p>Browse the huge variety of our products</p>
                        </div>
                        <div class="tabs-listing">
                            {{-- <ul class="tabs clearfix">
                                <li class="active" rel="tab1">Women</li>
                                <li rel="tab2">Men</li>
                                <li rel="tab3">Sale</li>
                            </ul> --}}
                            <div class="tab_container">
                                <div id="tab1" class="tab_content grid-products">
                                    <div class="productSlider">
                                        @if ($allProducts)
                                        @forelse ($allProducts as $allProduct)
                                        <div class="col-12 item">
                                            <!-- start product image -->
                                            <div class="product-image">
                                                <!-- start product image -->
                                                <a href="short-description.html">
                                                    <!-- image -->
                                                    <img class="primary blur-up lazyload" data-src="{{ asset('storage/images/products/'.$allProduct['image']) }}" src="{{ asset('storage/images/products/'.$allProduct['image']) }}" alt="image" title="product" style="height:300px;">
                                                    <!-- End image -->
                                                    <!-- Hover image -->
                                                    <img class="hover blur-up lazyload" data-src="{{ asset('storage/images/products/'.$allProduct['image']) }}" src="{{ asset('storage/images/products/'.$allProduct['image']) }}" alt="image" title="product">
                                                    <!-- End hover image -->
                                                    <!-- product label -->
                                                    @php
                                                    $savePrice = $allProduct['originalprice'] - $allProduct['price'];
                                                    $getPercent = ($savePrice / $allProduct['originalprice']) * 100;
                                                    @endphp
                                                    <div class="product-labels rectangular"><span class="lbl on-sale">-{{ ceil($getPercent) }}%</span> <span class="lbl pr-label1">new</span></div>
                                                    <!-- End product label -->
                                                </a>
                                                <!-- end product image -->
                                                
                                                <!-- countdown start -->
                                        		<div class="saleTime desktop" data-countdown="2023/07/01"></div>
                                        		<!-- countdown end -->
        
                                                <!-- Start product button -->
                                                <form class="variants add" action="#" onclick="window.location.href='{{ route('single', $allProduct['id']) }}'"method="post">
                                                    <input type="hidden" name="id" value="{{ $allProduct['id'] }}">
                                                    <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                                                </form>
                                                <div class="button-set">
                                                    <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view show-product" data-id="{{ $allProduct['id'] ?? '' }}" data-toggle="modal" data-target="#content_quickview">
                                                        <i class="icon anm anm-search-plus-r"></i>
                                                    </a>
                                                    <div class="wishlist-btn">
                                                        <a class="wishlist add-to-wishlist" data-id="{{ $allProduct['id'] ?? '' }}" data-userid="{{ Auth::id() }}" href="javascript:void(0)" title="Add to Wishlist">
                                                            <i class="icon anm anm-heart-l"></i>
                                                        </a>
                                                    </div>
                                                    {{-- <div class="compare-btn">
                                                        <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                            <i class="icon anm anm-random-r"></i>
                                                        </a>
                                                    </div> --}}
                                                </div>
                                                <!-- end product button -->
                                            </div>
                                            <!-- end product image -->
                                            <!--start product details -->
                                            <div class="product-details text-center">
                                                <!-- product name -->
                                                <div class="product-name">
                                                    <a href="short-description.html">{{ $allProduct['name'] }}</a>
                                                </div>
                                                <!-- End product name -->
                                                <!-- product price -->
                                                <div class="product-price">
                                                    <span class="old-price">${{ number_format($allProduct['originalprice'],2) }}</span>
                                                    <span class="price">${{ number_format($allProduct['price'],2) }}</span>
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
                                                    <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$allProduct['image']) }}" alt="image" /></li>
                                                    <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$allProduct['image']) }}" alt="image" /></li>
                                                    <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$allProduct['image']) }}" alt="image" /></li>
                                                    <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$allProduct['image']) }}" alt="image" /></li>
                                                    <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$allProduct['image']) }}" alt="image" /></li>
                                                    <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$allProduct['image']) }}" alt="image" /></li>
                                                </ul>
                                                <!-- End Variant -->
                                            </div>
                                            <!-- End product details -->
                                        </div>
                                        @empty
                                        <p>No products found...</p>
                                        @endforelse
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
            	</div>    
            </div>
        </div>
        <!--Collection Tab slider-->
        
        <!--Collection Box slider-->
        <div class="collection-box section">
        	<div class="container-fluid">
				<div class="collection-grid">
                        @forelse ($categories as $category)
                        <div class="collection-grid-item">
                            <a href="javascript:void(0)" class="collection-grid-item__link">
                                <img data-src="{{ asset('storage/images/category/'.$category['image']) }}" src="{{ asset('storage/images/category/'.$category['image']) }}" alt="Fashion" class="blur-up lazyload"/>
                                <div class="collection-grid-item__title-wrapper">
                                    <h3 class="collection-grid-item__title btn btn--secondary no-border">{{ $category->name }}</h3>
                                </div>
                            </a>
                        </div>
                        @empty
                        <p>No categories found</p>
                        @endforelse
                    </div>
            </div>
        </div>
        <!--End Collection Box slider-->
        
        <!--Logo Slider-->
        <div class="section logo-section">
        	<div class="container">
            	<div class="row">
                	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                		<div class="logo-bar">
                    <div class="logo-bar__item">
                        <img src="{{ asset('assets/images/logo/brandlogo1.png') }}" alt="" title="" />
                    </div>
                    <div class="logo-bar__item">
                        <img src="{{ asset('assets/images/logo/brandlogo2.png') }}" alt="" title="" />
                    </div>
                    <div class="logo-bar__item">
                        <img src="{{ asset('assets/images/logo/brandlogo3.png') }}" alt="" title="" />
                    </div>
                    <div class="logo-bar__item">
                        <img src="{{ asset('assets/images/logo/brandlogo4.png') }}" alt="" title="" />
                    </div>
                    <div class="logo-bar__item">
                        <img src="{{ asset('assets/images/logo/brandlogo5.png') }}" alt="" title="" />
                    </div>
                    <div class="logo-bar__item">
                        <img src="{{ asset('assets/images/logo/brandlogo6.png') }}" alt="" title="" />
                    </div>
                </div>
                	</div>
                </div>
            </div>
        </div>
        <!--End Logo Slider-->
        
        <!--Featured Product-->
        {{-- <div class="product-rows section">
        	<div class="container">
            	<div class="row">
                	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
        				<div class="section-header text-center">
                            <h2 class="h2">Featured collection</h2>
                            <p>Our most popular products based on sales</p>
                        </div>
            		</div>
                </div>
                <div class="grid-products  grid-products-hover-btn">
                    <div class="productSlider-style1">
                        @forelse ($featureproducts as $products)
                        <div class="col-6 col-sm-6 col-md-4 col-lg-4 item grid-view-item style2">
                        	<div class="grid-view_image">
                                <!-- start product image -->
                                <a href="product-accordion.html" class="grid-view-item__link">
                                    <!-- image -->
                                    <img class="grid-view-item__image primary blur-up lazyload" data-src="{{ asset('storage/images/products/'.$products['image']) }}" src="{{ asset('storage/images/products/'.$products['image']) }}" alt="image" title="product">
                                    <!-- End image -->
                                    <!-- Hover image -->
                                    <img class="grid-view-item__image hover blur-up lazyload" data-src="{{ asset('storage/images/products/'.$products['image']) }}" src="{{ asset('storage/images/products/'.$products['image']) }}" alt="image" title="product">
                                    <!-- End hover image -->
                                    <!-- product label -->
                                    <div class="product-labels rectangular"><span class="lbl on-sale">-16%</span> <span class="lbl pr-label1">new</span></div>
                                    <!-- End product label -->
                                </a>
                                <!-- end product image -->
                                <!--start product details -->
                                <div class="product-details hoverDetails text-center mobile">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="product-accordion.html">{{ $products['name'] }}</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="old-price">$500.00</span>
                                        <span class="price">${{ number_format($products['price'],2) }}</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <!-- product button -->
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-id="{{ $products['id'] ?? '' }}" data-toggle="modal" data-target="#content_quickview">
                                            <i class="icon anm anm-search-plus-r"></i>
                                        </a>
                                        <!-- Start product button -->
                                        <form class="variants add" action="#" onclick="window.location.href='{{ route('single', $products['id']) }}'"method="post">
                                            <input type="hidden" name="id" value="{{ $allProduct['id'] }}">
                                            <button class="btn cartIcon btn-addto-cart" type="button" tabindex="0"><i class="icon anm anm-bag-l"></i></button>
                                        </form>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="wishlist.html">
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
                                <!-- Variant -->
                                <ul class="swatches text-center">
                                    <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$products['image']) }}" alt="image" /></li>
                                    <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$products['image']) }}" alt="image" /></li>
                                    <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$products['image']) }}" alt="image" /></li>
                                    <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$products['image']) }}" alt="image" /></li>
                                    <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$products['image']) }}" alt="image" /></li>
                                    <li class="swatch medium rounded"><img src="{{ asset('storage/images/products/'.$products['image']) }}" alt="image" /></li>
                                </ul>
                                <!-- End Variant -->
                                <!-- End product details -->
                            </div>
                        </div>
                        @empty
                        <p>No Feature products.....</p>
                        @endforelse
                    </div>
                </div>
                
           </div>
        </div> --}}
        <div class="section">
        <div class="container">
        <div class="grid-products grid-products-hover-btn">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2">Featured collection</h2>
                        <p>Our most popular products based on sales</p>
                    </div>
                </div>
            </div>
            <div class="productSlider-style1">
                @forelse ($featureproducts as $products)
                <div class="col-12 item grid-view-item style2">
                    <div class="grid-view_image">
                        <!-- start product image -->
                        <a href="product-layout-2.html" class="grid-view-item__link">
                            <!-- image -->
                            <img class="grid-view-item__image primary blur-up lazyload" data-src="{{ asset('storage/images/products/'.$products['image']) }}" src="{{ asset('storage/images/products/'.$products['image']) }}" alt="image" title="product">
                            <!-- End image -->
                            <!-- Hover image -->
                            <img class="grid-view-item__image hover blur-up lazyload" data-src="{{ asset('storage/images/products/'.$products['image']) }}" src="{{ asset('storage/images/products/'.$products['image']) }}" alt="image" title="product">
                            <!-- End hover image -->
                        </a>
                        <!-- end product image -->
                        <!--start product details -->
                        <div class="product-details hoverDetails text-center mobile">
                            <!-- product name -->
                            <div class="product-name">
                                <a href="product-layout-2.html">{{ $products['name'] }}</a>
                            </div>
                            <!-- End product name -->
                            <!-- product price -->
                            <div class="product-price">
                                <span class="old-price">$500.00</span>
                                <span class="price">${{ number_format($products['price'],2) }}</span>
                            </div>
                            <!-- End product price -->
                            
                            <!-- product button -->
                            <div class="button-set">
                                <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view show-product" data-id="{{ $products['id'] ?? '' }}" data-toggle="modal" data-target="#content_quickview">
                                    <i class="icon anm anm-search-plus-r"></i>
                                </a>
                                <!-- Start product button -->
                                <form class="variants add" action="#" onclick="window.location.href='{{ route('single', $products['id']) }}'" method="post">
                                    <input type="hidden" name="id" value="{{ $allProduct['id'] }}">
                                    <button class="btn cartIcon btn-addto-cart" type="button" tabindex="0"><i class="icon anm anm-bag-l"></i></button>
                                </form>
                                <div class="wishlist-btn">
                                    <a class="wishlist add-to-wishlist" data-id="{{ $allProduct['id'] ?? '' }}" data-userid="{{ Auth::id() }}" href="javascript:void(0)" title="Add to Wishlist">
                                        <i class="icon anm anm-heart-l"></i>
                                    </a>
                                </div>
                                {{-- <div class="compare-btn">
                                    <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                        <i class="icon anm anm-random-r"></i>
                                    </a>
                                </div> --}}
                            </div>
                            <!-- end product button -->
                        </div>
                        <!-- End product details -->
                    </div>
                </div>
                @empty
                <p>Not found</p>
                @endforelse
            </div>
        </div>
        <div class="grid-products grid-products-hover-btn">
            <div class="productSlider-style1">
                @forelse ($featureproducts as $products)
                <div class="col-12 item grid-view-item style2">
                    <div class="grid-view_image">
                        <!-- start product image -->
                        <a href="product-layout-2.html" class="grid-view-item__link">
                            <!-- image -->
                            <img class="grid-view-item__image primary blur-up lazyload" data-src="{{ asset('storage/images/products/'.$products['image']) }}" src="{{ asset('storage/images/products/'.$products['image']) }}" alt="image" title="product">
                            <!-- End image -->
                            <!-- Hover image -->
                            <img class="grid-view-item__image hover blur-up lazyload" data-src="{{ asset('storage/images/products/'.$products['image']) }}" src="{{ asset('storage/images/products/'.$products['image']) }}" alt="image" title="product">
                            <!-- End hover image -->
                        </a>
                        <!-- end product image -->
                        <!--start product details -->
                        <div class="product-details hoverDetails text-center mobile">
                            <!-- product name -->
                            <div class="product-name">
                                <a href="product-layout-2.html">{{ $products['name'] }}</a>
                            </div>
                            <!-- End product name -->
                            <!-- product price -->
                            <div class="product-price">
                                <span class="old-price">$500.00</span>
                                <span class="price">${{ number_format($products['price'],2) }}</span>
                            </div>
                            <!-- End product price -->
                            
                            <!-- product button -->
                            <div class="button-set">
                                <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view show-product" data-id="{{ $products['id'] ?? '' }}" data-toggle="modal" data-target="#content_quickview">
                                    <i class="icon anm anm-search-plus-r"></i>
                                </a>
                                <!-- Start product button -->
                                <form class="variants add" action="#" onclick="window.location.href='{{ route('single', $products['id']) }}'" method="post">
                                    <input type="hidden" name="id" value="{{ $allProduct['id'] }}">
                                    <button class="btn cartIcon btn-addto-cart" type="button" tabindex="0"><i class="icon anm anm-bag-l"></i></button>
                                </form>
                                <div class="wishlist-btn">
                                    <a class="wishlist add-to-wishlist" data-id="{{ $allProduct['id'] ?? '' }}" data-userid="{{ Auth::id() }}" href="javascript:void(0)" title="Add to Wishlist">
                                        <i class="icon anm anm-heart-l"></i>
                                    </a>
                                </div>
                                {{-- <div class="compare-btn">
                                    <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                        <i class="icon anm anm-random-r"></i>
                                    </a>
                                </div> --}}
                            </div>
                            <!-- end product button -->
                        </div>
                        <!-- End product details -->
                    </div>
                </div>
                @empty
                <p>Not found</p>
                @endforelse
            </div>
        </div>
        </div>
        </div>
        <!--End Featured Product-->
        
        <!--Latest Blog-->
        <div class="latest-blog section pt-0">
        	<div class="container">
            	<div class="row">
                	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
        				<div class="section-header text-center">
      						<h2 class="h2">Latest From our Blog</h2>
					    </div>
            		</div>
                </div>
            	<div class="row">
                	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    	<div class="wrap-blog">
                        	<a href="blog-left-sidebar.html" class="article__grid-image">
              					<img src="{{ asset('assets/images/blog/post-img1.jpg') }}" alt="It's all about how you wear" title="It's all about how you wear" class="blur-up lazyloaded"/>
				            </a>
                            <div class="article__grid-meta article__grid-meta--has-image">
                                <div class="wrap-blog-inner">
                                    <h2 class="h3 article__title">
                                      <a href="blog-left-sidebar.html">It's all about how you wear</a>
                                    </h2>
                                    <span class="article__date">May 02, 2017</span>
                                    <div class="rte article__grid-excerpt">
                                        I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account...
                                    </div>
                                    <ul class="list--inline article__meta-buttons">
                                    	<li><a href="blog-article.html">Read more</a></li>
                                    </ul>
                                </div>
							</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    	<div class="wrap-blog">
                        	<a href="blog-left-sidebar.html" class="article__grid-image">
              					<img src="{{ asset('assets/images/blog/post-img2.jpg') }}" alt="27 Days of Spring Fashion Recap" title="27 Days of Spring Fashion Recap" class="blur-up lazyloaded"/>
				            </a>
                            <div class="article__grid-meta article__grid-meta--has-image">
                                <div class="wrap-blog-inner">
                                    <h2 class="h3 article__title">
                                      <a href="blog-right-sidebar.html">27 Days of Spring Fashion Recap</a>
                                    </h2>
                                    <span class="article__date">May 02, 2017</span>
                                    <div class="rte article__grid-excerpt">
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab...
                                    </div>
                                    <ul class="list--inline article__meta-buttons">
                                    	<li><a href="blog-article.html">Read more</a></li>
                                    </ul>
                                </div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Latest Blog-->
        
        <!--Store Feature-->
        <div class="store-feature section">
        	<div class="container">
            	<div class="row">
                	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    	<ul class="display-table store-info">
                        	<li class="display-table-cell">
                            	<i class="icon anm anm-truck-l"></i>
                            	<h5>Free Shipping &amp; Return</h5>
                            	<span class="sub-text">Free shipping on all US orders</span>
                            </li>
                          	<li class="display-table-cell">
                            	<i class="icon anm anm-dollar-sign-r"></i>
                                <h5>Money Guarantee</h5>
                                <span class="sub-text">30 days money back guarantee</span>
                          	</li>
                          	<li class="display-table-cell">
                            	<i class="icon anm anm-comments-l"></i>
                                <h5>Online Support</h5>
                                <span class="sub-text">We support online 24/7 on day</span>
                            </li>
                          	<li class="display-table-cell">
                            	<i class="icon anm anm-credit-card-front-r"></i>
                                <h5>Secure Payments</h5>
                                <span class="sub-text">All payment are Secured and trusted.</span>
                        	</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--End Store Feature-->
    </div>
    <!--End Body Content-->
    
    <!--Footer-->
    
    <!--End Footer-->
    <!--Scoll Top-->
    <!--End Scoll Top-->
    @push('page')
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
                                    <s id="ComparePrice-product-template"><span class="money regular"></span></s>
                                    <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                        <span id="ProductPrice-product-template"><span class="money price-product"></span></span>
                                    </span>
                                </p>
                                <div class="product-single__description rte description">
                                    
                                </div>
                                
                            <form method="post" action="{{ route('addcart', $allProduct->id) }}" id="product_form_10508262282" accept-charset="UTF-8" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">
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
                                                <a class="qtyBtn minus incr" href="javascript:void(0);"><i class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                                <input type="text" id="Quantity" name="qty" value="1" class="product-form__input qty myqty">
                                                <a class="qtyBtn plus decr" href="javascript:void(0);"><i class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="product-id" name="id" value="">
                                    <div class="product-form__item--submit">
                                        <button type="submit" name="add" class="btn product-form__cart-submit">
                                            <span>Add to cart</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- End Product Action -->
                            </form>
                            <div class="display-table shareRow">
                                    <div class="display-table-cell">
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" data-id="{{ $allProduct['id'] ?? '' }}" data-userid="{{ Auth::id() }}" href="javascript:void(0)" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l" aria-hidden="true"></i> <span>Add to Wishlist</span>
                                            </a>
                                        </div>
                                    </div>
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
    {{-- <div class="newsletter-wrap" id="popup-container">
        <div id="popup-window">
          <a class="btn closepopup"><i class="icon icon anm anm-times-l"></i></a>
          <!-- Modal content-->
          <div class="display-table splash-bg">
            <div class="display-table-cell width40"><img src="{{ asset('assets/images/newsletter-img.jpg') }}" alt="Join Our Mailing List" title="Join Our Mailing List" /> </div>
                <div class="display-table-cell width60 text-center">
                    <div class="newsletter-left">
                        <h2>Join Our Mailing List</h2>
                        <p>Sign Up for our exclusive email list and be the first to know about new products and special offers</p>
                        <form action="#" method="post">
                        <div class="input-group">
                            <input type="email" class="input-group__field newsletter__input" name="EMAIL" value="" placeholder="Email address" required="">
                                <span class="input-group__btn">
                                <button type="submit" class="btn newsletter__submit" name="commit" id="subscribeBtn"> <span class="newsletter__submit-text--large">Subscribe</span> </button>
                                </span>
                        </div>
                        </form>
                        <ul class="list--inline site-footer__social-icons social-icons">
                        <li><a class="social-icons__link" href="#" title="Facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                        <li><a class="social-icons__link" href="#" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a class="social-icons__link" href="#" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                        <li><a class="social-icons__link" href="#" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a class="social-icons__link" href="#" title="YouTube"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                        <li><a class="social-icons__link" href="#" title="Vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endpush
<!--End For Newsletter Popup-->
@push('script')
<script>
    $(".qtyBtn").on("click", function() {
      var qtyField = $(this).closest(".wrapQtyBtn").find(".qtyField"),
         oldValue = $(qtyField).find(".qty").val(),
          newVal = 1;

      if ($(this).is(".incr")) {
        newVal = parseInt(oldValue) + 1;
      } else if (oldValue > 1) {
        newVal = parseInt(oldValue) - 1;
      }
      $(qtyField).find(".qty").val(newVal);
    });
    function dropdown(){
		$(".site-header__cart").on("click", function(i) {
			i.preventDefault();
			$("#header-cart").slideToggle();
		});
	  }
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
                    $(".regular").html(Number(response.originalprice).toFixed(2));
                    $(".price-product").html(Number(response.price).toFixed(2));
                    $(".pimage").attr('src', 'storage/images/products/'+response.image+'');
                    $(".small-img").attr('style', 'background-image:url(/storage/images/products/'+response.image+')');
                    $(".description").html(desc);
                },
            });
        })
        $('[data-countdown]').countdown('2023/10/01').on('update.countdown', function(event) {
        $(".days .time-count").html(event.strftime('%-d'));
        $(".hour .time-count").html(event.strftime('%H'));
        $(".minutes .time-count").html(event.strftime('%M'));
        $(".second .time-count").html(event.strftime('%S'));
        });
    $(".add-to-wishlist").click(function(){
        let prodid = $(this).closest('.wishlist-btn').find('.add-to-wishlist').attr("data-id");
        let userid = $(this).closest('.wishlist-btn').find('.add-to-wishlist').attr("data-userid");
        if(prodid != '' && userid != ''){
            $.ajax({
                type: "POST",
                url: "{{route('wishstore')}}",
                data: {
                    "product_id": prodid,
                    "user_id": userid,
                    "_token": "{{ csrf_token() }}"
                },
                cache: false,
                success: function(response){
                    loadWish();
                    console.log(response);
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
                    $(".model-close-btn").click();
                    createData(response.product);
                    loadCart()
                    totalcalculate(response.product);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Add to Cart Succesfully!!.',
                    })
                }
            }
        });
    })
</script>
@endpush
@endsection