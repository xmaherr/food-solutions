@extends('admin.layout.admin')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Consultation Details</h2>
    <a href="{{ route('admin.consultations.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Back</a>
</div>
<div class="bg-white shadow rounded p-6">
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div><strong class="text-gray-700">Name:</strong> {{ $consultation->name }}</div>
        <div><strong class="text-gray-700">Date:</strong> {{ $consultation->created_at->format('Y-m-d H:i:s') }}</div>
        <div><strong class="text-gray-700">Phone:</strong> {{ $consultation->phone }}</div>
        <div><strong class="text-gray-700">Email:</strong> {{ $consultation->email }}</div>
        <div class="col-span-2"><strong class="text-gray-700">Service:</strong> {{ $consultation->service->title_ar ?? 'Not Selected' }}</div>
    </div>
    <div>
        <strong class="text-gray-700 block mb-2">Message:</strong>
        <div class="bg-gray-50 p-4 border rounded min-h-[100px] whitespace-pre-wrap">{{ $consultation->message ?? 'No Message' }}</div>
    </div>
</div>
@endsection