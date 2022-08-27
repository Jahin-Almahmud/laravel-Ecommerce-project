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

    </div>
</div>
@endsection

