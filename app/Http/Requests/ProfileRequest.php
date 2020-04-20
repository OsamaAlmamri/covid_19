<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
        $rules = [];
        $rules['username'] = ['string', Rule::unique('users', 'username')->ignore(auth()->user()->id)];
        $rules['email'] = ['required', 'string', 'email', Rule::unique('users', 'email')->ignore(auth()->user()->id)];
        $rules['password'] = 'confirmed';
        $rules['avatar2'] = 'image|max:5242880';

        return $rules;

    }

    public function messages()
    {
        return [
            'username.required' => 'إسم المستخدم مطلوب',
            'username.unique' => 'إسم المستخدم هذا مستخدم من قبل',
            'email.required' => 'الإيميل مطلوب',
            'email.email' => 'صيغة الإيميل غير صالحة',
            'email.unique' => 'هذا الإيميل مستخدم بالفعل',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
            'avatar2.image' => 'ملف الصورة غير صالح',
            'avatar2.max' => 'حجم الصورة يجب ألا يزيد عن 5 ميجابيت',
        ];
    }
}

