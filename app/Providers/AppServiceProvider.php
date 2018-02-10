<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
          \App\Repositories\ArtistRepositoryInterface::class,
          \App\Repositories\ArtistRepository::class,
          \App\Repositories\UserRepositoryInterface::class,
          \App\Repositories\UserRepository::class
        );
    }
}
