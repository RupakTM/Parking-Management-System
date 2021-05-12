@extends('layouts.master')

@section('title','Role Management')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Role Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Assign Permission</li>
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
                        Assign Permission
                        <a href="{{route('role.create')}}" class="btn btn-info">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Add
                        </a>

                        <a href="{{route('role.index')}}" class="btn btn-success">
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
                    <table class="table table-bordered">
                        <tr>
                            <th>Role Name</th>
                            <td>{{$data['row']->name}}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($data['row']->status == 1)
                                    <span class="text-success">Active</span>
                                @else
                                    <span class="text-danger">De Active</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created By</th>
                            <td>{{$data['create']->name}}</td>
                        </tr>
                        <tr>
                            <th>Updated By</th>
                            <td>
                                @if($data['update'] == '')
                                    -
                                @else
                                    {{$data['update']->name}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created at</th>
                            <td>{{$data['row']->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Updated at</th>
                            <td>{{$data['row']->updated_at}}</td>
                        </tr>
                    </table>
                    <h2>Permission Assignment</h2>
                        <form action="{{route('role.post_permission')}}" method="post">
                            @csrf
                            <input type="hidden" name="role_id" value="{{$data['row']->id}}"/>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Module</th>
                                    <th>Permission</th>
                                </tr>
                                @foreach($data['modules'] as $module)
                                    <tr>
                                        <td>{{$module->name}}</td>
                                        <td>
                                            <ul style="list-style: none;">
                                                @foreach($module->permissions as $permission)
                                                    @if(in_array($permission->id,$data['assigned_permission']))
                                                    <li>
                                                        <input type="checkbox" name="permission_id[]" value="{{$permission->id}}" checked="checked"/>
                                                        {{$permission->name}}
                                                    </li>
                                                    @else
                                                        <li>
                                                            <input type="checkbox" name="permission_id[]" value="{{$permission->id}}"/>
                                                            {{$permission->name}}
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">
                                        <input type="submit" class="btn btn-info" value="Assign"/>
                                    </td>
                                </tr>
                            </table>
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
