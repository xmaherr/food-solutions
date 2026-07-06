@extends('admin.layout.admin')
@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Create Home Section</h2>
<div class="bg-white shadow rounded p-6">
    <form action="{{ route('admin.home-sections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Image File</label>
                <input type="file" name="image" class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Title --}}
            <div>
                <label class="block text-gray-700 mb-2">Title (Arabic)</label>
                <input type="text" name="title_ar" value="{{ old('title_ar') }}"
                    class="w-full border rounded px-3 py-2 @error('title_ar') border-red-500 @enderror"
                    dir="rtl" placeholder="العنوان بالعربية" required>
                @error('title_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Title (English)</label>
                <input type="text" name="title_en" value="{{ old('title_en') }}"
                    class="w-full border rounded px-3 py-2 @error('title_en') border-red-500 @enderror"
                    dir="ltr" placeholder="Title in English" required>
                @error('title_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Subtitle --}}
            <div>
                <label class="block text-gray-700 mb-2">Subtitle (Arabic)</label>
                <input type="text" name="subtitle_ar" value="{{ old('subtitle_ar') }}"
                    class="w-full border rounded px-3 py-2 @error('subtitle_ar') border-red-500 @enderror"
                    dir="rtl" placeholder="العنوان الفرعي بالعربية" required>
                @error('subtitle_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Subtitle (English)</label>
                <input type="text" name="subtitle_en" value="{{ old('subtitle_en') }}"
                    class="w-full border rounded px-3 py-2 @error('subtitle_en') border-red-500 @enderror"
                    dir="ltr" placeholder="Subtitle in English" required>
                @error('subtitle_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Description --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Description (Arabic)</label>
                <textarea name="description_ar"
                    class="w-full border rounded px-3 py-2 @error('description_ar') border-red-500 @enderror"
                    rows="3" dir="rtl" placeholder="الوصف بالعربية" required>{{ old('description_ar') }}</textarea>
                @error('description_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Description (English)</label>
                <textarea name="description_en"
                    class="w-full border rounded px-3 py-2 @error('description_en') border-red-500 @enderror"
                    rows="3" dir="ltr" placeholder="Description in English" required>{{ old('description_en') }}</textarea>
                @error('description_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" class="w-full border rounded px-3 py-2" value="{{ old('sort_order', 0) }}">
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-primary text-text px-4 py-2 rounded">Save</button>
        </div>
    </form>
</div>
@endsection
