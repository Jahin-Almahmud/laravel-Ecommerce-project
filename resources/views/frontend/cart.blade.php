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
                <li>Cart</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb_section - end
    ================================================== -->

    <!-- cart_section - start
    ================================================== -->
    <div class="cart-main-area pt-100px pb-100px">
    <section class="cart_section section_space">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Untit Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


                                <form action="{{route('cart.update')}}" method="POST" id="cart_update_form">
                                    @csrf
                                    @method('PATCH')
                                    @php
                                        $total = 0;
                                        $stock = false;
                                    @endphp
                                    @forelse ($carts as $cart)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"> <img src="{{Storage::disk('public')->url('product_img/product_details_img/'.$cart->product->product_image)}}" alt></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{$cart->product->name}}
                                            </a> <p>status :<span class="text-{{$cart->product->quantity < $cart->amount ? 'danger' : 'success'}}">
                                                @if ($cart->product->quantity < $cart->amount)
                                                stock out
                                                   @php
                                                       $stock = True;
                                                   @endphp
                                                   @else
                                                   Available
                                                @endif
                                            </span></p></td>
                                        <td class="product-price-cart"><span class="amount">${{$cart->product->product_discount_price}}</span></td>


                                        <td class="product-quantity">
                                            <div class="cart-plus-minus"><div class="dec qtybutton">-</div>
                                                <input class="cart-plus-minus-box" max="5"  type="text" name="qtybutton[{{$cart->id}}]" value="{{$cart->amount}}">
                                            <div class="inc qtybutton">+</div></div>
                                        </td>

                                        <td class="product-subtotal">${{$cart->product->product_discount_price * $cart->amount }}</td>
                                        @php
                                            $total += $cart->product->product_discount_price * $cart->amount;
                                        @endphp
                                        <td class="product-remove">

                                            <a href="{{route('cart.remove',$cart->id)}}"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                       <div class="cart">
                                        <div class="alert alert-danger">NO FOUND PRODUCT</div>
                                       </div>
                                    @endforelse
                             </form>

                            </tbody>
                        </table>
                    </div>
            </div>
            <div class="cart_btns_wrap">
                <div class="row">

                    <div class="col col-lg-6">
                        <form>
                            <div class="coupon_form form_item mb-0">
                                <input type="text" name="coupon" value="{{$coupon_name ? $coupon_name : ''}}">
                                <button type="submit" class="btn btn_dark">Apply Coupon</button>
                                <div class="info_icon">
                                    <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Info Here"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col col-lg-6">
                        <ul class="btns_group ul_li_right">
                            <li><button class="btn border_black" id="cart_update">Update Cart</button></li>


                        </ul>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col col-lg-6">
                    <div class="calculate_shipping">
                        <h3 class="wrap_title">Calculate Shipping <span class="icon"><i class="far fa-arrow-up"></i></span></h3>
                        <form action="#">
                            <div class="select_option clearfix">
                                <select id="select">
                                    <option id="click" value="100">Inside City</option>
                                    <option id="click" value="200">Outside City</option>
                                </select>
                            </div>
                            <br>

                        </form>


                            @if ($stock == true )
                            <button class="btn btn_primary "data-bs-toggle="tooltip" data-bs-placement="top" title="Please remove stock out product">Prceed To Checkout</button>
                            @else
                            @if ($carts->count() == 0)
                            <button class="btn btn_primary "data-bs-toggle="tooltip" data-bs-placement="top" title="No product found for checkout">Prceed To Checkout</button>
                            @else

                            <a class="btn btn_dark d-none " id="checkout" href="{{route('cheakout')}}">Prceed To Checkout</a>
                            @endif

                            @endif

                    </div>
                </div>

                <div class="col col-lg-6">
                    <div class="cart_total_table">
                        <h3 class="wrap_title">Cart Totals</h3>
                        <ul class="ul_li_block">
                            <li>
                                @php
                                    if($coupon_name){
                                        Session::put('s_coupon_name', $coupon_name);
                                    }else {
                                        Session::put('s_coupon_name', '');

                                    }
                                    Session::put('s_cart_total', $total);
                                    Session::put('s_total_discount',  $discount);
                                @endphp
                                <span>Cart total</span>
                                <span>${{$total}}</span>
                            </li>
                            <li>
                                <span>Total Discount ({{$coupon_name == "" ? 'N/A' : $coupon_name}})</span>
                                <span >{{$coupon_name  ? '-' : ''}} ${{$discount}}</span>
                            </li>
                            <li>
                                <span>Sub Total ( approx.)</span>
                                <span>${{round($total - $discount)}}</span>
                            </li>
                            <li>
                                <span>Delivery Charge</span>
                                <span id="prepend">--</span>
                            </li>
                            <li>
                                <input type="number" id="total_price" value="{{round($total - $discount)}}" hidden>
                                <span>Order Total</span>
                                <span id="order_total"  class="total_price">${{round($total - $discount)}}</span>
                            </li>

                        </ul>



                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    <!-- cart_section - end
    ================================================== -->



</main>
<!-- main body - end
================================================== -->
@endsection
@push('js')

<script>
  $('#cart_update').click(function () {
    $('#cart_update_form').submit();

  });

  $(document).ready(function() {
    $("#select").change(function(){
        $('#checkout').removeClass("d-none");
         var order_total = $('#total_price').val();
        var delivery_charge = $(this).val();
        $("#prepend").text('$'+delivery_charge);
        $("#order_total").text('$'+ (Number(order_total) + Number(delivery_charge)));


    });
});

</script>
<script>
     $('select').niceSelect();
</script>
@endpush
