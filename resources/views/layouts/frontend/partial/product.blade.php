<div class="grid">
    <div class="product-pic">
        <img src="{{Storage::disk('public')->url('product_img/'.$product->product_image)}}" alt>
        @if ($product->product_regular_price > $product->product_discount_price)
        <span class="theme-badge-2">{{round(100 -(100*$product->product_discount_price)/$product->product_regular_price)}}% off</span>
        @endif
        <div class="actions">
            <ul>
                <li>
                    @guest
                    <a   href="{{route('wishlist.add.remove',$product->id)}}"><svg  role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a>
                    @else
                    <a class="{{Auth::user()->favorite_products()->where('product_id', $product->id)->count() == 1 ? 'bg-danger' : ''}}" href="javascript:void(0)"  onclick="favorite_add({{$product->id}})"><svg style="{{Auth::user()->favorite_products()->where('product_id', $product->id)->count() == 1 ? 'stroke: white;': ''}}" role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a>
                    @endguest

                </li>

                <li>
                    <a class="quickview_btn" data-bs-toggle="modal" href="#product-{{$product->id}}" role="button" tabindex="0"><svg width="48px" height="48px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Visible (eye)</title> <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z"/> <circle cx="12" cy="12" r="3"/> </svg></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="details">
        <h4><a href="{{route('product.details', $product->slug)}}">{{$product->name}}</a></h4>
        <p><a href="{{route('product.details', $product->slug)}}">{{Str::limit($product->product_description,60)}} </a></p>
        <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
        </div>
        <span class="price">
            <ins>
                <span class="woocommerce-Price-amount amount">
                    <bdi>
                        <span class="woocommerce-Price-currencySymbol">$</span>{{$product->product_discount_price}}
                    </bdi>
                </span>
            </ins>
             @if ($product->product_regular_price > $product->product_discount_price)
             <del aria-hidden="true">
                <span class="woocommerce-Price-amount amount">
                    <bdi>
                        <span class="woocommerce-Price-currencySymbol">$</span>{{$product->product_regular_price}}
                    </bdi>
                </span>
            </del>

             @endif
        </span>
        <div class="add-cart-area">
            <button class="add-to-cart" onclick="location.href='{{route('product.details', $product->slug)}}'">Add to cart</button>
        </div>
    </div>
</div>

<!-- product quick view modal - start
================================================== -->
<div class="modal fade" id="product-{{$product->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Product Quick View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="product_details">
                    <div class="container">
                        <div class="row">
                            <div class="col col-lg-6">
                                <div class="product_details_image p-0">
                                     <img src="{{Storage::disk('public')->url('product_img/product_details_img/'.$product->product_image)}}" alt>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="product_details_content">
                                    <h2 class="item_title">{{$product->name}}</h2>
                                    <p>
                                        {{Str::limit($product->product_description,100)}}
                                    </p>
                                    <div class="item_review">
                                        <ul class="rating_star ul_li">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
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


                                    <div class="quantity_wrap">
                                        <form action="{{route('cart.add',$product->id)}}" id="cart_form" method="POST">

                                        </form>


                                        <div class="total_price">
                                            Total: ${{$product->product_discount_price}}
                                        </div>
                                    </div>

                                    <ul class="default_btns_group ul_li">
                                        <li><a href="{{route('product.details',$product->slug)}}" class="addtocart_btn" id="update_btn" >Add To Cart</a></li>

                                        <li>
                                            @guest
                                            <a   href="{{route('wishlist.add.remove',$product->id)}}"><svg  style="width: 16px;height: 16px;stroke-width: 2; stroke: #686868;" role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a>
                                            @else
                                            <a class="{{Auth::user()->favorite_products()->where('product_id', $product->id)->count() == 1 ? 'bg-danger' : ''}}" href="javascript:void(0)"  onclick="favorite_add({{$product->id}})"><svg style="width: 16px;height: 16px;stroke-width: 2; stroke: #686868;{{Auth::user()->favorite_products()->where('product_id', $product->id)->count() == 1 ? 'stroke: white;': ''}}" role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a>
                                            @endguest
                                        </li>

                                    </ul>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product quick view modal - end
================================================== -->
