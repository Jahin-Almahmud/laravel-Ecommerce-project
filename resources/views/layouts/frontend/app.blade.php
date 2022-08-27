
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') -  Best Ecommerce website</title>
    <link rel="shortcut icon" href="{{asset('frontend/assets')}}/images/logo/favourite_icon_1.png">

    <!-- fraimwork - css include -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets')}}/css/bootstrap.min.css">

    <!-- icon font - css include -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets')}}/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets')}}/css/stroke-gap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets')}}/css/icofont.css">

    <!-- animation - css include -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets')}}/css/animate.css">

    <!-- carousel - css include -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets')}}/css/slick.css">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets')}}/css/slick-theme.css">

    <!-- popup - css include -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets')}}/css/magnific-popup.css">

    <!-- jquery-ui - css include -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets')}}/css/jquery-ui.css">

    <!-- select option - css include -->


    <!-- woocommercen - css include -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets')}}/css/woocommerce.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- custom - css include -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets')}}/css/style.css">
    @stack('css')

</head>

<body>

    <!-- body_wrap - start -->
    <div class="body_wrap">

        <!-- backtotop - start -->
        <div class="backtotop">
            <a href="#" class="scroll">
                <i class="far fa-arrow-up"></i>
            </a>
        </div>
        <!-- backtotop - end -->

        <!-- preloader - start -->
        <div id="preloader"></div>
        <!-- preloader - end -->


        <!-- header_section - start
        ================================================== -->
         @include('layouts.frontend.partial.header')
        <!-- header_section - end
        ================================================== -->

        <!-- main body - start
        ================================================== -->
        <main>

    @yield('content')

        </main>
        <!-- main body - end
        ================================================== -->
<!-- newsletter_section - start
================================================== -->
<section class="newsletter_section mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col col-lg-6">
                <h2 class="newsletter_title text-white">Sign Up for Newsletter </h2>
                <p>Get E-mail updates about our latest products and special offers.</p>
            </div>
            <div class="col col-lg-6">
                <form action="{{route('Subscriber')}}" method="POST">
                    @csrf
                    <div class="newsletter_form">
                        <input type="email" name="email" placeholder="Enter your email address">
                        <button type="submit" class="btn btn_secondary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- newsletter_section - end
================================================== -->
        <!-- footer_section - start
        ================================================== -->
        <footer class="footer_section">
            <div class="footer_widget_area">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-4 col-md-6 col-sm-6">
                            <div class="footer_widget footer_about">
                                <div class="brand_logo">
                                    <a class="brand_link" href="{{route('frontend')}}">
                                        <img src="{{asset('frontend/assets')}}/images/logo/logo_1x.png" srcset="assets/images/logo/logo_2x.png 2x" alt="logo_not_found">
                                    </a>
                                </div>
                                <ul class="social_round ul_li">
                                    <li><a href="#!"><i class="icofont-youtube-play"></i></a></li>
                                    <li><a href="#!"><i class="icofont-instagram"></i></a></li>
                                    <li><a href="#!"><i class="icofont-twitter"></i></a></li>
                                    <li><a href="#!"><i class="icofont-facebook"></i></a></li>
                                    <li><a href="#!"><i class="icofont-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col col-lg-2 col-md-3 col-sm-6">
                            <div class="footer_widget footer_useful_links">
                                <h3 class="footer_widget_title text-uppercase">Quick Links</h3>
                                <ul class="ul_li_block">
                                    <li><a href="{{route('frontend')}}">Home</a></li>
                                    <li><a href="{{route('shop')}}">shop</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                    @guest

                                    <li><a href="{{route('login')}}">Login</a></li>
                                    <li><a href="{{route('register')}}">Register</a></li>
                                    @endguest
                                </ul>
                            </div>
                        </div>

                        <div class="col col-lg-2 col-md-3 col-sm-6">
                            <div class="footer_widget footer_useful_links">
                                <h3 class="footer_widget_title text-uppercase">Categories</h3>
                                <ul class="ul_li_block">
                                    @foreach (categories() as $category)
                                    <li><a href="{{route('categorywiseProduct',$category->slug)}}"> {{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col col-lg-4 col-md-6 col-sm-6">
                            <div class="footer_widget footer_contact">
                                <h3 class="footer_widget_title text-uppercase">Contact Onfo</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                                </p>
                                <div class="hotline_wrap">
                                    <div class="footer_hotline">
                                        <div class="item_icon">
                                            <i class="icofont-headphone-alt"></i>
                                        </div>
                                        <div class="item_content">
                                            <h4 class="item_title">Have any question?</h4>
                                            <span class="hotline_number">+ 123 456 7890</span>
                                        </div>
                                    </div>
                                    {{-- <div class="livechat_btn clearfix">
                                        <a class="btn border_primary" href="#!">Live Chat</a>
                                    </div> --}}
                                </div>
                                {{-- <ul class="store_btns_group ul_li">
                                    <li><a href="#!"><img src="{{asset('frontend/assets')}}/images/app_store.png" alt="app_store"></a></li>
                                    <li><a href="#!"><img src="{{asset('frontend/assets')}}/images/play_store.png" alt="play_store"></a></li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer_bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-md-6">
                            <p class="copyright_text">
                                ©{{date('Y')}} . All Rights Reserved.
                            </p>
                        </div>

                        {{-- <div class="col col-md-6">
                            <div class="payment_method">
                                <h4>Payment:</h4>
                                <img src="{{asset('frontend/assets')}}/images/payments_icon.png" alt="image_not_found">
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer_section - end
        ================================================== -->

    </div>
    <!-- body_wrap - end -->

    <!-- fraimwork - jquery include -->
    <script src="{{asset('frontend/assets')}}/js/jquery.min.js"></script>
    <script src="{{asset('frontend/assets')}}/js/popper.min.js"></script>
    <script src="{{asset('frontend/assets')}}/js/bootstrap.min.js"></script>

    <!-- carousel - jquery plugins collection -->
    <script src="{{asset('frontend/assets')}}/js/jquery-plugins-collection.js"></script>

    <!-- google map  -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk2HrmqE4sWSei0XdKGbOMOHN3Mm2Bf-M&ver=2.1.6"></script>
    <script src="{{asset('frontend/assets')}}/js/gmaps.min.js"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <!-- custom - main-js -->
    <script src="{{asset('frontend/assets')}}/js/main.js"></script>

    @stack('js')
    {!! Toastr::message() !!}
   @if ($errors->any())
        @foreach ($errors->all() as $error )
        <script>
        toastr.error('{{$error}}','error',{
            CloseButton: true,
            progressBar: true,
        });
       </script>
        @endforeach

    @endif

    <script>
        function favorite_add(id){
            var id = id;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'get',
                url: "/product/favorite/" + id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data){
                    location.reload();
                }
            });
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#update_btn').click(function () {
                $('#cart_form').submit();

            });
        });
    </script>
<script>

</script>

</body>
</html>
