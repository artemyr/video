@extends('layouts.auth')

@section('title', 'Вход в аккаунт')

@section('content')
    <x-forms.auth-forms
        title="Вход в аккаунт"
        action="{{ route('login.handle') }}"
        method="POST"
    >
        @csrf

        <x-forms.text-input
            name="email"
            type="email"
            placeholder="E-mail"
            required="true"
            value="{{ old('email') }}"
            :isError="$errors->has('email')"
        />

        <x-forms.text-input
            name="password"
            type="password"
            placeholder="Пароль"
            required="true"
            :isError="$errors->has('email')"
        />

        <x-forms.success-button>
            Войти
        </x-forms.success-button>

        <x-slot:buttons>
            <div class="space-y-3 mt-5">
                <div class="text-xxs md:text-xs"><a href="{{ route('forgot') }}" class="text-white hover:text-white/70 font-bold">Забыли пароль?</a></div>
                <div class="text-xxs md:text-xs"><a href="{{ route('register') }}" class="text-white hover:text-white/70 font-bold">Регистрация</a></div>
            </div>
        </x-slot:buttons>
    </x-forms.auth-forms>
@endsection
