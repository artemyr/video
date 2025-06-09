@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.text.update', ['text' => $text->id]) }}" method="post">
        @csrf

        @error('code')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror
        <x-forms.text-input
            value="{{ $text->code }}"
            name="code"
            :isError="$errors->has('code')"
        ></x-forms.text-input>

        @error('text')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror
        <x-editor
            :text="old('text', $text->text)"
            :isError="$errors->has('text')"
        ></x-editor>

        <x-forms.success-button>
            Сохранить
        </x-forms.success-button>

    </form>
@endsection
