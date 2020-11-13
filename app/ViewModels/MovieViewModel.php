<?php

namespace App\ViewModels;

use App\Helper\Helper;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    /**
     * @var array
     */
    public array $movie;

    /**
     * @var string
     */
    private string $imageUrl;

    /**
     * MovieViewModel constructor.
     *
     * @param $movie
     */
    public function __construct(array $movie)
    {
        $this->movie    = $movie;
        $this->imageUrl = Helper::getImageUrl();
    }

    /**
     * Return movie data.
     *
     * @return Collection
     */
    public function movie(): Collection
    {
        return collect($this->movie)->merge([
            'poster_path' => $this->movie['poster_path'] ? $this->imageUrl . 'w500'. $this->movie['poster_path'] :
                'https://ui-avatars.com/api/?size=w500&name='. $this->movie['poster_path'],
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
}
