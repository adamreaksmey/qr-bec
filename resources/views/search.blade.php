<!DOCTYPE html>
<html lang="en">

<x-head />

<body>
    <div class="flex flex-col justify-center h-screen items-center gap-10 w-full">
        <div class="text-4xl sm:text-4xl md:text-5xl lg:text-6xl font-bold flex justify-center text-center">
            Find your name or number
        </div>
        <div class="flex justify-center gap-3">
            <div class="w-3/5"> <input class="input is-primary searchInput" type="text" placeholder="Search"
                    oninput="getTypedInMembersInfo()">
                <div class="border border-none rounded pl-3 parent-suggestion">
                </div>
            </div>
            <button class="button is-success" onclick="window.location.href = '/checked-in'">Submit</button>
        </div>
        <div class="flex justify-center items-end">
            <button class="button is-warning">ខ្មែរ | English</button>
        </div>
    </div>
</body>
<script>
    let userInfo;

    function getTypedInMembersInfo(value) {
        $.ajax({
            url: '/api/bec/all-members',
            type: 'GET',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                keyword: $('.searchInput').val()
            },
            success: function(response) {
                if (!$('.searchInput').val()) {
                    $('.parent-suggestion').css({
                        'height': '0',
                        'overflow': 'scroll',
                        'background-color': 'none'
                    })
                    return $('.parent-suggestion').empty()
                };
                var suggestionsHTML = '';
                response.data.forEach((element, index) => {
                    suggestionsHTML +=
                        `<div class="hover:opacity-50 cursor-pointer" onclick="assignUserState('${element.id}', '${element.name}')">` +
                        element.name + `</div>`;
                });
                $('.parent-suggestion').html(suggestionsHTML);
                $('.parent-suggestion').css({
                    'height': '100px',
                    'overflow': 'scroll',
                    'background-color': 'wheat'
                })
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function assignUserState(value, name) {
        // value is the user id
        userInfo = value;
        console.log(value, name)
        $('.searchInput').val(name)
        $('.parent-suggestion').css({
            'height': '0',
            'overflow': 'scroll',
            'background-color': 'none'
        })
    }

    function changeUserStatusInCamp() {
        const localStatus = localStorage.getItem('client-status');
        
    }
</script>

</html>
