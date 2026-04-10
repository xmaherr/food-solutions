@extends('admin.layout.admin')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Consultations</h2>
    <div>
        <a href="{{ route('admin.consultations.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">All</a>
        <a href="{{ route('admin.consultations.index', ['filter'=>'unread']) }}" class="text-red-500 hover:text-red-700 font-bold">Unread Only</a>
    </div>
</div>
<div class="bg-white shadow rounded overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-gray-100 text-gray-600 text-sm leading-normal">
                <th class="py-3 px-6 text-left">Date</th>
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-left">Service</th>
                <th class="py-3 px-6 text-center">Status</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($consultations as $consultation)
            <tr class="border-b border-gray-200 hover:bg-gray-50 {{ !$consultation->is_read ? 'bg-orange-50 font-semibold' : '' }}">
                <td class="py-3 px-6 text-left">{{ $consultation->created_at->format('Y-m-d H:i') }}</td>
                <td class="py-3 px-6 text-left">{{ $consultation->name }}</td>
                <td class="py-3 px-6 text-left">{{ $consultation->service->title_ar ?? 'N/A' }}</td>
                <td class="py-3 px-6 text-center">
                    @if($consultation->is_read)
                        <span class="text-green-500">Read</span>
                    @else
                        <span class="text-red-500">Unread</span>
                    @endif
                </td>
                <td class="py-3 px-6 text-center">
                    <a href="{{ route('admin.consultations.show', $consultation) }}" class="text-blue-500 hover:text-blue-700 mr-2">View</a>
                    <form action="{{ route('admin.consultations.destroy', $consultation) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
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