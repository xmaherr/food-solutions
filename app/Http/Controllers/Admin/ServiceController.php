<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Services\ImageUploadService;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request, ImageUploadService $uploadService)
    {
        $data = $request->validate([
            'title_ar' => 'required|string|max:255',
            'short_description_ar' => 'required|string',
            'long_description_ar' => 'required|string',
            'image' => 'required|file|image|max:5120',
            'icon' => 'required|file|image|max:5120',
            'sort_order' => 'integer',
            'points' => 'nullable|array'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $uploadService->upload($request->file('image'), 'images/services');
        }
        
        if ($request->hasFile('icon')) {
            $data['icon'] = $uploadService->upload($request->file('icon'), 'icons/services');
        }

        $data['is_active'] = $request->has('is_active');
        
        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service, ImageUploadService $uploadService)
    {
        $data = $request->validate([
            'title_ar' => 'required|string|max:255',
            'short_description_ar' => 'required|string',
            'long_description_ar' => 'required|string',
            'image' => 'nullable|file|image|max:5120',
            'icon' => 'nullable|file|image|max:5120',
            'sort_order' => 'integer',
            'points' => 'nullable|array'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $uploadService->upload($request->file('image'), 'images/services', $service->getRawOriginal('image'));
        } else {
            unset($data['image']);
        }
        
        if ($request->hasFile('icon')) {
            $data['icon'] = $uploadService->upload($request->file('icon'), 'icons/services', $service->getRawOriginal('icon'));
        } else {
            unset($data['icon']);
        }

        $data['is_active'] = $request->has('is_active');
        
        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service, ImageUploadService $uploadService)
    {
        $uploadService->delete($service->getRawOriginal('image'));
        $uploadService->delete($service->getRawOriginal('icon'));
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
