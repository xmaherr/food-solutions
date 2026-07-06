@extends('admin.layout.admin')
@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Home Section</h2>
<div class="bg-white shadow rounded p-6">
    <form action="{{ route('admin.home-sections.update', $home_section) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Image File</label>
                <input type="file" name="image" class="w-full border rounded px-3 py-2 mb-2">
                @if($home_section->image)
                    <img src="{{ $home_section->image }}" class="w-32 h-32 object-cover border" alt="Current Image">
                    <p class="text-xs text-gray-500 mt-1">Leave empty to keep existing image.</p>
                @endif
            </div>

            {{-- Title --}}
            <div>
                <label class="block text-gray-700 mb-2">Title (Arabic)</label>
                <input type="text" name="title_ar" value="{{ old('title_ar', $home_section->title_ar) }}"
                    class="w-full border rounded px-3 py-2 @error('title_ar') border-red-500 @enderror"
                    dir="rtl" required>
                @error('title_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Title (English)</label>
                <input type="text" name="title_en" value="{{ old('title_en', $home_section->title_en) }}"
                    class="w-full border rounded px-3 py-2 @error('title_en') border-red-500 @enderror"
                    dir="ltr" required>
                @error('title_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Subtitle --}}
            <div>
                <label class="block text-gray-700 mb-2">Subtitle (Arabic)</label>
                <input type="text" name="subtitle_ar" value="{{ old('subtitle_ar', $home_section->subtitle_ar) }}"
                    class="w-full border rounded px-3 py-2 @error('subtitle_ar') border-red-500 @enderror"
                    dir="rtl" required>
                @error('subtitle_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Subtitle (English)</label>
                <input type="text" name="subtitle_en" value="{{ old('subtitle_en', $home_section->subtitle_en) }}"
                    class="w-full border rounded px-3 py-2 @error('subtitle_en') border-red-500 @enderror"
                    dir="ltr" required>
                @error('subtitle_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Description --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Description (Arabic)</label>
                <textarea name="description_ar"
                    class="w-full border rounded px-3 py-2 @error('description_ar') border-red-500 @enderror"
                    rows="3" dir="rtl" required>{{ old('description_ar', $home_section->description_ar) }}</textarea>
                @error('description_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Description (English)</label>
                <textarea name="description_en"
                    class="w-full border rounded px-3 py-2 @error('description_en') border-red-500 @enderror"
                    rows="3" dir="ltr" required>{{ old('description_en', $home_section->description_en) }}</textarea>
                @error('description_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $home_section->sort_order) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-primary text-text px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>
@endsection
