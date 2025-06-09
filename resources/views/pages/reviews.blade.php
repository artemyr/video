@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="grid xs:grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 xl:gap-20 mb-16">

            @foreach($reviews as $review)
                <div class="text-center text-brown">
                    <img class="rounded-full pb-4" src="{{ $review->makeThumbnail('500x500') }}" alt="{{ $review->title }}">

                    <p class="text-xl mb-4 font-bold">{{ $review->title }}</p>

                    {!! $review->description !!}
                </div>
            @endforeach
        </div>
    </div>
@endsection
