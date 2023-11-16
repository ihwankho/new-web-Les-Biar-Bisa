<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Les Biar Bisa</title>
    @vite('resources/css/app.css')
</head>

<body class="font-poppins">
    <div class="flex gap-8 h-screen overflow-hidden">
        @include('components.navbarAdmin')
        <div class="h-screen w-full pr-9 overflow-y-auto pt-7">
            @include('components.header')
            <div class="h-full mt-10">
                @yield('content')
            </div>
            @include('components.footer')
        </div>
    </div>
</body>

</html>
