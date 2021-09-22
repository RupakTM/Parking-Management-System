<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=>'required|regex:/^[a-zA-Z\ ]+$/',
            'email' =>'email:rfc,dns',
            'address' => 'required',
            'phone'=>'required|regex:/^(98)([0-9]{8})$/', //starting with 98 followed by 8 digits
            'image' => 'mimes:png,jpg|max:2048',
        ];

    }
}
