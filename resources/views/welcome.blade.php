<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/church.svg') }}">
    <title>Hello!</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex flex-col justify-center pt-20 gap-10 w-full">
        <div class="text-3xl font-bold flex justify-center">
            Are you arriving or leaving?
        </div>
        <div class="flex justify-center gap-2">
            <button class="button is-primary">Arriving</button>
            <button class="button is-danger">Leaving</button>
        </div>
        <div class="flex justify-center items-end">
            <button class="button is-warning">ខ្មែរ | English</button>
        </div>
    </div>
</body>


</html>
