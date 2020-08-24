<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlayingMovies;
    public $genres;

    /**
     * MoviesViewModel constructor.
     *
     * @param $popularMovies
     * @param $nowPlayingMovies
     * @param $genres
     */
    public function __construct($popularMovies, $nowPlayingMovies, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres = $genres;
    }

    /**
     * Return popular movies.
     *
     * @return Collection
     */
    public function popularMovies(): Collection
    {
        return $this->formatMovies($this->popularMovies);
    }

    /**
     * Return now playing.
     *
     * @return Collection
     */
    public function nowPlayingMovies(): Collection
    {
        return $this->formatMovies($this->nowPlayingMovies);
    }

    /**
     * Return genres.
     *
     * @return Collection
     */
    public function genres(): Collection
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    /**
     * Format movies result.
     *
     * @param $movies
     *
     * @return Collection
     */
    private function formatMovies($movies): Collection
    {
        return collect($movies)->map(function($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => $this->returnImageUrl() . $movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 .'%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path',
                'id',
                'genre_ids',
                'title',
                'vote_average',
                'overview',
                'release_date',
                'genres',
            ]);
        });
    }

    /**
     * TODO:: need to refactor this as its also use on the other view models
     * Return url from env variables.
     *
     * @return Repository|Application|mixed
     */
    private function returnImageUrl()
    {
        return config('services.tmdb.imageUrl');
    }
}
