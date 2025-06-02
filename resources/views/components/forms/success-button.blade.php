@props([
    'class' => 'btn-success',
    'title' => ''
])

<button type="submit" class="{{ $class }}" title="{{ $title }}">
    {{ $slot }}
</button>
