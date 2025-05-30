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

    <div class="h-16 bg-admin-light grid grid-flow-col justify-between items-center p-2">

        <a href="{{ route('home') }}" class="p-2 rounded-xl bg-green">На сайт</a>

        <form action="{{ route('logOut') }}" method="POST">
            @csrf
            @method('DELETE')
            <x-forms.primary-button class="bg-red p-2 rounded-xl hover:bg-red-dark transition-colors" title="Выйти из аккаунта">
                Выйти
            </x-forms.primary-button>
        </form>
    </div>

    <div class="grid grid-cols-4">
        <div class="col-span-1 bg-admin-dark min-h-screen p-4">
            <a class="p-4 bg-admin block rounded-xl hover:bg-admin-light transition-colors"
               title="Редактировать главную страницу" href="{{ route('admin.main') }}">Главная</a>
        </div>
        <div class="col-span-3 min-h-screen">
            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
