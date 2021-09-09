<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use App\Http\Requests\RoleRequest;
use App\Models\Module;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Mod;

class ModuleController extends Controller
{

    public function index()
    {
        $data['rows'] = Module::all();
        $data['setting'] = Setting::first();
        return view('module.index',compact('data'));
    }

    public function create()
    {
        $data['setting'] = Setting::first();
        return view('module.create',compact('data'));
    }

    public function store(ModuleRequest $request)
    {
        $user_id = Auth::id();
        $request->request->add(['created_by'=>$user_id]);
        $row = Module::create($request->all());
        if ($row){
            $request->session()->flash('success', 'Module created successfully');
        } else{
            $request->session()->flash('error', 'Module creation failed');
        }
        return redirect()->route('module.index');
    }

    public function show($id)
    {
        $data['setting'] = Setting::first();

        $data['row'] = Module::find($id);
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
            return redirect()->route('module.index');
        }
        return view('module.show',compact('data'));
    }

    public function edit($id)
    {
        $data['setting'] = Setting::first();

        $data['row'] = Module::find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('module.index');
        }
        return view('module.edit',compact('data'));
    }

    public function update(ModuleRequest $request, $id)
    {
        $user_id = Auth::id();
        $request->request->add(['updated_by'=>$user_id]);
        $data['row'] = Module::find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('module.index');
        }
        if ($data['row']->update($request->all())){
            $request->session()->flash('success', 'Module updated successfully');
        } else{
            $request->session()->flash('error', 'Module update failed');
        }
        return redirect()->route('module.index');
    }

    public function destroy($id)
    {
        $data['row'] = Role::find($id);
        if ($data['row']){
            if ($data['row']->delete()){
                request()->session()->flash('success', 'Role deleted successfully');
            } else{
                request()->session()->flash('error', 'Role delete failed');
            }
        } else{
            request()->session()->flash('error', 'Invalid request');
        }
        return redirect()->route('role.index');
    }
}
