<?php

namespace App\ViewModels;

use App\Helper\Helper;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    /**
     * @var array
     */
    private array $actors;

    /**
     * @var string
     */
    private string $url;

    /**
     * ActorsViewModel constructor.
     *
     * @param array $actors
     */
    public function __construct(array $actors)
    {
        $this->actors = $actors;
        $this->url    = Helper::getImageUrl();
    }

    /**
     * @return Collection
     */
    public function actors(): Collection
    {
        return collect($this->actors)->map(function($actor) {
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path']
                    ? $this->url . 'w235_and_h235_face' . $actor['profile_path']
                    : 'https://ui-avatars.com/api/?size=235&name='. $actor['name'],
                'known_for' => collect($actor['known_for'])
                    ->where('media_type', 'movie')
                    ->pluck('title')
                    ->union(collect($actor['known_for'])
                        ->where('media_type', 'tv')
                        ->pluck('name')
                    )->implode(', ')
            ])->only([
                'profile_path',
                'name',
                'id',
                'known_for',
            ]);
        });
    }
}
