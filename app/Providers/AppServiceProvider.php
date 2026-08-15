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
        \Gate::define('view-dashboard', [DashboardPolicy::class, 'viewAny']);
        \Gate::define('view-dashboard-limited', [DashboardPolicy::class, 'viewAnyLimited']);
    }
}
