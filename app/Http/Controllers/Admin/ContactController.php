<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Services\ImageUploadService;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('sort_order')->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function create()
    {
        $platforms = \App\Models\Platform::all();
        return view('admin.contacts.create', compact('platforms'));
    }

    public function store(Request $request, ImageUploadService $uploadService)
    {
        $data = $request->validate([
            'type' => 'required|in:contact,social',
            'title' => 'required_if:type,contact|string|max:255|nullable',
            'platform_id' => 'required_if:type,social|exists:platforms,id|nullable',
            'icon' => 'required|file|max:5120',
            'value' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'sort_order' => 'integer',
        ]);

        if ($data['type'] === 'social') {
            $platform = \App\Models\Platform::find($data['platform_id']);
            $data['title'] = strtoupper($platform->name);
        } else {
            $data['platform_id'] = null;
        }

        if ($request->hasFile('icon')) {
            $data['icon'] = $uploadService->upload($request->file('icon'), 'images/icons');
        }

        $data['is_active'] = $request->has('is_active');
        
        Contact::create($data);
        return redirect()->route('admin.contacts.index')->with('success', 'Contact created successfully.');
    }

    public function edit(Contact $contact)
    {
        $platforms = \App\Models\Platform::all();
        return view('admin.contacts.edit', compact('contact', 'platforms'));
    }

    public function update(Request $request, Contact $contact, ImageUploadService $uploadService)
    {
        $data = $request->validate([
            'type' => 'required|in:contact,social',
            'title' => 'required_if:type,contact|string|max:255|nullable',
            'platform_id' => 'required_if:type,social|exists:platforms,id|nullable',
            'icon' => 'nullable|file|max:5120',
            'value' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'sort_order' => 'integer',
        ]);

        if ($data['type'] === 'social') {
            $platform = \App\Models\Platform::find($data['platform_id']);
            $data['title'] = strtoupper($platform->name);
        } else {
            $data['platform_id'] = null;
        }

        if ($request->hasFile('icon')) {
            $data['icon'] = $uploadService->upload($request->file('icon'), 'images/icons', $contact->getRawOriginal('icon'));
        } else {
            unset($data['icon']);
        }

        $data['is_active'] = $request->has('is_active');
        
        $contact->update($data);
        return redirect()->route('admin.contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact, ImageUploadService $uploadService)
    {
        $uploadService->delete($contact->getRawOriginal('icon'));
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
