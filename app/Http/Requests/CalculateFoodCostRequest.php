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
}