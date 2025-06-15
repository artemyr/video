@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.main.slider.update', $item->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        @error('title')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror
        <x-forms.text-input
            :value="old('title', $item->title)"
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
            :value="old('sort', $item->sort)"
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
            :value="old('active', $item->active)"
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
            :value="old('size', $item->size)"
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
            :image="asset('/storage/images/' . $item->image)"
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
            :link="asset('/storage/video/' . $item->video)"
            label="Видео"
            name="video"
            :isError="$errors->has('video')"
        ></x-forms.file-input>

        <x-forms.success-button>
            Сохранить
        </x-forms.success-button>

    </form>
@endsection
