@extends('layouts.app')

@section('content')

    <div class="container">
        @if($editMode)
            <a class="hover:text-red text-xxs italic text-gray-500/80" href="{{ route('filament.admin.resources.portfolios.create') }}">Редактировать</a>
        @endif

        <p class="text-brown uppercase text-center mb-8 font-bold text-md">мобильная съемка:</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-20 mb-16 lightgalery-container">
            @foreach($portfolios as $portfolio)
                <x-front.galery-item
                    :type="$portfolio->getVideoSlideType()"
                    :item="$portfolio"
                    resolution="500x825"
                >
                </x-front.galery-item>
            @endforeach
        </div>
    </div>

@endsection
