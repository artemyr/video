@extends('layouts.admin')

@section('content')
    <a href="{{ route('admin.main.slider') }}">Добавить элемент в слайдер</a>

    <form action="{{ route('logOut') }}" method="POST">
        @csrf
        @method('DELETE')
        <x-forms.primary-button>
            Выйти
        </x-forms.primary-button>
    </form>

    <div>
        @foreach($sliders as $slider)
            <div>{{ $slider->title }}</div>
            <div>{{ $slider->active }}</div>
            <div>{{ $slider->sort }}</div>
            <div>{{ $slider->photo }}</div>
            <div>{{ $slider->video }}</div>
        @endforeach
    </div>
@endsection
