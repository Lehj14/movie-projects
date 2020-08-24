<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;

    /**
     * MovieViewModel constructor.
     *
     * @param $movie
     */
    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    /**
     * Return movie data.
     *
     * @return Collection
     */
    public function movie(): Collection
    {
        return collect($this->movie)->merge([
            'poster_path' => $this->returnImageUrl() . $this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average'] * 10 .'%',
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(5),
            'cast' => collect($this->movie['credits']['cast'])->take(15),
            'images' => collect($this->movie['images']['backdrops'])->take(9),

        ])->only([
            'poster_path',
            'id',
            'genres',
            'title',
            'vote_average',
            'overview',
            'release_date',
            'credits',
            'videos',
            'images',
            'crew',
            'cast',
        ]);
    }

    //TODO:need to put this on a helper or another class so the MoviesViewModel can also access it and
    //avoid duplication
    private function returnImageUrl()
    {
        return config('services.tmdb.imageUrl');
    }
}
