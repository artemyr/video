@props([
    'table' => null
])

@if($table)
<table class="w-full table-auto border-collapse text-sm">
    <thead>
        <tr>
            @foreach($table->head->cols as $col)
                <th class="border-b border-gray-200 p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400 dark:border-gray-600 dark:text-gray-200">
                    {{ $col->value }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody class="bg-white dark:bg-gray-800">
        @foreach($table->body as $row)
            <tr x-data="{redirect:'{{ $row->detailUrl }}'}" x-on:click="location.href=redirect">
                @foreach($row->cols as $col)
                    @if(!empty($col->component))
                        <td class="border-b border-gray-100 p-4 pl-8 text-gray-500 dark:border-gray-700 dark:text-gray-400">
                            @component($col->component->name, $col->component->props)
                                Удалить
                            @endcomponent
                        </td>
                    @else
                        <td class="border-b border-gray-100 p-4 pl-8 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $col->value }}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
@endif
