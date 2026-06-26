<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateFoodCostRequest;
use App\Services\FoodCostService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class FoodCostController extends Controller
{
    #[OA\Post(
        path: '/api/tools/food-cost-calculator',
        summary: 'Calculate food cost percentage for mobile app',
        security: [['sanctum' => []]], // أضفنا سطر الحماية هنا لـ Swagger أيضاً
        tags: ['Tools'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['total_ingredient_cost', 'menu_price', 'servings_per_recipe'],
                properties: [
                    new OA\Property(property: 'total_ingredient_cost', type: 'number', format: 'float', example: 50.00),
                    new OA\Property(property: 'menu_price', type: 'number', format: 'float', example: 45.00),
                    new OA\Property(property: 'servings_per_recipe', type: 'integer', example: 4)
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Calculation completed'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    // قمنا بتغيير اسم الميثود هنا إلى calculate لتجنب أي تعارض مع الـ Middleware
    public function calculate(CalculateFoodCostRequest $request, FoodCostService $service): JsonResponse
    {
        $result = $service->calculate($request->validated());

        return response()->json($result);
    }
}