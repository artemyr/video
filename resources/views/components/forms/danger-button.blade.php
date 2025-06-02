@props([
    'class' => 'btn-danger',
    'title' => ''
])

<button type="submit" class="{{ $class }}" title="{{ $title }}">
    {{ $slot }}
</button>
