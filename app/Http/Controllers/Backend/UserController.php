<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['rows'] = User::all();
        $data['setting'] = Setting::first();
        return view('user.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['setting'] = Setting::first();
        $data['staffs'] = Staff::all();
        $data['roles'] = Role::all();
        return view('user.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        //user name from staff
        $staff_id = $request->input('staff_id');
        $name = Staff::where('id',$staff_id)->value('name');
        $request->request->add(['name'=>$name]);

        //Email
        $email = $request->input('email');
        if($email==null){
            $staffEmail = Staff::where('id',$staff_id)->value('email');
            $request->request->add(['email'=>$staffEmail]);
        }

        //Image Upload
        $file = $request->file('image_file');
        if($request->hasfile("image_file")) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/images/user'), $fileName);
            $request->request->add(['image' => $fileName]);
        }

        $user_id = Auth::id();
        $request->request->add(['created_by'=>$user_id]);
        //Hash value for password
        $pw = Hash::make($request->input('password'));
        $request->request->add(['password'=>$pw]);


        $row = User::create($request->all());
        if ($row){
            $request->session()->flash('success', 'User created successfully');
        } else{
            $request->session()->flash('error', 'User creation failed');
        }
        return redirect()->route('user.index');
    }

    public function show($id)
    {
        $data['setting'] = Setting::first();

        $data['row'] = User::find($id);

        $role = $data['row']->role_id;
        $data['role'] = Role::find($role);

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
            return redirect()->route('user.index');
        }
        return view('user.show',compact('data'));
    }

    public function edit($id)
    {
        $data['setting'] = Setting::first();
        $data['roles'] = Role::all();
        $data['row'] = User::find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('user.index');
        }
        return view('user.edit',compact('data'));
    }

    public function update(UserRequest $request, $id)
    {
        $data['row'] = User::find($id);
//        dd($data['row']);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('user.edit');
        }
        if ($data['row']) {
            //User Id
            $user_id = Auth::id();
            $request->request->add(['updated_by'=>$user_id]);
            //Image Upload
            $file = $request->file('image_file');
            //check file
            if($request->hasfile("image_file")) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/images/user'), $fileName);
                $request->request->add(['image' => $fileName]);
            }

            //Hash value for password
            $pw = Hash::make($request->input('password'));
            $request->request->add(['password'=>$pw]);
            $data['row']->update($request->all());
            $request->session()->flash('success', 'User updated successfully');
        } else{
            $request->session()->flash('error', 'User update failed');
        }
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data['row'] = User::find($id);
        if ($data['row']){
            if ($data['row']->delete()){
                request()->session()->flash('success', 'User deleted successfully');
            } else{
                request()->session()->flash('error', 'User delete failed');
            }
        } else{
            request()->session()->flash('error', 'Invalid request');
        }
        return redirect()->route('user.index');
    }

    public function trash(){
        $data['setting'] = Setting::first();
        $data['rows'] = User::onlyTrashed()->orderby('deleted_at','desc')->get();
        return view('user.trash',compact('data'));
    }

    public function restore($id){
        $data['row'] = User::where('id',$id)->withTrashed()->first();

        if ($data['row']->restore()){
            request()->session()->flash('success', 'User restored successfully');
        } else{
            request()->session()->flash('error', 'User restore failed');
        }
        return redirect()->route('user.index');
    }

    public function forceDelete($id){
        $data['row'] = User::where('id',$id)->withTrashed()->first();
        if ($data['row']->forceDelete()){
            request()->session()->flash('success', 'User premanently deleted');
        } else{
            request()->session()->flash('error', 'User delete failed');
        }
        return redirect()->route('user.trash');
    }
}
