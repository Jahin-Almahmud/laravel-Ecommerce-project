@extends('layouts.dashboard.app')

@section('title','Settngs')


@section('content')

<div class="content-body">
<div class="container">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item "><a href="javascript:void(0)">password</a></li>


        </ol>
    </div>
    <div class="col-md-12 mt-5 mt-100px">
        <div class="card-box">


            <div class="row">
            <div class="col-md-8 m-auto">
                <form action="{{route('adminchange.password')}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">Change password</div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Old Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="old_password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">New Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="new_password" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="confirm_password" >
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


