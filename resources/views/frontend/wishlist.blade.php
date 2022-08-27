@extends('layouts.frontend.app')
@section('title','wishlist')
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
                        <li>Wishlist</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->

            <!-- cart_section - start
            ================================================== -->
            <section class="cart_section section_space">
                <div class="container">
                    <div class="cart_table">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>PRODUCT</th>
                                    <th class="text-center">PRICE</th>
                                    <th class="text-center">STOCK STATUS</th>
                                    <th class="text-center">ADD TO CART</th>
                                    <th class="text-center">REMOVE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($favoriteProducttoUser as $product)
                                <tr>
                                    <td>
                                        <div class="cart_product">
                                            <img src="{{Storage::disk('public')->url('product_img/'.$product->product_image)}}" alt>
                                            <h3>{{$product->name}}</h3>
                                        </div>
                                    </td>
                                    <td class="text-center"><span class="price_text">${{$product->product_discount_price}}</span></td>
                                    <td class="text-center">
                                        @if ($product->quantity == 0)
                                        <span class="price_text text-danger"><output>Out Stock</output></span>
                                        @else
                                        <span class="price_text text-success"><output>Stock</output></span>
                                         @endif
                                   </td>
                                    <td class="text-center">
                                        <a href="#!" class="btn btn_primary">Add To Cart</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" onclick="favorite_add({{$product->id}})" class="remove_btn"><i class="fal fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @empty
                                     <div class="card">
                                        <div class="alert alert-danger">Empty</div>
                                     </div>
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- cart_section - end
            ================================================== -->



        </main>
        <!-- main body - end
        ================================================== -->


@endsection
