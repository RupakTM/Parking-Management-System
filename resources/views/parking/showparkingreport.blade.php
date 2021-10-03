@extends('layouts.master')

@section('title','Report')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Parking Information</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Parking Report</li>
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
                        Parking Report
                        <a href="{{route('parking.report')}}" class="btn btn-success">
                            <i class="fa fa-list" aria-hidden="true"></i>
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
                    <div>
                        <table>
                            <tr>
                                <td>
                                    <strong>Car Number: </strong>
                                </td>
                                <td>
                                    <strong> {{$car_no}} </strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Total Amount: </strong>
                                </td>
                                <td>
                                    <strong>Rs. {{$total_amount}}</strong>
                                </td>
                            </tr>
                        </table>
                        <table class="table table-bordered" name="parking_info" id="parking_info" style="margin-top: 10px; text-align: center;">
                            <thead>
                            <tr style="">
                                <th>SN</th>
                                <th>Customer Name</th>
                                <th>Parking Slot</th>
                                <th>Bill Number</th>
                                <th>Entry Time</th>
                                <th>Exit Time</th>
                                <th>Amount(in Rs.)</th>
                                <th>Created By</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($data['rows']))
                                @forelse($data['rows'] as $i => $row)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$row->customer_name}}</td>
                                        <td>{{$row->parking_slot_no}}</td>
                                        <td>{{$row->bill_no}}</td>
                                        <td>{{$row->entry_time}}</td>
                                        <td>{{$row->exit_time}}</td>
                                        <td>{{$row->price}}</td>
                                        <td>{{$row->createdBy->name}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text text-danger">Record not found</td>
                                    </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="6" class="text text-danger"></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <a class="btn btn-secondary text-white no-print" id="printBtn">
                            <i class="fa fa-print" aria-hidden="true"></i>
                            Print
                        </a>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script type="text/javascript"
            src="{{ asset('backend/plugins/print_any_part/dist/jQuery.print.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {

            $("#printBtn").on('click', function () {

                $.print("#printable");

            });

        });
    </script>

@endsection
