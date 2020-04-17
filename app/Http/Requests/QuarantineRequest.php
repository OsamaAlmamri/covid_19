<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuarantineRequest extends FormRequest
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
        //                                    maxCapacity,manager_id,quarantine_area_type_id,zone_id,name
        return [
            'maxCapacity' => 'required|numeric',
            'manager_id' => 'required|numeric',
            'quarantine_area_type_id' => 'required|numeric',
            'zone_id' => 'required|numeric',
            'name' => 'required|string',


        ];
    }

    public function messages()
    {
        return [
            'name.required' => '  عنوان المركز مطلوب',
            'maxCapacity.required' => 'اقصى سعة   مطلوب',
            'maxCapacity.numeric' => 'اقصى سعة يجب ان يكون رقم',


        ];
    }
}
