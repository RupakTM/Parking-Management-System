<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\StaffRequest;
use App\Models\Customer;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    public function index()
    {
        $data['rows'] = Customer::all();
        $data['setting'] = Setting::first();
        return view('customer.index',compact('data'));
    }

    public function create()
    {
        $data['setting'] = Setting::first();
        return view('customer.create',compact('data'));
    }

    public function store(CustomerRequest $request)
    {
//        $user_id = Auth::id();
//        $request->request->add(['created_by'=>$user_id]);
//        $row = Customer::create($request->all());
//        if ($row){
//            $request->session()->flash('success', 'Staff created successfully');
//        } else{
//            $request->session()->flash('error', 'Staff creation failed');
//        }
//        return redirect()->action([ParkingController::class, 'store']);
    }

    public function show($id)
    {
        $data['setting'] = Setting::first();

        $data['row'] = Customer::find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('staff.index');
        }
        return view('customer.show',compact('data'));
    }

    public function edit($id)
    {

    }

    public function update(CustomerRequest $request, $id)
    {

    }

    public function destroy($id)
    {
        $data['row'] = Customer::find($id);
        if ($data['row']){
            if ($data['row']->delete()){
                request()->session()->flash('success', 'Customer deleted successfully');
            } else{
                request()->session()->flash('error', 'Customer delete failed');
            }
        } else{
            request()->session()->flash('error', 'Invalid request');
        }
        return redirect()->route('customer.index');
    }
}
