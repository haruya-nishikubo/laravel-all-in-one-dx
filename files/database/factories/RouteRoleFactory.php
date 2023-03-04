<?php

namespace Database\Factories;

use App\Models\RoutePolicy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RouteRole>
 */
class RouteRoleFactory extends Factory
{
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
