@extends('admin.layout.admin')
@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Contact</h2>
<div class="bg-white shadow rounded p-6">
    <form action="{{ route('admin.contacts.update', $contact) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 mb-2">Type</label>
                <select name="type" id="type-select" class="w-full border rounded px-3 py-2" onchange="toggleType()">
                    <option value="contact" {{ $contact->type == 'contact' ? 'selected' : '' }}>Contact</option>
                    <option value="social" {{ $contact->type == 'social' ? 'selected' : '' }}>Social</option>
                </select>
            </div>

            {{-- Contact-only Title fields --}}
            <div id="title-ar-container">
                <label class="block text-gray-700 mb-2">Title (Arabic)</label>
                <input type="text" name="title_ar" id="title-ar-input"
                    value="{{ old('title_ar', $contact->title_ar) }}"
                    class="w-full border rounded px-3 py-2 @error('title_ar') border-red-500 @enderror"
                    dir="rtl">
                @error('title_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div id="title-en-container">
                <label class="block text-gray-700 mb-2">Title (English)</label>
                <input type="text" name="title_en" id="title-en-input"
                    value="{{ old('title_en', $contact->title_en) }}"
                    class="w-full border rounded px-3 py-2 @error('title_en') border-red-500 @enderror"
                    dir="ltr">
                @error('title_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Social-only Platform field --}}
            <div id="platform-container" class="md:col-span-2" style="display: none;">
                <label class="block text-gray-700 mb-2">Platform</label>
                <select name="platform_id" id="platform-select" class="w-full border rounded px-3 py-2">
                    <option value="">Select Platform</option>
                    @foreach($platforms as $platform)
                        <option value="{{ $platform->id }}" {{ $contact->platform_id == $platform->id ? 'selected' : '' }}>
                            {{ $platform->name_en }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">The title will be automatically set to the platform name.</p>
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Icon File</label>
                <input type="file" name="icon" class="w-full border rounded px-3 py-2 mb-2">
                @if($contact->icon)
                    <img src="{{ $contact->icon }}" class="w-16 h-16 object-contain border bg-gray-50" alt="Current Icon">
                    <p class="text-xs text-gray-500 mt-1">Leave empty to keep existing icon.</p>
                @endif
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Value</label>
                <input type="text" name="value" value="{{ old('value', $contact->value) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Link (Optional)</label>
                <input type="text" name="link" value="{{ old('link', $contact->link) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $contact->sort_order) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div class="md:col-span-2 mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ $contact->is_active ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-primary">
                    <span class="ml-2 text-gray-700">Is Active</span>
                </label>
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-primary text-text px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>
<script>
    function toggleType() {
        const type = document.getElementById('type-select').value;
        const titleArContainer = document.getElementById('title-ar-container');
        const titleEnContainer = document.getElementById('title-en-container');
        const platformContainer = document.getElementById('platform-container');
        const titleArInput = document.getElementById('title-ar-input');
        const titleEnInput = document.getElementById('title-en-input');
        const platformSelect = document.getElementById('platform-select');

        if (type === 'social') {
            titleArContainer.style.display = 'none';
            titleEnContainer.style.display = 'none';
            platformContainer.style.display = 'block';
            titleArInput.removeAttribute('required');
            titleEnInput.removeAttribute('required');
            platformSelect.setAttribute('required', 'required');
        } else {
            titleArContainer.style.display = 'block';
            titleEnContainer.style.display = 'block';
            platformContainer.style.display = 'none';
            titleArInput.setAttribute('required', 'required');
            titleEnInput.setAttribute('required', 'required');
            platformSelect.removeAttribute('required');
        }
    }

    document.addEventListener('DOMContentLoaded', toggleType);
</script>
@endsection