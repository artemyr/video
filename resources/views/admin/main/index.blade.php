@extends('layouts.admin')

@section('content')

    <a class="bg-admin-dark block p-4 rounded-xl hover:bg-admin-light"
       href="{{ route('admin.main.slider.index') }}"
       title="Редактировать слайдер на главной"
    >
        Слайдер
    </a>

@endsection
