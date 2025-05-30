@extends('layouts.admin')

@section('content')
    <a class="bg-admin-dark block p-4 rounded-xl"
       href="{{ route('admin.main.slider') }}" title="Редактировать слайдер на главной">Слайдер</a>
@endsection
