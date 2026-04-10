@extends('admin.layout.admin')

@section('content')
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded shadow border-l-4 border-secondary">
            <h3 class="text-gray-500 text-sm">Total Consultations</h3>
            <p class="text-3xl font-bold text-gray-800">{{ $totals['consultations'] }}</p>
            @if($totals['unread_consultations'] > 0)
                <p class="text-sm text-red-600 font-bold mt-2">{{ $totals['unread_consultations'] }} Unread</p>
            @endif
        </div>
        <div class="bg-white p-6 rounded shadow border-l-4 border-primary">
            <h3 class="text-gray-500 text-sm">Total Services</h3>
            <p class="text-3xl font-bold text-gray-800">{{ $totals['services'] }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow border-l-4 border-primary">
            <h3 class="text-gray-500 text-sm">Total Contacts</h3>
            <p class="text-3xl font-bold text-gray-800">{{ $totals['contacts'] }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow border-l-4 border-primary">
            <h3 class="text-gray-500 text-sm">Total Socials</h3>
            <p class="text-3xl font-bold text-gray-800">{{ $totals['socials'] }}</p>
        </div>
    </div>
@endsection