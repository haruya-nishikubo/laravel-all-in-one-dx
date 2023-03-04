<?php

namespace Hrynskb\AllInOneDx;

use Hrynskb\AllInOneDx\Console\InstallCommand;
use Hrynskb\AllInOneDx\Console\ScaffoldCommand;
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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            InstallCommand::class,
            ScaffoldCommand::class,
        ]);
    }
}
