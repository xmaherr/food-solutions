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
            <div>
                <label class="block text-gray-700 mb-2">Title</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Subtitle</label>
                <input type="text" name="subtitle" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2" rows="4" required></textarea>
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" class="w-full border rounded px-3 py-2" value="0">
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-primary text-text px-4 py-2 rounded">Save</button>
        </div>
    </form>
</div>
@endsection
