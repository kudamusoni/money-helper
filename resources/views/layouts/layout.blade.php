<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Money Helper</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="">
    <a href="/">
        <div class="top-0 left-0 fixed z-10 m-8 font-extrabold">Money Helper</div>
    </a>

    <div id="app" class="flex items-center justify-center h-screen">
        @yield('content')
    </div>
</body>
</html>
