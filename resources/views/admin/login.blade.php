<!DOCTYPE html>
<html lang="en">

<x-head />

<body>
    <div class="flex flex-col justify-center items-center gap-10 h-screen">
        <span class="text-primary text-3xl">Welcome!</span>
        <div>
            <div class="w-full">
                <span>Email</span>
                <input class="input w-full email" type="text" placeholder="Enter your email..." />
            </div>
            <div class="w-full">
                <span>Password</span>
                <input class="input w-full password" type="password" placeholder="and password..." />
            </div>
        </div>
        <div class="alert-text text-danger"></div>
        <button id="loginButton" class="button is-primary">Login</button>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#loginButton').click(function() {
            var email = $('.email').val();
            var password = $('.password').val();
            $.ajax({
                url: '/api/bec/login',
                type: 'POST',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                    $('.alert-text').text(response.message)
                    localStorage.setItem('token', response.token);
                    window.location.href = '/dashboard';
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
