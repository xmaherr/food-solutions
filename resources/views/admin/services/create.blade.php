@extends('admin.layout.admin')
@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Create Service</h2>
<div class="bg-white shadow rounded p-6">
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 mb-2">Title (AR)</label>
                <input type="text" name="title_ar" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Short Description (AR)</label>
                <textarea name="short_description_ar" class="w-full border rounded px-3 py-2" required></textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Long Description (AR)</label>
                <textarea name="long_description_ar" class="w-full border rounded px-3 py-2" rows="4" required></textarea>
            </div>
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
                <input type="number" name="sort_order" class="w-full border rounded px-3 py-2" value="0">
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Points (JSON List of strings)</label>
                <div id="points-container"></div>
                <button type="button" onclick="addPoint()" class="mt-2 text-primary font-bold text-sm">+ Add Point</button>
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
    function addPoint(val = '') {
        const div = document.createElement('div');
        div.className = 'flex items-center mt-2';
        div.innerHTML = `<input type="text" name="points[]" value="${val}" class="w-full border rounded px-3 py-2 mr-2">
                         <button type="button" onclick="this.parentElement.remove()" class="text-red-500">Remove</button>`;
        document.getElementById('points-container').appendChild(div);
    }
</script>
@endsection