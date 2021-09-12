@extends('layouts.master')

@section('title','Parking Management')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Parking Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Car List</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Parking List
                        <a href="{{route('parking.create')}}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Add
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
                    <table class="table table-bordered" style="margin-bottom: 10px;">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Car Number</th>
                            <th>Parking Slot No.</th>
                            <th>Customer Name</th>
                            <th>Entry Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data['rows'] as $i => $row)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$row->car_no}}</td>
                                <td>Slot {{$row->parking_slot_no}}</td>
                                <td>{{$row->customer_name}}</td>
                                <td>{{$row->entry_time}}</td>
                                <td>
                                    @if($row->status == 1)
                                        <span class="text-success">Active</span>
                                    @else
                                        <span class="text-danger">De Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('parking.show',$row->id)}}" class="btn btn-info">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                    <a href="{{route('parking.edit',$row->id)}}" class="btn btn-warning">
                                        <i class="fas fa-edit" aria-hidden="true"></i> Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text text-danger">Parking list not found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <span>
                        {{$data['rows']->links()}}
                    </span>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
