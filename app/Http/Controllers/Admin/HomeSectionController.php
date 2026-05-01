<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSection;
use App\Services\ImageUploadService;

class HomeSectionController extends Controller
{
    public function index()
    {
        $sections = HomeSection::orderBy('sort_order')->get();
        return view('admin.home-sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.home-sections.create');
    }

    public function store(Request $request, ImageUploadService $uploadService)
    {
        $data = $request->validate([
            'image' => 'required|file|image|max:5120',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $uploadService->upload($request->file('image'), 'images/home_sections');
        }

        HomeSection::create($data);
        return redirect()->route('admin.home-sections.index')->with('success', 'Home Section created successfully.');
    }

    public function edit(HomeSection $home_section)
    {
        return view('admin.home-sections.edit', compact('home_section'));
    }

    public function update(Request $request, HomeSection $home_section, ImageUploadService $uploadService)
    {
        $data = $request->validate([
            'image' => 'nullable|file|image|max:5120',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $uploadService->upload($request->file('image'), 'images/home_sections', $home_section->getRawOriginal('image'));
        } else {
            unset($data['image']);
        }

        $home_section->update($data);
        return redirect()->route('admin.home-sections.index')->with('success', 'Home Section updated successfully.');
    }

    public function destroy(HomeSection $home_section, ImageUploadService $uploadService)
    {
        $uploadService->delete($home_section->getRawOriginal('image'));
        $home_section->delete();
        return redirect()->route('admin.home-sections.index')->with('success', 'Home Section deleted successfully.');
    }
}
