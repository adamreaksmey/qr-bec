<!DOCTYPE html>
<html lang="en">

<x-head />

<body>
    <div>Hello from dashboard!</div>
</body>
<script>
    function redirectDashBoard(token) {
        $.ajax({
            url: '/api/bec/get-registered-user',
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token,
            },
            success: function(response) {
                if (response.data.authUser) {
                    return
                }
                window.location.href = '/login';
                return
            }
        })
    }

    const token = localStorage.getItem('token')
    redirectDashBoard(token)
</script>
