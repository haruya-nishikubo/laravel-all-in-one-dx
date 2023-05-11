<?php

namespace HaruyaNishikubo\AllInOneDx;

use HaruyaNishikubo\AllInOneDx\Console\Commands\InstallCommand;
use HaruyaNishikubo\AllInOneDx\Console\Commands\ScaffoldCommand;
use Illuminate\Support\ServiceProvider;

class AllInOneDxServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            InstallCommand::class,
            ScaffoldCommand::class,
        ]);
    }
}
