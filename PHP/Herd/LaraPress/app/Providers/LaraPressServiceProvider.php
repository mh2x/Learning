<?php

namespace App\Providers;

use App\Core\LangManager;
use App\Core\SettingsManager;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class LaraPressServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //dd($this->app['path.base']);
        //Register the settings manager
        $this->app->singleton(SettingsManager::class, function () {
            return new SettingsManager(
                $this->app['path.base']
            );
        });

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
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}