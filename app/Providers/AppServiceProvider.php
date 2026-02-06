<?php

namespace App\Providers;

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
        \App\Models\Post::observe(\App\Observers\PostObserver::class);
        \App\Models\Infografis::observe(\App\Observers\InfografisObserver::class);
        \App\Models\Pengaturan::observe(\App\Observers\PengaturanObserver::class);
    }
}
