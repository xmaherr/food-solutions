<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // تغييرها إلى true لتسمح للجميع بالتقييم (أو ضع شروطك هنا)
    }

    public function rules(): array
    {
        return [
            'service_id' => 'required|exists:services,id', // التأكد أن الخدمة موجودة في قاعدة البيانات
            'name' => 'required|string|max:255',
            'comment' => 'nullable|string|max:1000',
            'rate' => 'required|numeric|min:1|max:5', // التحقق أن التقييم بين 1 و 5 نجوم
        ];
    }
}