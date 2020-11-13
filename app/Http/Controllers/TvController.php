<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class TvController extends Controller
{
    private const POPULAR_TV = '/tv/popular';
    private const TOP_RATED_TV = '/tv/top_rated';

    /**
     * @var string
     */
    private string $url;

    /**
     * @var string
     */
    private string $token;

    /**
     * @var string
     */
    private string $tvGenreUrl;

    /**
     * TvController constructor.
     */
    public function __construct()
    {
        $this->url        = Helper::getUrl();
        $this->token      = Helper::getToken();
        $this->tvGenreUrl = Helper::getTvGenreUrl();
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $popularTv = Http::withToken($this->token)
            ->get($this->url . self::POPULAR_TV)
            ->json()['results'];

        $genres = $this->genreTvList();
        $topRatedTv = $this->topRatedTv();

        $viewModel = new TvViewModel(
            $popularTv,
            $topRatedTv,
            $genres
        );

        return view('tv.index', $viewModel);
    }

    /**
     * Get all now playing from the endpoint.
     *
     * @return array
     */
    public function topRatedTv(): array
    {
        return Http::withToken($this->token)
            ->get($this->url . self::TOP_RATED_TV)
            ->json()['results'];
    }

    /**
     * Get all genres.
     *
     * @return array
     */
    public function genreTvList(): array
    {
        return Http::withToken($this->token)
            ->get($this->tvGenreUrl)
            ->json()['genres'];
    }

    /**
     * @param $id
     *
     * @return View
     */
    public function show(int $id): View
    {
        $tvshow = Http::withToken($this->token)
            ->get($this->url . '/tv/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        $viewModel = new TvShowViewModel($tvshow);

        return view('tv.show', $viewModel);
    }
}
