<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'code' => 'required|string',

        ];
    }

    public function messages()
    {
        return [
            'title.required' => '  عنوان المشروع مطلوب',
            'description.required' => 'وصف المشروع مطلوب',
            'start_date.required' => ' تاريخ بداية المشروع مطلوب',
            'end_date.required' => 'تاريخ انهاء المشروع مطلوب',
            'code.required' => 'رمز المشروع مطلوب',

        ];
    }
}
