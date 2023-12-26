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
        <button id="loginButton" class="button is-primary">Login</button>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#loginButton').click(function() {
            var email = $('.email').val();
            var password = $('.password').val();

            // Send the data to the Auth controller
            $.ajax({
                url: '/api/bec/login', // Replace with your actual route URL
                method: 'POST',
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                    // Handle the success response from the server
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle the error response from the server
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
