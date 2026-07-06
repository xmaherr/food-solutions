<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use OpenApi\Attributes as OA;

class ServiceController extends Controller
{
    #[OA\Get(
        path: "/api/services",
        summary: "Get all active services with their reviews",
        tags: ["Services"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Success",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "total", type: "integer", example: 5),
                        new OA\Property(
                            property: "data",
                            type: "array",
                            items: new OA\Items(
                                type: "object",
                                properties: [
                                    new OA\Property(property: "id", type: "integer"),
                                    new OA\Property(property: "title_ar", type: "string"),
                                    new OA\Property(property: "icon", type: "string"),
                                    new OA\Property(property: "short_description_ar", type: "string"),
                                    new OA\Property(property: "long_description_ar", type: "string"),
                                    new OA\Property(property: "points", type: "array", items: new OA\Items(type: "string")),
                                    new OA\Property(property: "image", type: "string"),
                                    new OA\Property(
                                        property: "service_reviews",
                                        type: "object",
                                        properties: [
                                            new OA\Property(property: "total", type: "integer", example: 10),
                                            new OA\Property(property: "averageRate", type: "number", format: "float", example: 4.5),
                                            new OA\Property(
                                                property: "data",
                                                type: "array",
                                                items: new OA\Items(
                                                    type: "object",
                                                    properties: [
                                                        new OA\Property(property: "name", type: "string", example: "أحمد محمد"),
                                                        new OA\Property(property: "comment", type: "string", example: "خدمة رائعة"),
                                                        new OA\Property(property: "rate", type: "integer", example: 5)
                                                    ]
                                                )
                                            )
                                        ]
                                    )
                                ]
                            )
                        )
                    ]
                )
            )
        ]
    )]
    public function index()
    {
        $services = Service::with('reviews')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $formattedServices = $services->map(function ($service) {
            $reviews = $service->reviews;

            return [
                'id'                  => $service->id,
                // Keys kept identical to old API contract; values are language-aware via accessors
                'title_ar'            => $service->title,             // accessor returns correct lang value
                'icon'                => $service->icon,
                'short_description_ar' => $service->short_description, // accessor returns correct lang value
                'long_description_ar'  => $service->long_description,  // accessor returns correct lang value
                'points'              => $service->points,             // accessor returns correct lang value
                'image'               => $service->image,

                'service_reviews' => [
                    'total'       => $reviews->count(),
                    'averageRate' => round($reviews->avg('rate') ?? 0, 1),
                    'data'        => $reviews->map(fn ($review) => [
                        'name'    => $review->name,
                        'comment' => $review->comment,
                        'rate'    => $review->rate,
                    ]),
                ],
            ];
        });

        return response()->json([
            'total' => $formattedServices->count(),
            'data'  => $formattedServices,
        ]);
    }

    #[OA\Get(
        path: "/api/services/lookup",
        summary: "Get lightweight list of services",
        tags: ["Services"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Success",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "total", type: "integer"),
                        new OA\Property(
                            property: "data",
                            type: "array",
                            items: new OA\Items(
                                type: "object",
                                properties: [
                                    new OA\Property(property: "id", type: "integer"),
                                    new OA\Property(property: "title", type: "string")
                                ]
                            )
                        )
                    ]
                )
            )
        ]
    )]
    public function lookup()
    {
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id', 'title_ar', 'title_en']);

        $data = $services->map(fn ($service) => [
            'id'    => $service->id,
            'title' => $service->title, // accessor returns correct lang value
        ]);

        return response()->json([
            'total' => $data->count(),
            'data'  => $data,
        ]);
    }
}