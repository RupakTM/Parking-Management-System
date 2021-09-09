<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\SettingRequest;
use App\Models\Payment;
use App\Models\Setting;
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

        $bill_no = $request->input('searchBill');
        //Store Data To payment Table

        //payment data stored

        $data['payments'] = DB::table('payments')
            ->select("*")
            ->where('invoice_no', $bill_no)
            ->get();
//        dd($data['payments']);

        return view('payment.searchinformation',compact('data'));
    }

    public function report(PaymentRequest $request)
    {

        $data['setting'] = Setting::first();

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        //Store Data To payment Table

        //payment data stored

        $data['payments'] = DB::table('payments')
            ->select("*")
            ->whereBetween('payment_date', [$date_from, $date_to])
            ->get();
//        dd($data['payments']);

        return view('payment.index',compact('data'));
    }


}
