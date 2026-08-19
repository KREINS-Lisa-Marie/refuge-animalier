<?php

namespace App\Providers;

use App\Policies\DashboardPolicy;
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
        // Source - https://stackoverflow.com/a/68499999
        \URL::forceScheme('https');

        \Gate::define('view-dashboard', [DashboardPolicy::class, 'viewAny']);
        \Gate::define('view-dashboard-limited', [DashboardPolicy::class, 'viewAnyLimited']);
    }
}
