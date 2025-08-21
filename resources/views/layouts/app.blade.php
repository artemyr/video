<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title->value }}</title>
    <meta name="description" content="{{ $description->value }}">

    <link rel="icon" type="image/x-icon" href="{{ asset($favicon) }}">

    @if ($showCaptcha)
    <script src="{{ config('captcha.js_url') }}"></script>
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('shared.flash')

    @include('shared.header')

    @yield('content')

    @include('shared.footer')

    @stack('scripts')

</body>
</html>
