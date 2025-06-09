@extends('layouts.app')

@section('title')
    123
@endsection

@section('content')

    <main>
        <section class="mb-[25px]">
            <div class="swiper">
                <div class="swiper-wrapper lightgalery-container">
                    @each('index.shared.slider', $sliders, 'slider')
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <div class="container">
            <section>
                <div class="grid grid-cols-4 py-[25px]">
                    <div class="px-[25px] col-span-4 md:col-span-3">
                        <x-edit-text id="{{ $about->id }}">
                            {!! $about->text !!}
                        </x-edit-text>
                    </div>
                    <div class="px-[25px] grid justify-center col-span-4 md:col-span-1">
                        <img src="{{ Vite::image('author.jpg') }}" alt="women">
                    </div>
                </div>
            </section>
            <section>
                <div class="grid grid-flow-col grid-cols-4 py-[25px]">
                    <div class="col-span-3 px-[25px]">
                        <p class="text-[24px] md:text-xl mb-[18px]">Узнайте, свободна ли дата</p>
                        <p class="mt-[17px]">или задайте любой другой вопрос</p>
                        <div class="mt-[25px]">
                            <a href="https://wa.me/79585469791" target="_blank" class="bg-primary text-white rounded-[100px] px-[40px] py-[18px] uppercase text-[12px] hover:bg-[rgba(43,43,43,0.6)] transition-colors">свободные даты</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

@endsection
