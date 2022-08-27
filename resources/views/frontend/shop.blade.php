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
                        <li>Product Grid</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->

            <!-- product_section - start
            ================================================== -->
            <section class="product_section section_space">
                <h2 class="hidden">Product sidebar</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <aside class="sidebar_section p-0 mt-0">
                                <div class="sb_widget sb_category">
                                    <h3 class="sb_widget_title">Categories</h3>
                                    <ul class="sb_category_list ul_li_block">
                                        @forelse (categories() as $category)
                                        <li>
                                            <a href="{{route('categorywiseProduct',$category->slug)}}">{{$category->name}} <span>({{$category->products->count()}})</span></a>
                                        </li>
                                      @empty
                                           <div class="card mb-5">
                                              <div class="card-body text-center"><div class="alert alert-danger">No product found :)</div></div>
                                           </div>
                                      @endforelse


                                    </ul>
                                </div>

                                {{-- <div class="sb_widget">
                                    <h3 class="sb_widget_title">Your Filter</h3>
                                    <div class="filter_sidebar">
                                        <div class="fs_widget">
                                            <h3 class="fs_widget_title">Category</h3>
                                            <form action="#">
                                                <div class="select_option clearfix">
                                                    <select>
                                                        <option data-display="Select Category">Select Your Option</option>
                                                        <option value="1" selected>HP</option>
                                                        <option value="2">HP</option>
                                                        <option value="3">HP</option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="fs_widget">
                                            <h3 class="fs_widget_title">Manufacturer</h3>
                                            <form action="#">
                                                <ul class="fs_brand_list ul_li_block">
                                                    <li>
                                                        <div class="checkbox_item">
                                                            <input id="apple_brand" type="checkbox" name="brand_checkbox" />
                                                            <label for="apple_brand">Apple <span>(19)</span></label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="checkbox_item">
                                                            <input id="asus_brand" type="checkbox" name="brand_checkbox" />
                                                            <label for="asus_brand">Asus <span>(1)</span></label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="checkbox_item">
                                                            <input id="bank_oluvsen_brand" type="checkbox" name="brand_checkbox" />
                                                            <label for="bank_oluvsen_brand">Bank & Oluvsen <span>(1)</span></label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                            </aside>
                        </div>

                        <div class="col-lg-9">
                            <div class="filter_topbar">
                                <div class="row align-items-center">
                                    <div class="col col-md-6">
                                        <ul class="layout_btns nav" role="tablist">
                                            <li>
                                                <button class="active" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fal fa-bars"></i></button>
                                            </li>
                                        </ul>
                                    </div>



                                    <div class="col col-md-6">
                                        <div class="result_text">Showing 1-{{productsOfShopPage()->count()}} of {{allproducts()->count()}} relults</div>
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                    <div class="shop-product-area shop-product-area-col">
                                        <div class="product-area shop-grid-product-area clearfix">
                                            @forelse (productsOfShopPage() as $product)
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
