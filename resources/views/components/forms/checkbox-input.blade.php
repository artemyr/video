@props([
    'type' => 'text',
    'value' => '',
    'isError' => false,
    'label' => ''
])

<label>{{ $label }}</label>
<input placeholder="{{ $label }}" type="checkbox" value="1" {{ $attributes
    ->class([
        'border-red' => $isError,
        'border block rounded-md p-2 text-black mb-8'
    ]) }}
    @checked($value)
>
