<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use OpenApi\Attributes as OA;

class StatisticController extends Controller
{
    #[OA\Get(
        path: "/api/statistics",
        summary: "Get company statistics",
        tags: ["Statistics"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Success",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "data",
                            type: "object",
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 1),
                                new OA\Property(property: "years_of_experience", type: "integer", example: 10),
                                new OA\Property(property: "clients_count", type: "integer", example: 250),
                                new OA\Property(property: "projects_count", type: "integer", example: 180)
                            ]
                        )
                    ]
                )
            )
        ]
    )]
    public function index()
    {
        $statistic = Statistic::select(['id', 'years_of_experience', 'clients_count', 'projects_count'])->first();
        
        return response()->json([
            'data' => $statistic
        ]);
    }
}
