@extends('layouts.dashboard.app')

@section('title', 'coupon')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item "><a href="{{route('admincoupon.index')}}">Coupon</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$coupon->coupon_name}}</a></li>
            </ol>
        </div>
        <div class="row">
           <div class="col-xl-8 col-lg-8 m-auto">
               <div class="card">
                   <div class="card-header ">
                       <h4 class="card-title text-center m-auto ">update coupon</h4>
                   </div>
                   <div class="card-body">
                       <div class="basic-form">
                           <form method="POST" action="{{route('admincoupon.update', $coupon->id)}}" >
                            @csrf
                            @method('PATCH')
                               <div class="form-group row">
                                   <label class="col-sm-3 col-form-label">Coupon name</label>
                                   <div class="col-sm-9">
                                       <input type="text" name="coupon_name" class="form-control" value="{{$coupon->coupon_name}}" >
                                   </div>
                               </div>
                               <div class="form-group row">
                                   <label class="col-sm-3 col-form-label">Coupon percentige</label>
                                   <div class="col-sm-9">
                                       <input type="number" name="coupon_percentige" class="form-control" value="{{$coupon->coupon_percentige}}" >
                                   </div>
                               </div>
                               <div class="form-group row">
                                   <label class="col-sm-3 col-form-label">Coupon validaty</label>
                                   <div class="col-sm-9">
                                       <input type="date" name="validaty" class="form-control" value="{{$coupon->validaty}}" >
                                   </div>
                               </div>
                               <div class="form-group row">
                                   <label class="col-sm-3 col-form-label">Coupon limit</label>
                                   <div class="col-sm-9">
                                       <input type="number" name="limit" class="form-control"value="{{$coupon->limit}}" >
                                   </div>
                               </div>
                               <div class="form-group row">
                                   <div class="col-sm-10">
                                       <button type="submit" class="btn btn-primary">Submit</button>
                                   </div>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
        </div>
       </div>
</div>
@endsection
