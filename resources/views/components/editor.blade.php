@props([
    'text' => '',
    'isError' => false
])

<div class="bg-white text-black" {{ $attributes->class(['border-red' => $isError]) }}>
    <textarea name="content" id="editor">{{ $text }}</textarea>
</div>
