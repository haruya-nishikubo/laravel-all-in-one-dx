# Requirement
```shell
$ composer require laravel/breeze --dev

$ yarn install

$ php artisan breeze:install
```

# Installation

## composer.json
```json
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/",

            "HaruyaNishikubo\\AllInOneDx\\": "vendor/hrynskb/laravel-all-in-one-dx/src"
        }
    },
```

## app/config.php
```php
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

        HaruyaNishikubo\AllInOneDx\AllInOneDxServiceProvider::class,
```

## app/Models/User.php
```php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Traits\HasRouteRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRouteRole;
```

## app/Http/Kernel.php
```php
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\EnsureRoutePolicy::class,
    ];
```

## routes/web.php
```php
require __DIR__ . '/web/admin/route_policy.php';
require __DIR__ . '/web/admin/route_role.php';
```
