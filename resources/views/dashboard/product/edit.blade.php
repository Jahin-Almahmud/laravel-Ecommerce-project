@extends('layouts.dashboard.app')

@section('title', 'product - Edit')
@push('css')
<link href="{{asset('dashboard/vendor')}}/summernote/summernote.css" rel="stylesheet">
@endpush


@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item "><a href="{{route('adminproduct.index')}}">Product</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$product->name }}</a></li>

            </ol>
        </div>
        <form action="{{route('adminproduct.update',$product->slug)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row mt-5 mt-100px " >
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Product name</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{$product->name}}" name="name" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Product Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="product_image" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Product old Image:</label>
                                <div class="col-sm-9">
                                    <img width="100" src="{{Storage::disk('public')->url('product_img/'.$product->product_image)}}" alt="">
                                </div>
                            </div>
                            @if ($product->thumnailphotos->count() == 0 )

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Product Thumnail Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="product_thumnail_image[]" class="form-control" multiple >
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <input id="check" {{$product->status == 1 ? 'checked': ''}} type="checkbox" name="status" value="1">
                                <label for="check">publish</label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                        <div class="card">
                        <div class="card-body">
                           <div class="form-group">
                             <select name="category_id" class="form-control" >

                                @forelse (categories() as $item)

                                <option
                                    @foreach ($product->categories as $category)
                                     {{$category->id == $item->id ? 'selected' : ''}}
                                    @endforeach

                                    value="{{$item->id}}">{{$item->name}}

                                </option>
                                @empty
                                <option class="text-danger" disabled>No category found</option>

                                @endforelse
                             </select>
                           </div>
                           <div class="form-group row">
                            <label class="col-form-label ml-3">Product Quantity</label>
                            <div class="col-sm-9">
                                <input type="number" value="{{$product->quantity}}" name="quantity" class="form-control" >
                            </div>
                        </div>
                            <a href="{{route('adminproduct.index')}}"  class="btn btn-danger">Back</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-body">
                            <label class=" col-form-label">Product Description</label>
                            <div class="form-group">
                                <textarea class="form-control"style="width: 100%;"  rows="5" cols="200" name="product_description"> {{$product->product_description}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-form-label ml-3">Product regular price</label>
                                <div class="col-sm-9">
                                    <input type="number" name="product_regular_price" value="{{$product->product_regular_price}}" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label ml-3">Product discount price</label>
                                <div class="col-sm-9">
                                    <input type="number" name="product_discount_price" value="{{$product->product_discount_price}}" class="form-control" >
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                    <div class="card-body">
                        <label class=" col-form-label">Product Additional Infromation</label>
                        <div class="form-group">
                            <textarea class="form-control " id="summernote" style="width: 100%;"  rows="10" cols="500" name="product_additional_description">{{$product->product_additional_infromation}}</textarea>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead >

                                    <tr>
                                        <th class="width80">Sl N.</th>
                                        <th>Product Thumnail Image</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    @forelse ($product->thumnailphotos as $key=>$thumnailphoto)
                                        <tr>
                                            <td><strong>{{$key+1}}</strong></td>
                                            <td><img width="100" src="{{Storage::disk('public')->url('product_img/product_thumnail_image/'. $thumnailphoto->image) }}" alt=""></td>

                                            <td>
                                                <a href="{{route('adminproduct.thumnail.edit',$thumnailphoto->id)}}" class="badge badge-danger">Edit</i></a>
                                                <a href="{{route('adminproduct.thumnail.delete',$thumnailphoto->id)}}"  class="badge badge-danger">Delete</i></a>

                                            </td>
                                        </tr>
                                        @empty
                                        <div class="alert alert-danger">No found Product Thumnail Image !</div>
                                   @endforelse
                                </tbody>
                            </table>
                        </div>
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
<script>
$(document).ready(function() {
$('#summernote').summernote();

});
</script>
@endpush
