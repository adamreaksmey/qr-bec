<!DOCTYPE html>
<html lang="en">

<x-head />

<body>
    <div class="min-h-screen flex justify-center items-center">
        <div class="flex flex-col">
            <div class="text-2xl sm:text-3xl pb-6 title-desc">Who in your group is leaving?</div>
            <div class="relatives-container">
                <div class="text-xl sm:text-2xl">
                    <label class="checkbox flex items-center">
                        <input type="checkbox" class="form-checkbox h-4 w-4">
                        <span class="ml-2">Adam</span>
                    </label>
                </div>
                <div class="text-xl sm:text-2xl">
                    <label class="checkbox flex items-center">
                        <input type="checkbox" class="form-checkbox h-4 w-4">
                        <span class="ml-2">Zac</span>
                    </label>
                </div>
                <div class="text-xl sm:text-2xl">
                    <label class="checkbox flex items-center">
                        <input type="checkbox" class="form-checkbox h-4 w-4">
                        <span class="ml-2">Mey Mey</span>
                    </label>
                </div>
            </div>
            <div class="flex justify-center items-end">
                <button class="button is-warning" onclick="redirectComplete()">All done!</button>
            </div>
        </div>
    </div>
</body>

<script>
    const localStatus = localStorage.getItem('client-status');

    function redirectComplete() {
        window.location.href = `/checked-in?status=${localStatus}`
    }
    $(document).ready(function() {
        const url = new URL(window.location.href);
        const searchParams = new URLSearchParams(url.search);
        const paramValue = searchParams.get('userId');

        const localStatus = localStorage.getItem('client-status');
        if (localStatus == "arrived") {
            $(".title-desc").text("Who in your group is arriving?")
        } else {
            $(".title-desc").text("Who in your group is leaving?")
        }

        $.ajax({
            url: '/api/bec/get-user-relatives',
            type: 'GET',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                id: paramValue
            },
            success: function(response) {
                var suggestionsHTML = '';
                response?.data?.relatives.forEach((element, index) => {
                    suggestionsHTML +=
                        `               
                            <div class="text-xl sm:text-2xl">
                                <label class="checkbox flex items-center">
                                    <input type="checkbox" class="form-checkbox h-4 w-4" onclick="handleUpdateUserStatus('${element.id}', true)">
                                    <span class="ml-2">${element.name}</span>
                                </label>
                            </div>
                        `;
                });
                suggestionsHTML += `
                        <div class="text-xl sm:text-2xl">
                            <input type="checkbox" class="form-checkbox h-4 w-4" onclick="handleUpdateUserStatus('${paramValue}', false)">
                                    <span class="ml-2">You</span>
                        </div>
                    `;
                $('.relatives-container').html(suggestionsHTML);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    })

    function handleUpdateUserStatus(event, isNotParent) {
        const localStatus = localStorage.getItem('client-status');
        $.ajax({
            url: '/api/bec/update-relative-status',
            type: 'PATCH',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                id: event,
                status: localStatus,
                isNotParent: isNotParent
            },
            success: function(response) {
                // var allCheckboxes = $('.relatives-container input[type="checkbox"]');
                // var checkedCheckboxes = $('.relatives-container input[type="checkbox"]:checked');

                // if (allCheckboxes.length === checkedCheckboxes.length) {
                //     window.location.href = `/checked-in?status=${localStatus}`
                // } else {
                //     console.log("Not all checkboxes are checked");
                // }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script>

</html>
