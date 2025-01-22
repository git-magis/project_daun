<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Pohon;
use App\Models\Bunga;
use App\Observers\BungaObserver;
use App\Observers\PohonObserver;

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
    public function boot()
    {
        Pohon::observe(PohonObserver::class);
        Bunga::observe(BungaObserver::class);
    }
}
