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
                        <li><a href="{{route('frontend')}}">Home</a></li>
                        <li><a href="javascript:void(0)">category</a></li>
                        <li>{{$category->name}}</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->

            <!-- product_section - start
            ================================================== -->
            <section class="product_section section_space">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="filter_topbar">
                                <div class="row align-items-center">
                                    <div class="col col-md-6">
                                        <ul class="layout_btns nav" role="tablist">
                                            <li>
                                                <button class="active" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fal fa-bars"></i></button>
                                            </li>
                                        </ul>
                                    </div>



                                    <div class="col col-md-6 float-right">
                                        <div class="result_text">Showing 1-{{$products->count()}} of {{allproducts()->count()}} relults</div>
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                    <div class="shop-product-area shop-product-area-col">
                                        <div class="product-area shop-grid-product-area clearfix">
                                            @forelse ($products as $product)
                                            @include('layouts.frontend.partial.product')
                                            @empty
                                                <div class="card mb-5">
                                                    <div class="card-body text-center"><div class="alert alert-danger">No product found :)</div></div>
                                                </div>
                                            @endforelse

                                        </div>
                                    </div>

                                    <div class="pagination_wrap">
                                        <div class="pagination_wrap">
                                            {{ productsOfShopPage()->links('layouts.frontend.partial.pagination') }}
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- product_section - end
            ================================================== -->



        </main>
        <!-- main body - end
        ================================================== -->

@endsection
