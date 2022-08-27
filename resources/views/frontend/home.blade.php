@extends('layouts.frontend.app')

@section('title','home')

@section('content')

<!-- slider_section - start
================================================== -->
<section class="slider_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-3">
                <div class="main_slider" data-slick='{"arrows": false}'>
                    <div class="slider_item set-bg-image" data-background="{{asset('frontend/assets')}}/images/slider/slide-2.jpg">
                        <div class="slider_content">
                            <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Clothing</h3>
                            <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">Smart blood  <span>Pressure monitor</span></h4>
                            <p data-animation="fadeInUp2" data-delay=".6s">The best gadgets collection 2021</p>
                            <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                                <del>$430.00</del>
                                <span class="sale_price">$350.00</span>
                            </div>
                            <a class="btn btn_primary" href="shop_details.html" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                        </div>
                    </div>
                    <div class="slider_item set-bg-image" data-background="{{asset('frontend/assets')}}/images/slider/slide-3.jpg">
                        <div class="slider_content">
                            <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Clothing</h3>
                            <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">Smart blood  <span>Pressure monitor</span></h4>
                            <p data-animation="fadeInUp2" data-delay=".6s">The best gadgets collection 2021</p>
                            <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                                <del>$430.00</del>
                                <span class="sale_price">$350.00</span>
                            </div>
                            <a class="btn btn_primary" href="shop_details.html" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                        </div>
                    </div>
                    <div class="slider_item set-bg-image" data-background="{{asset('frontend/assets')}}/images/slider/slide-1.jpg">
                        <div class="slider_content">
                            <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Clothing</h3>
                            <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">Smart blood  <span>Pressure monitor</span></h4>
                            <p data-animation="fadeInUp2" data-delay=".6s">The best gadgets collection 2021</p>
                            <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                                <del>$430.00</del>
                                <span class="sale_price">$350.00</span>
                            </div>
                            <a class="btn btn_primary" href="shop_details.html" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- slider_section - end
================================================== -->

<!-- policy_section - start
================================================== -->
<section class="policy_section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="policy-wrap">
                    <div class="policy_item">
                        <div class="item_icon">
                            <i class="icon icon-Truck"></i>
                        </div>
                        <div class="item_content">
                            <h3 class="item_title">Free Shipping</h3>
                            <p>
                                Free shipping on all US order
                            </p>
                        </div>
                    </div>

                    <div class="policy_item">
                        <div class="item_icon">
                            <i class="icon icon-Headset"></i>
                        </div>
                        <div class="item_content">
                            <h3 class="item_title">Support 24/ 7</h3>
                            <p>
                                Contact us 24 hours a day
                            </p>
                        </div>
                    </div>

                    <div class="policy_item">
                        <div class="item_icon">
                            <i class="icon icon-Wallet"></i>
                        </div>
                        <div class="item_content">
                            <h3 class="item_title">100% Money Back</h3>
                            <p>
                                You have 30 days to Return
                            </p>
                        </div>
                    </div>

                    <div class="policy_item">
                        <div class="item_icon">
                            <i class="icon icon-Starship"></i>
                        </div>
                        <div class="item_content">
                            <h3 class="item_title">90 Days Return</h3>
                            <p>
                                If goods have problems
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>
<!-- policy_section - end
================================================== -->

<!-- products-with-sidebar-section - start
================================================== -->
<section class="products-with-sidebar-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-lg-3">
                <div class="best-selling-products">
                    <div class="sec-title-link">
                        <h3>Best product</h3>
                        <div class="view-all"><a href="#">View all<i class="fal fa-long-arrow-right"></i></a></div>
                    </div>
                    <div class="product-area clearfix">
                        @forelse (products() as $product)
                            @include('layouts.frontend.partial.product')
                        @empty
                                <div class="card mb-5">
                                <div class="card-body text-center"><div class="alert alert-danger">No product found :)</div></div>
                                </div>
                        @endforelse

                    </div>
                </div>

                <div class="top_category_wrap">
                    <div class="sec-title-link">
                        <h3>Top categories</h3>
                    </div>
                    <div class="top_category_carousel2" data-slick='{"dots": false}'>
                    @forelse (categories() as $category)
                    <div class="slider_item">
                        <div class="category_boxed">
                            <a href="{{route('categorywiseProduct',$category->slug)}}">
                                    <span class="item_image">
                                        <img src="{{Storage::disk('public')->url('category/'.$category->category_image)}}" alt="image_not_found">
                                    </span>
                                <span class="item_title">{{$category->name}}</span>
                            </a>
                        </div>
                    </div>
                        @empty
                            <div class="card mb-5">
                                <div class="card-body text-center"><div class="alert alert-danger">No found category :)</div></div>
                            </div>
                        @endforelse


                    </div>
                    <div class="carousel_nav carousel-nav-top-right">
                        <button type="button" class="tc_left_arrow"><i class="fal fa-long-arrow-alt-left"></i></button>
                        <button type="button" class="tc_right_arrow"><i class="fal fa-long-arrow-alt-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 order-lg-9">
                <div class="product-sidebar">
                    <div class="widget latest_product_carousel">
                        <div class="title_wrap">
                            <h3 class="area_title">Latest Products</h3>
                            <div class="carousel_nav">
                                <button type="button" class="vs4i_left_arrow"><i class="fal fa-angle-left"></i></button>
                                <button type="button" class="vs4i_right_arrow"><i class="fal fa-angle-right"></i></button>
                            </div>
                        </div>
                        <div class="vertical_slider_4item" data-slick='{"dots": false}'>
                            @forelse (latestproducts() as $product)
                            <div class="slider_item">
                                <div class="small_product_layout">
                                    <a class="item_image" href="{{route('product.details', $product->slug)}}">
                                        <img width="80" src="{{Storage::disk('public')->url('product_img/product_details_img/'.$product->product_image)}}"  alt="image_not_found">
                                    </a>
                                    <div class="item_content">
                                        <h3 class="item_title">
                                            <a href="{{route('product.details', $product->slug)}}">{{Str::limit($product->name, 15)}}</a>
                                        </h3>
                                        <ul class="rating_star ul_li">
                                            <li>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </li>
                                        </ul>
                                        <div class="item_price">
                                            <span>${{$product->product_discount_price}}</span>
                                            @if ($product->product_regular_price > $product->product_discount_price)
                                            <del>${{$product->product_regular_price}}</del>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="card mb-5">
                                    <div class="card-body text-center"><div class="alert alert-danger">No product found :)</div></div>
                                </div>
                            @endforelse


                        </div>
                    </div>
                    <div class="widget product-add">
                        <div class="product-img">
                            <img src="{{asset('frontend/assets')}}/images/shop/product_img_10.png" alt>
                        </div>
                        <div class="details">
                            <h4>iPad pro</h4>
                            <p>iPad pro with M1 chipe</p>
                            <a class="btn btn_primary" href="{{route('shop')}}" >Start Buying</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div> <!-- end container  -->
