<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ActorsController extends Controller
{
    private const POPULAR_ACTOR = '/person/popular';
    private const ACTOR = '/person/';

    /**
     * @var string
     */
    private string $url;

    /**
     * @var string
     */
    private string $token;

    /**
     * ActorsController constructor.
     */
    public function __construct()
    {
        $this->url   = Helper::getUrl();
        $this->token = Helper::getToken();
    }

    /**
     * @param int $page
     *
     * @return Application|Factory|View
     */
    public function index(int $page = 1)
    {
        $actors = Http::withToken($this->token)
            ->get($this->url . self::POPULAR_ACTOR . '?page=' . $page)
            ->json()['results'];

        $viewModel = new ActorsViewModel($actors);

        return view('actors.index', $viewModel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return View
     */
    public function show(int $id): View
    {
        $actor = Http::withToken($this->token)
            ->get($this->url . self::ACTOR . $id)
            ->json();

        $social = Http::withToken($this->token)
            ->get($this->url . self::ACTOR . $id . '/external_ids')
            ->json();

        $credits = Http::withToken($this->token)
            ->get($this->url . self::ACTOR . $id . '/combined_credits')
            ->json();

        $viewModel = new ActorViewModel($actor, $social, $credits);

        return view('actors.show', $viewModel);
    }
}
