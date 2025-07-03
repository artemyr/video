@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="grid grid-flow-row gap-4 justify-center text-center">
            <div>
                @if(!empty($author))
                    <img class="rounded-full w-[400px]" src="{{ asset($author) }}" alt="">
                @endif
            </div>
            <p class="text-md">
                <x-edit-setting :setting="$text1" :code="\Support\Enums\SettingsEnum::CONTACT_TEXT_1->value">
                </x-edit-setting>
            </p>
            <a href="tel:{{ $phone }}" class="text-xl">
                <x-edit-setting :setting="$displayPhone" :code="\Support\Enums\SettingsEnum::MAIN_PHONE->value">
                </x-edit-setting>
            </a>
            <div class="py-4">
                <a href="https://wa.me/{{ $phone }}" class="btn-black">Написать whatsapp</a>
            </div>
            <div class="py-4">
                <a href="https://t.me/{{ $tg->value }}" class="btn-black">Написать телеграм</a>
            </div>
        </div>
    </div>
@endsection
