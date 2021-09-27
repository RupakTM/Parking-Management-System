@extends('layouts.master')

@section('title','Add Car')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Car</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Car</li>
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
                        Add
                        <a href="{{route('parking.index')}}" class="btn btn-success">
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
                    <form action="{{route('parking.index')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="car_no">Car Number</label>
                            <input type="text" class="form-control" name="car_no" id="car_no" value="{{old('car_no')}}">
                            @error('car_no')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="customer_name">Customer Name</label>
                            <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{old('customer_name')}}">
                            @error('customer_name')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="parking_slot">Select Parking Slot:</label>
                            <div class="card">
                                <div class="card-body">
                                    <div class="parking-buttons">
                                        @foreach($data['parkingslots'] as $parkingslot)
                                            @if($parkingslot->status == 0)
                                                <button type="button" class="btn btn-info" name="slot_{{$parkingslot->number}}" id="slot_{{$parkingslot->number}}" value="{{$parkingslot->number}}">
                                                    Slot {{$parkingslot->number}}
                                                </button>
                                            @else
                                                <button type="button" disabled class="btn btn-danger" name="slot_{{$parkingslot->name}}" id="slot_{{$parkingslot->name}}" value="{{$parkingslot->name}}">
                                                    Slot {{$parkingslot->number}}
                                                </button>
                                            @endif
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="parking_slot_no" id="parking_slot_no" value="">
                                </div>
                                @error('parking_slot')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnSave" value="Save" class="btn btn-primary">
                        </div>
                    </form>
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
            $("button").click(function() {
                var button_value = $(this).val();
                // document.getElementById("parkingslot_id").innerHTML = button_value;
                document.getElementById("parking_slot_no").value = button_value;
                // alert(button_value);
            });
        });

    </script>
@endsection
