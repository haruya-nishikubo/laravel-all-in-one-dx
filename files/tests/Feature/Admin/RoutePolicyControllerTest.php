<?php

namespace Tests\Feature\Admin;

use HaruyaNishikubo\AllInOneDx\Models\RoutePolicy;
use Tests\TestCase;

class RoutePolicyControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.route_policy.index'));

        $response->assertStatus(200)
            ->assertViewIs('admin.route_policy.index');
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.route_policy.create'));

        $response->assertStatus(200)
            ->assertViewIs('admin.route_policy.create');
    }

    public function testStore()
    {
        $params = RoutePolicy::factory()
            ->definition();

        $response = $this->actingAs($this->user)
            ->post(route('admin.route_policy.store'), [
                'route_policy' => $params,
            ]);

        unset($params['allows']);

        $this->assertDatabaseHas('route_policies', $params);

        $route_policy = RoutePolicy::firstWhere($params);

        $response->assertStatus(302)
            ->assertRedirect(route('admin.route_policy.show', $route_policy));
    }

    public function testShow()
    {
        $route_policy = RoutePolicy::factory()
            ->create();

        $response = $this->actingAs($this->user)
            ->get(route('admin.route_policy.show', $route_policy));

        $response->assertStatus(200)
            ->assertViewIs('admin.route_policy.show');
    }

    public function testEdit()
    {
        $route_policy = RoutePolicy::factory()
            ->create();

        $response = $this->actingAs($this->user)
            ->get(route('admin.route_policy.edit', $route_policy));

        $response->assertStatus(200)
            ->assertViewIs('admin.route_policy.edit');
    }

    public function testUpdate()
    {
        $route_policy = RoutePolicy::factory()
            ->create();

        $params = RoutePolicy::factory()
            ->definition();

        $response = $this->actingAs($this->user)
            ->put(route('admin.route_policy.update', $route_policy), [
                'route_policy' => $params,
            ]);

        unset($params['allows']);

        $this->assertDatabaseHas('route_policies', array_merge($params, [
            'id' => $route_policy->id,
        ]));

        $response->assertStatus(302)
            ->assertRedirect(route('admin.route_policy.show', $route_policy));
    }

    public function testDestroy()
    {
        $route_policy = RoutePolicy::factory()
            ->create();

        $response = $this->actingAs($this->user)
            ->delete(route('admin.route_policy.show', $route_policy));

        $this->assertSoftDeleted($route_policy);

        $response->assertStatus(302)
            ->assertRedirect(route('admin.route_policy.index'));
    }
}
