@props([
    'type' => 'text',
    'value' => '',
    'isError' => false,
    'label' => ''
])

<label for="">{{ $label }}</label>
<input placeholder="{{ $label }}" type="{{ $type }}" value="{{ $value }}" {{ $attributes
    ->class([
        'border-red' => $isError,
        'border block w-full rounded-md p-2 text-black mb-8'
    ]) }}
>
