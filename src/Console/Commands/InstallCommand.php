<?php

namespace HaruyaNishikubo\AllInOneDx\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'all-in-one-dx:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install All-In-One-Dx Files.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->installApp()
            ->installDatabase()
            ->installLang()
            ->installResources()
            ->installRoutes()
            ->installTests()
            ->installTailwindConfig();

        return self::SUCCESS;
    }

    protected function installApp(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../../files/app',
            base_path('app')
        );

        return $this;
    }

    protected function installDatabase(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../../files/database',
            base_path('database')
        );

        return $this;
    }

    protected function installLang(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../../files/lang',
            base_path('lang')
        );

        return $this;
    }

    protected function installResources(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../../files/resources',
            base_path('resources')
        );

        return $this;
    }

    protected function installRoutes(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../../files/routes',
            base_path('routes')
        );

        return $this;
    }

    public function installTests(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../../files/tests',
            base_path('tests')
        );

        return $this;
    }

    public function installTailwindConfig(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../../files/tailwind-config',
            base_path('tailwind-config')
        );

        return $this;
    }
}
