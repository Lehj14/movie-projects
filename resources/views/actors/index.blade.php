@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="popular-movies">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular People</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach($actors as $actor)
               <div class="actor mt-8">
                   <a href="#">
                       <img src="{{ $actor['profile_path'] }}" alt="profile image" class="hover:opacity-75 transition ease-in-out duration-150">
                   </a>
                   <div class="mt-2">
                       <a href="#" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                       <div class="text-sm text-gray-400">{{ $actor['known_for'] }}</div>
                   </div>
               </div>
            @endforeach
        </div>
    </div>

    <div class=""

</div>
<div class="mt-6"></div>
@endsection
