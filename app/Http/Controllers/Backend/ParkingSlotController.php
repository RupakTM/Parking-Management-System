<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParkingSlotRequest;
use App\Models\Parking;
use App\Models\ParkingSlot;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkingSlotController extends Controller
{

    public function index()
    {
        $data['rows'] = ParkingSlot::all();
        $data['setting'] = Setting::first();
        return view('parkingslot.index',compact('data'));
    }

    public function create()
    {
        $data['setting'] = Setting::first();
        $data['last_id'] = ParkingSlot::orderBy('id','DESC')->first();
//        dd($data['last_id']);
//        $data['last_number'] = ParkingSlot::orderBy('number','DESC')->first();
//        if ($data['last_number'] == null){
//            $data['last_number']->number = 1;
//        }
        return view('parkingslot.create',compact('data'));
    }


    public function store(ParkingSlotRequest $request)
    {
        $user_id = Auth::id();
        $request->request->add(['created_by'=>$user_id]);
        $row = ParkingSlot::create($request->all());
        if ($row){
            $request->session()->flash('success', 'Parking Slot created successfully');
        } else{
            $request->session()->flash('error', 'Parking Slot creation failed');
        }
        return redirect()->route('parkingslot.index');
    }


    public function show($id)
    {
        $data['setting'] = Setting::first();
        $data['user'] = auth()->user();
        $data['row'] = ParkingSlot::find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('parkingslot.index');
        }
        return view('parkingslot.show',compact('data'));
    }


    public function edit($id)
    {
        $data['setting'] = Setting::first();
        $data['row'] = ParkingSlot::find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('parkingslot.index');
        }
        return view('parkingslot.edit',compact('data'));
    }


    public function update(ParkingSlotRequest $request, $id)
    {
        $data['row'] = ParkingSlot::find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('parkingslot.edit');
        }
        if ($data['row']) {
            $data['row']->update($request->all());
            $request->session()->flash('success', 'Parking Slot updated successfully');
        } else{
            $request->session()->flash('error', 'Parking Slot update failed');
        }
        return redirect()->route('parkingslot.index');
    }


    public function destroy($id)
    {
        $data['row'] = ParkingSlot::find($id);
        $data['last_id'] = ParkingSlot::orderBy('id','DESC')->first();
//        dd($data['last']->id);
        if ($data['row']){
            if ($data['row']->id == $data['last_id']->id) {
                if ($data['row']->delete()) {
                    request()->session()->flash('success', 'Parking slot deleted successfully');
                } else {
                    request()->session()->flash('error', 'Parking slot delete failed');
                }
            }else{
                request()->session()->flash('error', 'Invalid request');
            }
        } else{
            request()->session()->flash('error', 'Invalid request');
        }
        return redirect()->route('parkingslot.index');
    }
}
