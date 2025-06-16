@extends('layouts.app')

@section('content')
    <div class="container">

        @if($editMode)
            <a class="hover:text-red text-xxs italic text-gray-500/80" href="{{ route('admin.price.index') }}">Редактировать</a>
        @endif

        <div class="grid xs:grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mb-20">
            @foreach($prices as $price)
                <div>
                    <p class="text-xl text-brown mb-4 font-bold">{{ $price->title }}</p>

                    {!! $price->description !!}
                </div>
            @endforeach
        </div>

        <div class="grid justify-center mb-20">
            <div class="max-w-[550px]">
                <x-edit-text
                    :text="$bottomText"
                    :code="\Support\Enums\TextsEnum::PRICES_BOTTOM_TEXT->value"
                >
                </x-edit-text>
            </div>
        </div>

    </div>
@endsection
