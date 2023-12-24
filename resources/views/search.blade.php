<!DOCTYPE html>
<html lang="en">

<x-head />

<body>
    <div class="flex flex-col justify-center h-screen items-center gap-10 w-full">
        <div class="text-4xl sm:text-4xl md:text-5xl lg:text-6xl font-bold flex justify-center text-center">
            Find your name or number
        </div>
        <div class="flex justify-center gap-3">
            <div class="w-3/5"> <input class="input is-primary" type="text" placeholder="Search"></div>
            <button class="button is-success" onclick="window.location.href = '/checked-in'">Submit</button>
        </div>
        <div class="flex justify-center items-end">
            <button class="button is-warning">ខ្មែរ | English</button>
        </div>
    </div>
</body>

</html>
