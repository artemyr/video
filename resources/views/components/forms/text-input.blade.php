@props([
    'type' => 'text',
    'value' => '',
    'isError' => false
])

<input type="{{ $type }}" value="{{ $value }}" {{ $attributes
    ->class([
        'border-red' => $isError,
        'border block w-full rounded-md p-2 text-black'
    ]) }}
>
