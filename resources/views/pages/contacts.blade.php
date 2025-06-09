@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="grid grid-flow-row gap-4 justify-center text-center">
            <div>
                <img class="rounded-full w-[400px]" src="{{ Vite::image('author.jpg') }}" alt="">
            </div>
            <p class="text-md">Фотограф</p>
            <a href="tel:+79585469791" class="text-xl">8-958-546-97-91</a>
            <div class="py-4">
                <a class="btn-black">Написать вконтакте</a>
            </div>
            <div class="py-4">
                <a href="https://wa.me/79585469791" class="btn-black">Написать whatsapp</a>
            </div>
            <div class="py-4">
                <a class="btn-black">Написать инстаграмм</a>
            </div>
            <div class="py-4">
                <a href="https://t.me/GK_Darya_13" class="btn-black">Написать телеграм</a>
            </div>
        </div>
    </div>
@endsection
