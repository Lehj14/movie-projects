<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class MoviesController extends Controller
{
    private const POPULAR_MOVIES = '/movie/popular';
    private const NOW_PLAYING = '/movie/now_playing';

    /**
     * @var string
     */
    private string $url;

    /**
     * @var string
     */
    private string $token;

    /**
     * @var string
     */
    private string $genreUrl;

    /**
     * MoviesController constructor.
     */
    public function __construct()
    {
        $this->url      = Helper::getUrl();
        $this->token    = Helper::getToken();
        $this->genreUrl = Helper::getGenreUrl();
    }

    /**
     * Display movie's index.
     *
     * @return View
     */
    public function index(): View
    {
        $popularMovies = Http::withToken($this->token)
            ->get($this->url . self::POPULAR_MOVIES)
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

    /**
     * Get all now playing from the endpoint.
     *
     * @return array
     */
    public function nowPlaying(): array
    {
        return Http::withToken($this->token)
            ->get($this->url . self::NOW_PLAYING)
            ->json()['results'];
    }

    /**
     * @return array
     */
    public function genreMovieList(): array
    {
        return Http::withToken($this->token)
            ->get($this->genreUrl)
            ->json()['genres'];
    }

    /**
     * Show movie details.
     *
     * @param int $id
     *
     * @return View
     */
    public function show(int $id): View
    {
        $movie = Http::withToken($this->token)
            ->get($this->url . '/movie/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        $viewModel = new MovieViewModel(
            $movie
        );

        return view('movies.show', $viewModel);
    }
}
