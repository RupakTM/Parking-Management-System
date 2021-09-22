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
                            <li class="breadcrumb-item active">View Parking</li>
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
                        <a href="{{route('parking.index')}}" class="btn btn-success">
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
                            <th>Car Number</th>
                            <td>{{$data['row']->car_no}}</td>
                        </tr>
                        <tr>
                            <th>Customer Name</th>
                            <td>{{$data['row']->customer_name}}</td>
                        </tr>
                        <tr>
                            <th>Parking Slot No</th>
                            <td>Slot {{$data['row']->parking_slot_no}}</td>
                        </tr>
                        <tr>
                            @if(!empty($data['row']->bill_no))
                                <th>Bill No</th>
                                <td>{{$data['row']->bill_no}}</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Entry Time</th>
                            <td>{{$data['row']->entry_time}}</td>
                        </tr>
                        <tr>
                            @if(!empty($data['row']->exit_time))
                                <th>Exit Time</th>
                                <td>{{$data['row']->exit_time}}</td>
                            @endif
                        </tr>
                        <tr>
                            @if(!empty($data['row']->hour))
                                <th>Total Hour</th>
                                <td>{{$data['row']->hour}}</td>
                            @endif
                        </tr>
                        <tr>
                            @if(!empty($data['row']->price))
                                <th>Total Amount</th>
                                <td>{{$data['row']->price}}</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($data['row']->status == 1)
                                    <span class="text-success">IN</span>
                                @else
                                    <span class="text-danger">OUT</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created By</th>
                            <td>{{$data['row']->createdBy->name}}</td>
                        </tr>
                        <tr>
                            @if(!empty($data['row']->updated_by))
                                <th>Updated By</th>
                                <td>{{$data['row']->updatedBy->name}}</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Created at</th>
                            <td>{{$data['row']->created_at}}</td>
                        </tr>
                        <tr>
                            @if(!empty($data['row']->updated_at))
                                <th>Updated at</th>
                                <td>{{$data['row']->updated_at}}</td>
                            @endif
                        </tr>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
