<?php

namespace App\ViewModels;

use App\Helper\Helper;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    /**
     * @var array
     */
    public array $popularMovies;

    /**
     * @var array
     */
    public array $nowPlayingMovies;

    /**
     * @var array
     */
    public array $genres;

    /**
     * @var string
     */
    private string $imageUrl;

    /**
     * MoviesViewModel constructor.
     *
     * @param array $popularMovies
     * @param array $nowPlayingMovies
     * @param array $genres
     */
    public function __construct(array $popularMovies, array $nowPlayingMovies, array $genres)
    {
        $this->popularMovies    = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres           = $genres;
        $this->imageUrl         = Helper::getImageUrl();
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
                'poster_path' => $this->imageUrl . 'w500' . $movie['poster_path'],
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
}
