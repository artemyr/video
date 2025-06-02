<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title', env('APP_NAME'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-admin text-white">
    @include('shared.flash')

    <main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
        <div class="container">

            @yield('content')

        </div>
    </main>
</body>
</html>
