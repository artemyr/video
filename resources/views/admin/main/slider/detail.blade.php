@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.main.slider.update', $slider->id) }}" method="post">
        @csrf

{{--        'Название',--}}
{{--        'Активность',--}}
{{--        'Фото',--}}
{{--        'Видео',--}}
{{--        'Размер',--}}

        @error('sort')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror
        <x-forms.text-input
            :value="old('sort', $slider->sort)"
            label="Sort"
            name="sort"
            :isError="$errors->has('sort')"
        ></x-forms.text-input>

        <x-forms.success-button>
            Сохранить
        </x-forms.success-button>

    </form>
@endsection
