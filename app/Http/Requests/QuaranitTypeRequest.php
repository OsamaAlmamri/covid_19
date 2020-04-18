<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuaranitTypeRequest extends FormRequest
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
//        return dd($this->route()->user);
////          'email', 'password', 'username', 'avatar', 'work_team_id', 'status', 'deleted_by', 'created_by',
        return [
            'name' => [
                'required', 'string', $this->method() == 'PUT' ? Rule::unique('quarantine_area_types', 'name')->ignore($this->route()->quarantineType->id) : Rule::unique('quarantine_area_types', 'name')],
];
    }

    public function messages()
    {
        return [
            'name.required' => 'إسم النوع مطلوب',
            'name.unique' => '   هذا النوع موجود  من قبل',

        ];
    }
}
