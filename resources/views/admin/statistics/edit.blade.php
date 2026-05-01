@extends('admin.layout.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Edit Statistics</h2>
    <a href="{{ route('admin.statistics.index') }}" class="text-gray-600 hover:text-gray-900">
        Back to Statistics
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form action="{{ route('admin.statistics.update', $statistic) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="years_of_experience">Years of Experience</label>
            <input type="number" name="years_of_experience" id="years_of_experience" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-primary @error('years_of_experience') border-red-500 @enderror" value="{{ old('years_of_experience', $statistic->years_of_experience) }}" required min="0">
            @error('years_of_experience')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="clients_count">Clients Count</label>
            <input type="number" name="clients_count" id="clients_count" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-primary @error('clients_count') border-red-500 @enderror" value="{{ old('clients_count', $statistic->clients_count) }}" required min="0">
            @error('clients_count')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="projects_count">Projects Count</label>
            <input type="number" name="projects_count" id="projects_count" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-primary @error('projects_count') border-red-500 @enderror" value="{{ old('projects_count', $statistic->projects_count) }}" required min="0">
            @error('projects_count')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-primary text-white px-6 py-2 rounded hover:bg-primary/90 transition-colors">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
