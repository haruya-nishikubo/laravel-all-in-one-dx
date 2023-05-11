<?php

namespace Tests\Feature\Admin;

use HaruyaNishikubo\AllInOneDx\Models\RouteRole;
use Tests\TestCase;

class RouteRoleControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.route_role.index'));

        $response->assertStatus(200)
            ->assertViewIs('admin.route_role.index');
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.route_role.create'));

        $response->assertStatus(200)
            ->assertViewIs('admin.route_role.create');
    }

    public function testStore()
    {
        $params = RouteRole::factory()
            ->definition();

        $response = $this->actingAs($this->user)
            ->post(route('admin.route_role.store'), [
                'route_role' => $params,
            ]);

        $this->assertDatabaseHas('route_roles', $params);

        $route_role = RouteRole::firstWhere($params);

        $response->assertStatus(302)
            ->assertRedirect(route('admin.route_role.show', $route_role));
    }

    public function testShow()
    {
        $route_role = RouteRole::factory()
            ->create();

        $response = $this->actingAs($this->user)
            ->get(route('admin.route_role.show', $route_role));

        $response->assertStatus(200)
            ->assertViewIs('admin.route_role.show');
    }

    public function testEdit()
    {
        $route_role = RouteRole::factory()
            ->create();

        $response = $this->actingAs($this->user)
            ->get(route('admin.route_role.edit', $route_role));

        $response->assertStatus(200)
            ->assertViewIs('admin.route_role.edit');
    }

    public function testUpdate()
    {
        $route_role = RouteRole::factory()
            ->create();

        $params = RouteRole::factory()
            ->definition();

        $response = $this->actingAs($this->user)
            ->put(route('admin.route_role.update', $route_role), [
                'route_role' => $params,
            ]);

        $this->assertDatabaseHas('route_roles', array_merge($params, [
            'id' => $route_role->id,
        ]));

        $response->assertStatus(302)
            ->assertRedirect(route('admin.route_role.show', $route_role));
    }

    public function testDestroy()
    {
        $route_role = RouteRole::factory()
            ->create();

        $response = $this->actingAs($this->user)
            ->delete(route('admin.route_role.show', $route_role));

        $this->assertSoftDeleted($route_role);

        $response->assertStatus(302)
            ->assertRedirect(route('admin.route_role.index'));
    }
}
