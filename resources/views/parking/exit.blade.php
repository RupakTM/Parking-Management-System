@extends('layouts.master')

@section('title','Exit Car')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Exit Car</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Exit Car</li>
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
                    <h3 class="card-title">Exit</h3>

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
                    <form method="POST" id="exitCar" action="{{route('parking.exitCar')}}">
                        {{--                        onsubmit="return validateForm(this)"--}}
                        {{--                        <input type="hidden" name="_method" value="PUT">--}}
                        @csrf
                        <div class="form-group">
                            <label for="car_no">Car Number</label>
                            <select name="car_no" id="car_no" class="form-control">
                                <option value="">Choose car</option>
                                @foreach($data['rows'] as $row)
                                    @if($row->status == 1)
                                        <option value="{{$row->id}}">{{$row->car_no}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('car_no')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <input type="hidden" name="car_id" id="car_id" value="">

                        <div class="form-group">
                            <input type="submit" name="btnExit" value="Exit" class="btn btn-warning">
                        </div>
                    </form>
                    <div class="card" id="result" style="display: none;">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Reg Number</th>
                                    <td>26</td>
                                </tr>
                                <tr>
                                    <th>Car Number</th>
                                    <td>Lu 36 Pa 2563</td>
                                </tr>
                                <tr>
                                    <th>Slot Number</th>
                                    <td>Slot 8</td>
                                </tr>
                                <tr>
                                    <th>Start Time</th>
                                    <td>---</td>
                                </tr>
                                <tr>
                                    <th>Exit Time</th>
                                    <td>---</td>
                                </tr>
                                <tr>
                                    <th>Total Time</th>
                                    <td>---</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>---</td>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <div class="form-group">
                                            <input type="submit" name="btnPrint" value="Print" class="btn btn-info" >
                                        </div>
                                    </th>
                                </tr>
                            </table>
                        </div>
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
    <script>
        $(document).ready(function (){
            $('select').on('change', function() {
                var value = this.value;
                document.getElementById("car_id").value = value;
                // alert(document.getElementsByName("car_id").id);
            });


        });
    </script>
@endsection
