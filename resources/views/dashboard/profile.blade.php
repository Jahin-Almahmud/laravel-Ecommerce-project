@extends('layouts.dashboard.app')

@section('title','Settngs')


@section('content')

<div class="content-body">
<div class="container">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item "><a href="javascript:void(0)">Profile</a></li>


        </ol>
    </div>
    <div class="col-md-12 mt-5 mt-100px">
        <div class="card-box">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <form action="{{route('adminchange.profle.photo')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">Change profile photo</div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="{{Auth::user()->name}}" name="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Profile Photos</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="profile_photo">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info waves-effect waves-light">update</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>





        </div>
    </div>

</div>
</div>

@endsection


