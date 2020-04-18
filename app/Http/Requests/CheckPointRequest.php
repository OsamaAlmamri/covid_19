<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckPointRequest extends FormRequest
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
        //   'name', 'manager_id', 'zone_id', 'longitude',
        // 'latitude', 'map_address', 'status', 'deleted_by', 'created_by',
        return [
            'manager_id' => 'required|numeric',
            'zone_id' => 'required|numeric',
            'name' => 'required|string',


        ];
    }

    public function messages()
    {
        return [
            'name.required' => '  عنوان المركز مطلوب',
            'manager_id.required' => '  يجب تحديد المدير  ',
        ];
    }
}
