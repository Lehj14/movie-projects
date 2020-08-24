<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    private $actors;

    public function __construct($actors)
    {
        $this->actors = $actors;
    }

    public function actors()
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

    private function returnImageUrl()
    {
        return config('services.tmdb.actorImageUrl');
    }
}
