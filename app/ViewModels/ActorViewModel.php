<?php

namespace App\ViewModels;

use App\Helper\Helper;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    /**
     * @var array
     */
    private array $actor;

    /**
     * @var array
     */
    private array $social;

    /**
     * @var array
     */
    private array $credits;

    /**
     * @var string
     */
    private string $url;

    /**
     * ActorViewModel constructor.
     *
     * @param array $actor
     * @param array $social
     * @param array $credits
     */
    public function __construct(array $actor, array $social, array $credits)
    {
        $this->actor   = $actor;
        $this->social  = $social;
        $this->credits = $credits;
        $this->url     = Helper::getImageUrl();
    }

    /**
     * @return Collection
     */
    public function actor(): Collection
    {
        return collect($this->actor)->merge([
            'birthday' => Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->actor['birthday'])->age,
            'profile_path' => $this->actor['profile_path']
                ? $this->url . 'w300/' . $this->actor['profile_path']
                : 'https://via.placeholder.com/300x450',
        ]);
    }

    /**
     * @return Collection
     */
    public function social(): Collection
    {
        return collect($this->social)->merge([
            'twitter' => $this->social['twitter_id'] ? 'https://twitter.com/' . $this->social['twitter_id'] : null,
            'facebook' => $this->social['facebook_id'] ? 'https://facebook.com/' . $this->social['facebook_id'] : null,
            'instagram' => $this->social['instagram_id'] ? 'https://instagram.com/' . $this->social['instagram_id'] : null,
        ]);
    }

    /**
     * @return Collection
     */
    public function knownFor(): Collection
    {
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)->sortByDesc('popularity')->take(10)->map(function($movie) {

            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = 'Untitled';
            }

            return collect($movie)->merge([
                'poster_path' => $movie['poster_path'] ?
                     $this->url . 'w185' . $movie['poster_path'] :
                    'https://via.placeholder.com/185x278',
                'title' => $title,
                'linkToPage' => $movie['media_type'] === 'movie'
                    ? route('movies.show', $movie['id'])
                    : route('tv.show', $movie['id'])
            ])->only([
                'poster_path',
                'title',
                'id',
                'media_type',
                'linkToPage'
            ]);
        });
    }

    /**
     * @return Collection
     */
    public function credits(): Collection
    {
        $casts = collect($this->credits)->get('cast');

        return collect($casts)
            ->map(function($movie){

                if (isset($movie['release_date'])) {
                    $releaseDate = $movie['release_date'];
                } elseif (isset($movie['first_air_date'])) {
                    $releaseDate = $movie['first_air_date'];
                } else {
                    $releaseDate = '';
                }

                if (isset($movie['title'])) {
                    $title = $movie['title'];
                } elseif (isset($movie['name'])) {
                    $title = $movie['name'];
                } else {
                    $title = 'Untitled';
                }

                return collect($movie)->merge([
                    'release_date' => $releaseDate,
                    'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                    'title' => $title,
                    'character' => $movie['character'] ?? '',
                ]);
            })->sortByDesc('release_date');
    }
}
