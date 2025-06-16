@extends('layouts.app')

@section('content')

    <div class="container">
        @if($editMode)
            <a class="hover:text-red text-xxs italic text-gray-500/80" href="{{ route('admin.portfolio.index') }}">Редактировать</a>
        @endif

        <p class="text-brown uppercase text-center mb-8 font-bold text-md">мобильная съемка:</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-20 mb-16 lightgalery-container">
            @foreach($portfolios as $portfolio)
                <div class="lightgalery">
                    <a
                        data-lg-size="{{ $portfolio->size }}"
                        data-video='{"source": [{"src":"{{ $portfolio->video() }}", "type":"video/mp4"}], "attributes": {"preload": false, "playsinline": true, "controls": true}}'
                        data-poster="{{ $portfolio->makeThumbnail('500x825') }}"
                        data-sub-html="<h4>{{ $portfolio->title }}</h4>"
                    >
                        <img
                            class="img-responsive"
                            src="{{ $portfolio->makeThumbnail('500x825') }}"
                            alt="{{ $portfolio->title }}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
