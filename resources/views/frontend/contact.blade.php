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


    <section class="contact_section section_space">
        <div class="container">
            <div class="row">


                <div class="col col-lg-12">
                    <div class="contact_info_wrap">
                        <h3 class="contact_title">Get In Touch <span>Inform Us</span></h3>
                        <div class="decoration_image">
                            <img src="{{asset('frontend/assets')}}/images/leaf.png" alt="image_not_found">
                        </div>

                        <form action="{{route('message')}}" method="POST">
                            @csrf
                            <div class="form_item">
                                <input id="contact-form-name" type="text" name="name" placeholder="Your Name">
                            </div>
                            <div class="row">
                                <div class="col col-md-6 col-sm-6">
                                    <div class="form_item">
                                    <input id="contact-form-email" type="email" name="email" placeholder="Your Email">
                                </div>
                                </div>
                                <div class="col col-md-6 col-sm-6">
                                    <div class="form_item">
                                        <input type="text" name="subject" placeholder="Your Subject">
                                    </div>
                                </div>
                            </div>
                            <div class="form_item">
                                <textarea id="contact-form-message" name="message" placeholder="Message"></textarea>
                            </div>

                            <button  type="submit" class="btn btn_dark">Send Message</button>
                        </form>
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



@endpush
