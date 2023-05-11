<?php

namespace HaruyaNishikubo\AllInOneDx\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Throwable;

class ScaffoldCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'all-in-one-dx:scaffold {--model=} {--prefix=} {--debug} {--run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold All-In-One-Dx files by model';

    protected bool $is_debug;

    protected bool $is_run;

    protected string $model;

    protected string $prefix;

    protected array $properties = [];

    protected array $replacements = [];

    protected array $publish_dirs = [];

    protected array $stub_path = [
        'controller-resource' => __DIR__ . '/../../stubs/controllers/controller-resource.stub',
        'controller-export' => __DIR__ . '/../../stubs/controllers/controller-export.stub',
        'controller-import' => __DIR__ . '/../../stubs/controllers/controller-import.stub',
        'controller-import-rule-line' => __DIR__ . '/../../stubs/controllers/controller-import-rule-line.stub',
        'request-index' => __DIR__ . '/../../stubs/requests/request-index.stub',
        'request-index-query-line-string' => __DIR__ . '/../../stubs/requests/request-index-query-line-string.stub',
        'request-index-query-line-datetime' => __DIR__ . '/../../stubs/requests/request-index-query-line-datetime.stub',
        'request-index-query-line-float' => __DIR__ . '/../../stubs/requests/request-index-query-line-float.stub',
        'request-index-query-line-int' => __DIR__ . '/../../stubs/requests/request-index-query-line-int.stub',
        'request-store' => __DIR__ . '/../../stubs/requests/request-store.stub',
        'request-store-rule-line' => __DIR__ . '/../../stubs/requests/request-store-rule-line.stub',
        'request-update' => __DIR__ . '/../../stubs/requests/request-update.stub',
        'request-export' => __DIR__ . '/../../stubs/requests/request-export.stub',
        'request-import' => __DIR__ . '/../../stubs/requests/request-import.stub',
        'view-create' => __DIR__ . '/../../stubs/views/view-create.stub',
        'view-edit' => __DIR__ . '/../../stubs/views/view-edit.stub',
        'view-form' => __DIR__ . '/../../stubs/views/view-form.stub',
        'view-form-input' => __DIR__ . '/../../stubs/views/view-form-input.stub',
        'view-index' => __DIR__ . '/../../stubs/views/view-index.stub',
        'view-index-form-line' => __DIR__ . '/../../stubs/views/view-index-form-line.stub',
        'view-show' => __DIR__ . '/../../stubs/views/view-show.stub',
        'view-show-body-line' => __DIR__ . '/../../stubs/views/view-show-body-line.stub',
        'lang' => __DIR__ . '/../../stubs/lang/lang.stub',
        'lang-actions' => __DIR__ . '/../../stubs/lang/lang-actions.stub',
        'routes-web' => __DIR__ . '/../../stubs/routes/routes-web.stub',
        'test-controller-resource' => __DIR__ . '/../../stubs/tests/test-controller-resource.stub',
        'test-controller-export' => __DIR__ . '/../../stubs/tests/test-controller-export.stub',
        'test-controller-import' => __DIR__ . '/../../stubs/tests/test-controller-import.stub',
    ];

    protected const INDENT = '    ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $this->setIsDebug()
                ->setIsRun()
                ->setModel()
                ->setPrefix()
                ->setProperties()
                ->setReplacements()
                ->setPublishDirs();
        } catch (Throwable $e) {
            $this->error($e->getMessage());

            return self::INVALID;
        }

        try {
            $this->makeControllerResource()
                ->makeIndexRequest()
                ->makeStoreRequest()
                ->makeUpdateRequest()
                ->makeControllerExport()
                ->makeExportRequest()
                ->makeControllerImport()
                ->makeImportRequest()
                ->makeViewIndex()
                ->makeViewCreate()
                ->makeViewShow()
                ->makeViewEdit()
                ->makeViewForm()
                ->makeLangActions()
                ->makeLangModels()
                ->makeRoutes()
                ->makeTestControllerResource()
                ->makeTestControllerExport()
                ->makeTestControllerImport();
        } catch (Throwable $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        return self::SUCCESS;
    }

    /**
     * @return $this
     */
    protected function setIsDebug(): self
    {
        $this->is_debug = $this->option('debug');

        return $this;
    }

    /**
     * @return $this
     */
    protected function setIsRun(): self
    {
        $this->is_run = $this->option('run');

        return $this;
    }

    /**
     * @return $this
     *
     * @throws Exception
     */
    protected function setModel(): self
    {
        $this->model = $this->option('model');

        if (! ctype_upper(substr($this->model, 0, 1))) {
            throw new Exception('first letter of model is not uppercase.');
        }

        return $this;
    }

    /**
     * @return $this
     *
     * @throws Exception
     */
    protected function setPrefix(): self
    {
        $this->prefix = $this->option('prefix') ?? '';

        if (! ctype_upper(substr($this->prefix, 0, 1))) {
            throw new Exception('first letter of prefix is not uppercase.');
        }

        return $this;
    }

    /**
     * @return $this
     *
     * @throws Exception
     */
    protected function setProperties(): self
    {
        $path = base_path('_ide_helper_models.php');
        if (! file_exists($path)) {
            throw new Exception('_ide_helper_models.php is not found. run `php artisan ide-helper:models --nowrite`');
        }

        $lines = file($path);
        $is_start = false;
        foreach ($lines as $v) {
            if (str_contains($v, "class {$this->model} extends \\Eloquent")) {
                break;
            }

            if (str_contains($v, "* App\\Models\\{$this->model}")) {
                $is_start = true;
            }

            if (! $is_start) {
                continue;
            }

            if (! str_contains($v, '* @property ')) {
                continue;
            }

            $words = explode(' ', trim($v));

            $name = str_replace('$', '', $words[3]);
            if (in_array($name, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                continue;
            }

            $type = explode('|', $words[2])[0];
            if ($type == '\Illuminate\Support\Carbon') {
                $type = 'datetime';
            }

            $this->properties[] = [
                'name' => $name,
                'type' => $type,
                'comment' => $words[4] ?? null,
                'is_nullable' => str_contains($words[2], 'null') !== false,
            ];
        }

        if (empty($this->properties)) {
            throw new Exception("{$this->model} properties is empty.");
        }

        if ($this->is_debug) {
            $this->info(print_r($this->properties, true));
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function setReplacements(): self
    {
        $this->replacements = [
            '{{ namespace_controller }}' => collect([
                'App\\Http\\Controllers',
                $this->prefix,
            ])->filter(function ($value) {
                return ! empty($value);
            })->implode('\\'),

            '{{ namespace_request }}' => collect([
                'App\\Http\\Requests',
                $this->prefix,
                $this->model,
            ])->filter(function ($value) {
                return ! empty($value);
            })->implode('\\'),

            '{{ namespace_model }}' => 'App\\Models',

            '{{ namespace_test }}' => collect([
                'Tests\\Feature',
                $this->prefix,
            ])->filter(function ($value) {
                return ! empty($value);
            })->implode('\\'),

            '{{ Controller }}' => "{$this->model}Controller",
            '{{ Model }}' => $this->model,

            '{{ model }}' => $this->toSnake($this->model),
            '{{ models }}' => $this->toSnake($this->toPlural($this->model)),

            '{{ view_path }}' => collect([
                $this->toSnake($this->prefix),
                $this->toSnake($this->model),
            ])->filter(function ($value) {
                return ! empty($value);
            })->implode('.'),

            '{{ route_path }}' => collect([
                $this->toSnake($this->prefix),
                $this->toSnake($this->model),
            ])->implode('.'),
            '{{ route_prefix }}' => $this->toSnake($this->prefix),
            '{{ route_name }}' => $this->toSnake($this->prefix),
            '{{ route_resource_name }}' => $this->toSnake($this->model),

            '{{ lang_model }}' => $this->toSnake($this->model),

            '{{ layout }}' => "x-{$this->prefix}-layout",
        ];

        return $this;
    }

    /**
     * @return $this
     */
    protected function setPublishDirs(): self
    {
        $this->publish_dirs = [
            'controllers' => collect([
                'app/Http/Controllers',
                $this->prefix,
            ])->filter(function ($value) {
                return ! empty($value);
            })->implode('/'),

            'requests' => collect([
                'app/Http/Requests',
                $this->prefix,
                $this->model,
            ])->filter(function ($value) {
                return ! empty($value);
            })->implode('/'),

            'views' => collect([
                'resources/views',
                $this->toSnake($this->prefix),
                $this->toSnake($this->model),
            ])->filter(function ($value) {
                return ! empty($value);
            })->implode('/'),

            'lang' => 'lang',

            'routes' => collect([
                'routes',
                'web',
                $this->toSnake($this->prefix),
            ])->filter(function ($value) {
                return ! empty($value);
            })->implode('/'),

            'tests' => collect([
                'tests',
                'Feature',
                $this->prefix,
            ])->filter(function ($value) {
                return ! empty($value);
            })->implode('/'),
        ];

        return $this;
    }

    /**
     * @param  string  $key
     * @return string
     */
    protected function getStubPath(string $key): string
    {
        return $this->stub_path[$key];
    }

    /**
     * @param  string  $key
     * @return string
     */
    protected function getPublishPath(string $key, string $file_name): string
    {
        return $this->publish_dirs[$key] . "/{$file_name}";
    }

    /**
     * @return $this
     */
    protected function makeControllerResource(): self
    {
        $replacements = $this->replacements;

        $contents = $this->getContents($this->getStubPath('controller-resource'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('controllers', "{$this->model}Controller.php"), $contents);
        }

        return $this;
    }

    protected function makeControllerExport(): self
    {
        $replacements = $this->replacements;

        $contents = $this->getContents($this->getStubPath('controller-export'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('controllers', "{$this->model}/ExportController.php"), $contents);
        }

        return $this;
    }

    protected function makeControllerImport(): self
    {
        $replacements = array_merge($this->replacements, [
            '{{ transform }}' => collect($this->properties)->map(function ($value, $index) {
                return str_repeat(self::INDENT, 4) . "'{$value['name']}' => " . '$v[' . $index . '],';
            })->implode("\n"),

            '{{ rules }}' => collect($this->properties)->map(function ($value) {
                $field = $this->toSnake($this->model) . ".*.{$value['name']}";
                $type = match ($value['type']) {
                    '\\Illuminate\\Support\\Carbon' => 'datetime',
                    'int', 'float', 'double' => 'numeric',
                    default => $value['type'],
                };

                return $this->getContents($this->getStubPath('controller-import-rule-line'), [
                    '{{ field }}' => $field,
                    '{{ required }}' => $value['is_nullable'] ? 'nullable' : 'required',
                    '{{ type }}' => $type,
                ]);
            })->implode("\n"),
        ]);

        $contents = $this->getContents($this->getStubPath('controller-import'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('controllers', "{$this->model}/ImportController.php"), $contents);
        }

        return $this;
    }

    protected function makeIndexRequest(): self
    {
        $replacements = array_merge($this->replacements, [
            '{{ rules }}' => collect($this->properties)->map(function ($value) {
                $field = $this->toSnake($this->model) . ".{$value['name']}";
                $type = match ($value['type']) {
                    '\\Illuminate\\Support\\Carbon', 'datetime' => 'date',
                    'int', 'float', 'double' => 'numeric',
                    default => $value['type'],
                };

                if ($type == 'date') {
                    return [
                        $this->getContents($this->getStubPath('request-store-rule-line'), [
                            '{{ field }}' => $this->toSnake($this->model) . ".start_{$value['name']}",
                            '{{ required }}' => 'nullable',
                            '{{ type }}' => 'date',
                        ]),
                        $this->getContents($this->getStubPath('request-store-rule-line'), [
                            '{{ field }}' => $this->toSnake($this->model) . ".end_{$value['name']}",
                            '{{ required }}' => 'nullable',
                            '{{ type }}' => 'date',
                        ]),
                    ];
                }

                return $this->getContents($this->getStubPath('request-store-rule-line'), [
                    '{{ field }}' => $field,
                    '{{ required }}' => 'nullable',
                    '{{ type }}' => $type,
                ]);
            })->flatten()
                ->implode("\n"),

            '{{ query }}' => collect($this->properties)->map(function ($value) {
                if ($value['type'] == 'array') {
                    return '';
                }

                return $this->getContents($this->getStubPath("request-index-query-line-{$value['type']}"), [
                    '{{ model }}' => $this->toSnake($this->model),
                    '{{ field }}' => $value['name'],
                ]);
            })->filter(function ($value) {
                return ! empty($value);
            })->implode("\n"),
        ]);

        $contents = $this->getContents($this->getStubPath('request-index'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('requests', 'IndexRequest.php'), $contents);
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function makeStoreRequest(): self
    {
        $replacements = array_merge($this->replacements, [
            '{{ rules }}' => collect($this->properties)->map(function ($value) {
                $field = $this->toSnake($this->model) . ".{$value['name']}";
                $type = match ($value['type']) {
                    '\\Illuminate\\Support\\Carbon', 'datetime' => 'date',
                    'int', 'float', 'double' => 'numeric',
                    default => $value['type'],
                };

                return $this->getContents($this->getStubPath('request-store-rule-line'), [
                    '{{ field }}' => $field,
                    '{{ required }}' => $value['is_nullable'] ? 'nullable' : 'required',
                    '{{ type }}' => $type,
                ]);
            })->implode("\n"),
        ]);

        $contents = $this->getContents($this->getStubPath('request-store'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('requests', 'StoreRequest.php'), $contents);
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function makeUpdateRequest(): self
    {
        $replacements = $this->replacements;

        $contents = $this->getContents($this->getStubPath('request-update'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('requests', 'UpdateRequest.php'), $contents);
        }

        return $this;
    }

    protected function makeExportRequest(): self
    {
        $replacements = $this->replacements;

        $contents = $this->getContents($this->getStubPath('request-export'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('requests', 'ExportRequest.php'), $contents);
        }

        return $this;
    }

    protected function makeImportRequest(): self
    {
        $replacements = $this->replacements;

        $contents = $this->getContents($this->getStubPath('request-import'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('requests', 'ImportRequest.php'), $contents);
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function makeViewIndex(): self
    {
        $replacements = array_merge($this->replacements, [
            '{{ form }}' => collect($this->properties)->map(function ($value) {
                $type = match ($value['type']) {
                    '\\Illuminate\\Support\\Carbon' => 'datetime',
                    'int', 'float', 'double' => 'numeric',
                    default => $value['type'],
                };

                if ($type == 'datetime') {
                    return [
                        $this->getContents($this->getStubPath('view-index-form-line'), [
                            '{{ model }}' => $this->toSnake($this->model),
                            '{{ field }}' => "start_{$value['name']}",
                            '{{ type }}' => 'datetime-local',
                        ]),
                        $this->getContents($this->getStubPath('view-index-form-line'), [
                            '{{ model }}' => $this->toSnake($this->model),
                            '{{ field }}' => "end_{$value['name']}",
                            '{{ type }}' => 'datetime-local',
                        ]),
                    ];
                }

                return $this->getContents($this->getStubPath('view-index-form-line'), [
                    '{{ model }}' => $this->toSnake($this->model),
                    '{{ field }}' => $value['name'],
                    '{{ type }}' => 'text',
                ]);
            })->flatten()
                ->implode("\n"),
        ]);

        $contents = $this->getContents($this->getStubPath('view-index'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('views', 'index.blade.php'), $contents);
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function makeViewCreate(): self
    {
        $replacements = $this->replacements;

        $contents = $this->getContents($this->getStubPath('view-create'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('views', 'create.blade.php'), $contents);
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function makeViewShow(): self
    {
        $replacements = array_merge($this->replacements, [
            '{{ body }}' => collect($this->properties)->map(function ($value) {
                return $this->getContents($this->getStubPath('view-show-body-line'), [
                    '{{ model }}' => $this->toSnake($this->model),
                    '{{ field }}' => $value['name'],
                ]);
            })->implode("\n"),
        ]);

        $contents = $this->getContents($this->getStubPath('view-show'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('views', 'show.blade.php'), $contents);
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function makeViewEdit(): self
    {
        $replacements = $this->replacements;

        $contents = $this->getContents($this->getStubPath('view-edit'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('views', 'edit.blade.php'), $contents);
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function makeViewForm(): self
    {
        $replacements = [
            '{{ body }}' => collect($this->properties)->map(function ($value) {
                $replacements = array_merge($this->replacements, [
                    '{{ model }}' => $this->toSnake($this->model),
                    '{{ field }}' => $value['name'],
                    '{{ label_required }}' => (! $value['is_nullable']) ? ':required="true"' : '',
                    '{{ input_required }}' => (! $value['is_nullable']) ? 'required="required"' : '',
                ]);

                $contents = $this->getContents($this->getStubPath('view-form-input'), $replacements);

                return collect(explode("\n", $contents))->map(function ($line) {
                    if (empty(trim($line))) {
                        return '';
                    }

                    return str_repeat(self::INDENT, 1) . $line;
                })->implode("\n");
            })->implode("\n"),
        ];

        $contents = $this->getContents($this->getStubPath('view-form'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('views', 'form.blade.php'), $contents);
        }

        return $this;
    }

    protected function makeLangActions(): self
    {
        $file_path = $this->getPublishPath('lang', 'ja/actions.php');

        $lang = (file_exists($file_path))
            ? require $file_path
            : [];

        if (empty($lang)) {
            $lang = json_decode($this->getContents($this->getStubPath('lang-actions'), []), true);
        }

        if ($this->is_debug) {
            $this->info(var_export($lang, true));
        }

        if ($this->is_run) {
            $contents = $this->getContents($this->getStubPath('lang'), [
                '{{ lang }}' => str_replace(
                    [
                        'array (',
                        ')',
                    ], [
                        '[',
                        ']',
                    ], var_export($lang, true)
                ),
            ]);

            $this->putContents($file_path, $contents);
        }

        return $this;
    }

    protected function makeLangModels(): self
    {
        $file_path = $this->getPublishPath('lang', 'ja/models.php');

        $lang = (file_exists($file_path))
            ? require $file_path
            : [];

        $model_name = $this->toSnake($this->model);
        if (! isset($lang[$model_name])) {
            $lang[$model_name] = [
                'table_name' => $model_name,
                'field' => [],
            ];
        }

        foreach ($this->properties as $v) {
            $lang[$model_name]['field'][$v['name']] = $v['comment'] ?? $v['name'];
        }

        if ($this->is_debug) {
            $this->info(var_export($lang[$model_name], true));
        }

        if ($this->is_run) {
            $contents = $this->getContents($this->getStubPath('lang'), [
                '{{ lang }}' => str_replace(
                    [
                        'array (',
                        ')',
                    ], [
                        '[',
                        ']',
                    ], var_export($lang, true)
                ),
            ]);

            $this->putContents($file_path, $contents);
        }

        return $this;
    }

    protected function makeRoutes(): self
    {
        $file_path = $this->getPublishPath('routes', $this->toSnake($this->model) . '.php');

        if (file_exists($file_path)) {
            return $this;
        }

        $replacements = $this->replacements;

        $contents = $this->getContents($this->getStubPath('routes-web'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($file_path, $contents);

            $append = "require __DIR__ . '/"
                . collect([
                    'web',
                    $this->toSnake($this->prefix),
                    $this->toSnake($this->model) . '.php',
                ])->filter(function ($value) {
                    return ! empty($value);
                })->implode('/')
                . "';\n";

            $this->appendContents('routes/web.php', $append);
        }

        return $this;
    }

    protected function makeTestControllerResource(): self
    {
        $replacements = $this->replacements;

        $contents = $this->getContents($this->getStubPath('test-controller-resource'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('tests', "{$this->model}ControllerTest.php"), $contents);
        }

        return $this;
    }

    protected function makeTestControllerExport(): self
    {
        $replacements = $this->replacements;

        $contents = $this->getContents($this->getStubPath('test-controller-export'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('tests', "{$this->model}/ExportControllerTest.php"), $contents);
        }

        return $this;
    }

    protected function makeTestControllerImport(): self
    {
        $replacements = $this->replacements;

        $contents = $this->getContents($this->getStubPath('test-controller-import'), $replacements);

        if ($this->is_debug) {
            $this->info($contents);
        }

        if ($this->is_run) {
            $this->putContents($this->getPublishPath('tests', "{$this->model}/ImportControllerTest.php"), $contents);
        }

        return $this;
    }

    /**
     * @param  string  $stub_path
     * @param  array  $replacements
     * @return string
     */
    protected function getContents(string $stub_path, array $replacements): string
    {
        return str_replace(
            array_keys($replacements),
            array_values($replacements),
            file_get_contents($stub_path)
        );
    }

    /**
     * @param  string  $file_path
     * @param  string  $contents
     * @return void
     */
    protected function putContents(string $file_path, string $contents): void
    {
        $dir_path = dirname($file_path);
        if (! file_exists($dir_path)) {
            mkdir($dir_path, 0755, true);
        }

        file_put_contents($file_path, $contents);
    }

    protected function appendContents(string $file_path, $contents): void
    {
        file_put_contents($file_path, $contents, FILE_APPEND);
    }

    protected function replaceContents(string $file_path, string $search, string $replace): void
    {
        $contents = file_get_contents($file_path);

        $contents = str_replace($search, $replace, $contents);

        file_put_contents($file_path, $contents);
    }

    protected function toSnake(string $value): string
    {
        return Str::of($value)
            ->snake()
            ->value();
    }

    protected function toPlural(string $value): string
    {
        return Str::of($value)
            ->plural()
            ->value();
    }
}
