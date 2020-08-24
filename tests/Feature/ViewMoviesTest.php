<?php

namespace Tests\Feature;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_main_page_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenre()
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
    }

    public function the_search_dropdown_works_correctly()
    {
        Http::fake([
            'https://api.themoviedb.org/3/search/movie?query=jumanji' => $this->fakeSearchMovies(),
        ]);

        Livewire::test('search-dropdown')
            ->assertDontSee('jumanji')
            ->set('search', 'jumanji')
            ->assertSee('Jumanji');
    }

    private function fakePopularMovies(): PromiseInterface
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 133.64,
                    "vote_count" => 334,
                    "video" => false,
                    "poster_path"=> "/b5XfICAvUe8beWExBz97i0Qw4Qh.jpg",
                    "id"=> 612706,
                    "adult"=> false,
                    "backdrop_path"=> "/ishzDCZIv9iWfI70nv5E4ZreYUD.jpg",
                    "original_language"=> "en",
                    "original_title"=> "Work It",
                    "genre_ids"=> [
                        35,
                        10402
                    ],
                    "title"=> "Work It",
                    "vote_average"=> 8,
                    "overview"=> "A brilliant but clumsy high school senior vows to get into her late father's alma mater by transforming herself and a misfit squad into dance champions.",
                    "release_date" => "2020-08-07"
                ]
            ]
        ], 200);
    }

    private function fakeNowPlayingMovies()
    {
        return Http::response([
            'results' => [
                [
                    "popularity"=> 114.229,
                    "vote_count"=> 75,
                    "video"=> false,
                    "poster_path"=> "/5MSDwUcqnGodFTvtlLiLKK0XKS.jpg",
                    "id"=> 521034,
                    "adult"=> false,
                    "backdrop_path"=> "/8PK4X8U3C79ilzIjNTkTgjmc4js.jpg",
                    "original_language"=> "en",
                    "original_title"=> "The Secret Garden",
                    "genre_ids"=> [
                        18,
                        14,
                        10751
                    ],
                    "title"=> "The Secret Garden",
                    "vote_average"=> 7.5,
                    "overview"=> "Mary Lennox is born in India to wealthy British parents who never wanted her. When her parents suddenly die, she is sent back to England to live with her uncle. She meets her sickly cousin, and the two children find a wondrous secret garden lost in the grounds of Misselthwaite Manor.",
                    "release_date" => "2020-08-07",
                ]
            ]
        ], 200);
    }

    private function fakeGenre()
    {
        return Http::response([
            'genres' => [
                [
                    "id"=> 28,
                    "name" => "Action"
                ]
            ]
        ], 200);
    }

    private function fakeSearchMovies()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 406.677,
                    "vote_count" => 2607,
                    "video" => false,
                    "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                    "id" => 419704,
                    "adult" => false,
                    "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                    "original_language" => "en",
                    "original_title" => "Jumanji",
                    "genre_ids" => [
                        12,
                        18,
                        9648,
                        878,
                        53,
                    ],
                    "title" => "Jumanji",
                    "vote_average" => 6,
                    "overview" => "Jumanji description. The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet earth.",
                    "release_date" => "2019-09-17",
                ]
            ]
        ], 200);
    }
}
