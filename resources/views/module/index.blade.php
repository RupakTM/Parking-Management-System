@extends('layouts.master')

@section('title','Module Management')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Module Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Modules</li>
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
                        Modules
                        <a href="{{route('module.create')}}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add</a>
{{--                        <a href="{{route('module.trash')}}" class="btn btn-danger">--}}
{{--                            <i class="fa fa-trash" aria-hidden="true"></i> Trash</a>--}}
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
                            <th>SN</th>
                            <th>Name</th>
                            <th>Route</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @forelse($data['rows'] as $i => $row)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->route}}</td>
                                <td>
                                    @if($row->status == 1)
                                        <span class="text-success">Active</span>
                                    @else
                                        <span class="text-danger">De Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('module.show',$row->id)}}" class="btn btn-info">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                    <a href="{{route('module.edit',$row->id)}}" class="btn btn-warning">
                                        <i class="fas fa-edit" aria-hidden="true"></i> Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text text-danger">Modules not found</td>
                            </tr>
                        @endforelse
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
