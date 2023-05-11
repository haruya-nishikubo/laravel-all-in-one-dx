<?php

namespace Database\Factories;

use HaruyaNishikubo\AllInOneDx\Models\RoutePolicy;
use HaruyaNishikubo\AllInOneDx\Models\RouteRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<RouteRole>
 */
class RouteRoleFactory extends Factory
{
    protected $model = RouteRole::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
        ];
    }

    public function superuser()
    {
        return $this->hasAttached(
            RoutePolicy::factory()
                ->state(function (array $attributes) {
                    return [
                        'allows' => (new RoutePolicy())
                            ->targetRoutes()
                            ->pluck('name')
                            ->toArray(),
                    ];
                })
        );
    }
}
