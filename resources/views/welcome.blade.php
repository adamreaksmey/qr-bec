<!DOCTYPE html>
<html lang="en">

<x-head />

<body>
    <div class="flex flex-col justify-center items-center h-screen gap-10 w-full">
        <div class="text-3xl font-bold flex justify-center">
            Are you arriving or leaving?
        </div>
        <div class="flex justify-center gap-2">
            <button class="button is-primary" onclick="window.location.href = '/search-page'">Arriving</button>
            <button class="button is-danger" onclick="window.location.href = '/search-page'">Leaving</button>
        </div>
        <div class="flex justify-center items-end">
            <button class="button is-warning">ខ្មែរ | English</button>
        </div>
    </div>
</body>

</html>
