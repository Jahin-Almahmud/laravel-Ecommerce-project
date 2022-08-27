@extends('layouts.frontend.app')
@section('title','checkout')
@push('css')
<style>
.your-order-area .Place-order button:hover {
    background-color: #000;
}
.your-order-area .Place-order button {
    background-color: #fb5d5d;
    color: #fff;
    display: block;
    font-weight: 700;
    letter-spacing: 1px;
    line-height: 1;
    padding: 18px 20px;
    text-align: center;
    text-transform: uppercase;
    border-radius: 0;
    z-index: 9;
}
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
                        <li>Check Out</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->

<form action="{{route('cheakout.post')}}" method="POST">
    @csrf
            <div class="checkout-area pt-100px pb-100px mt-5 mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="billing-info-wrap">
                                <h3>Billing Details</h3>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-4">
                                            <label>First Name</label>
                                            <input type="text" value="{{old('name')}}" name="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-4">
                                            <label>Email</label>
                                            <input type="text" name="email" value="{{auth()->user()->email}}">
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="billing-select mb-4">
                                            <label>Division</label>
                                            <select name="division" value="{{old('division')}}" id="division" >
                                                <option value="">-- select Devesion --</option>
                                                @foreach ($divisions as $division)
                                                <option value="{{$division->id}}">{{$division->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-select mb-4">
                                            <label>City</label>
                                            <select name="city"value="{{old('district')}}"  id="city_dropdown" >
                                                <option value="">Please select country first</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-4">
                                            <label> Address</label>
                                            <input class="billing-address"value="{{old('address')}}" name="address" type="text">

                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-4">
                                            <label>Postcode / ZIP</label>
                                            <input type="number" value="{{old('postcode')}}" name="postcode">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-4">
                                            <label>Phone</label>
                                            <input type="number" value="{{old('phone')}}" name="number">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-select mb-4">
                                            <label>Payment option</label>
                                            <select name="payment_option" class="form-control" value="{{old('division')}}">
                                                <option value="">--select payment option--</option>
                                                <option value="1">cash on delivery</option>
                                                <option value="2">Online Payment</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>

                                <div class="additional-info-wrap">
                                    <h4>Additional information</h4>
                                    <div class="additional-info">
                                        <label>Order notes</label>
                                        <textarea placeholder="Notes about your order, e.g. special notes for delivery. " name="message">{{old('message')}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                            <div class="your-order-area">
                                <h3>Your order</h3>
                                <div class="your-order-wrap gray-bg-4">
                                    <div class="your-order-product-info">
                                        <div class="your-order-top">
                                            <ul>
                                                <li>Product</li>
                                                <li>Total</li>
                                            </ul>
                                        </div>
                                        <div class="your-order-middle">
                                            <ul>
                                                @foreach (carts() as $cart)

                                                <li><span class="order-middle-left">{{$cart->product->name}} X {{$cart->amount}}</span> <span class="order-price">${{$cart->product->product_discount_price * $cart->amount}}</span></li>
                                                @endforeach

                                            </ul>
                                        </div>
                                        <div class="your-order-bottom">
                                            <ul>
                                                <li class="your-order-shipping">cart total</li>
                                                <li>${{session('s_cart_total')}}</li>
                                            </ul>
                                        </div>
                                        <div class="your-order-bottom">
                                            <ul>
                                                <li class="your-order-shipping">Total Discount</li>
                                                <li>${{session('s_total_discount')}}</li>
                                            </ul>
                                        </div>
                                        <div class="your-order-bottom">
                                            <ul>
                                                <li class="your-order-shipping">Sub Total </li>
                                                <li>${{round(session('s_cart_total')-session('s_total_discount'))}}</li>
                                            </ul>
                                        </div>
                                        <div class="your-order-bottom">
                                            <ul>
                                                <li class="your-order-shipping">Shipping</li>
                                                <li>$0</li>
                                            </ul>
                                        </div>
                                        <div class="your-order-total">
                                            <ul>
                                                <li class="order-total">Total</li>
                                                <li>${{round(session('s_cart_total')-session('s_total_discount'))}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="payment-accordion element-mrg">
                                            <div id="faq" class="panel-group">
                                                <div class="panel panel-default single-my-account m-0">
                                                    <div class="panel-heading my-account-title">
                                                        <h4 class="panel-title"><a data-bs-toggle="collapse" href="#my-account-1" class="collapsed" aria-expanded="true">Direct bank transfer</a>
                                                        </h4>
                                                    </div>
                                                    <div id="my-account-1" class="panel-collapse collapse show" data-bs-parent="#faq">

                                                        <div class="panel-body">
                                                            <p>Please send a check to Store Name, Store Street, Store Town,
                                                                Store State / County, Store Postcode.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default single-my-account m-0">
                                                    <div class="panel-heading my-account-title">
                                                        <h4 class="panel-title"><a data-bs-toggle="collapse" href="#my-account-2" aria-expanded="false" class="collapsed">Check payments</a></h4>
                                                    </div>
                                                    <div id="my-account-2" class="panel-collapse collapse" data-bs-parent="#faq">

                                                        <div class="panel-body">
                                                            <p>Please send a check to Store Name, Store Street, Store Town,
                                                                Store State / County, Store Postcode.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default single-my-account m-0">
                                                    <div class="panel-heading my-account-title">
                                                        <h4 class="panel-title"><a data-bs-toggle="collapse" href="#my-account-3">Cash on delivery</a></h4>
                                                    </div>
                                                    <div id="my-account-3" class="panel-collapse collapse" data-bs-parent="#faq">

                                                        <div class="panel-body">
                                                            <p>Please send a check to Store Name, Store Street, Store Town,
                                                                Store State / County, Store Postcode.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="Place-order mt-25">
                                    <button class="btn-hover" href="#">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        </main>
        <!-- main body - end
        ================================================== -->

@endsection
@push('js')
<script>
    $('#division').change(function (e) {
        e.preventDefault();
      var id =   $(this).val();

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
         type:'POST',
         url:'/get/city/'+id,
         data: {division_id:id},
         success:function(data){
            $('#city_dropdown').html(data);
         }
      });

    });
</script>

@endpush
