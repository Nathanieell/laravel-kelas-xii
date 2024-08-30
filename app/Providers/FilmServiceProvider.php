<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\FilmRepositoryInterfaces;
use App\Repositories\FilmRepository;

class FilmServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FilmRepositoryInterfaces::class, FilmRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}