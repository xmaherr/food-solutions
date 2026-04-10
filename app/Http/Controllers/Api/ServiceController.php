<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use OpenApi\Attributes as OA;

class ServiceController extends Controller
{
    #[OA\Get(
        path: "/api/services",
        summary: "Get all active services",
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
                                    new OA\Property(property: "title_ar", type: "string"),
                                    new OA\Property(property: "icon", type: "string"),
                                    new OA\Property(property: "short_description_ar", type: "string"),
                                    new OA\Property(property: "long_description_ar", type: "string"),
                                    new OA\Property(property: "points", type: "array", items: new OA\Items(type: "string")),
                                    new OA\Property(property: "image", type: "string")
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
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        return response()->json([
            'total' => $services->count(),
            'data' => $services
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