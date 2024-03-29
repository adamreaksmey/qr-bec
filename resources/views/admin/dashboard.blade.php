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
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Other members</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700" onclick="handleLogOut()">Log out</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 overflow-scroll">
            <h2 class="text-2xl font-bold mb-4">Welcome to the Dashboard!</h2>

            <div class="bg-white rounded-lg p-4 shadow">
                <h3 class="text-xl font-bold mb-4">All Authorized users</h3>
                <div class="flex flex-col w-full justify-start">
                    <div>Total campers: <span style="color: blue" class="total-all">100</span></div>
                    <div>Total left: <span style="color: red" class="left">100</span></div>
                    <div>Total in: <span style="color: green" class="arrived">100</span></div>
                </div>
                <div class="flex w-full justify-end gap-2">
                    <button class="button" onclick="fetchMembers('arrived')">In Camp</button>
                    <button class="button" onclick="fetchMembers('left')">Out Camp</button>
                </div>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200">#</th>
                            <th class="py-2 px-4 border-b border-gray-200">Name</th>
                            <th class="py-2 px-4 border-b border-gray-200">Email</th>
                            <th class="py-2 px-4 border-b border-gray-200">Phone</th>
                            <th class="py-2 px-4 border-b border-gray-200">Camp Status</th>
                        </tr>
                    </thead>
                    <tbody class="td-body">
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


    const fetchMembers = (status) => {
        $.ajax({
            url: '/api/bec/all-members',
            type: 'GET',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                status: status
            },
            success: function(response) {
                var suggestionsHTML = '';
                $('.td-body').empty();
                response?.data?.forEach((element, index) => {
                    suggestionsHTML +=
                        `
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">${index + 1}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${element.name}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${element.email ?? ''}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${element.phone_number}</td>
                            <td class="py-2 px-4 border-b border-gray-200" style="color: ${element.status == 'arrived' ? 'green' : 'red'}">${element.status}</td>
                        </tr>

                        `;
                });
                $('.td-body').html(suggestionsHTML);
                const arrived = response.data.filter(user => user.status == 'arrived').length;
                const left = response.data.filter(user => user.status == 'left').length;
                const total = response.data.length

                $('.arrived').text(arrived)
                $('.left').text(left)
                $('.total-all').text(total)
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
    fetchMembers()
</script>

</html>
