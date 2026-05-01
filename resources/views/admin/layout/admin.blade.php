<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#14594F',
                        secondary: '#E69D65',
                        text: '#FFF4E2',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-primary text-text min-h-screen flex flex-col">
        <div class="h-16 flex items-center justify-center border-b border-secondary/30">
            <h1 class="text-xl font-bold">Food Solutions</h1>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-secondary/20 rounded">Dashboard</a>
            <a href="{{ route('admin.home-sections.index') }}" class="block px-4 py-2 hover:bg-secondary/20 rounded">Home Sections</a>
            <a href="{{ route('admin.services.index') }}" class="block px-4 py-2 hover:bg-secondary/20 rounded">Services</a>
            <a href="{{ route('admin.contacts.index') }}" class="block px-4 py-2 hover:bg-secondary/20 rounded">Contacts</a>
            <a href="{{ route('admin.consultations.index') }}" class="block px-4 py-2 hover:bg-secondary/20 rounded">Consultations</a>
            <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 hover:bg-secondary/20 rounded">Settings</a>
            <a href="{{ route('admin.statistics.index') }}" class="block px-4 py-2 hover:bg-secondary/20 rounded">Statistics</a>
            <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-secondary/20 rounded">Users</a>
        </nav>
        <div class="px-4 py-6">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full bg-secondary text-primary font-bold py-2 px-4 rounded hover:bg-white transition-colors">Logout</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col">
        <header class="h-16 bg-white shadow flex items-center px-6 justify-end">
            <span class="text-gray-600">Logged in as {{ auth()->user()->name }}</span>
        </header>

        <div class="p-6 flex-1 overflow-auto">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
</html>