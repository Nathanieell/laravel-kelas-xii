<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\{
    FilmRepositoryInterface,
};
use App\Repositories\FilmReposiotry;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FilmRepositoryInterface::class, FilmReposiotry::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
