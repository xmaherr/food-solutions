<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'phone'    => ['required', 'string', 'max:30', 'unique:users,phone'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'حقل الاسم مطلوب.',
            'name.string'        => 'الاسم يجب أن يكون نصاً.',
            'name.max'           => 'الاسم يجب ألا يتجاوز 255 حرفاً.',
            'phone.required'     => 'حقل رقم الهاتف مطلوب.',
            'phone.string'       => 'رقم الهاتف يجب أن يكون نصاً.',
            'phone.max'          => 'رقم الهاتف يجب ألا يتجاوز 30 حرفاً.',
            'phone.unique'       => 'رقم الهاتف مسجل مسبقاً.',
            'email.required'     => 'حقل البريد الإلكتروني مطلوب.',
            'email.email'        => 'يجب إدخال بريد إلكتروني صالح.',
            'email.max'          => 'البريد الإلكتروني يجب ألا يتجاوز 255 حرفاً.',
            'email.unique'       => 'البريد الإلكتروني مسجل مسبقاً.',
            'password.required'  => 'حقل كلمة المرور مطلوب.',
            'password.string'    => 'كلمة المرور يجب أن تكون نصاً.',
            'password.min'       => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل.',
            'password.confirmed' => 'كلمة المرور وتأكيدها غير متطابقتين.',
        ];
    }
}
