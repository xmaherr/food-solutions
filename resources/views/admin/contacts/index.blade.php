@extends('admin.layout.admin')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Contacts & Socials</h2>
    <a href="{{ route('admin.contacts.create') }}" class="bg-primary text-text px-4 py-2 rounded">Add New</a>
</div>
<div class="bg-white shadow rounded overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-gray-100 text-gray-600 text-sm leading-normal">
                <th class="py-3 px-6 text-left">Type</th>
                <th class="py-3 px-6 text-left">Title</th>
                <th class="py-3 px-6 text-left">Value</th>
                <th class="py-3 px-6 text-center">Status</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($contacts as $contact)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="py-3 px-6 text-left">{{ ucfirst($contact->type) }}</td>
                <td class="py-3 px-6 text-left">{{ $contact->title }}</td>
                <td class="py-3 px-6 text-left">{{ $contact->value }}</td>
                <td class="py-3 px-6 text-center">
                    <span class="bg-{{ $contact->is_active ? 'green' : 'red' }}-200 text-{{ $contact->is_active ? 'green' : 'red' }}-600 py-1 px-3 rounded-full text-xs">
                        {{ $contact->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="py-3 px-6 text-center">
                    <a href="{{ route('admin.contacts.edit', $contact) }}" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
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