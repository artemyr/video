@props([
    'setting' => null,
    'code' => ''
])

@if(auth()->id() > 0 && auth()->user()->role === 'admin')
    <div class="group hover:border border-gray-500">
        @if($setting)
            <a class="group-hover:text-red text-xxs italic text-gray-500/80" href="{{ route('admin.settings.detail', ['id' => $setting->id]) }}">Редактировать</a>
            {!! $setting->value !!}
        @else
            <a class="group-hover:text-red text-xxs italic text-gray-500/80" href="{{ route('admin.settings.create', ['code' => $code]) }}">Редактировать</a>
        @endif
    </div>
@else
    @if($setting)
        {!! $setting->value !!}
    @endif
@endif
