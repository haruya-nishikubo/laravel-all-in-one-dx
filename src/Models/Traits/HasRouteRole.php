<?php

namespace HaruyaNishikubo\AllInOneDx\Models\Traits;

use HaruyaNishikubo\AllInOneDx\Models\RouteRole;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

trait HasRouteRole
{
    public function routeRoles(): BelongsToMany
    {
        return $this->belongsToMany(RouteRole::class);
    }

    public function routeAllows(): Collection
    {
        return $this->routeRoles
            ->map(function ($role) {
                return $role->routePolicies
                    ->map(function ($policy) {
                        return $policy->allows;
                    });
            })->flatten()
                ->unique();
    }

    public function isRouteAllowed(string $route): bool
    {
        return $this->routeAllows()
            ->contains($route);
    }
}
