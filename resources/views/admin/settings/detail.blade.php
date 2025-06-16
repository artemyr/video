@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.settings.update', $item->id) }}" method="post">
        @csrf

        @error('code')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror
        <x-forms.text-input
            :value="old('code', $item->code)"
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
            :value="old('sort', $item->sort)"
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
            :value="old('description',$item->description)"
            label="Description"
            name="description"
            :isError="$errors->has('description')"
        ></x-forms.text-input>

        @error('value')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror
        <x-forms.text-input
            label="Значение"
            name="value"
            :value="old('value', $item->value)"
            :isError="$errors->has('value')"
        ></x-forms.text-input>

        <x-forms.success-button>
            Сохранить
        </x-forms.success-button>

    </form>
@endsection
