@extends('admin.layout.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Statistics Management</h2>
    <a href="{{ route('admin.statistics.edit', $statistic) }}" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary/90 transition-colors">
        Edit Statistics
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="border p-4 rounded-lg bg-gray-50 text-center">
            <h3 class="text-lg font-semibold text-gray-700">Years of Experience</h3>
            <p class="text-3xl font-bold text-primary mt-2">{{ $statistic->years_of_experience }}</p>
        </div>
        
        <div class="border p-4 rounded-lg bg-gray-50 text-center">
            <h3 class="text-lg font-semibold text-gray-700">Clients Count</h3>
            <p class="text-3xl font-bold text-primary mt-2">{{ $statistic->clients_count }}</p>
        </div>
        
        <div class="border p-4 rounded-lg bg-gray-50 text-center">
            <h3 class="text-lg font-semibold text-gray-700">Projects Count</h3>
            <p class="text-3xl font-bold text-primary mt-2">{{ $statistic->projects_count }}</p>
        </div>
    </div>
</div>
@endsection
