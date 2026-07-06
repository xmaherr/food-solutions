<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email_or_phone' => ['required', 'string'],
            'password'       => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email_or_phone.required' => 'حقل البريد الإلكتروني أو رقم الهاتف مطلوب.',
            'email_or_phone.string'   => 'يجب أن يكون النص صالحاً.',
            'password.required'       => 'حقل كلمة المرور مطلوب.',
            'password.string'         => 'كلمة المرور يجب أن تكون نصاً.',
        ];
    }
}
