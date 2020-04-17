<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'priority' => 'required|string',
            'phase_id' => 'required|string',

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'عنوان المهمة مطلوب',
            'description.required' => 'وصف المهمة مطلوب',
            'start_date.required' => ' تاريخ بداية المهمة مطلوب',
            'end_date.required' => 'تاريخ انهاء المهمة مطلوب',
            'code.required' => 'رمز المهمة مطلوب',
            'phase_id.required' => 'رقم المرحلة مطلوب',

        ];
    }
}
