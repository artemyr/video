@extends('layouts.admin')

@section('content')

    <form action="{{ route('admin.main.slider.handle') }}" method="POST">
        @csrf

        <label>Заголовок</label>
        <x-forms.text-input
            name="title"
            type="text"
            placeholder="Заголовок"
            required="true"
            value="{{ old('title') }}"
            :isError="$errors->has('title')"
        />
        @error('title')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <input type="submit">
    </form>

@endsection
