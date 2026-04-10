<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: '#14594F', secondary: '#E69D65', text: '#FFF4E2' }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-lg max-w-sm w-full">
        <h2 class="text-2xl font-bold mb-6 text-primary text-center">Admin Login</h2>
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Email</label>
                <input type="email" name="email" class="w-full border rounded px-3 py-2 focus:border-primary focus:outline-none" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Password</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2 focus:border-primary focus:outline-none" required>
            </div>
            <button type="submit" class="w-full bg-primary text-text font-bold py-2 px-4 rounded hover:bg-opacity-90 transition">Login</button>
        </form>
    </div>
</body>
</html>