<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['sometimes', 'required', 'string', 'max:255'],
            'phone'    => [
                'sometimes',
                'required',
                'string',
                'max:30',
                Rule::unique('users', 'phone')->ignore($this->user()->id),
            ],
            'email'    => [
                'sometimes',
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user()->id),
            ],
            'password' => ['sometimes', 'nullable', 'string', 'min:8', 'confirmed'],
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
            'password.string'    => 'كلمة المرور يجب أن تكون نصاً.',
            'password.min'       => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل.',
            'password.confirmed' => 'كلمة المرور وتأكيدها غير متطابقتين.',
        ];
    }
}
