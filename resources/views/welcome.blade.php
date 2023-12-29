<!DOCTYPE html>
<html lang="en">

<x-head />

<body>
    <div class="flex flex-col justify-center items-center min-h-screen gap-10 w-full px-4 sm:px-6" style="height: 100vh">
        <div class="text-2xl sm:text-3xl font-bold text-center">
            Are you arriving or leaving?
        </div>
        <div class="flex justify-center gap-2">
            <button class="button is-primary" onclick="setLocalStorage('arrived')">Arriving</button>
            <button class="button is-danger" onclick="setLocalStorage('left')">Leaving</button>
        </div>
        <div class="flex justify-center items-end mt-4">
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
