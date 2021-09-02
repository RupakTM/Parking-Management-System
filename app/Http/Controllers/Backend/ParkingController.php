<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\ParkingRequest;
use App\Models\Customer;
use App\Models\Parking;
use App\Models\ParkingSlot;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class ParkingController extends Controller
{
    function create(){
        $data['parkingslots'] = ParkingSlot::all();
        $data['setting'] = Setting::first();
        return view('parking.create',compact('data'));
    }
    public function store(ParkingRequest $request)
    {

//        $customer_name = $request->input('customer_name');
//        $car_no = $request->input('car_no');

//        $customer->request->add(['name'=>$customer_name]);
//        dd($customer_name);
//        $request->Customer::create(['customer_name'=>$customer_name]);
//        $request->Customer::create(['car_no'=>$car_no]);

        //set entry time
        $entry = Carbon::now();
        $request->request->add(['entry_time'=>$entry]);
        //set created_at
        $request->request->add(['created_at'=>$entry]);
        //set parking status as unavailable
        $request->request->add(['status'=>1]);
        //set status of parking slot
        $parking_slot = $request->input('parking_slot_no');
//        dd($parking_slot);
//        $parking_status = ParkingSlot::find($parking_slot);
        $parking_status = ParkingSlot::where('number',$parking_slot)->first();
//        dd($parking_status);
//        dd($parking_status->id);
        if ($parking_status) {
            $parking_status->update(['status' => 1]);
            $request->request->add(['parking_slot_no'=>$parking_status->id]);
        }
        //set created_by
        $user_id = Auth::id();
        $request->request->add(['created_by'=>$user_id]);

        $customer_name = $request->input('customer_name');
        $car_number = $request->input('car_no');
        DB::table('customers')->insert([
            'name' => $customer_name,
            'car_no' => $car_number,
            'created_by' => $user_id,
            'created_at' => $entry,
        ]);

        $row = Parking::create($request->all());
        if ($row){
            $request->session()->flash('success', 'Car Added successfully');
            $data['setting'] = Setting::first();
            $data['receipt'] = Parking::find($row->id);
            $data['parkingslot_number'] = ParkingSlot::where('id',$data['receipt']->parking_slot_no)->first();
//            dd($data['receipt']);
//            dd($data['receipt']->parkingslotNumber->number);
            return view('parking.parking_slip',compact('data'));
        } else{
            $request->session()->flash('error', 'Car parking failed');
            return redirect()->route('parking.add');
        }

    }

    function index(){
        $data['setting'] = Setting::first();
        $data['rows'] = Parking::all();
        return view('parking.index',compact('data'));
    }

    function show($id){
        $data['setting'] = Setting::first();

        $data['row'] = Parking::find($id);
        $updated_user = $data['row']->updated_by;
        if (isset($updated_user)) {
            $data['update'] = User::find($updated_user);
        } else{
            $data['update'] = '';
        }
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('parking.index');
        }
        return view('parking.show',compact('data'));
    }

    function destroy($id){

    }

    function edit(){
        $data['setting'] = Setting::first();
        $data['rows'] = Parking::all();
        return view('parking.edit',compact('data'));
    }

    public function update(ParkingRequest $request, $id)
    {

    }
    public function exit(Request $request)
    {

        $car_id = $request->input('car_id');
        $data['row'] = Parking::find($car_id);
//        dd($data['row']);


        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route('parking.edit');
        }
        if ($data['row']){
            //User Id
            $user_id = Auth::id();
//            dd($user_id);
            $customer = $data['row']->customer_name;
            //Calculate Time Difference
            $startTime = Carbon::parse($data['row']->entry_time);
            $exitTime = Carbon::now();
            $total_hour =  $startTime->diff($exitTime)->format('%H:%I:%S'); //Difference in hour:minute format
//            dd($total_hour);

            //Calculation Time Difference Ends

            //get hour from total time
            $hour = Carbon::parse($total_hour)->hour;
            //get minute from total time
            $minute = Carbon::parse($total_hour)->minute;
            //get price from setting table
            $price = Setting::select('price_per_hour')->first()->value('price_per_hour');
            $min = 60;
            $minute_price = $price / $min ;

            //Calculation of total amount
            if ($hour == 0){
                $total_amount = ceil($minute_price * $minute);
            } else{
                if ($minute >= 30){
                    $total_amount = ceil(($hour+1) * $price);
                } else{
                    $total_amount = ceil($hour * $price);
                } //innner else ends
            } //outer if ends

            //SET bill_no
            $bill_record = Parking::select('bill_no')->limit(1)->orderby('updated_at','desc')->value('bill_no'); //get last bill record
            //check bill record
            if ($bill_record){
                $bill = explode('-', $bill_record);

                //check first day in a year
                $Date = date("md");
                if ($Date=="0101"){
                    $InvoiceNumber = date('Y').'-0001';
                } else {
                    //increase 1 with last invoice number
                    $updated_digit = $bill[1] + 1;
                    $last_digit = substr(str_repeat(0, 4).$updated_digit, -4); //Add leading zero
                    $InvoiceNumber = $bill[0].'-'. $last_digit;
                } //inner else ends
            }//outer if ends
            else{
                //if it is first transaction
                $InvoiceNumber = date('Y').'-0001';
            } //outer else ends


            //Store Data To parking Table
            DB::table('parkings')
                ->where('id',$car_id)
                ->update([
                    'bill_no' => $InvoiceNumber,
                    'exit_time' => $exitTime,
                    'status' => 0,
                    'hour' => $total_hour,
                    'price' => $total_amount,
                    'updated_at'=> $exitTime,
                    'updated_by' => $user_id,
                ]);
            //parking data stored

            //Store Data To payment Table
            DB::table('payments')
                ->insert([
                    'customer_name' => $customer,
                    'invoice_no' => $InvoiceNumber,
                    'payment_date' => $exitTime,
                    'amount' => $total_amount,
                    'created_by' => $user_id,
                    'created_at' => $exitTime,
                ]);
            //payment data stored

            //SET status of parking slot as available
            $parking_slot = $data['row']->parking_slot_no;
            $parking_status = ParkingSlot::find($parking_slot);
            if ($parking_status){
                $parking_status->update(['status'=>0]);
            }
            //Status of parking slot set as available
            $data['setting'] = Setting::first();
            $data['receipt'] = Parking::find($car_id);
            $data['parkingslot_number'] = ParkingSlot::where('id',$data['receipt']->parking_slot_no)->first();
            return view('parking.invoice',compact('data'));
        } else{
            $request->session()->flash('error', 'Car exit failed');
            return redirect()->route('parking.edit');
        }

    }

    public function invoice(){
        $data['setting'] = Setting::first();
        $data['rows'] = Parking::all();
        return view('parking.invoice',compact('data'));
    }
}
