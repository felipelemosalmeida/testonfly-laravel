<?php

namespace App\Providers;

use App\Models\Expenses;
use App\Observers\ExpensesObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Expenses::observe(ExpensesObserver::class);
        Schema::defaultStringLength(191);
    }
}
