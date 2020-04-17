<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhaseRequest extends FormRequest
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
            'description' => 'required|string',
            'title' => 'required|string',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'project_id' => 'required|string',

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'عنوان المرحلة مطلوب',
            'description.required' => 'وصف المرحلة مطلوب',
            'start_date.required' => ' تاريخ بداية المرحلة مطلوب',
            'end_date.required' => 'تاريخ انهاء المرحلة مطلوب',
            'project_id.required' => ' المشروع مطلوب',

        ];
    }
}
