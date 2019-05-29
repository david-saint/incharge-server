<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Contracts\RequestRelationshipParserInterface::class,
            \App\Repositories\Concrete\RequestRelationshipParser::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\ClinicRepositoryInterface::class,
            \App\Repositories\Concrete\ClinicRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
