<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorkTeamRequest extends FormRequest
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
        //
// 'name', 'zone_id', 'phone', 'ssn', 'workType', 'job', 'birth_date',
//        'gender', 'join_date', 'country', 'deleted_by', 'created_by',

        return [
            'ssn' => [ 'required', 'string', $this->method() == 'PUT' ? Rule::unique('work_teams', 'ssn')->ignore($this->route()->workTeam->id) : Rule::unique('work_teams', 'ssn')],
            'phone' => [ 'required', 'string', $this->method() == 'PUT' ? Rule::unique('work_teams', 'phone')->ignore($this->route()->workTeam->id) : Rule::unique('work_teams', 'phone')],
            'name' => 'required|string',
            'workType' => 'required|string',
            'job' => 'required|string',
            'birth_date' => 'required|string',
            'join_date' => 'required|string',
            'gender' => 'required|string',
            'country' => 'required|string',
            'zone_id' => 'required|numeric',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => '   اسم الشخص  مطلوب',
            'phone.required' => '  رقم التلفون مطلوب',
            'ssn.required' => '  رقم البطاقة او الجواز مطلوب',
            'workType.required' => 'نوع العمل مطلوب',
            'job.required' => 'وظيفة الشخص  مطلوب ',
            'birth_date.required' => ' تاريخ الميلاد  مطلوب',
            'join_date.required' => ' تاريخ الانضمام الى فريق العمل  مطلوب',
            'gender.required' => 'نوع الجنس   مطلوب',
            'country.required' => 'الدولة    مطلوبة',

        ];
    }
}
