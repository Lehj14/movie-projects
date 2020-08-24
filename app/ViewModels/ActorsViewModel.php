<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    private $actors;

    /**
     * ActorsViewModel constructor.
     *
     * @param $actors
     */
    public function __construct($actors)
    {
        $this->actors = $actors;
    }

    /**
     * @return Collection
     */
    public function actors(): Collection
    {
        return collect($this->actors)->map(function($actor) {
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path'] ?
                    $this->returnImageUrl() . $actor['profile_path'] :
                    'https://ui-avatars.com/api/?size=235&name='. $actor['name'],
                'known_for' => collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                    collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')
                )->implode(', ')
            ])->only([
                'profile_path',
                'name',
                'id',
                'known_for',
            ]);
        })->dump();
    }

    /**
     * TODO:: need to refactor this as its also use on the other view models
     * Return url from env variables.
     *
     * @return Repository|Application|mixed
     */
    private function returnImageUrl()
    {
        return config('services.tmdb.actorImageUrl');
    }
}
