@extends('layouts.dashboard')
@section('cardtitle', 'Dashboard')
@section('cardicons', 'fas fa-tachometer-alt')
@section('content')
<!-- Main content -->
<div class="row mt-5 mb-3">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>123</h3>
                <p>Users</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-pink">
            <div class="inner">
                <h3>123</h3>
                <p>Roles</p>
            </div>
            <div class="icon"><i class="fas fa-shield-alt"></i></div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>    
    <div class="col-lg-3 col-6">
        <div class="small-box bg-teal">
            <div class="inner">
                <h3>123</h3>
                <p>Permission</p>
            </div>
            <div class="icon"><i class="fas fa-key"></i></div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $menu }}</h3>
                <p>Menu</p>
            </div>
            <div class="icon"><i class="fas fa-bars"></i></div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection
