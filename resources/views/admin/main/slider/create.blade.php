@extends('layouts.admin')

@section('content')

    <div>
        <form action="{{ route('admin.main.slider.create') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @error('title')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror
            <x-forms.text-input
                :value="old('title', '')"
                label="Название"
                name="title"
                :isError="$errors->has('title')"
            ></x-forms.text-input>

            @error('sort')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror
            <x-forms.text-input
                :value="old('sort', 500)"
                label="Сортировка"
                name="sort"
                :isError="$errors->has('sort')"
            ></x-forms.text-input>

            @error('active')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror
            <x-forms.checkbox-input
                :value="old('active', true)"
                label="Активность"
                name="active"
                :isError="$errors->has('active')"
            ></x-forms.checkbox-input>

            @error('size')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror
            <x-forms.text-input
                :value="old('size', '')"
                label="Размер"
                name="size"
                :isError="$errors->has('size')"
            ></x-forms.text-input>

            @error('image')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror
            <x-forms.file-input
                label="Картинка"
                name="image"
                :isError="$errors->has('image')"
            ></x-forms.file-input>

            @error('video')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror
            <x-forms.file-input
                label="Видео"
                name="video"
                :isError="$errors->has('video')"
            ></x-forms.file-input>

            <x-forms.success-button>
                Сохранить
            </x-forms.success-button>
        </form>
    </div>

@endsection
