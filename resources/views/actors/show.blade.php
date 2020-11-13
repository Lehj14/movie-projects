@extends('layouts.main')
@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{ $actor['profile_path'] }}" alt="poster" class="w-76">

                <ul class="flex items-center mt-4">
                    @if ($social['facebook'])
                        <li>
                            <a href="{{ $social['facebook'] }}" title="facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-gray-400 hover:text-white w-6" width="24" height="24" viewBox="0 0 24 24" fill="#ffffff"><path d="M24 12.07C24 5.41 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.04V9.41c0-3.02 1.8-4.7 4.54-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.5c-1.5 0-1.96.93-1.96 1.89v2.26h3.32l-.53 3.5h-2.8V24C19.62 23.1 24 18.1 24 12.07"/></svg>
                            </a>
                        </li>
                    @endif
                    @if ($social['instagram'])
                        <li class="ml-6">
                            <a href="{{ $social['instagram'] }}" title="instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-gray-400 hover:text-white w-6" width="24" height="24" viewBox="0 0 24 24" fill="#ffffff"><path d="M16.98 0a6.9 6.9 0 0 1 5.08 1.98A6.94 6.94 0 0 1 24 7.02v9.96c0 2.08-.68 3.87-1.98 5.13A7.14 7.14 0 0 1 16.94 24H7.06a7.06 7.06 0 0 1-5.03-1.89A6.96 6.96 0 0 1 0 16.94V7.02C0 2.8 2.8 0 7.02 0h9.96zm.05 2.23H7.06c-1.45 0-2.7.43-3.53 1.25a4.82 4.82 0 0 0-1.3 3.54v9.92c0 1.5.43 2.7 1.3 3.58a5 5 0 0 0 3.53 1.25h9.88a5 5 0 0 0 3.53-1.25 4.73 4.73 0 0 0 1.4-3.54V7.02a5 5 0 0 0-1.3-3.49 4.82 4.82 0 0 0-3.54-1.3zM12 5.76c3.39 0 6.2 2.8 6.2 6.2a6.2 6.2 0 0 1-12.4 0 6.2 6.2 0 0 1 6.2-6.2zm0 2.22a3.99 3.99 0 0 0-3.97 3.97A3.99 3.99 0 0 0 12 15.92a3.99 3.99 0 0 0 3.97-3.97A3.99 3.99 0 0 0 12 7.98zm6.44-3.77a1.4 1.4 0 1 1 0 2.8 1.4 1.4 0 0 1 0-2.8z"/></svg>                            </a>
                        </li>
                    @endif
                    @if ($social['twitter'])
                        <li class="ml-6">
                            <a href="{{ $social['twitter'] }}" title="twitter">
                                <svg xmlns="http://www.w3.org/2000/svg"  class="fill-current text-gray-400 hover:text-white w-6" width="24" height="24" viewBox="0 0 24 24" fill="#ffffff"><path d="M24 4.37a9.6 9.6 0 0 1-2.83.8 5.04 5.04 0 0 0 2.17-2.8c-.95.58-2 1-3.13 1.22A4.86 4.86 0 0 0 16.61 2a4.99 4.99 0 0 0-4.79 6.2A13.87 13.87 0 0 1 1.67 2.92 5.12 5.12 0 0 0 3.2 9.67a4.82 4.82 0 0 1-2.23-.64v.07c0 2.44 1.7 4.48 3.95 4.95a4.84 4.84 0 0 1-2.22.08c.63 2.01 2.45 3.47 4.6 3.51A9.72 9.72 0 0 1 0 19.74 13.68 13.68 0 0 0 7.55 22c9.06 0 14-7.7 14-14.37v-.65c.96-.71 1.79-1.6 2.45-2.61z"/></svg>                            </a>
                        </li>
                    @endif
                    @if ($actor['homepage'])
                        <li class="ml-6">
                            <a href="{{ $actor['homepage'] }}" title="homepage">
                                <svg class="fill-current text-gray-400 hover:text-white w-6" viewBox="0 0 496 512"><path d="M248 8C111.03 8 0 119.03 0 256s111.03 248 248 248 248-111.03 248-248S384.97 8 248 8zm82.29 357.6c-3.9 3.88-7.99 7.95-11.31 11.28-2.99 3-5.1 6.7-6.17 10.71-1.51 5.66-2.73 11.38-4.77 16.87l-17.39 46.85c-13.76 3-28 4.69-42.65 4.69v-27.38c1.69-12.62-7.64-36.26-22.63-51.25-6-6-9.37-14.14-9.37-22.63v-32.01c0-11.64-6.27-22.34-16.46-27.97-14.37-7.95-34.81-19.06-48.81-26.11-11.48-5.78-22.1-13.14-31.65-21.75l-.8-.72a114.792 114.792 0 01-18.06-20.74c-9.38-13.77-24.66-36.42-34.59-51.14 20.47-45.5 57.36-82.04 103.2-101.89l24.01 12.01C203.48 89.74 216 82.01 216 70.11v-11.3c7.99-1.29 16.12-2.11 24.39-2.42l28.3 28.3c6.25 6.25 6.25 16.38 0 22.63L264 112l-10.34 10.34c-3.12 3.12-3.12 8.19 0 11.31l4.69 4.69c3.12 3.12 3.12 8.19 0 11.31l-8 8a8.008 8.008 0 01-5.66 2.34h-8.99c-2.08 0-4.08.81-5.58 2.27l-9.92 9.65a8.008 8.008 0 00-1.58 9.31l15.59 31.19c2.66 5.32-1.21 11.58-7.15 11.58h-5.64c-1.93 0-3.79-.7-5.24-1.96l-9.28-8.06a16.017 16.017 0 00-15.55-3.1l-31.17 10.39a11.95 11.95 0 00-8.17 11.34c0 4.53 2.56 8.66 6.61 10.69l11.08 5.54c9.41 4.71 19.79 7.16 30.31 7.16s22.59 27.29 32 32h66.75c8.49 0 16.62 3.37 22.63 9.37l13.69 13.69a30.503 30.503 0 018.93 21.57 46.536 46.536 0 01-13.72 32.98zM417 274.25c-5.79-1.45-10.84-5-14.15-9.97l-17.98-26.97a23.97 23.97 0 010-26.62l19.59-29.38c2.32-3.47 5.5-6.29 9.24-8.15l12.98-6.49C440.2 193.59 448 223.87 448 256c0 8.67-.74 17.16-1.82 25.54L417 274.25z"/></svg>
                            </a>
                        </li>
                    @endif
                </ul>

                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-5">
                    <span>
                        <svg class="fill-current text-gray-400 w-4" viewBox="0 0 448 512"><path d="M448 384c-28.02 0-31.26-32-74.5-32-43.43 0-46.825 32-74.75 32-27.695 0-31.454-32-74.75-32-42.842 0-47.218 32-74.5 32-28.148 0-31.202-32-74.75-32-43.547 0-46.653 32-74.75 32v-80c0-26.5 21.5-48 48-48h16V112h64v144h64V112h64v144h64V112h64v144h16c26.5 0 48 21.5 48 48v80zm0 128H0v-96c43.356 0 46.767-32 74.75-32 27.951 0 31.253 32 74.75 32 42.843 0 47.217-32 74.5-32 28.148 0 31.201 32 74.75 32 43.357 0 46.767-32 74.75-32 27.488 0 31.252 32 74.5 32v96zM96 96c-17.75 0-32-14.25-32-32 0-31 32-23 32-64 12 0 32 29.5 32 56s-14.25 40-32 40zm128 0c-17.75 0-32-14.25-32-32 0-31 32-23 32-64 12 0 32 29.5 32 56s-14.25 40-32 40zm128 0c-17.75 0-32-14.25-32-32 0-31 32-23 32-64 12 0 32 29.5 32 56s-14.25 40-32 40z"/></svg>
                    </span>
                    <span class="ml-2"><b>Birthdate:</b><br>{{ $actor['birthday'] }} ({{ $actor['age'] }} years old)</span>
                </div>

                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-5">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/><circle cx="12" cy="10" r="3"/></svg>
                    </span>
                    <span class="ml-2"><b>Place of birth:</b><br>{{ $actor['place_of_birth'] }}</span>
                </div>

                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-5">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3"/><circle cx="12" cy="10" r="3"/><circle cx="12" cy="12" r="10"/></svg>
                    </span>
                    <span class="ml-2"><b>Known for:</b><br>{{ $actor['known_for_department'] }}</span>
                </div>

                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-5">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>       </span>
                    <span class="ml-2"><b>Popularity:</b><br>{{ $actor['popularity'] }}</span>
                </div>

            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $actor['name'] }}</h2>

                <h4 class="font-semibold mt-6">Biography</h4>
                <p class="text-gray-300 mt-5 biography overflow-hidden text-justify">{{ $actor['biography'] }}</p>

                <h4 class="font-semibold mt-12">Known For</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
                    @foreach($knownFor as $knownMovies)
                        <div class="mt-4">
                            <a href="{{ $knownMovies['linkToPage'] }}">
                                <img src="{{ $knownMovies['poster_path'] }}" alt="poster" class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>

                            <a href="{{ route('movies.show', $knownMovies['id']) }}" class="text-sm leading-normal block text-gray-400 hover:text-white mt-1">
                                {{ $knownMovies['title'] }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="credits border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl">Acting</h2>
            <ul class="list-disc leading-loose pl-5 mt-8">
                @foreach($credits as $credit)
                    <li>
                        {{ $credit['release_year'] }} &middot; <a href="{{ route('movies.show', $credit['id']) }}"><strong>{{ $credit['title'] }}</strong></a>
                        as {{ $credit['character'] }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/readmore-js@2.2.1/readmore.min.js"></script>
    <script>
        $('.biography').readmore({
            speed: 300,
            collapsedHeight: 300,
            moreLink: '<a href="#">Read more &gt;</a>',
            lessLink: '<a href="#">Read less &gt;</a>',
            heightMargin: 16
        });
    </script>
@endsection
