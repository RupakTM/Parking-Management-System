<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    function edit(){
        $data['setting'] = Setting::first();
        if (!$data['setting']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('home');
        }
        return view('setting.edit',compact('data'));
    }

    public function update(SettingRequest $request,$id)
    {
        $data['row'] = Setting::find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('setting.edit');
        }
        if ($data['row']){
            //User Id
            $user_id = Auth::id();
            $request->request->add(['updated_by'=>$user_id]);
            //Logo Upload
            $file = $request->file('logo_file');
            //check file
            if($request->hasfile("logo_file")) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/images/settings'), $fileName);
                $request->request->add(['logo' => $fileName]);
            }
            //Fav Icon Upload
            $fav = $request->file('fav_file');
            //check file
            if($request->hasfile("fav_file")) {
                $fav_img = time() . '_' . $fav->getClientOriginalName();
                $fav->move(public_path('uploads/images/settings'), $fav_img);
                $request->request->add(['fav_icon' => $fav_img]);
            }
            $data['row']->update($request->all());
            $request->session()->flash('success', 'Setting updated successfully');
        } else{
            $request->session()->flash('error', 'Setting update failed');
        }
        return redirect()->route('setting.edit');
    }


}
