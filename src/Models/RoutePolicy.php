<?php

namespace HaruyaNishikubo\AllInOneDx\Models;

use Database\Factories\RoutePolicyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class RoutePolicy extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'allows',
    ];

    protected $casts = [
        'allows' => 'array',
    ];

    public function targetRoutes(): Collection
    {
        return collect(Route::getRoutes())->filter(function ($value) {
            return in_array('auth', $value->gatherMiddleware());
        })->map(function ($value) {
            return [
                'methods' => $value->methods(),
                'uri' => $value->uri(),
                'name' => $value->getName(),
            ];
        });
    }

    protected static function newFactory()
    {
        return RoutePolicyFactory::new();
    }
}
