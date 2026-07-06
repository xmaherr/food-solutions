<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_id' => 'required|exists:services,id',
            'name'       => 'required|string|max:255',
            'comment'    => 'nullable|string|max:1000',
            'rate'       => 'required|numeric|min:1|max:5',
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required' => 'الرجاء اختيار الخدمة.',
            'service_id.exists'   => 'الخدمة المحددة غير موجودة.',
            'name.required'       => 'حقل الاسم مطلوب.',
            'name.string'         => 'الاسم يجب أن يكون نصاً.',
            'name.max'            => 'الاسم يجب ألا يتجاوز 255 حرفاً.',
            'comment.string'      => 'التعليق يجب أن يكون نصاً.',
            'comment.max'         => 'التعليق يجب ألا يتجاوز 1000 حرف.',
            'rate.required'       => 'حقل التقييم مطلوب.',
            'rate.numeric'        => 'التقييم يجب أن يكون رقماً.',
            'rate.min'            => 'أقل تقييم مسموح به هو 1.',
            'rate.max'            => 'أعلى تقييم مسموح به هو 5.',
        ];
    }
}