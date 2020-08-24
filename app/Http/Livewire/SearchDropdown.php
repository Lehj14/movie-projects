<?php
//NOTE: php artisan make:livewire SearchDropdown
namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    /**
     * Render search dropdown using livewire.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        $searchResult = [];

        if (strlen($this->search) > 2) {
            $searchResult = Http::withToken(config('services.tmdb.token'))
                ->get(config('services.tmdb.URL') . '/search/movie?query=' . $this->search)
                ->json()['results'];
        }

        $limitResult = collect($searchResult)->take(7);

        return view('livewire.search-dropdown', compact('limitResult'));
    }
}
