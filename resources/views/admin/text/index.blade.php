@extends('layouts.admin')

@section('content')

    <table class="w-full table-auto border-collapse text-sm">
        <thead>
            <tr>
                <th class="border-b border-gray-200 p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400 dark:border-gray-600 dark:text-gray-200">Код</th>
                <th class="border-b border-gray-200 p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400 dark:border-gray-600 dark:text-gray-200">Сортировка</th>
                <th class="border-b border-gray-200 p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400 dark:border-gray-600 dark:text-gray-200">Текст</th>
                <th class="border-b border-gray-200 p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400 dark:border-gray-600 dark:text-gray-200">Удалить</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800">
            @foreach($texts as $text)
                <tr>
                   <td class="border-b border-gray-100 p-4 pl-8 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $text->code }}</td>
                   <td class="border-b border-gray-100 p-4 pl-8 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $text->sort }}</td>
                   <td class="border-b border-gray-100 p-4 pl-8 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $text->text }}</td>
                   <td class="border-b border-gray-100 p-4 pl-8 text-gray-500 dark:border-gray-700 dark:text-gray-400">
                       <form action="" method="post">
                           @csrf
                           @method('DELETE')
                           <x-forms.danger-button>
                               Удалить
                           </x-forms.danger-button>
                       </form>
                   </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
