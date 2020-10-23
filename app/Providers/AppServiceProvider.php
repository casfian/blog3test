<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Add this if you want to use Bootstrap 4 Pagination
// Instead of Tailwind
use Illuminate\Pagination\Paginator;
// ====

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
        // add this if you want Bootstrap pagination
        Paginator::useBootStrap();

    }
}
