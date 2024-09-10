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
        //Register the language manager
        $this->app->singleton(LangManager::class, function ($app) {
            return new LangManager(
                new Filesystem,
                $app['path.lang'],
                [$app['path.resources'], $app['path']]
            );
        });

        //To get an instance...
        //  $langManager = app(LangManager::class);
        //OR
        //  $langManager = resolve(LangManager::class);

        //DebugBar messages
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}