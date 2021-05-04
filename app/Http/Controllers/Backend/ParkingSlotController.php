<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParkingSlotRequest;
use App\Models\ParkingSlot;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkingSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['rows'] = ParkingSlot::all();
        $data['setting'] = Setting::find(3);
        return view('parkingslot.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['setting'] = Setting::find(3);
        return view('parkingslot.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['setting'] = Setting::find(3);
        $data['user'] = auth()->user();
        $data['row'] = ParkingSlot::find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('parkingslot.index');
        }
        return view('parkingslot.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['setting'] = Setting::find(3);
        $data['row'] = ParkingSlot::find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('parkingslot.index');
        }
        return view('parkingslot.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
