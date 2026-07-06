<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use OpenApi\Attributes as OA;

class HomeController extends Controller
{
    #[OA\Get(
        path: "/api/home",
        summary: "Get all home sections",
        tags: ["Home"],
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
                                    new OA\Property(property: "image", type: "string"),
                                    new OA\Property(property: "title", type: "string"),
                                    new OA\Property(property: "subtitle", type: "string"),
                                    new OA\Property(property: "description", type: "string"),
                                    new OA\Property(property: "sort_order", type: "integer")
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
        $sections = HomeSection::orderBy('sort_order')->get();

        $data = $sections->map(fn ($section) => [
            'id'          => $section->id,
            'image'       => $section->image,
            'title'       => $section->title,       // via accessor → language-aware
            'subtitle'    => $section->subtitle,    // via accessor → language-aware
            'description' => $section->description, // via accessor → language-aware
            'sort_order'  => $section->sort_order,
        ]);

        return response()->json([
            'total' => $data->count(),
            'data'  => $data,
        ]);
    }
}
