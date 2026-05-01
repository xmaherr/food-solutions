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
            <div>
                <label class="block text-gray-700 mb-2">Title</label>
                <input type="text" name="title" value="{{ $home_section->title }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Subtitle</label>
                <input type="text" name="subtitle" value="{{ $home_section->subtitle }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2" rows="4" required>{{ $home_section->description }}</textarea>
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ $home_section->sort_order }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-primary text-text px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>
@endsection
