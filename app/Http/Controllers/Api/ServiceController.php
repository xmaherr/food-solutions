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
                                    // 👇 الـ Object الجديد الخاص بالتقييمات في السواجر
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
        // سحب الخدمات مع علاقة الـ reviews لتجنب مشكلة الـ N+1 Query
        $services = Service::with('reviews')->where('is_active', true)->orderBy('sort_order')->get();

        $formattedServices = $services->map(function ($service) {
            $reviews = $service->reviews;

            return [
                'id' => $service->id,
                'title_ar' => $service->title_ar,
                'icon' => $service->icon,
                'short_description_ar' => $service->short_description_ar,
                'long_description_ar' => $service->long_description_ar,
                'points' => $service->points,
                'image' => $service->image,

                'service_reviews' => [
                    'total' => $reviews->count(),
                    'averageRate' => round($reviews->avg('rate'), 1) ?? 0,
                    'data' => $reviews->map(function ($review) {
                        return [
                            'name' => $review->name,
                            'comment' => $review->comment,
                            'rate' => $review->rate,
                        ];
                    })
                ]
            ];
        });

        return response()->json([
            'total' => $formattedServices->count(),
            'data' => $formattedServices
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
        $services = Service::where('is_active', true)->orderBy('sort_order')->select('id', 'title_ar as title')->get();
        return response()->json([
            'total' => $services->count(),
            'data' => $services
        ]);
    }
}