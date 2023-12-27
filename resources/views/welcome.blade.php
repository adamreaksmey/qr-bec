<!DOCTYPE html>
<html lang="en">

<x-head />

<body>
    <div class="flex flex-col justify-center items-center h-screen gap-10 w-full">
        <div class="text-3xl font-bold flex justify-center">
            Are you arriving or leaving?
        </div>
        <div class="flex justify-center gap-2">
            <button class="button is-primary" onclick="setLocalStorage('arriving')">Arriving</button>
            <button class="button is-danger" onclick="setLocalStorage('leaving')">Leaving</button>
        </div>
        <div class="flex justify-center items-end">
            <button class="button is-warning">ខ្មែរ | English</button>
        </div>
    </div>
</body>

<script>
    function setLocalStorage(status) {
        localStorage.setItem('client-status', status);
        window.location.href = '/search-page'
    }
</script>

</html>
