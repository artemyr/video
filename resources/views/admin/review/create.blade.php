@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.review.create') }}" method="post" enctype="multipart/form-data">
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

        @error('description')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror
        <x-forms.text-input
            :value="old('description', '')"
            label="Описание"
            name="description"
            :isError="$errors->has('description')"
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

        <x-forms.success-button>
            Сохранить
        </x-forms.success-button>

    </form>
@endsection
