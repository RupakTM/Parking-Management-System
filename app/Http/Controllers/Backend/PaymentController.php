<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\SettingRequest;
use App\Models\Payment;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $data['rows'] = Payment::all();
        $data['setting'] = Setting::first();
        return view('payment.index',compact('data'));
    }

    public function search(PaymentRequest $request)
    {

        $data['setting'] = Setting::first();

        $bill_no = $request->input('invoice_id');

        $data['payments'] = Payment::where('invoice_no', $bill_no)->first();
//        dd($data['payments']);

        return view('payment.searchinformation',compact('data'));
    }

    public function reportlist(PaymentRequest $request)
    {

        $data['setting'] = Setting::first();
        $date_to = $request->input('date_to');
        $date_from = $request->input('date_from');
        $today = date('Y-m-d H:i:s');
        $total_amount = 0;
        if ($date_to){
            if ($today > $date_from && $today >= $date_to) {
                if ($date_from <= $date_to) {
                    $data['payments'] = Payment::whereBetween('payment_date', [$date_from, $date_to])->get();
                    $total_amount = Payment::whereBetween('payment_date', [$date_from, $date_to])->sum('amount');
                } else {
                    $request->session()->flash('error', 'Invalid Request');
                }
            } else{
                $request->session()->flash('error', 'Invalid Date Format');
            }
        } else{
            $date_to = Carbon::now();
            if ($today > $date_from) {
                $data['payments'] = Payment::whereBetween('payment_date', [$date_from, $date_to])->get();
                $total_amount = Payment::whereBetween('payment_date', [$date_from, $date_to])->sum('amount');
            }else{
                $request->session()->flash('error', 'Invalid Date Format');
            }
        }
        return view('payment.index',compact('data','total_amount'));
    }


}
