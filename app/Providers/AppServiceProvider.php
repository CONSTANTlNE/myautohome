<?php

namespace App\Providers;

use App\Models\Application;
use App\Observers\ApplicationObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//         Application::observe(ApplicationObserver::class);
//        Model::preventLazyLoading(!app()->isProduction());
    }
}
