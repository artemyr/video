@props([
    'setting' => null,
    'code' => ''
])

@if($editMode)
    <div class="group hover:border border-gray-500">
        @if($setting && $setting->id)
            <a class="group-hover:text-red text-xxs italic text-gray-500/80" href="{{ route('filament.admin.resources.settings.edit', $setting->id) }}">Редактировать</a>
            {!! $setting->value !!}
        @else
            <a class="group-hover:text-red text-xxs italic text-gray-500/80" href="{{ route('filament.admin.resources.settings.create', ['code' => $code]) }}">Редактировать</a>
        @endif
    </div>
@else
    @if($setting)
        {!! $setting->value !!}
    @endif
@endif
