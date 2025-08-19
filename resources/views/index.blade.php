@extends('layouts.app')

@section('content')

    <main>
        <section class="mb-[25px]">
            @if($editMode)
                <a class="hover:text-red text-xxs italic text-gray-500/80" href="{{ route('filament.admin.resources.sliders.create') }}">Редактировать</a>
            @endif
            <div class="swiper">
                <div class="swiper-wrapper lightgalery-container">
                    @foreach($sliders as $slider)
                        <x-front.galery-item
                            :type="$slider->getVideoSlideType()"
                            :item="$slider"
                            class="swiper-slide"
                            resolution="500x500"
                        >
                        </x-front.galery-item>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <div class="container">
            <section>
                <div class="grid grid-cols-4 py-[25px]">
                    <div class="px-[25px] col-span-4 md:col-span-3">
                        <x-edit-text :text="$about" :code="\Support\Enums\TextsEnum::MAIN_ABOUT->value">
                        </x-edit-text>
                    </div>
                    <div class="px-[25px] grid justify-center col-span-4 md:col-span-1">
                        @if(!empty($author))
                            <img src="{{ asset($author) }}" alt="">
                        @endif
                    </div>
                </div>
            </section>
            <section>
                <div class="grid grid-flow-col grid-cols-4 py-[25px]">
                    <div class="col-span-3 px-[25px]">
                        <p class="text-[24px] md:text-xl mb-[18px]">Узнайте, свободна ли дата</p>
                        <p class="mt-[17px]">или задайте любой другой вопрос</p>
                        <div class="mt-[25px]">
                            <a href="https://wa.me/{{ $phone }}" target="_blank" class="text-white rounded-[100px] px-[40px] py-[18px] uppercase text-[12px] bg-admin-dark hover:bg-admin-light transition-colors">свободные даты</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

@endsection
