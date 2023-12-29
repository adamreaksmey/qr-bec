<x-layout>
    <div class="flex flex-col gap-3">
        <h2 class="text-2xl font-bold mb-2">Welcome to the Relatives dashboard!</h2>
        <div>
            <p>This is where you can see all of the members are associated with each user!</p>
        </div>
        <div class="bg-white rounded-lg p-4 shadow">
            <h3 class="text-xl font-bold mb-4">All Authorized relatives</h3>
            <div class="flex flex-col w-full justify-start">
                <div>Total campers' associated members: <span style="color: blue" class="total-all">100</span></div>
                <div>Total left: <span style="color: red" class="left">100</span></div>
                <div>Total in camp: <span style="color: green" class="arrived">100</span></div>
            </div>
            <div class="flex gap-2 pt-2">
                <div class="field w-1/3">
                    <div class="control has-icons-left">
                        <input class="input" type="text" placeholder="Search"
                            oninput="fetchMembers(null, this.value)">
                        <span class="icon is-small is-left">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
                <div class="flex w-full justify-end gap-2">
                    <button id="arrivedButton" class="button" onclick="fetchMembers('arrived')">In Camp</button>
                    <button id="leftButton" class="button" onclick="fetchMembers('left')">Out Camp</button>
                    <button id="allButton" class="button" onclick="fetchMembers()">All</button>
                </div>
            </div>

            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200">#</th>
                        <th class="py-2 px-4 border-b border-gray-200">Id</th>
                        <th class="py-2 px-4 border-b border-gray-200">Name</th>
                        <th class="py-2 px-4 border-b border-gray-200">Parent's name</th>
                        <th class="py-2 px-4 border-b border-gray-200">Parent's Id</th>
                        <th class="py-2 px-4 border-b border-gray-200">Camp Status</th>
                    </tr>
                </thead>
                <tbody class="td-body">
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const fetchMembers = (status, keyword) => {
            $.ajax({
                url: '/api/bec/all-relatives',
                type: 'GET',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                    status: status,
                    keyword: keyword
                },
                success: function(response) {
                    var suggestionsHTML = '';
                    $('.td-body').empty();
                    response?.data?.forEach((element, index) => {
                        suggestionsHTML +=
                            `
                        <tr class="hover:opacity-50 cursor-pointer">
                            <td class="py-2 px-4 border-b border-gray-200">${index + 1}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${element?.id}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${element.name}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${element.users.name}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${element.users.id}</td>
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
</x-layout>
