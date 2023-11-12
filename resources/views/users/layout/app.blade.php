<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body class="font-poppins">
    <div class="flex gap-8">
        @include('users.components.navbar')
        <div class="h-screen w-full pr-9 overflow-y-scroll pt-7">
            @include('users.components.header')
            <div class="h-full">
                @yield('content')
            </div>
            @include('users.components.footer')
        </div>
    </div>
</body>

</html>
