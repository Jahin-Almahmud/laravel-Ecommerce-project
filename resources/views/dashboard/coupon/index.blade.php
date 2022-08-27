@extends('layouts.dashboard.app')

@section('title', 'coupon')
@section('bar_name', 'coupon')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Coupon</a></li>

            </ol>
        </div>
         <div class="col-lg-12">
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title  ">All Coupon</h4>
                     <a class="btn btn-danger float-right ml-3 mb-2 " href="{{route('admincoupon.create')}}">+ Add Coupon</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead >

                                <tr>
                                    <th class="width80">Sl N.</th>
                                    <th>Coupon Name</th>
                                    <th>coupon persentige</th>
                                    <th>validaty</th>
                                    <th>limit</th>
                                    <th>action</th>

                                </tr>

                            </thead>
                            <tbody>
                                @forelse (coupons() as $key=>$coupon)
                                    <tr>
                                        <td><strong>{{$key+1}}</strong></td>
                                        <td>{{$coupon->coupon_name }}</td>
                                        <td class="">{{$coupon->coupon_percentige }}</td>

                                        <td>{{$coupon->validaty}}</td>
                                        <td>{{$coupon->limit}}</td>
                                        <td>
                                            <a href="{{route('admincoupon.edit',$coupon->id)}}" class="badge badge-danger">Edit</i></a>
                                            <a href="javascript:void(0)" onclick="Delete({{$coupon->id}})" class="badge badge-danger">Delete</i></a>
                                            <form id="delete-from-{{$coupon->id}}" action="{{route('admincoupon.destroy',$coupon->id)}}" class="d-none" method="POST">
                                             @csrf
                                             @method('Delete')
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <div class="alert alert-danger">No coupon found !</div>
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
