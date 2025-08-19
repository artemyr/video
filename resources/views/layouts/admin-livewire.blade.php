<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Админка</title>

    @livewireStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-admin text-white">
    @include('shared.flash')

    <div class="h-16 bg-admin-light grid grid-flow-col justify-between items-center p-2">

        <a href="{{ route('home') }}" class="btn-success">На сайт</a>

        <form action="{{ route('logOut') }}" method="POST">
            @csrf
            @method('DELETE')
            <x-forms.danger-button title="Выйти из аккаунта">
                Выйти
            </x-forms.danger-button>
        </form>
    </div>

    <div class="grid grid-cols-4">

        <div class="col-span-1 bg-admin-dark min-h-screen p-4">
            <div class="grid grid-flow-row gap-4">
                @foreach($adminMenu as $item)
                <a class="p-4 bg-admin block rounded-xl transition-colors
                    @if($item->isActive()) font-bold bg-admin-light cursor-default @else hover:bg-admin-light  @endif"
                    href="{{ $item->link() }}">{{ $item->label() }}</a>
                @endforeach
            </div>
        </div>

        <div class="col-span-3 min-h-screen">
            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
