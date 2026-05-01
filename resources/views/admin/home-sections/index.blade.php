@extends('admin.layout.admin')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Home Sections</h2>
    <a href="{{ route('admin.home-sections.create') }}" class="bg-primary text-text px-4 py-2 rounded">Add New</a>
</div>
<div class="bg-white shadow rounded overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-gray-100 text-gray-600 text-sm leading-normal">
                <th class="py-3 px-6 text-left">Sort</th>
                <th class="py-3 px-6 text-left">Image</th>
                <th class="py-3 px-6 text-left">Title</th>
                <th class="py-3 px-6 text-left">Subtitle</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($sections as $section)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="py-3 px-6 text-left">{{ $section->sort_order }}</td>
                <td class="py-3 px-6 text-left">
                    <img src="{{ $section->image }}" class="w-16 h-16 object-cover border" alt="Section Image">
                </td>
                <td class="py-3 px-6 text-left">{{ $section->title }}</td>
                <td class="py-3 px-6 text-left">{{ $section->subtitle }}</td>
                <td class="py-3 px-6 text-center">
                    <a href="{{ route('admin.home-sections.edit', $section) }}" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                    <form action="{{ route('admin.home-sections.destroy', $section) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
