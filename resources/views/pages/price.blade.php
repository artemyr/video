@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="grid xs:grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mb-16">

            @foreach($prices as $price)
                <div>
                    <p class="text-xl text-brown mb-4 font-bold">{{ $price->title }}</p>

                    {!! $price->description !!}
                </div>
            @endforeach
        </div>

        <div class="grid justify-center">
            <div class="max-w-[550px]">
                <p class="text-center text-brown text-md font-bold">ВАЖНАЯ ИНФОРМАЦИЯ:</p>
                <p class="text-center text-brown text-sm mb-4">ПРОЧИТАЙТЕ ИНФОРМАЦИЮ ПЕРЕД БРОНИРОВАНИЕМ</p>

                <ul class="grid grid-flow-cols gap-4">
                    <li>Для брони напишите мне WhatsApp или Telegram</li>
                    <li>Запись и бронирование осуществляется внесением задатка 50%,</li>
                    <li>замена основной аудиодорожки при монтаже видеоролика НЕ считается правкой (согласовывается только ПЕРЕД монажем)</li>
                    <li>Остаток оплачивается в день съемхи.</li>
                    <li>первичные видеоматериалы (исходники) не пердоставляются.</li>
                </ul>
            </div>
        </div>

    </div>
@endsection
