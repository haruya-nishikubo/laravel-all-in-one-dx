# About
- excel や spreadsheet をメインに運用されている業務をシステム化するためのコマンドを提供
  - `all-in-one-dx:install`: 必要なファイルをインストール
    - アカウント単位でアクセス権限を管理する機能が含まれる
    - アップロードされたファイル情報を記録するテーブルが含まれる
  - `all-in-one-dx:scaffold`: resource, import, export の controller を生成
    - モデルのフィールドから自動的にロジックを実装した状態で生成される

# Requirement
- 事前に laravel/breeze を導入する必要あり

```shell
composer require laravel/breeze --dev
```

```shell
php artisan breeze:install
```

# Installation
```composer.json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/haruya-nishikubo/laravel-all-in-one-dx"
        }
    ],
```

```shell
composer require haruya-nishikubo/laravel-all-in-one-dx --dev
```

## app/config.php
- AllInOneDxServiceProvider を追加
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
- HasRouteRole を追加
```php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use HaruyaNishikubo\AllInOneDx\Traits\HasRouteRole;
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
- EnsureRoutePolicy を追加
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
- require を追加
```php
require __DIR__ . '/web/admin/user.php';
require __DIR__ . '/web/admin/route_policy.php';
require __DIR__ . '/web/admin/route_role.php';
```

## all-in-one-dx:install
- 必要なファイルをインストール
```shell
php artisan all-in-one-dx:install
```

# Usage
```shell
php artisan all-in-one-dx:scaffold --model=User --prefix=Admin --debug --run
```
