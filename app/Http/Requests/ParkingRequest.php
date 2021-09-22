<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParkingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'car_no'=>'required|regex:/^[a-zA-Z\d\ ]+$/', // alphabet with digit and space
            'customer_name' => 'required|regex:/^[a-zA-Z\ ]+$/', // alphabet with space
            'parking_slot_no' => 'required',
        ];
    }
}
