@extends('admin.layout.admin')
@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Create Service</h2>
<div class="bg-white shadow rounded p-6">
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Title --}}
            <div>
                <label class="block text-gray-700 mb-2">Title (Arabic)</label>
                <input type="text" name="title_ar" value="{{ old('title_ar') }}"
                    class="w-full border rounded px-3 py-2 @error('title_ar') border-red-500 @enderror"
                    dir="rtl" placeholder="اسم الخدمة بالعربية" required>
                @error('title_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Title (English)</label>
                <input type="text" name="title_en" value="{{ old('title_en') }}"
                    class="w-full border rounded px-3 py-2 @error('title_en') border-red-500 @enderror"
                    dir="ltr" placeholder="Service name in English" required>
                @error('title_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Short Description --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Short Description (Arabic)</label>
                <textarea name="short_description_ar"
                    class="w-full border rounded px-3 py-2 @error('short_description_ar') border-red-500 @enderror"
                    dir="rtl" placeholder="الوصف المختصر بالعربية" required>{{ old('short_description_ar') }}</textarea>
                @error('short_description_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Short Description (English)</label>
                <textarea name="short_description_en"
                    class="w-full border rounded px-3 py-2 @error('short_description_en') border-red-500 @enderror"
                    dir="ltr" placeholder="Short description in English" required>{{ old('short_description_en') }}</textarea>
                @error('short_description_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Long Description --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Long Description (Arabic)</label>
                <textarea name="long_description_ar"
                    class="w-full border rounded px-3 py-2 @error('long_description_ar') border-red-500 @enderror"
                    rows="4" dir="rtl" placeholder="الوصف التفصيلي بالعربية" required>{{ old('long_description_ar') }}</textarea>
                @error('long_description_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Long Description (English)</label>
                <textarea name="long_description_en"
                    class="w-full border rounded px-3 py-2 @error('long_description_en') border-red-500 @enderror"
                    rows="4" dir="ltr" placeholder="Detailed description in English" required>{{ old('long_description_en') }}</textarea>
                @error('long_description_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Image & Icon --}}
            <div>
                <label class="block text-gray-700 mb-2">Image File</label>
                <input type="file" name="image" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Icon File</label>
                <input type="file" name="icon" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" class="w-full border rounded px-3 py-2" value="{{ old('sort_order', 0) }}">
            </div>

            {{-- Points Arabic --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Arabic Points</label>
                <div id="points-ar-container"></div>
                <button type="button" onclick="addPoint('ar')" class="mt-2 text-primary font-bold text-sm">+ Add Arabic Point</button>
            </div>

            {{-- Points English --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">English Points</label>
                <div id="points-en-container"></div>
                <button type="button" onclick="addPoint('en')" class="mt-2 text-primary font-bold text-sm">+ Add English Point</button>
            </div>

            <div class="md:col-span-2 mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" class="form-checkbox h-5 w-5 text-primary" checked>
                    <span class="ml-2 text-gray-700">Is Active</span>
                </label>
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-primary text-text px-4 py-2 rounded">Save</button>
        </div>
    </form>
</div>
<script>
    function addPoint(lang, val = '') {
        const container = document.getElementById(`points-${lang}-container`);
        const div = document.createElement('div');
        div.className = 'flex items-center mt-2';
        div.innerHTML = `<input type="text" name="points_${lang}[]" value="${val}"
                          class="w-full border rounded px-3 py-2 mr-2"
                          dir="${lang === 'ar' ? 'rtl' : 'ltr'}"
                          placeholder="${lang === 'ar' ? 'نقطة بالعربية' : 'Point in English'}">
                         <button type="button" onclick="this.parentElement.remove()" class="text-red-500">Remove</button>`;
        container.appendChild(div);
    }
</script>
@endsection