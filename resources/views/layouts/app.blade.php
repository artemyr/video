<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">

    <link rel="icon" type="image/x-icon" href="{{ $favicon }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('shared.flash')

    @include('shared.header')

    @yield('content')

    @include('shared.footer')
</body>
</html>
