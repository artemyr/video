@extends('layouts.admin')

@section('content')

    <div class="mb-4">
        <a class="btn-success" href="{{ route('admin.settings.create.page') }}">Добавить</a>
    </div>

    <x-table
        :table="$table"
    ></x-table>

@endsection
