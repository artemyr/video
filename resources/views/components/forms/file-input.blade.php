@props([
    'value' => '',
    'image' => '',
    'link' => '',
    'isError' => false,
    'label' => '',
    'name' => ''
])

<label class="block">{{ $label }}</label>

@if(!empty($image))
    <img width="300" src="{{ $image }}" alt="">
@endif

@if(!empty($link))
    <a target="_blank" class="block" href="{{ $link }}">{{ $link }}</a>
@endif

<input placeholder="{{ $label }}" type="file" name="{{ $name }}" {{ $attributes
    ->class([
        'border-red' => $isError,
        'border block w-full rounded-md p-2 text-black mb-8 text-white'
    ]) }}
>

@error($name)
<x-forms.error>
    {{ $message }}
</x-forms.error>
@enderror
