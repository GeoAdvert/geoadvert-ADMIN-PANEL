<?php

namespace App\Providers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //force redirect to HTTPS

            // \URL::forceScheme('https');

        // Paginator::useBootstrap();
    }
}
