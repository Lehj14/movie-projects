<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class MovieCard extends Component
{
    /**
     * @var Collection
     */
    public Collection $popularMovie;

    /**
     * Create a new component instance.
     *
     * @param $popularMovie
     */
    public function __construct(Collection $popularMovie)
    {
        $this->popularMovie = $popularMovie;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.movie-card');
    }
}
