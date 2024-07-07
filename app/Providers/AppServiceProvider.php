<?php

namespace App\Providers;

use App\Http\Services\CarService;
use App\Http\Services\HomeService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CarService::class);
        $this->app->singleton(HomeService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('components.paginator');
        Vite::useScriptTagAttributes([
            'async' => true, // Specify an attribute without a value...
            'defer' => 'defer'
        ]);
    }
}
