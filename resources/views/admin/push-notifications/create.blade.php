@extends('admin.layout.admin')

@section('title', 'Send Notification')

@section('content')
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Send Push Notification to All Users</h2>

    <div class="bg-white shadow rounded p-6 max-w-2xl">
        <form id="notificationForm" action="{{ route('admin.push-notifications.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Notification Title</label>
                    <input type="text" id="inputTitle" name="title"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary/50"
                        placeholder="e.g., New Update Available!" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Message Body</label>
                    <textarea id="inputBody" name="body"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary/50"
                        rows="5" placeholder="Write the notification details here..." required></textarea>
                </div>

                <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded text-sm text-amber-700">
                    ⚠️ Once confirmed, this notification will be broadcasted immediately via Firebase to all app users.
                </div>
            </div>

            <div class="mt-6 flex space-x-3">
                <button type="button" onclick="openConfirmationModal()"
                    class="bg-primary text-text px-6 py-2 rounded font-bold hover:opacity-90 transition-opacity">
                    Push Now
                </button>
                <a href="{{ route('admin.push-notifications.index') }}"
                    class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- 🔔 Confirmation Popup (Modal) -->
    <div id="confirmModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full overflow-hidden">
            <div class="bg-primary p-4 text-text">
                <h3 class="text-lg font-bold flex items-center">
                    📢 Review & Confirm Notification
                </h3>
            </div>

            <div class="p-6 space-y-4">
                <p class="text-sm text-gray-500">Please review the content carefully before broadcasting to all devices:</p>

                <div class="bg-gray-50 p-3 rounded border border-gray-200">
                    <span class="block text-xs font-bold text-gray-400 uppercase">Title:</span>
                    <p id="previewTitle" class="text-gray-800 font-semibold mt-1"></p>
                </div>

                <div class="bg-gray-50 p-3 rounded border border-gray-200">
                    <span class="block text-xs font-bold text-gray-400 uppercase">Body:</span>
                    <p id="previewBody" class="text-gray-700 text-sm mt-1 whitespace-pre-wrap"></p>
                </div>

                <p class="text-xs text-red-500 font-medium">💡 Clicking "Confirm & Send" will deliver this message to users'
                    phones within seconds.</p>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                <button type="button" onclick="closeConfirmationModal()"
                    class="bg-gray-300 text-gray-700 px-5 py-2 rounded hover:bg-gray-400 transition-colors">
                    Edit Content
                </button>
                <button type="button" onclick="submitForm()"
                    class="bg-green-600 text-white px-5 py-2 rounded font-bold hover:bg-green-700 transition-colors">
                    Confirm & Send
                </button>
            </div>
        </div>
    </div>

    <!-- 📜 Modal Control Script -->
    <script>
        const modal = document.getElementById('confirmModal');
        const form = document.getElementById('notificationForm');

        const inputTitle = document.getElementById('inputTitle');
        const inputBody = document.getElementById('inputBody');

        const previewTitle = document.getElementById('previewTitle');
        const previewBody = document.getElementById('previewBody');

        function openConfirmationModal() {
            if (!inputTitle.value.trim() || !inputBody.value.trim()) {
                form.reportValidity();
                return;
            }

            previewTitle.textContent = inputTitle.value;
            previewBody.textContent = inputBody.value;

            modal.classList.remove('hidden');
        }

        function closeConfirmationModal() {
            modal.classList.add('hidden');
        }

        function submitForm() {
            form.submit();
        }
    </script>
@endsection