<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class MovieCard extends Component
{
    public $popularMovie;

    /**
     * Create a new component instance.
     *
     * @param $popularMovie
     * @param $genres
     */
    public function __construct($popularMovie)
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
