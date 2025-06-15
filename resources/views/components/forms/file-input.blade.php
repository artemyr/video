@props([
    'value' => '',
    'image' => '',
    'link' => '',
    'isError' => false,
    'label' => ''
])

<label>{{ $label }}</label>

@if(!empty($image))
    <img width="300" src="{{ $image }}" alt="">
@endif

@if(!empty($link))
    <a target="_blank" class="block" href="{{ $link }}">{{ $link }}</a>
@endif

<input placeholder="{{ $label }}" type="file" {{ $attributes
    ->class([
        'border-red' => $isError,
        'border block w-full rounded-md p-2 text-black mb-8 text-white'
    ]) }}
>
