@extends('admin.layout.admin')
@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Contact</h2>
<div class="bg-white shadow rounded p-6">
    <form action="{{ route('admin.contacts.update', $contact) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 mb-2">Type</label>
                <select name="type" class="w-full border rounded px-3 py-2">
                    <option value="contact" {{ $contact->type == 'contact' ? 'selected' : '' }}>Contact</option>
                    <option value="social" {{ $contact->type == 'social' ? 'selected' : '' }}>Social</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Title</label>
                <input type="text" name="title" value="{{ $contact->title }}" class="w-full border rounded px-3 py-2" required>
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
                <input type="text" name="value" value="{{ $contact->value }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Link (Optional)</label>
                <input type="text" name="link" value="{{ $contact->link }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ $contact->sort_order }}" class="w-full border rounded px-3 py-2">
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
@endsection