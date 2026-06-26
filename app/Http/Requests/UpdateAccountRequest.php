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
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'phone' => [
                'sometimes',
                'required',
                'string',
                'max:30',
                Rule::unique('users', 'phone')->ignore($this->user()->id),
            ],
            'email' => [
                'sometimes',
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user()->id),
            ],
            'password' => ['sometimes', 'nullable', 'string', 'min:8', 'confirmed'],
        ];
    }
}
