@extends('layouts.dashboard.app')

@section('title', 'product Thumnail Photo - Edit')
@push('css')
<link href="{{asset('dashboard/vendor')}}/summernote/summernote.css" rel="stylesheet">
@endpush


@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('adminproduct.edit',$thumnail_image->product->slug)}}">{{$thumnail_image->product->name}}</a></li>
                <li class="breadcrumb-item active"><a href="">product Thumnail Photo - Edit</a></li>


            </ol>
        </div>
        <form action="{{route('adminproduct.thumnail.update',$thumnail_image->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mt-5 mt-100px  " >
                <div class="col-xl-8 m-auto ">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Old Product Thumnail Image</label>
                                <div class="col-sm-9">
                                    <img width="100" src="{{Storage::disk('public')->url('product_img/product_thumnail_image/'. $thumnail_image->image) }}" alt="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Product Thumnail Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="product_thumnail_image" class="form-control">
                                </div>
                            </div>
                            <a href="{{route('adminproduct.edit',$thumnail_image->product_id)}}"  class="btn btn-danger">Back</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>

            </div>

        </form>
       </div>
</div>
@endsection
@push('js')
<script src="{{asset('dashboard/vendor')}}/summernote/js/summernote.min.js"></script>

@endpush
