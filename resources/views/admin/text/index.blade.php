@extends('layouts.admin')

@section('content')

    <div class="mb-4">
        <a class="btn-success" href="{{ route('admin.text.create') }}">Добавить</a>
    </div>

    <x-table
        :table="$table"
    ></x-table>

@endsection
