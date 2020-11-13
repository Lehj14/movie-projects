@extends('layouts.main')
@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-tv">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($popularTv as $tvshow)
                   {{-- you can use component if you got repetative blade--}}
                    <x-tv-card :tvshow="$tvshow" :genres="$genres"></x-tv-card>
                @endforeach
            </div>
        </div>

        <div class="popular-movies mt-32">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Rated Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($topRatedTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow" :genres="$genres"></x-tv-card>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-6"></div>
@endsection
