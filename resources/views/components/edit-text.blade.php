@props([
    'text' => null,
    'code' => ''
])

@if($editMode)
    <div class="group hover:border border-gray-500">
        @if($text)
            <a class="group-hover:text-red text-xxs italic text-gray-500/80" href="{{ route('admin.text.detail', $text->id) }}">Редактировать</a>
            {!! $text->text !!}
        @else
            <a class="group-hover:text-red text-xxs italic text-gray-500/80" href="{{ route('admin.text.create', ['code' => $code]) }}">Редактировать</a>
        @endif
    </div>
@else
    @if($text)
        {!! $text->text !!}
    @endif
@endif
