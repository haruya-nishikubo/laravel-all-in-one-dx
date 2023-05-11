<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.user.index'));

        $response->assertStatus(200)
            ->assertViewIs('admin.user.index');
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.user.create'));

        $response->assertStatus(200)
            ->assertViewIs('admin.user.create');
    }

    public function testStore()
    {
        $params = User::factory()
            ->definition();

        $response = $this->actingAs($this->user)
            ->post(route('admin.user.store'), [
                'user' => $params,
            ]);

        unset($params['password'],
            $params['email_verified_at'],
            $params['remember_token']);

        $this->assertDatabaseHas('users', $params);

        $user = User::firstWhere($params);

        $response->assertStatus(302)
            ->assertRedirect(route('admin.user.show', $user));
    }

    public function testShow()
    {
        $user = User::factory()
            ->create();

        $response = $this->actingAs($this->user)
            ->get(route('admin.user.show', $user));

        $response->assertStatus(200)
            ->assertViewIs('admin.user.show');
    }

    public function testEdit()
    {
        $user = User::factory()
            ->create();

        $response = $this->actingAs($this->user)
            ->get(route('admin.user.edit', $user));

        $response->assertStatus(200)
            ->assertViewIs('admin.user.edit');
    }

    public function testUpdate()
    {
        $user = User::factory()
            ->create();

        $params = User::factory()
            ->definition();

        $response = $this->actingAs($this->user)
            ->put(route('admin.user.update', $user), [
                'user' => $params,
            ]);

        unset($params['password'],
            $params['email_verified_at'],
            $params['remember_token']);

        $this->assertDatabaseHas('users', array_merge($params, [
            'id' => $user->id,
        ]));

        $response->assertStatus(302)
            ->assertRedirect(route('admin.user.show', $user));
    }

    public function testDestroy()
    {
        $user = User::factory()
            ->create();

        $response = $this->actingAs($this->user)
            ->delete(route('admin.user.show', $user));

        $this->assertSoftDeleted($user);

        $response->assertStatus(302)
            ->assertRedirect(route('admin.user.index'));
    }
}
