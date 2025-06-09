@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.text.update', $text->id) }}" method="post">
        @csrf

        @error('code')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror
        <x-forms.text-input
            :value="old('code', $text->code)"
            label="Code"
            name="code"
            :isError="$errors->has('code')"
        ></x-forms.text-input>

        @error('sort')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror
        <x-forms.text-input
            :value="old('sort', $text->sort)"
            label="Sort"
            name="sort"
            :isError="$errors->has('sort')"
        ></x-forms.text-input>

        @error('description')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror
        <x-forms.text-input
            :value="old('description',$text->description)"
            label="Description"
            name="description"
            :isError="$errors->has('description')"
        ></x-forms.text-input>

        @error('text')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror
        <x-editor
            label="Текст"
            name="text"
            :value="old('text', $text->text)"
            :isError="$errors->has('text')"
        ></x-editor>

        <x-forms.success-button>
            Сохранить
        </x-forms.success-button>

    </form>
@endsection