</section>
<!-- products-with-sidebar-section - end
================================================== -->


<!-- promotion_section - start
================================================== -->
<section class="promotion_section">
    <div class="container">
        <div class="row promotion_banner_wrap">
            <div class="col col-lg-6">
                <div class="promotion_banner">
                    <div class="item_image">
                        <img src="{{asset('frontend/assets')}}/images/promotion/banner_img_1.png" alt>
                    </div>
                    <div class="item_content">
                        <h3 class="item_title">Protective sleeves <span>combo.</span></h3>
                        <p>It is a long established fact that a reader will be distracted</p>
                        <a class="btn btn_primary" href="{{route('shop')}}">Shop Now</a>
                    </div>
                </div>
            </div>

            <div class="col col-lg-6">
                <div class="promotion_banner">
                    <div class="item_image">
                        <img src="{{asset('frontend/assets')}}/images/promotion/banner_img_2.png" alt>
                    </div>
                    <div class="item_content">
                        <h3 class="item_title">Nutrillet blender <span>combo.</span></h3>
                        <p>
                            It is a long established fact that a reader will be distracted
                        </p>
                        <a class="btn btn_primary" href="{{route('shop')}}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- promotion_section - end
================================================== -->

<!-- new_arrivals_section - start
================================================== -->
<section class="new_arrivals_section section_space">
    <div class="container">
        <div class="sec-title-link">
            <h3>New Arrivals</h3>
        </div>

        <div class="row newarrivals_products">
            <div class="col col-lg-5">
                <div class="deals_product_layout1">
                    <div class="bg_area">
                        <h3 class="item_title">Best <span>Product</span> Deals</h3>
                        <p>
                            Get a 20% Cashback when buying TWS Product From SoundPro Audio Technology.
                        </p>
                        <a class="btn btn_primary" href="{{route('shop')}}">Shop Now</a>
                    </div>
                </div>
            </div>

            <div class="col col-lg-7">
                <div class="new-arrivals-grids clearfix">
                    @forelse (newproducts() as $product)
                    @include('layouts.frontend.partial.product')
                    @empty
                        <div class="card mb-5">
                            <div class="card-body text-center"><div class="alert alert-danger">No product found :)</div></div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<!-- new_arrivals_section - end
================================================== -->

<!-- brand_section - start
================================================== -->
<div class="brand_section pb-0 mb-2">
    <div class="container">
        <div class="brand_carousel">
            <div class="slider_item">
                <a class="product_brand_logo" href="#!">
                    <img src="{{asset('frontend/assets')}}/images/brand/brand_1.png" alt="image_not_found">
                    <img src="{{asset('frontend/assets')}}/images/brand/brand_1.png" alt="image_not_found">
                </a>
            </div>
            <div class="slider_item">
                <a class="product_brand_logo" href="#!">
                    <img src="{{asset('frontend/assets')}}/images/brand/brand_2.png" alt="image_not_found">
                    <img src="{{asset('frontend/assets')}}/images/brand/brand_2.png" alt="image_not_found">
                </a>
            </div>
            <div class="slider_item">
                <a class="product_brand_logo" href="#!">
                    <img src="{{asset('frontend/assets')}}/images/brand/brand_3.png" alt="image_not_found">
                    <img src="{{asset('frontend/assets')}}/images/brand/brand_3.png" alt="image_not_found">
                </a>
            </div>
            <div class="slider_item">
                <a class="product_brand_logo" href="#!">
                    <img src="{{asset('frontend/assets')}}/images/brand/brand_4.png" alt="image_not_found">
                    <img src="{{asset('frontend/assets')}}/images/brand/brand_4.png" alt="image_not_found">
                </a>
            </div>
            <div class="slider_item">
                <a class="product_brand_logo" href="#!">
                    <img src="{{asset('frontend/assets')}}/images/brand/brand_5.png" alt="image_not_found">
                    <img src="{{asset('frontend/assets')}}/images/brand/brand_5.png" alt="image_not_found">
                </a>
            </div>
        </div>
    </div>
</div>
<!-- brand_section - end
================================================== -->




@endsection
