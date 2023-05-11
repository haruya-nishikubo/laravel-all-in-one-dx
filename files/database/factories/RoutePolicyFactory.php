<?php

namespace Database\Factories;

use HaruyaNishikubo\AllInOneDx\Models\RoutePolicy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<RoutePolicy>
 */
class RoutePolicyFactory extends Factory
{
    protected $model = RoutePolicy::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'allows' => [
                'admin.route_policy.index',
            ],
        ];
    }
}
