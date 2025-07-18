@extends('layouts.admin')

@section('content')
    <form class="space-y-3" action="{{ route('admin.main.slider.create') }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        <x-forms.text-input
            :value="old('title', '')"
            label="Название"
            name="title"
            :isError="$errors->has('title')"
        ></x-forms.text-input>

        <x-forms.text-input
            :value="old('sort', 500)"
            label="Сортировка"
            name="sort"
            :isError="$errors->has('sort')"
        ></x-forms.text-input>

        <x-forms.checkbox-input
            :value="old('active', true)"
            label="Активность"
            name="active"
            :isError="$errors->has('active')"
        ></x-forms.checkbox-input>

        <x-forms.file-input
            label="Картинка"
            name="image"
            :isError="$errors->has('image')"
        ></x-forms.file-input>

        <x-forms.video-input
            linkValue="{{ old('link','') }}"
            :height="old('x_size', 0)"
            :width="old('y_size', 0)"
        >
        </x-forms.video-input>

        <x-forms.success-button>
            Сохранить
        </x-forms.success-button>
    </form>
@endsection
