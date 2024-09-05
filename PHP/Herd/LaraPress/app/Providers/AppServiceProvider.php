<?php

namespace App\Providers;

use App\Core\LangManager;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Register the language manager
        $this->app->singleton(LangManager::class, function () {
            return new LangManager(
                new Filesystem,
                $this->app['path.lang'],
                [$this->app['path.resources'], $this->app['path']]
            );
        });

        //To get an instance...
        //  $langManager = app(LangManager::class);
        //OR
        //  $langManager = resolve(LangManager::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}