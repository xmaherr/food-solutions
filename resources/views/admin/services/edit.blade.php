@extends('admin.layout.admin')
@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Service</h2>
<div class="bg-white shadow rounded p-6">
    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 mb-2">Title (AR)</label>
                <input type="text" name="title_ar" value="{{ $service->title_ar }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Short Description (AR)</label>
                <textarea name="short_description_ar" class="w-full border rounded px-3 py-2" required>{{ $service->short_description_ar }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Long Description (AR)</label>
                <textarea name="long_description_ar" class="w-full border rounded px-3 py-2" rows="4" required>{{ $service->long_description_ar }}</textarea>
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Image / Icon File</label>
                <input type="file" name="image" class="w-full border rounded px-3 py-2 mb-2">
                @if($service->image)
                    <img src="{{ $service->image }}" class="w-24 h-24 object-cover border" alt="Current File">
                    <p class="text-xs text-gray-500 mt-1">Leave empty to keep existing file.</p>
                @endif
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ $service->sort_order }}" class="w-full border rounded px-3 py-2">
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Points</label>
                <div id="points-container">
                    @if($service->points)
                        @foreach($service->points as $point)
                            <div class="flex items-center mt-2">
                                <input type="text" name="points[]" value="{{ $point }}" class="w-full border rounded px-3 py-2 mr-2">
                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500">Remove</button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" onclick="addPoint()" class="mt-2 text-primary font-bold text-sm">+ Add Point</button>
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
    function addPoint(val = '') {
        const div = document.createElement('div');
        div.className = 'flex items-center mt-2';
        div.innerHTML = `<input type="text" name="points[]" value="${val}" class="w-full border rounded px-3 py-2 mr-2">
                         <button type="button" onclick="this.parentElement.remove()" class="text-red-500">Remove</button>`;
        document.getElementById('points-container').appendChild(div);
    }
</script>
@endsection