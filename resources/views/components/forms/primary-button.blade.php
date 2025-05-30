@props([
    'class' => 'p-2 rounded-md',
    'title' => ''
])

<button type="submit" class="{{ $class }}" title="{{ $title }}">
    {{ $slot }}
</button>
