@props([
    'text' => '',
    'id' => 0
])

@if(auth()->id() > 0 && auth()->user()->role === 'admin')
    <a class="text-xs italic" href="{{ route('admin.text.detail', ['id' => $id]) }}">Редактировать</a>
    {{ $slot }}
@else
    {{ $slot }}
@endif
