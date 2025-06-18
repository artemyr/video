@props([
    'type' => 'text',
    'value' => '',
    'isError' => false,
    'label' => '',
    'name' => ''
])

<label class="block">{{ $label }}</label>

<input placeholder="{{ $label }}" type="{{ $type }}" value="{{ $value }}" name="{{ $name }}" {{ $attributes
    ->class([
        'border-red' => $isError,
        'border block w-full rounded-md p-2 text-black mb-8'
    ]) }}
>

@error($name)
<x-forms.error>
    {{ $message }}
</x-forms.error>
@enderror
