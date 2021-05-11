<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use App\Models\ParkingSlot;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date = Carbon::parse('22:02:00');
        $now = Carbon::now();

        $diff = $date->diff($now)->format('%H:%I:%S');
//        dd($diff);
        $data['setting'] = Setting::first();

        if ($data['setting'] == null){
            $name = 'Company Name';
            $address = 'Company Address';
            $pan_no = 'Company Pan No';
            $reg_no = 'Company Reg No';
            $phone = 'Company Phone';
            $logo = 'logo.jpg';
            $fav_icon = 'Icon.jpg';
            $price = 0;
            $created_by = 1;
            DB::table('settings')
                ->insert([
                    'name' => $name,
                    'address' => $address,
                    'pan_no' => $pan_no,
                    'reg_no' => $reg_no,
                    'phone' => $phone,
                    'logo' => $logo,
                    'fav_icon' => $fav_icon,
                    'price_per_hour' => $price,
                    'created_by' => $created_by,
                ]);
        }

        $data['available_parking'] = ParkingSlot::where('status','=', 0)->count();
        $data['total_parkingslots'] = ParkingSlot::count();
        $data['total_parkings'] = Parking::count();
        $data['total_users'] = User::count();
        $data['total_roles'] = Role::count();
        return view('home',compact('data'));
    }
}
