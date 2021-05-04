<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\StaffRequest;
use App\Models\Customer;
use App\Models\Parking;
use App\Models\ParkingSlot;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data['total_parkingslots'] = ParkingSlot::count();
        $data['total_parkings'] = Parking::count();
        $data['total_users'] = User::count();
        $data['total_roles'] = Role::count();
        return view('dashboard.create',compact('data'));
    }

}
