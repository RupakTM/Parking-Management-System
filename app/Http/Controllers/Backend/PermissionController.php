<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests\RoleRequest;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{

    public function index()
    {
        $data['rows'] = Permission::all();
        $data['setting'] = Setting::first();
        return view('permission.index',compact('data'));
    }

    public function create()
    {
        $data['setting'] = Setting::first();
        $data['modules'] = Module::all();
        return view('permission.create',compact('data'));
    }

    public function store(PermissionRequest $request)
    {
        $user_id = Auth::id();
        $request->request->add(['created_by'=>$user_id]);
        $row = Permission::create($request->all());
        if ($row){
            $request->session()->flash('success', 'Permission created successfully');
        } else{
            $request->session()->flash('error', 'Permission creation failed');
        }
        return redirect()->route('permission.index');
    }

    public function show($id)
    {
        $data['setting'] = Setting::first();

        $data['row'] = Permission::find($id);
        $data['module'] = Module::find($data['row']->module_id);
        $created_user = $data['row']->created_by;
        $data['create'] = User::find($created_user);
        $updated_user = $data['row']->updated_by;
        if (isset($updated_user)) {
            $data['update'] = User::find($updated_user);
        } else{
            $data['update'] = '';
        }
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('permission.index');
        }
        return view('permission.show',compact('data'));
    }

    public function edit($id)
    {
        $data['setting'] = Setting::first();

        $data['row'] = Permission::find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('permission.index');
        }
        return view('permission.edit',compact('data'));
    }

    public function update(PermissionRequest $request, $id)
    {
        $user_id = Auth::id();
        $request->request->add(['updated_by'=>$user_id]);
        $data['row'] = Permission::find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('permission.index');
        }
        if ($data['row']->update($request->all())){
            $request->session()->flash('success', 'Permission updated successfully');
        } else{
            $request->session()->flash('error', 'Permission update failed');
        }
        return redirect()->route('permission.index');
    }

    public function destroy($id)
    {
        $data['row'] = Permission::find($id);
        if ($data['row']->delete()){
            request()->session()->flash('success', 'Permission deleted successfully');
        } else{
            request()->session()->flash('error', 'Permission delete failed');
        }
        return redirect()->route('permission.index');
    }

}
