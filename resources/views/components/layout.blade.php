<!DOCTYPE html>
<html lang="en">

<x-head />

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="bg-gray-800 text-white w-64">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Welcome!</h1>
            </div>
            <nav class="mt-4">
                <ul class="space-y-1">
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700"
                            onclick="window.location.href = '/'">Home</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700"
                            onclick="window.location.href = '/dashboard'">Dashboard</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700"
                            onclick="window.location.href = '/register'">Create users</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700" onclick="window.location.href = '/relatives'">Users' members</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700" onclick="handleLogOut()">Log out</a>
                    </li>
                </ul>
            </nav>
        </aside>
        <main class="flex-1 p-4 overflow-scroll">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
