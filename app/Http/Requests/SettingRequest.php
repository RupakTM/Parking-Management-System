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
            'name'=>'required',
            'address' => 'required',
            'pan_no'=>'required',
            'reg_no' => 'required',
            'phone'=>'required',
            'price_per_hour' => 'required',
            'logo_file' => 'mimes:png,jpg|max:2048',
            'fav_file' => 'mimes:png,jpg|max:2048',
        ];
    }
}
