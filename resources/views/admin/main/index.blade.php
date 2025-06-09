@extends('layouts.admin')

@section('content')

    <a class="bg-admin-dark block p-4 rounded-xl hover:bg-admin-light"
       href="{{ route('admin.main.meta') }}"
       title="title, description, логотип, контакты"
    >
        Мета информация
    </a>

    <a class="bg-admin-dark block p-4 rounded-xl hover:bg-admin-light"
       href="{{ route('admin.main.slider') }}"
       title="Редактировать слайдер на главной"
    >
        Слайдер
    </a>

@endsection
