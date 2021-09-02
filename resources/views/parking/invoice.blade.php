@extends('layouts.master')

@section('title','Invoice Report')

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
                            <li class="breadcrumb-item active">Invoice Report</li>
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
                        Invoice
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
                    <div class="receipt col-6">
                        <div class="header text-center">
                            <img src="{{asset('uploads/images/settings/'.$data['setting']->logo)}}" alt="Logo" width="100px" height="100px">
                            <p class="">{{$data['setting']->name}}
                                <br>Pan No: {{$data['setting']->pan_no}}
                                <br>{{$data['setting']->address}}
                                <br>Payment Receipt
                            </p>
                        </div>
                        {{-- Header Ends--}}
                        <div class="content">
                            <div class="header-content">
                                <table>
                                <tr>
                                    <td>Receipt No:</td>
                                    <td>{{$data['receipt']->bill_no}}</td>
                                </tr>
                                    <tr>
                                        <td>Rate:</td>
                                        <td>Rs.{{$data['setting']->price_per_hour}} per hour</td>
                                    </tr>
                                </table>
                            </div>
                            {{-- Content Header Ends--}}
                            <div class="main-content">
                                <table class="">
                                <tr>
                                    <td>Customer Name:</td>
                                    <td>{{$data['receipt']->customer_name}}</td>
                                </tr>
                                <tr>
                                    <td>Car Number:</td>
                                    <td>{{$data['receipt']->car_no}}</td>
                                </tr>
                                <tr>
                                    <td>Alloted Parking Slot:</td>
                                    <td>{{$data['parkingslot_number']->number}}</td>
                                </tr>
                                <tr>
                                    <td>Entry Time:</td>
                                    <td>{{$data['receipt']->entry_time}}</td>
                                </tr>
                                <tr>
                                    <td>Exit Time:</td>
                                    <td>{{$data['receipt']->exit_time}}</td>
                                </tr>
                                <tr>
                                    <td>Total Time:</td>
                                    <td>{{$data['receipt']->hour}}</td>
                                </tr>
                                <tr>
                                    <td>Total Amount:</td>
                                    <td>Rs.{{$data['receipt']->price}}</td>
                                </tr>
                            </table>
                            </div>
                            {{-- Main Content Ends--}}
                            <div class="content-footer text-center">
                                <p>
                                   Cashier: {{auth()->user()->name}}
                                </p>
                                <p>
                                    <i>This is not a tax invoice</i>
                                    <br>Thanks you for parking with
                                    <br>{{$data['setting']->name}}
                                </p>
                            </div>
                            {{-- Content Footer Ends--}}
                        </div>
                        {{-- Content Ends--}}
                    </div>
                    {{--  Ends--}}
                    <button id="btnPrint" class="btn btn-info" onclick="window.print()">
                        <i class="fa fa-print"> Print</i>
                    </button>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

