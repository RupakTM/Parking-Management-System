@extends('layouts.master')

@section('title','Payment Management')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Payment Information</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Payment Details</li>
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
                        Payment Details
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
                    @if(isset($data['payments']))
                        <table class="table table-bordered">
                            <tr>
                                <th>Customer Name</th>
                                <td>{{$data['payments']->customer_name}}</td>
                            </tr>
                            <tr>
                                <th>Invoice Number</th>
                                <td>{{$data['payments']->invoice_no}}</td>
                            </tr>
                            <tr>
                                <th>Amount (in Npr)</th>
                                <td>{{$data['payments']->amount}}</td>
                            </tr>
                            <tr>
                                <th>Payment Date</th>
                                <td>{{$data['payments']->payment_date}}</td>
                            </tr>
                            <tr>
                                <th>Created By</th>
                                <td>{{$data['payments']->createdBy->name}}</td>
                            </tr>
                        </table>
                    @else
                        <label class="text text-danger">Record not found</label>
                    @endif

                </div>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection



{{--@section('js')--}}
{{--    <script>--}}
{{--        function showTable() {--}}
{{--            var lTable = document.getElementById("payment_info");--}}
{{--            lTable.style.display = (lTable.style.display == "table") ? "block" : "table";--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}

