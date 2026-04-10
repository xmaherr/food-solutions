@extends('admin.layout.admin')
@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Settings</h2>
<div class="bg-white shadow rounded p-6">
    <form action="{{ route('admin.settings.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="block text-gray-700 mb-2">Consultation Email</label>
                <input type="email" name="consultation_email" value="{{ $settings['consultation_email'] ?? '' }}" class="w-full border rounded px-3 py-2" required>
                <p class="text-sm text-gray-500 mt-1">This email acts as the destination for consultation requests.</p>
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Site Name</label>
                <input type="text" name="site_name" value="{{ $settings['site_name'] ?? '' }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-primary text-text px-4 py-2 rounded">Update Settings</button>
        </div>
    </form>
</div>
@endsection