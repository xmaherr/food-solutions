<?php

$dir = __DIR__ . '/app/Http/Controllers';

file_put_contents($dir . '/Controller.php', <<<'EOF'
<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(version: "1.0.0", title: "Food Solutions API")]
#[OA\Server(url: "/")]
abstract class Controller
{
    //
}
EOF
);

file_put_contents($dir . '/Api/ConsultationController.php', <<<'EOF'
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
EOF
);

file_put_contents($dir . '/Api/ContactController.php', <<<'EOF'
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use OpenApi\Attributes as OA;

class ContactController extends Controller
{
    #[OA\Get(
        path: "/api/contacts",
        summary: "Get all active contacts and social links",
        tags: ["Contacts"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Success",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "total_contacts", type: "integer"),
                        new OA\Property(
                            property: "contacts",
                            type: "array",
                            items: new OA\Items(
                                type: "object",
                                properties: [
                                    new OA\Property(property: "title", type: "string"),
                                    new OA\Property(property: "icon", type: "string"),
                                    new OA\Property(property: "value", type: "string"),
                                    new OA\Property(property: "link", type: "string")
                                ]
                            )
                        ),
                        new OA\Property(property: "total_socials", type: "integer"),
                        new OA\Property(
                            property: "socials",
                            type: "array",
                            items: new OA\Items(
                                type: "object",
                                properties: [
                                    new OA\Property(property: "title", type: "string"),
                                    new OA\Property(property: "icon", type: "string"),
                                    new OA\Property(property: "value", type: "string"),
                                    new OA\Property(property: "link", type: "string")
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
        $contacts = Contact::where('is_active', true)->where('type', 'contact')->orderBy('sort_order')->get(['title', 'icon', 'value', 'link']);
        $socials = Contact::where('is_active', true)->where('type', 'social')->orderBy('sort_order')->get(['title', 'icon', 'value', 'link']);

        return response()->json([
            'total_contacts' => $contacts->count(),
            'contacts' => $contacts,
            'total_socials' => $socials->count(),
            'socials' => $socials
        ]);
    }
}
EOF
);

file_put_contents($dir . '/Api/ServiceController.php', <<<'EOF'
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
EOF
);

echo "Updated correctly to attributes.";
