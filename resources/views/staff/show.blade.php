@extends('layouts.master')

@section('title','Staff Management')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Staff Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">View Staff</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        View Details
                        <a href="{{route('staff.index')}}" class="btn btn-success">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            List
                        </a>
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                    @if(Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{$data['row']->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$data['row']->email}}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{$data['row']->address}}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{$data['row']->phone}}</td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td>
                                @if($data['row']->image)
                                    <img src="{{asset('uploads/images/staff/'.$data['row']->image)}}" height="100px" width="100px">
                                @else
                                    <img alt=" " src="{{asset('public_image/image_not_found.jpg')}}" height="100px" width="100px"/>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($data['row']->status == 1)
                                    <span class="text-success">Active</span>
                                @else
                                    <span class="text-danger">De Active</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created By</th>
                            <td>{{$data['create']->name}}</td>
                        </tr>
                        <tr>
                            <th>Updated By</th>
                            <td>
                                @if($data['update'] == '')
                                    -
                                @else
                                    {{$data['update']->name}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created at</th>
                            <td>{{$data['row']->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Updated at</th>
                            <td>{{$data['row']->updated_at}}</td>
                        </tr>

                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
