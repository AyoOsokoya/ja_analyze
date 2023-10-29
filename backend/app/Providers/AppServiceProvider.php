<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Sanctum::ignoreMigrations(); // Prevent Sanctum from auto-including personal access token migrations
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
