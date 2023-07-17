<?php

namespace App\Providers;

use App\Repositories\Contracts\ExpensesRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\ExpensesRepository;
use App\Repositories\UserRepository;
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
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            ExpensesRepositoryInterface::class,
            ExpensesRepository::class
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
