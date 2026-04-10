<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultationRequest;
use App\Models\Consultation;
use App\Models\Setting;
use App\Mail\ConsultationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;

class ConsultationController extends Controller
{
    #[OA\Post(
        path: "/api/consultation",
        summary: "Submit a new request",
        tags: ["Consultations"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["name", "phone", "email", "service_id"],
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Ahmed"),
                    new OA\Property(property: "phone", type: "string", example: "0512345678"),
                    new OA\Property(property: "email", type: "string", format: "email", example: "ahmed@example.com"),
                    new OA\Property(property: "service_id", type: "integer", example: 1),
                    new OA\Property(property: "message", type: "string", example: "I need some help.")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Success",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "تم إرسال طلبك بنجاح، سنتواصل معك قريباً")
                    ]
                )
            ),
            new OA\Response(response: 422, description: "Validation Error")
        ]
    )]
    public function store(StoreConsultationRequest $request)
    {
        $consultation = Consultation::create($request->validated());
        
        $emailSetting = Setting::where('key', 'consultation_email')->first();
        if ($emailSetting && $emailSetting->value) {
            try {
                Mail::to($emailSetting->value)->send(new ConsultationMail($consultation));
            } catch (\Exception $e) {
                Log::error('Failed to send consultation email: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'تم إرسال طلبك بنجاح، سنتواصل معك قريباً'
        ]);
    }
}