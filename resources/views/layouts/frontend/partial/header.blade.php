<!-- sidebar cart - start
================================================== -->
<div class="sidebar-menu-wrapper">
    <div class="cart_sidebar {{session('active') ? 'active': '' }}">
        <button type="button" class="close_btn"><i class="fal fa-times"></i></button>

            <ul class="cart_items_list ul_li_block mb_30 clearfix">
                @php
                    $total = 0;
                @endphp
                @auth

                @forelse (Auth::user()->carts as $cart)
                <li>
                 <div class="item_image">
                     <img src="{{Storage::disk('public')->url('product_img/'. $cart->product->product_image)}}" alt>
                 </div>
                 <div class="item_content">
                     <h4 class="item_title">{{Str::limit($cart->product->name, 10)}}</h4>
                     <span class="item_price">${{$cart->product->product_discount_price}}</span>
                     @php
                         $total += $cart->product->product_discount_price * $cart->amount
                     @endphp
                 </div>
                 <button type="button" onclick="window.location.href=''" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
             </li>
             @empty
              <div class="alert alert-danger">Empty</div>
                @endforelse
                @endauth

            </ul>

        <ul class="total_price ul_li_block mb_30 clearfix">

            <li>
                <span>Subtotal:</span>
                <span>${{$total}}</span>
            </li>


        </ul>

        <ul class="btns_group ul_li_block clearfix">
            <li><a class="btn btn_primary" href="{{route('cart.index')}}">View Cart</a></li>

        </ul>


    </div>

    <div class="cart_overlay"></div>
</div>
<!-- sidebar cart - end
================================================== -->
<header class="header_section header-style-no-collapse">
    <div class="header_top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col col-md-6">
                    <ul class="header_select_options ul_li">


                    </ul>
                </div>
                <div class="col col-md-6">
                    <p class="header_hotline">Call us toll free: <strong>+1888 234 5678</strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="header_middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col col-lg-3 col-md-3 col-sm-12">
                    <div class="brand_logo">
                        <a class="brand_link" href="{{route('frontend')}}">
                            <img src="{{asset('frontend/assets')}}/images/logo/logo_1x.png" srcset="assets/images/logo/logo_2x.png 2x" alt>
                        </a>
                    </div>
                </div>
                <div class="col col-lg-6 col-md-6 col-sm-12">
                    <form action="{{route('search')}}" method="POST">
                        @csrf
                        <div class="advance_serach">
                            <div class="form_item" style="width: 100%;">
                                <input type="search" name="search" placeholder="Search Prudcts...">
                                <button type="submit" class="search_btn"><i class="far fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col col-lg-3 col-md-3 mb-5 col-sm-12">
                    <button class="mobile_menu_btn2 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu_dropdown" aria-controls="main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fal fa-bars"></i>
                    </button>
                    <button type="button" class="cart_btn">
                       <ul class="header_icons_group ul_li_right">

                            <li>
                                <span class="cart_icon">
                                    <i class="icon icon-ShoppingCart"></i>
                                    @auth
                                    <small class="cart_counter">{{Auth::user()->carts->count()}}</small>
                                    @else
                                    <small class="cart_counter">0</small>
                                    @endauth
                                </span>
                            </li>
                       </ul>
                    </button>
                </div>

            </div>
        </div>
    </div>


    <div class="header_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col col-md-3">
                    <div class="allcategories_dropdown">
                        <button class="allcategories_btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#allcategories_collapse" aria-expanded="false" aria-controls="allcategories_collapse">
                            <svg role="img" xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" aria-labelledby="statsIconTitle" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none" color="#000"> <title id="statsIconTitle">Stats</title> <path d="M6 7L15 7M6 12L18 12M6 17L12 17"></path> </svg>
                            Browse categories
                        </button>
                        <div class="allcategories_collapse collapse {{!Request::is('/') ? 'collapsing': ''}} " id="allcategories_collapse" style="">
                            <div class="card card-body">
                                <ul class="allcategories_list ul_li_block">
                                    @foreach (categories() as $category)
                                    <li><a href="{{route('categorywiseProduct',$category->slug)}}"><i class="fas fa-chevron-right"></i> {{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col col-md-6">
                    <nav class="main_menu navbar navbar-expand-lg">
                        <div class="main_menu_inner collapse navbar-collapse" id="main_menu_dropdown">
                            <button type="button" class="offcanvas_close">
                                <i class="fal fa-times"></i>
                            </button>
                            <ul class="main_menu_list ul_li">
                                <li><a class="nav-link" href="{{route('frontend')}}">Home</a></li>
                                <li><a class="nav-link" href="{{route('shop')}}">Shop</a></li>
                                <li><a class="nav-link" href="{{route('contact.index')}}">Contact Us</a></li>
                                @auth
                                    @if (Auth::user()->role == 1)
                                        <li>
                                            <a href="{{route('admindashboard')}}">Dashboard</a>
                                        </li>
                                        @else
                                        <li><a class="nav-link" href="{{route('frontend.dashboard')}}">Dashboard</a></li>
                                    @endif
                                @endauth
                            </ul>
                        </div>
                    </nav>
                    <div class="offcanvas_overlay"></div>
                </div>

                <div class="col col-md-3">
                    <ul class="header_icons_group ul_li_right">
                        @auth
                        <li>
                            @if (Auth::user()->role == 1)
                            <li>
                                <a href="{{route('admindashboard')}}">{{auth::user()->name}}</a>
                            </li>
                            @else
                            <li>
                                <a href="{{route('frontend.dashboard')}}">{{auth::user()->name}}</a>
                                {{-- <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">{{auth::user()->name}}</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form> --}}
                            </li>
                            @endif

                        </li>
                        @else
                        <li>
                            <a class="text-danger" href="{{route('login')}}">Login/Register</a>
                        </li>
                        @endauth


                        <li >
                            <a href="{{route('wishlist.index')}}">
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" stroke="#051d43" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"></path> </svg>
                                <span class="wishlist_counter">
                                    @auth
                                    {{Auth::user()->favorite_products->count()}}
                                        @else
                                        0
                                    @endauth
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
