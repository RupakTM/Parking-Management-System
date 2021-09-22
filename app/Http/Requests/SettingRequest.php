<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'name'=>'required|regex:/^[a-zA-Z\ \.]+$/',
            'address' => 'required',
            'pan_no'=>'required',
            'reg_no' => 'required',
            'phone'=>'required|regex:/^(98)([0-9]{8})$/',
            'price_per_hour' => 'required|numeric',
            'logo_file' => 'mimes:png,jpg|max:2048',
            'fav_file' => 'mimes:png,jpg|max:2048',
        ];
    }
}
