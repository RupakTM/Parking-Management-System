<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['rows'] = Staff::all();
        $data['setting'] = Setting::first();
        return view('staff.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['setting'] = Setting::first();
        return view('staff.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        //Image Upload
        $file = $request->file('image_file');
        if($request->hasfile("image_file")) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/images/staff'), $fileName);
            $request->request->add(['image' => $fileName]);
        }
        $user_id = Auth::id();
        $request->request->add(['created_by'=>$user_id]);
        $row = Staff::create($request->all());
        if ($row){
            $request->session()->flash('success', 'Staff created successfully');
        } else{
            $request->session()->flash('error', 'Staff creation failed');
        }
        return redirect()->route('staff.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['setting'] = Setting::first();

        $data['row'] = Staff::find($id);
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
            return redirect()->route('staff.index');
        }
        return view('staff.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['setting'] = Setting::first();
        $data['row'] = Staff::find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('staff.index');
        }
        return view('staff.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffRequest $request, $id)
    {
        $data['row'] = Staff::find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('staff.edit');
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
                $file->move(public_path('uploads/images/staff'), $fileName);
                $request->request->add(['image' => $fileName]);
            }
            //Store Data To user Table
            $staff_name = $request->input('name');
            DB::table('users')
                ->where('staff_id',$id)
                ->update([
                    'name' => $staff_name,
                ]);
            //user data stored
            $data['row']->update($request->all());
            $request->session()->flash('success', 'Staff updated successfully');
        } else{
            $request->session()->flash('error', 'Staff update failed');
        }
        return redirect()->route('staff.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data['row'] = Staff::find($id);
        if ($data['row']){
            if ($data['row']->delete()){
                request()->session()->flash('success', 'Staff deleted successfully');
            } else{
                request()->session()->flash('error', 'Staff delete failed');
            }
        } else{
            request()->session()->flash('error', 'Invalid request');
        }
        return redirect()->route('staff.index');
    }

    public function trash(){
        $data['setting'] = Setting::first();
        $data['rows'] = Staff::onlyTrashed()->orderby('deleted_at','desc')->get();
        return view('staff.trash',compact('data'));
    }

    public function restore($id){
        $data['row'] = Staff::where('id',$id)->withTrashed()->first();

        if ($data['row']->restore()){
            request()->session()->flash('success', 'Staff restored successfully');
        } else{
            request()->session()->flash('error', 'Staff restore failed');
        }
        return redirect()->route('staff.index');
    }

    public function forceDelete($id){
        $data['row'] = Staff::where('id',$id)->withTrashed()->first();
        if ($data['row']->forceDelete()){
            request()->session()->flash('success', 'Staff premanently deleted');
        } else{
            request()->session()->flash('error', 'Staff delete failed');
        }
        return redirect()->route('staff.trash');
    }
}
