@extends('layouts.frontend.app')
@section('title','cart')
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets')}}/css/nice-select.css">

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
                <li><a href="{{route('frontend')}}">Home</a></li>
                <li>Order Details</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb_section - end
    ================================================== -->


<section class="product_section section_space">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="heading text-center mb-5">
                    <h3>My Orders Details</h3>
                    <h4 class=" text-danger">
                        Payment-status : <small class="badge bg-{{$Order_summery->payment_status == 0 ? 'danger': 'success'}} badge-{{$Order_summery->payment_status == 0 ? 'danger': 'success'}}">{{$Order_summery->payment_status == 0 ? 'unpaid ': 'Paid'}}</small>
                    </h4>
                </div>

                <div class="product-area clearfix">
                    @foreach ($order_details as $order_detail)
                    <div class="grid">
                        <div class="product-pic">
                            <img src="{{Storage::disk('public')->url('product_img/'.$order_detail->product->product_image)}}" alt>
                            <div class="actions">
                                <ul>
                                    <li>
                                        @guest
                                        <a   href="{{route('wishlist.add.remove',$order_detail->product->id)}}"><svg  role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a>
                                        @else
                                        <a class="{{Auth::user()->favorite_products()->where('product_id', $order_detail->product->id)->count() == 1 ? 'bg-danger' : ''}}" href="javascript:void(0)"  onclick="favorite_add({{$order_detail->product->id}})"><svg style="{{Auth::user()->favorite_products()->where('product_id', $order_detail->product->id)->count() == 1 ? 'stroke: white;': ''}}" role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a>
                                        @endguest

                                    </li>


                                </ul>
                            </div>
                        </div>
                        <div class="details">
                            <h4><a href="{{route('product.details', $order_detail->product->slug)}}">{{$order_detail->product->name}}</a></h4>
                            <p><a href="{{route('product.details', $order_detail->product->slug)}}">{{Str::limit($order_detail->product->product_description,60)}} </a></p>
                            @if ($Order_summery->payment_status == 1)

                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            @endif

                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>



</main>
<!-- main body - end
================================================== -->
@endsection
@push('js')


<script>
     $('select').niceSelect();
</script>
@endpush
