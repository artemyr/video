@props([
    'type' => 'text',
    'value' => '',
    'isError' => false,
    'label' => '',
    'name' => ''
])

<label class="block">{{ $label }}</label>

<input placeholder="{{ $label }}" type="checkbox" name="{{ $name }}" value="1" {{ $attributes
    ->class([
        'border-red' => $isError,
        'border block rounded-md p-2 text-black mb-8'
    ]) }}
    @checked($value)
>

@error($name)
<x-forms.error>
    {{ $message }}
</x-forms.error>
@enderror
