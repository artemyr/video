@extends('layouts.app')

@section('content')

    <main>
        <section class="mb-[25px]">
            <div class="swiper">
                <div class="swiper-wrapper lightgalery-container">

                    @foreach($sliders as $slider)
                        <div class="swiper-slide lightgalery">
                            <a
                                data-lg-size="1080-1920"
                                data-video='{"source": [{"src":"{{ $slider->video() }}", "type":"video/mp4"}], "attributes": {"preload": false, "playsinline": true, "controls": true}}'
                                data-poster="{{ $slider->makeThumbnail('500x500') }}"
                                data-sub-html="<h4>{{ $slider->title }}</h4>"
                            >
                                <img
                                    class="img-responsive"
                                    src="{{ $slider->makeThumbnail('500x500') }}"
                                />
                            </a>
                        </div>
                    @endforeach

                    <div class="swiper-slide lightgalery">
                        <a
                            data-lg-size="1280-720"
                            data-video='{"source": [{"src":"{{  Vite::image('video/sea.mp4') }}", "type":"video/mp4"}], "attributes": {"preload": false, "playsinline": true, "controls": true}}'
                            data-poster="{{ Vite::image('slider/1.png') }}"
                            data-sub-html="<h4>1</h4>"
                        >
                            <img
                                class="img-responsive"
                                src="{{ Vite::image('slider/1.png') }}"
                            />
                        </a>
                    </div>
                    <div class="swiper-slide lightgalery">
                        <a
                            data-lg-size="1280-720"
                            data-video='{"source": [{"src":"{{ Vite::image('video/river.mp4') }}", "type":"video/mp4"}], "attributes": {"preload": false, "playsinline": true, "controls": true}}'
                            data-poster="{{ Vite::image('slider/2.png') }}"
                            data-sub-html="<h4>2</h4>"
                        >
                            <img
                                class="img-responsive"
                                src="{{ Vite::image('slider/2.png') }}"
                            />
                        </a>
                    </div>
                    <div class="swiper-slide lightgalery">
                        <a
                            data-lg-size="1280-720"
                            data-src="//www.youtube.com/watch?v=EIUJfXk3_3w"
                            data-poster="{{ Vite::image('slider/3.png') }}"
                            data-sub-html="<h4>3</h4>"
                        >
                            <img
                                class="img-responsive"
                                src="{{ Vite::image('slider/3.png') }}"
                            />
                        </a>
                    </div>
                    <div class="swiper-slide lightgalery">
                        <a
                            data-lg-size="1280-720"
                            data-video='{"source": [{"src":"{{ Vite::image('video/river.mp4') }}", "type":"video/mp4"}], "attributes": {"preload": false, "playsinline": true, "controls": true}}'
                            data-poster="{{ Vite::image('slider/1.png') }}"
                            data-sub-html="<h4>5</h4>"
                        >
                            <img
                                class="img-responsive"
                                src="{{ Vite::image('slider/1.png') }}"
                            />
                        </a>
                    </div>
                    <div class="swiper-slide lightgalery">
                        <a
                            data-lg-size="1280-720"
                            data-video='{"source": [{"src":"{{ Vite::image('video/sea.mp4') }}", "type":"video/mp4"}], "attributes": {"preload": false, "playsinline": true, "controls": true}}'
                            data-poster="{{ Vite::image('slider/2.png') }}"
                            data-sub-html="<h4>6</h4>"
                        >
                            <img
                                class="img-responsive"
                                src="{{ Vite::image('slider/2.png') }}"
                            />
                        </a>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <div class="container">
            <section>
                <div class="grid grid-cols-4 py-[25px]">
                    <div class="px-[25px] col-span-4 md:col-span-3">
                        <p class="text-xl mb-[18px]">Приветствую</p>
                        <p class="my-[14px] font-sec">Меня зовут Дарья, я SMM-менеджер и мобильный видеограф из Краснодара.</p>
                        <p class="my-[14px]">
                            Моя задача - сделать ваш бренд заметным и привлекательным в социальных сетях с помощью качественного видеоконтента и ведения страниц.
                            Я создаю короткометражные ролики, которые не только красиво выглядят, но и помогают продавать ваш продукт, донести его ценность до аудитории и повысить узнаваемость.
                        </p>
                        <p class="my-[14px]">
                            Видео - один из самых мощных инструментов современного маркетинга. Именно поэтому я предлагаю самые разнообразные форматы.
                        </p>
                        <p class="my-[14px]">
                            Вместе мы разработаем визуальную концепцию, наполним вашу страницу
                            оригинальным и качественным контентом, а также привлечём именно тех клиентов, которые действительно заинтересованы в вашем продукте.
                        </p>
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
