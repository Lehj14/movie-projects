<?php

namespace App\ViewModels;

use App\Helper\Helper;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    /**
     * @var array
     */
    public array $tvshow;

    /**
     * @var string
     */
    private string $imageUrl;


    public function __construct(array $tvshow)
    {
        $this->tvshow   = $tvshow;
        $this->imageUrl = Helper::getImageUrl();
    }

    /**
     * Return movie data.
     *
     * @return Collection
     */
    public function tvshow(): Collection
    {
        return collect($this->tvshow)->merge([
            'poster_path' => $this->imageUrl . 'w500' . $this->tvshow['poster_path'],
            'vote_average' => $this->tvshow['vote_average'] * 10 .'%',
            'first_air_date' => Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->tvshow['credits']['crew'])->take(5),
            'cast' => collect($this->tvshow['credits']['cast'])->take(15),
            'images' => collect($this->tvshow['images']['backdrops'])->take(9),
        ])->only([
            'poster_path',
            'id',
            'genres',
            'name',
            'vote_average',
            'overview',
            'first_air_date',
            'credits',
            'videos',
            'images',
            'crew',
            'cast',
            'created_by'
        ]);
    }
}
