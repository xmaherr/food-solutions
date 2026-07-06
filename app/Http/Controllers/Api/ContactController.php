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
                                    new OA\Property(
                                        property: "platform",
                                        type: "object",
                                        properties: [
                                            new OA\Property(property: "id", type: "integer"),
                                            new OA\Property(property: "name", type: "string"),
                                            new OA\Property(property: "color", type: "string")
                                        ]
                                    ),
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
        $contacts = Contact::where('is_active', true)
            ->where('type', 'contact')
            ->orderBy('sort_order')
            ->get();

        $socials = Contact::with('platform')
            ->where('is_active', true)
            ->where('type', 'social')
            ->orderBy('sort_order')
            ->get();

        $contactsFormatted = $contacts->map(fn ($contact) => [
            'title' => $contact->title, // accessor → language-aware
            'icon'  => $contact->icon,
            'value' => $contact->value,
            'link'  => $contact->link,
        ]);

        $socialsFormatted = $socials->map(fn ($social) => [
            'platform' => $social->platform ? [
                'id'    => $social->platform->id,
                'name'  => $social->platform->name,  // accessor → language-aware
                'color' => $social->platform->color,
            ] : null,
            'icon'  => $social->icon,
            'value' => $social->value,
            'link'  => $social->link,
        ]);

        return response()->json([
            'total_contacts' => $contactsFormatted->count(),
            'contacts'       => $contactsFormatted,
            'total_socials'  => $socialsFormatted->count(),
            'socials'        => $socialsFormatted,
        ]);
    }
}