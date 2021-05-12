@extends('layouts.master')

@section('title','Permission Management')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Permission Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Permission</li>
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
                    <h3 class="card-title">Add Permission
                        <a href="{{route('permission.index')}}" class="btn btn-success">
                            <i class="fa fa-list" aria-hidden="true"></i> List</a>
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
                    <form action="{{route('permission.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="module_id">Module Name</label>
                            <select name="module_id" id="module_id" class="form-control">
                                <option value="">Select Module</option>
                                @foreach($data['modules'] as $module)
                                    <option value="{{$module->id}}">{{$module->name}}</option>
                                @endforeach
                            </select>
                            @error('module_id')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                            @error('name')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="route">Route</label>
                            <input type="text" class="form-control" name="route" id="route" value="{{old('route')}}">
                            @error('route')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="radio" name="status" id="active" value="1">Active
                            <input type="radio" name="status" id="deactive" value="0" checked>De Active
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnSave" value="Save" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
