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


    <section class="account_section section_space">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 account_menu">
                    <div class="nav account_menu_list flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">


                        <button class="nav-link text-start w-100 active" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="true">My Orders</button>
                        <a class="text-dark nav-link text-start w-100 "href="{{ route('logout') }}"
        onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content bg-light p-3" id="v-pills-tabContent">

     
                        <div class="tab-pane fade active show" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <h5 class="text-center pb-3">Your Orders</h5>
                            <table class="table table-bordered">
                                <tbody><tr>

                                    <th>Order id</th>
                                    <th>Grand Total</th>
                                    <th>Payment status</th>
                                    <th>Payment option</th>

                                    <th>Action</th>
                                </tr>
                                @foreach (Order_summeries() as $Order_summery)
                                <tr>
                                    <td class="text-center">{{$Order_summery->id}}</td>
                                    <td class="text-center">${{$Order_summery->grand_total}}</td>
                                    <td>
                                        <span class="badge  bg-{{$Order_summery->payment_status == 0 ? 'danger': 'success'}}">{{$Order_summery->payment_status == 0 ? 'Unpaid': 'paid'}}</span></td>
                                    <td class="text-center">{{$Order_summery->payment_option == 1 ? 'Cash on Delivery' : 'Online payment'}}</td>
                                    <td>
                                        <a href="{{route('download.invoice')}}" class="btn btn-primary">Download Invoice</a>
                                        <a href="{{route('order.detail',Crypt::encryptString($Order_summery->id))}}" class="btn btn-primary">details</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody></table>
                        </div>
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
