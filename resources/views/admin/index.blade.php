@extends('layouts.admin')

@section('content')
    <a href="{{ route('admin.main.slider') }}">Добавить элемент в слайдер</a>

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
