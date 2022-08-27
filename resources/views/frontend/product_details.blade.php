@extends('layouts.frontend.app')
@section('title','shop')
@push('css')
<style>

</style>
@endpush
@section('content')

<!-- main body - start
================================================== -->
<main>


    <!-- breadcrumb_section - start
    ================================================== -->
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="index.html">Home</a></li>
                <li>Product Details</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb_section - end
    ================================================== -->

    <!-- product_details - start
    ================================================== -->
    <section class="product_details section_space pb-0">
        <div class="container">
            <div class="row">
                <div class="col col-lg-6">
                    <div class="product_details_image">
                        <div class="details_image_carousel">
                            @forelse ($product->thumnailphotos as $thumnailphoto)
                            <div class="slider_item">
                                <img src="{{Storage::disk('public')->url('product_img/product_thumnail_image/'.$thumnailphoto->image)}}" alt>
                            </div>
                            @empty
                               <div class="card border" style="width: 680px; height: 400px"><div class="alert alert-danger">Image Not found</div></div>
                            @endforelse

                        </div>

                        <div class="details_image_carousel_nav">

                            @forelse ($product->thumnailphotos as $thumnailphoto)
                            <div class="slider_item">
                                <img src="{{Storage::disk('public')->url('product_img/product_thumnail_image/'.$thumnailphoto->image)}}" alt>
                            </div>
                            @empty
                               <div class="card border" style="width: 680px; height: 400px"><div class="alert alert-danger">Image Not found</div></div>
                            @endforelse


                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="product_details_content">
                        <h2 class="item_title">{{$product->name}}</h2>
                        <p>{{$product->product_description}}</p>
                        <p><small>Available stock : <span class="text-danger">{{$product->quantity}}</span></small></p>
                        <div class="item_review">
                            <ul class="rating_star ul_li">
                                <li><i class="fas fa-star"></i>></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star-half-alt"></i></li>
                            </ul>
                            <span class="review_value">3 Rating(s)</span>
                        </div>

                        <div class="item_price">
                            <span>${{$product->product_discount_price}}</span>
                            @if ($product->product_regular_price > $product->product_discount_price)
                            <del>${{$product->product_regular_price}}</del>
                            @endif
                        </div>
                        <hr>



                        <form action="{{route('cart.add',$product->id)}}" method="POST">
                            @csrf
                            <div class="quantity_wrap">
                                <div class="quantity_input">

                                    <button type="button" class="input_number_decrement">
                                        <i class="fal fa-minus"></i>
                                    </button>
                                    <input class="input_number" name="prduct_qunatity" type="text" value="1" min="1" max="{{$product->quantity}}">
                                    <button type="button" class="input_number_increment">
                                        <i class="fal fa-plus"></i>
                                    </button>
                                </div>
                                <div class="total_price">Total: ${{$product->product_discount_price}}</div>

                            </div>

                            <ul class="default_btns_group ul_li">
                                <li><button class="btn btn_primary addtocart_btn"  onclick="{{$product->quantity == 0 ? Toastr::error('stock not Available') : ''}}" type="submit">Add To Cart</button></li>
                            </ul>

                        </form>



                </div>
            </div>

            <div class="details_information_tab">
                <ul class="tabs_nav nav ul_li" role=tablist>
                    <li>
                        <button class="active" data-bs-toggle="tab" data-bs-target="#description_tab" type="button" role="tab" aria-controls="description_tab" aria-selected="true">
                        Description
                        </button>
                    </li>
                    <li>
                        <button data-bs-toggle="tab" data-bs-target="#additional_information_tab" type="button" role="tab" aria-controls="additional_information_tab" aria-selected="false">
                        Additional information
                        </button>
                    </li>
                    <li>
                        <button data-bs-toggle="tab" data-bs-target="#reviews_tab" type="button" role="tab" aria-controls="reviews_tab" aria-selected="false">
                        Reviews(2)
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="description_tab" role="tabpanel">
                        <p>{{$product->product_description}}</p>
                    </div>

                    <div class="tab-pane fade" id="additional_information_tab" role="tabpanel">
                       {!! $product->product_additional_infromation!!}
                    </div>

                    <div class="tab-pane fade" id="reviews_tab" role="tabpanel">
                        <div class="average_area">
                            <div class="row align-items-center">
                                <div class="col-md-12 order-last">
                                    <div class="average_rating_text">
                                        <ul class="rating_star ul_li_center">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                        <p class="mb-0">
                                        Average Star Rating: <span>4 out of 5</span> (2 vote)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="customer_reviews">
                            <h4 class="reviews_tab_title">2 reviews for this product</h4>
                            <div class="customer_review_item clearfix">
                                <div class="customer_image">
                                    <img src="{{asset('frontend/assets')}}/images/team/team_1.jpg" alt="image_not_found">
                                </div>
                                <div class="customer_content">
                                    <div class="customer_info">
                                        <ul class="rating_star ul_li">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star-half-alt"></i></li>
                                        </ul>
                                        <h4 class="customer_name">Aonathor troet</h4>
                                        <span class="comment_date">JUNE 2, 2021</span>
                                    </div>
                                    <p class="mb-0">Nice Product, I got one in black. Goes with anything!</p>
                                </div>
                            </div>

                            <div class="customer_review_item clearfix">
                                <div class="customer_image">
                                    <img src="{{asset('frontend/assets')}}/images/team/team_2.jpg" alt="image_not_found">
                                </div>
                                <div class="customer_content">
                                    <div class="customer_info">
                                        <ul class="rating_star ul_li">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star-half-alt"></i></li>
                                        </ul>
                                        <h4 class="customer_name">Danial obrain</h4>
                                        <span class="comment_date">JUNE 2, 2021</span>
                                    </div>
                                    <p class="mb-0">
                                    Great product quality, Great Design and Great Service.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="customer_review_form">
                            <h4 class="reviews_tab_title">Add a review</h4>
                            <form action="#">
                                <div class="form_item">
                                    <input type="text" name="name" placeholder="Your name*">
                                </div>
                                <div class="form_item">
                                    <input type="email" name="email" placeholder="Your Email*">
                                </div>
                                <div class="your_ratings">
                                    <h5>Your Ratings:</h5>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                </div>
                                <div class="form_item">
                                    <textarea name="comment" placeholder="Your Review*"></textarea>
                                </div>
                                <button type="submit" class="btn btn_primary">Submit Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product_details - end
    ================================================== -->

    <!-- related_products_section - start
    ================================================== -->
    <section class="related_products_section section_space">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="best-selling-products related-product-area">
                        <div class="sec-title-link">
                            <h3>Related products</h3>
                            {{-- <div class="view-all"><a href="#">View all<i class="fal fa-long-arrow-right"></i></a></div> --}}
                        </div>
                        <div class="product-area clearfix">
                            @foreach ($categories as $category)
                                @forelse ($category->products as $product)
                                @if ($product->id !=  $product_id)
                                    @include('layouts.frontend.partial.product')
                                @endif
                                @empty
                                <div class="card mb-5">
                                    <div class="card-body text-center"><div class="alert alert-danger">No product found :)</div></div>
                                </div>
                                @endforelse
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- related_products_section - end
    ================================================== -->



</main>
<!-- main body - end
================================================== -->

@endsection
