<?php

namespace App\Helper;

class Helper
{
    /**
     * @return string
     */
    public static function getImageUrl(): string
    {
        return config('services.tmdb.imageUrl');
    }

    /**
     * @return string
     */
    public static function getUrl(): string
    {
        return config('services.tmdb.URL');
    }

    /**
     * @return string
     */
    public static function getToken(): string
    {
        return config('services.tmdb.token');
    }

    /**
     * @return string
     */
    public static function getGenreUrl(): string
    {
        return config('services.tmdb.genreUrL');
    }

    /**
     * @return string
     */
    public static function getTvGenreUrl(): string
    {
        return config('services.tmdb.tvgenreUrl');
    }
}
