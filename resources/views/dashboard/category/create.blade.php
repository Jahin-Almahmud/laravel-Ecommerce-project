@extends('layouts.dashboard.app')

@section('title', 'category')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item "><a href="{{route('admincategory.index')}}">Category</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Add New</a></li>
            </ol>
        </div>
        <div class="row">
           <div class="col-xl-8 col-lg-8 m-auto">
               <div class="card">
                   <div class="card-header ">
                       <h4 class="card-title text-center m-auto ">Add category</h4>
                   </div>
                   <div class="card-body">
                       <div class="basic-form">
                           <form method="POST" action="{{route('admincategory.store')}}" enctype="multipart/form-data">
                            @csrf
                               <div class="form-group row">
                                   <label class="col-sm-3 col-form-label">Category name</label>
                                   <div class="col-sm-9">
                                       <input type="text" name="name" class="form-control" >
                                   </div>
                               </div>
                               <div class="form-group row">
                                   <label class="col-sm-3 col-form-label">Category Image</label>
                                   <div class="col-sm-9">
                                       <input type="file" name="category_image" class="form-control" >
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
