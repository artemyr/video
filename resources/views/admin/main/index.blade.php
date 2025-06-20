@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.main.save') }}" enctype="multipart/form-data" method="post">
        @csrf

        <x-forms.file-input
            image="{{ $image }}"
            :isError="$errors->has('logo')"
            label="Автор"
            name="logo"
        >
        </x-forms.file-input>

        <x-forms.file-input
            image="{{ $favicon }}"
            :isError="$errors->has('favicon')"
            label="Фавиконка"
            name="favicon"
        >
        </x-forms.file-input>

        <x-forms.success-button>
            Сохранить
        </x-forms.success-button>

    </form>
@endsection
