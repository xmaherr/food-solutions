<?php

namespace App\Services;

class FoodCostService
{
    public function calculate(array $data): array
    {
        $totalCost = $data['total_ingredient_cost'];
        $menuPrice = $data['menu_price'];
        $servings  = $data['servings_per_recipe'];

        // Core calculations
        $costPerServing     = round($totalCost / $servings, 2);
        $foodCostPercentage = round(($costPerServing / $menuPrice) * 100, 2);
        $profitPerServing   = round($menuPrice - $costPerServing, 2);
        $profitMargin       = round(($profitPerServing / $menuPrice) * 100, 2);
        $markup             = round(($profitPerServing / $costPerServing) * 100, 2);
        $totalRevenue       = round($menuPrice * $servings, 2);
        $totalProfit        = round($profitPerServing * $servings, 2);

        // Status
        if ($foodCostPercentage < 28) {
            $status  = 'excellent';
            $message = 'Good — within the ideal 28-30% range';
        } elseif ($foodCostPercentage <= 35) {
            $status  = 'normal';
            $message = 'Normal — acceptable average aligned with global market.';
        } else {
            $status  = 'high';
            $message = 'Warning: Cost is high! Review ingredient prices or raise the selling price.';
        }

        // Suggested menu prices based on total ingredient cost (not per serving)
        // formula: suggested_price = cost_per_serving / target_percentage
        $suggestedPrices = [
            ['target_percentage' => 25, 'label' => 'Premium', 'price' => round($costPerServing / 0.25, 2)],
            ['target_percentage' => 28, 'label' => 'Ideal',   'price' => round($costPerServing / 0.28, 2)],
            ['target_percentage' => 30, 'label' => 'Average', 'price' => round($costPerServing / 0.30, 2)],
            ['target_percentage' => 35, 'label' => 'Max',     'price' => round($costPerServing / 0.35, 2)],
        ];

        return [
            // Main metric
            'food_cost_percentage' => $foodCostPercentage,
            'status'               => $status,
            'guidance_message'     => $message,

            // Per-serving breakdown
            'cost_per_serving'     => $costPerServing,
            'profit_per_serving'   => $profitPerServing,
            'profit_margin'        => $profitMargin,

            // Business metrics
            'markup'               => $markup,
            'total_revenue'        => $totalRevenue,
            'total_profit'         => $totalProfit,

            // Formula breakdown (for "How We Calculated It" section)
            'formula' => [
                'cost_per_serving'     => $costPerServing,
                'menu_price'           => $menuPrice,
                'food_cost_percentage' => $foodCostPercentage,
            ],

            // Suggested prices table
            'suggested_prices' => $suggestedPrices,
        ];
    }
}