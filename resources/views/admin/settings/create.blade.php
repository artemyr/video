@extends('layouts.admin')

@section('content')
    <form class="space-y-3" action="{{ route('admin.settings.create') }}" method="post">
        @csrf

        <x-forms.text-input
            :value="old('code', request('code', ''))"
            label="Code"
            name="code"
            :isError="$errors->has('code')"
        ></x-forms.text-input>

        <x-forms.text-input
            :value="old('sort', '500')"
            label="Sort"
            name="sort"
            :isError="$errors->has('sort')"
        ></x-forms.text-input>

        <x-forms.text-input
            :value="old('description', '')"
            label="Description"
            name="description"
            :isError="$errors->has('description')"
        ></x-forms.text-input>

        <x-forms.text-input
            label="Значение"
            name="value"
            :value="old('value', '')"
            :isError="$errors->has('value')"
        ></x-forms.text-input>

        <x-forms.success-button>
            Сохранить
        </x-forms.success-button>

    </form>
@endsection
