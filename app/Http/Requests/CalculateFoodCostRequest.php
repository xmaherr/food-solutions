<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateFoodCostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'total_ingredient_cost' => ['required', 'numeric', 'min:0'],
            'menu_price'            => ['required', 'numeric', 'min:0.01'],
            'servings_per_recipe'   => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'total_ingredient_cost.required' => 'حقل إجمالي تكلفة المكونات مطلوب.',
            'total_ingredient_cost.numeric'  => 'إجمالي تكلفة المكونات يجب أن يكون رقماً.',
            'total_ingredient_cost.min'      => 'إجمالي تكلفة المكونات يجب ألا يكون أقل من الصفر.',
            'menu_price.required'            => 'حقل سعر القائمة مطلوب.',
            'menu_price.numeric'             => 'سعر القائمة يجب أن يكون رقماً.',
            'menu_price.min'                 => 'سعر القائمة يجب أن يكون أكبر من الصفر.',
            'servings_per_recipe.required'   => 'حقل عدد الحصص في الوصفة مطلوب.',
            'servings_per_recipe.integer'    => 'عدد الحصص يجب أن يكون عدداً صحيحاً.',
            'servings_per_recipe.min'        => 'عدد الحصص يجب أن يكون 1 على الأقل.',
        ];
    }
}