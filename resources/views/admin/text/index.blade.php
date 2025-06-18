@extends('layouts.admin')

@section('content')

    <div class="mb-4">
        <a class="btn-success" href="{{ route('admin.text.create.page') }}">Добавить</a>
    </div>

    <x-table
        :table="$table"
    ></x-table>

    {{ $items->links() }}

@endsection
