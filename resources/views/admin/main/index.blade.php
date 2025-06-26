@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.main.save') }}" enctype="multipart/form-data" method="post">
        @csrf

        <x-forms.file-input
            image="{{ $logo }}"
            :isError="$errors->has('logo')"
            label="Логотип"
            name="logo"
        >
        </x-forms.file-input>

        <x-forms.file-input
            image="{{ $author }}"
            :isError="$errors->has('author')"
            label="Автор"
            name="author"
        >
        </x-forms.file-input>

        <x-forms.file-input
            image="{{ $favicon }}"
            :isError="$errors->has('favicon')"
            label="Фавиконка"
            name="favicon"
        >
        </x-forms.file-input>

        <x-editor
            value="{{ $robots }}"
            :isError="$errors->has('robots')"
            label="robots.txt"
            name="robots"
        >
        </x-editor>

        <x-forms.success-button>
            Сохранить
        </x-forms.success-button>

    </form>
@endsection
