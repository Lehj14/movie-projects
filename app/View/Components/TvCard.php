<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class TvCard extends Component
{
    /**
     * @var Collection
     */
    public Collection $tvshow;

    /**
     * TvCard constructor.
     * @param Collection $tvshow
     */
    public function __construct(Collection $tvshow)
    {
        $this->tvshow = $tvshow;
    }

    /**
     * @return View|string
     */
    public function render()
    {
        return view('components.tv-card');
    }
}
