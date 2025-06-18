@props([
    'value' => '',
    'isError' => false,
    'label' => '',
    'name' => ''
])

@error($name)
<x-forms.error>
    {{ $message }}
</x-forms.error>
@enderror

<label for="">{{ $label }}</label>
<textarea {{ $attributes->class([
    'border-red' => $isError,
    'text-black border w-full'
]) }} rows="20" name="{{ $name }}" id="editor">{{ $value }}</textarea>
