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
                    @if(Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                    @if(Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
                    <form action="{{route('payment.reportlist')}}" method="POST" class="no_print">
                        @csrf
                        <label for="">From:</label>
                        <input type="datetime-local" name="date_from" id="date_from"/>
                        <label for="">To:</label>
                        <input type="datetime-local" name="date_to" id="date_to"/>
                        <input type="submit" class="btn btn-info" value="search"/>
                        <a class="btn btn-primary text-white" id="printBtn">
                            <i class="fa fa-print" aria-hidden="true"></i>
                            Print
                        </a>
                    </form>
                    <table class="table table-bordered" name="payment_info" id="payment_info" style="margin-top: 25px;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Customer Name</th>
                                <th>Invoice Number</th>
                                <th>Amount(in Rs.)</th>
                                <th>Payment Date</th>
                                <th>Created By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data['payments']))
                                @forelse($data['payments'] as $i => $row)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$row->customer_name}}</td>
                                        <td>{{$row->invoice_no}}</td>
                                        <td>{{$row->amount}}</td>
                                        <td>{{$row->payment_date}}</td>
                                        <td>{{$row->createdBy->name}}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text text-danger">Record not found</td>
                                        </tr>
                                @endforelse
                                <tr style="text-align: center">
                                    <th colspan="5">Total Amount</th>
                                    <th>Rs. {{$total_amount}}</th>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="6" class="text text-danger"></td>
                                </tr>
                            @endif
                        </tbody>
{{--                        <tfoot class="no_print">--}}
{{--                            <tr>--}}
{{--                                <th>SN</th>--}}
{{--                                <th>Customer Name</th>--}}
{{--                                <th>Invoice Number</th>--}}
{{--                                <th>Amount(in Rs.)</th>--}}
{{--                                <th>Payment Date</th>--}}
{{--                                <th>Created By</th>--}}
{{--                            </tr>--}}
{{--                        </tfoot>--}}
                    </table>
                </div>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('backend/plugins/print_any_part/dist/jQuery.print.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {

            $("#printBtn").on('click', function() {

                $.print("#printable");

            });

        });
    </script>

@endsection



{{--@section('js')--}}
{{--    <script>--}}
{{--        function showTable() {--}}
{{--            var lTable = document.getElementById("payment_info");--}}
{{--            lTable.style.display = (lTable.style.display == "table") ? "block" : "table";--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}

{{--alert message fade out--}}
{{-- $(document).ready(function(){--}}
{{--     $(".alert").slideDown(300).delay(3000).slideUp(300);--}}
{{-- });--}}
