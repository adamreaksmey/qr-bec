<!DOCTYPE html>
<html lang="en">

<x-head />

<body>
    <div class="flex flex-col justify-center h-screen items-center gap-10 w-full" style="height: 100vh">
        <div class="text-3xl font-bold lead-title"> You have arrived.</div>
        <div class="flex justify-center text-center description">Finished, please remember to scan back in
            when you arrive again!
        </div>
        <div class="flex justify-center items-end">
            <button class="button is-warning" onclick="window.location.href = '/'">Restart Session</button>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        const url = new URL(window.location.href);
        const searchParams = new URLSearchParams(url.search);
        const paramValue = searchParams.get('status');

        if (paramValue == "arrived") {
            $(".lead-title").text("You have arrived!")
            $(".description").text("Finished, please remember to scan back in when you arrive again!")
            return
        }
        $(".lead-title").text("You have left!")
        $(".description").text("Thank you for coming!")
    })
</script>

</html>
