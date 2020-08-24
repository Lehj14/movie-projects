<?php
//NOTE: php artisan make:livewire SearchDropdown
namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

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
