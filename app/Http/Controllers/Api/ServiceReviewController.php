<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreReviewRequest;
use App\Models\ServiceReview;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;

class ServiceReviewController extends Controller
{
    #[OA\Post(
        path: "/api/services/reviews",
        summary: "Submit a new review for a service",
        tags: ["Service Reviews"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["service_id", "name", "rate"],
                properties: [
                    new OA\Property(property: "service_id", type: "integer", example: 1),
                    new OA\Property(property: "name", type: "string", example: "أحمد محمد"),
                    new OA\Property(property: "comment", type: "string", example: "الخدمة ممتازة وسريعة جداً، أنصح بالتعامل معهم.", nullable: true),
                    // تم التعديل هنا ليدعم الكسور في طلب الـ API
                    new OA\Property(property: "rate", type: "number", format: "float", minimum: 1, maximum: 5, example: 4.5)
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 210,
                description: "Review submitted successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "Review submitted successfully!"),
                        new OA\Property(
                            property: "data",
                            type: "object",
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 1),
                                new OA\Property(property: "service_id", type: "integer", example: 1),
                                new OA\Property(property: "name", type: "string", example: "أحمد محمد"),
                                new OA\Property(property: "comment", type: "string", example: "الخدمة ممتازة وسريعة جداً، أنصح بالتعامل معهم."),
                                // تم التعديل هنا أيضاً في شكل الـ Response المتوقع
                                new OA\Property(property: "rate", type: "number", format: "float", example: 4.5),
                                new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2026-07-03T08:00:00.000000Z"),
                                new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2026-07-03T08:00:00.000000Z")
                            ]
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: "Validation error"
            )
        ]
    )]
    public function store(StoreReviewRequest $request): JsonResponse
    {
        // البيانات القادمة هنا تم التحقق منها تلقائياً بناءً على الـ StoreReviewRequest
        $review = ServiceReview::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully!',
            'data' => $review
        ], 210); // تم تثبيتها بناءً على طلبك
    }
}