<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class MoviesController extends Controller
{
    private const POPULAR_MOVIES = '/movie/popular';
    private const NOW_PLAYING = '/movie/now_playing';

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.URL') . self::POPULAR_MOVIES)
            ->json()['results'];

        $genres = $this->genreMovieList();
        $nowPlaying = $this->nowPlaying();

        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlaying,
            $genres
        );

        return view('movies.index', $viewModel);
    }

    public function nowPlaying()
    {
        return Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.URL') . self::NOW_PLAYING)
            ->json()['results'];
    }

    public function genreMovieList()
    {
        return Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.genreUrL'))
            ->json()['genres'];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.URL') . '/movie/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        $viewModel = new MovieViewModel(
            $movie
        );

        return view('movies.show', $viewModel);
    }
}
