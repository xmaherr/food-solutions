@extends('admin.layout.admin')
@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Service</h2>
<div class="bg-white shadow rounded p-6">
    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Title --}}
            <div>
                <label class="block text-gray-700 mb-2">Title (Arabic)</label>
                <input type="text" name="title_ar" value="{{ old('title_ar', $service->title_ar) }}"
                    class="w-full border rounded px-3 py-2 @error('title_ar') border-red-500 @enderror"
                    dir="rtl" required>
                @error('title_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Title (English)</label>
                <input type="text" name="title_en" value="{{ old('title_en', $service->title_en) }}"
                    class="w-full border rounded px-3 py-2 @error('title_en') border-red-500 @enderror"
                    dir="ltr" required>
                @error('title_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Short Description --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Short Description (Arabic)</label>
                <textarea name="short_description_ar"
                    class="w-full border rounded px-3 py-2 @error('short_description_ar') border-red-500 @enderror"
                    dir="rtl" required>{{ old('short_description_ar', $service->short_description_ar) }}</textarea>
                @error('short_description_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Short Description (English)</label>
                <textarea name="short_description_en"
                    class="w-full border rounded px-3 py-2 @error('short_description_en') border-red-500 @enderror"
                    dir="ltr" required>{{ old('short_description_en', $service->short_description_en) }}</textarea>
                @error('short_description_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Long Description --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Long Description (Arabic)</label>
                <textarea name="long_description_ar"
                    class="w-full border rounded px-3 py-2 @error('long_description_ar') border-red-500 @enderror"
                    rows="4" dir="rtl" required>{{ old('long_description_ar', $service->long_description_ar) }}</textarea>
                @error('long_description_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Long Description (English)</label>
                <textarea name="long_description_en"
                    class="w-full border rounded px-3 py-2 @error('long_description_en') border-red-500 @enderror"
                    rows="4" dir="ltr" required>{{ old('long_description_en', $service->long_description_en) }}</textarea>
                @error('long_description_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Image & Icon --}}
            <div>
                <label class="block text-gray-700 mb-2">Image File</label>
                <input type="file" name="image" class="w-full border rounded px-3 py-2 mb-2">
                @if($service->image)
                    <img src="{{ $service->image }}" class="w-24 h-24 object-cover border" alt="Current Image">
                    <p class="text-xs text-gray-500 mt-1">Leave empty to keep existing image.</p>
                @endif
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Icon File</label>
                <input type="file" name="icon" class="w-full border rounded px-3 py-2 mb-2">
                @if($service->icon && $service->icon !== '-')
                    <img src="{{ $service->icon }}" class="w-24 h-24 object-cover border" alt="Current Icon">
                    <p class="text-xs text-gray-500 mt-1">Leave empty to keep existing icon.</p>
                @endif
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="w-full border rounded px-3 py-2">
            </div>

            {{-- Points Arabic --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Arabic Points</label>
                <div id="points-ar-container">
                    @if($service->getRawOriginal('points_ar'))
                        @foreach(json_decode($service->getRawOriginal('points_ar'), true) ?? [] as $point)
                            <div class="flex items-center mt-2">
                                <input type="text" name="points_ar[]" value="{{ $point }}"
                                    class="w-full border rounded px-3 py-2 mr-2" dir="rtl">
                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500">Remove</button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" onclick="addPoint('ar')" class="mt-2 text-primary font-bold text-sm">+ Add Arabic Point</button>
            </div>

            {{-- Points English --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">English Points</label>
                <div id="points-en-container">
                    @if($service->getRawOriginal('points_en'))
                        @foreach(json_decode($service->getRawOriginal('points_en'), true) ?? [] as $point)
                            <div class="flex items-center mt-2">
                                <input type="text" name="points_en[]" value="{{ $point }}"
                                    class="w-full border rounded px-3 py-2 mr-2" dir="ltr">
                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500">Remove</button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" onclick="addPoint('en')" class="mt-2 text-primary font-bold text-sm">+ Add English Point</button>
            </div>

            <div class="md:col-span-2 mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-primary">
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