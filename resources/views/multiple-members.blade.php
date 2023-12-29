<!DOCTYPE html>
<html lang="en">

<x-head />

<body>
    <div class="min-h-screen flex justify-center items-center" style="height: 100vh">
        <div class="flex flex-col gap-2">
            <div class="text-2xl sm:text-3xl pb-6 title-desc">
                <span class="come"> {{ __('messages.group_come') }}</span>
                <span class="go">{{ __('messages.group_leave') }}</span>
            </div>
            <div class="relatives-container">
            </div>
            <div class="flex justify-center items-end gap-2">
                <button class="button is-warning" onclick="redirectComplete()">{{ __('messages.submit') }}</button>
                <x-refresh-button />
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
            $(".come").show();
            $('.go').hide();
        } else {
            $(".go").show();
            $('.come').hide();
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
                                    <input type="checkbox" class="form-checkbox h-4 w-4" onclick="handleUpdateUserStatus('${element.id}', true, this.checked)">
                                    <span class="ml-2">${element.name}</span>
                                </label>
                            </div>
                        `;
                });
                suggestionsHTML += `
                        <div class="text-xl sm:text-2xl">
                            <input type="checkbox" class="form-checkbox h-4 w-4" onclick="handleUpdateUserStatus('${paramValue}', false, this.checked)">
                                    <span class="ml-2 parent-member">You</span>
                        </div>
                    `;
                $('.relatives-container').html(suggestionsHTML);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    })

    function handleUpdateUserStatus(event, isNotParent, condition) {
        const localStatus = localStorage.getItem('client-status');
        $.ajax({
            url: '/api/bec/update-relative-status',
            type: 'PATCH',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                id: event,
                status: condition ? localStatus : localStatus == 'arrived' ? 'left' : 'arrived',
                isNotParent: isNotParent
            },
            success: function(response) {
                console.log(response)
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script>

</html>
