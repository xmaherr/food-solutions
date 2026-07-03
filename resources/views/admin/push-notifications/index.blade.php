@extends('admin.layout.admin')

@section('title', 'Push Notifications')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Push Notifications Archive</h2>
        <a href="{{ route('admin.push-notifications.create') }}" class="bg-primary text-text px-4 py-2 rounded">Send New
            Notification</a>
    </div>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 text-gray-600 text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Sent At</th>
                    <th class="py-3 px-6 text-left">Title</th>
                    <th class="py-3 px-6 text-left">Message Body</th>
                    <th class="py-3 px-6 text-left">Target (Topic)</th>
                    <th class="py-3 px-6 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($notifications as $notification)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $notification->created_at->format('Y-m-d H:i') }}
                        </td>
                        <td class="py-3 px-6 text-left font-semibold">{{ $notification->title }}</td>
                        <td class="py-3 px-6 text-left">{{ \Illuminate\Support\Str::limit($notification->body, 70) }}</td>
                        <td class="py-3 px-6 text-left"><span
                                class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">{{ $notification->topic }}</span>
                        </td>
                        <td class="py-3 px-6 text-center">
                            @if($notification->is_sent)
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Success</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">Failed</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @if($notifications->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-400">No notifications sent yet.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection