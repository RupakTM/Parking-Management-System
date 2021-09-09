@extends('layouts.master')

@section('title','Dashboard Page')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if(Session::has('invalid_access'))
                <p class="alert alert-danger">{{ Session::get('invalid_access') }}</p>
            @endif
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>
                                    {{$data['total_parkingslots']}}
                                </h3>
                                <p>Total Parking Space</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-list"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    {{$data['available_parking']}}
                                </h3>
                                <p>Available Parking Space</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-car"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $data['total_users']}}</h3>
                                <p>Users</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user-alt"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->

                </div>
                <!-- /.row -->
                <div class="row">
{{--                    Text here--}}
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
