@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-16">
    <div class="popular-movies">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular movies</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach($popularMovies as $popularMovie)
                {{--you can use component if you got repetative blade--}}
                <x-movie-card :popularMovie="$popularMovie" :genres="$genres"></x-movie-card>
            @endforeach
        </div>
    </div>

    {{--Popular movies secttion--}}
    <div class="popular-movies mt-32">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Now Playing</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach($nowPlayingMovies  as $nowPlaying)
                <x-movie-card :popularMovie="$nowPlaying"></x-movie-card>
            @endforeach
        </div>
    </div>
</div>

<div class="mt-6"></div>
@endsection
