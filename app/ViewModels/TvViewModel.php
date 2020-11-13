<?php

namespace App\ViewModels;

use App\Helper\Helper;
use Carbon\Carbon;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    /**
     * @var array
     */
    public array $popularTv;

    /**
     * @var array
     */
    public array $topRatedTv;

    /**
     * @var array
     */
    public array $genres;

    /**
     * @var string
     */
    private string $imageUrl;

    public function __construct(array $popularTv, array $topRatedTv, array $genres)
    {
        $this->popularTv  = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres     = $genres;
        $this->imageUrl   = Helper::getImageUrl();
    }

    /**
     * @return Collection
     */
    public function popularTv(): Collection
    {
        return $this->formatTv($this->popularTv);
    }

    /**
     * @return Collection
     */
    public function topRatedTv(): Collection
    {
        return $this->formatTv($this->topRatedTv);
    }

    /**
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
     * @param array $tv
     *
     * @return Collection
     */
    private function formatTv(array $tv): Collection
    {
        return collect($tv)->map(function($tvshow) {

            $formattedGenres = collect($tvshow['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvshow)->merge([
                'poster_path' => $this->imageUrl . 'w500' . $tvshow['poster_path'],
                'vote_average' => $tvshow['vote_average'] * 10 .'%',
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genres' => $formattedGenres,
            ])->only([
                'poster_path',
                'id',
                'genre_ids',
                'name',
                'vote_average',
                'overview',
                'first_air_date',
                'genres',
            ]);
        });
    }
}
