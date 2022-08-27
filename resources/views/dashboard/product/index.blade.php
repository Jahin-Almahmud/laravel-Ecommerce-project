@extends('layouts.dashboard.app')

@section('title', 'product')
@section('bar_name', 'product')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Products</a></li>

            </ol>
        </div>
         <div class="col-lg-12">
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title  ">All Product</h4>
                     <a class="btn btn-danger float-right ml-3 mb-2 " href="{{route('adminproduct.create')}}">+ Add product</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead >

                                <tr>
                                    <th class="width80">Sl N.</th>
                                    <th>Product Name</th>
                                    <th>Product price </th>
                                    <th>Created at</th>
                                    <th>Action</th>

                                </tr>

                            </thead>
                            <tbody>
                                @forelse (latestProducts() as $key=>$product)
                                    <tr>
                                        <td><strong>{{$key+1}}</strong></td>
                                        <td>{{$product->name }}</td>
                                        <td>{{$product->product_discount_price }}</td>

                                        <td>{{$product->created_at->toFormattedDateString()}}</td>
                                        <td>
                                            <a href="{{route('adminproduct.edit',$product->slug)}}" class="badge badge-danger">Edit</i></a>
                                            <a href="{{route('product.details',$product->slug)}}" class="badge badge-danger">show</i></a>
                                            <a href="javascript:void(0)" onclick="Delete({{$product->id}})" class="badge badge-danger">Delete</i></a>
                                            <form id="delete-from-{{$product->id}}" action="{{route('adminproduct.destroy',$product->id)}}" class="d-none" method="POST">
                                             @csrf
                                             @method('Delete')
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <div class="alert alert-danger">No product found !</div>
                               @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       </div>
</div>
@endsection
@push('js')
<script>
function Delete(id) {
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        $('#delete-from-'+id).submit();
        Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
        )
    }
    })
}



</script>
@endpush
