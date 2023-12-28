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
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Dashboard</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Create users</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Settings</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700" onclick="handleLogOut()">Log out</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4">
            <h2 class="text-2xl font-bold mb-4">Welcome to the Dashboard!</h2>

            <div class="bg-white rounded-lg p-4 shadow">
                <h3 class="text-xl font-bold mb-4">Table Example</h3>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200">ID</th>
                            <th class="py-2 px-4 border-b border-gray-200">Name</th>
                            <th class="py-2 px-4 border-b border-gray-200">Email</th>
                            <th class="py-2 px-4 border-b border-gray-200">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">1</td>
                            <td class="py-2 px-4 border-b border-gray-200">John Doe</td>
                            <td class="py-2 px-4 border-b border-gray-200">john@example.com</td>
                            <td class="py-2 px-4 border-b border-gray-200">Admin</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">2</td>
                            <td class="py-2 px-4 border-b border-gray-200">Jane Smith</td>
                            <td class="py-2 px-4 border-b border-gray-200">jane@example.com</td>
                            <td class="py-2 px-4 border-b border-gray-200">User</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
<script>
    function handleLogOut() {
        $.ajax({
            url: '/api/bec/logout',
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(response) {
                window.location.href = '/login'
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script>

</html>
