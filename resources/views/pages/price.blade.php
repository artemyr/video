@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="grid grid-cols-3 gap-10">

            @foreach($prices as $price)
                <div>
                    <p class="text-xl text-brown mb-4">{{ $price->title }}</p>

                    {!! $price->description !!}
                </div>
            @endforeach

            <div>
                ВАЖНАЯ ИНФОРМАЦИЯ:
                ПРОЧИТАЙТЕ ИНФОРМАЦИЮ ПЕРЕД БРОНИРОВАНИЕМ

                • Для брони напишите мне WhatsApp или Telegram
                • Запись и бронирование осуществляется внесением задатка 50%,
                • замена основной аудиодорожки при монтаже видеоролика НЕ считается правкой (согласовывается только ПЕРЕД монажем)
                • Остаток оплачивается в день съемхи.
                • первичные видеоматериалы (исходники) не пердоставляются.
            </div>
        </div>
    </div>
@endsection
