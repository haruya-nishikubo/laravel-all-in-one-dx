<?php

namespace HaruyaNishikubo\AllInOneDx\Console;

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
        $this->installModels()
            ->installMigrations()
            ->installControllers()
            ->installRequests()
            ->installResources()
            ->installRoutes()
            ->installMiddlewares()
            ->installExceptions()
            ->installLangModels()
            ->installFactories()
            ->installTests();

        return self::SUCCESS;
    }

    protected function installModels(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../files/app/Models',
            base_path('app/Models')
        );

        return $this;
    }

    protected function installMigrations(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../files/database/migrations',
            base_path('database/migrations')
        );

        return $this;
    }

    protected function installControllers(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../files/app/Http/Controllers',
            base_path('app/Http/Controllers')
        );

        return $this;
    }

    protected function installRequests(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../files/app/Http/Requests',
            base_path('app/Http/Requests')
        );

        return $this;
    }

    protected function installResources(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../files/resources',
            base_path('resources')
        );

        return $this;
    }

    protected function installRoutes(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../files/routes',
            base_path('routes')
        );

        return $this;
    }

    protected function installMiddlewares(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../files/app/Http/Middleware',
            base_path('app/Http/Middleware')
        );

        return $this;
    }

    protected function installExceptions(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../files/app/Exceptions',
            base_path('app/Exceptions')
        );

        return $this;
    }

    protected function installLangModels(): self
    {
        $target_path = base_path('lang/ja/models.php');
        $target = (file_exists(($target_path)))
            ? require $target_path
            : [];

        $source_path = __DIR__ . '/../../files/lang/ja/models.php';
        $source = (file_exists(($source_path)))
            ? require $source_path
            : [];

        $lang = array_merge($target, $source);

        if (! file_exists(dirname($target_path))) {
            mkdir(dirname($target_path), 0755, true);
        }

        file_put_contents($target_path,
            "<?php\n\nreturn " . str_replace([
                'array (',
                ')'
            ], [
                '[',
                ']',
            ], var_export($lang, true)) . ';'
        );

        return $this;
    }

    public function installFactories(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../files/database/factories',
            base_path('database/factories')
        );

        return $this;
    }

    public function installTests(): self
    {
        (new Filesystem())->copyDirectory(
            __DIR__ . '/../../files/tests',
            base_path('tests')
        );

        return $this;
    }
}
