<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersRequest extends FormRequest
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
////        truck_image, ssn_image,truck_number,company_id,governorate_id,zone_id,avatar,phone
        return [
            'username' => [
                'required', 'string', $this->method() == 'PUT' ? Rule::unique('users', 'username')->ignore($this->route()->user->id) : Rule::unique('users', 'username')],
            'name' => 'required|string',
            'email' => [ 'string', 'email', $this->method() == 'PUT' ? Rule::unique('users', 'email')->ignore($this->route()->user->id) : Rule::unique('users', 'email')],
            'phone' => ['required', 'string', $this->method() == 'PUT' ? Rule::unique('users', 'phone')->ignore($this->route()->user->id) : Rule::unique('users', 'phone')],
            'password' => $this->method() == 'PUT' ? 'confirmed' : 'required|confirmed',
//            'phone_number' => $this->method() == 'PUT' ? 'string' : 'required|string',
            'avatar' => 'image|max:5242880',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'إسم المستخدم مطلوب',
            'username.unique' => 'إسم المستخدم هذا مستخدم من قبل',
            'name.required' => 'الإسم مطلوب',
            'email.required' => 'الإيميل مطلوب',
            'email.email' => 'صيغة الإيميل غير صالحة',
            'email.unique' => 'هذا الإيميل مستخدم بالفعل',
            'phone.unique' => 'رقم الهاتف مستخدم من قبل',
            'phone_number.required' => 'رقم الهاتف مطلوب',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
            'avatar.image' => 'ملف الصورة غير صالح',
            'avatar.max' => 'حجم الصورة يجب ألا يزيد عن 5 ميجابيت',
        ];
    }
}
