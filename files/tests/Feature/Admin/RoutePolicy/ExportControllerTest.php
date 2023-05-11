<?php

namespace Tests\Feature\Admin\RoutePolicy;

use Tests\TestCase;

class ExportControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInvoke()
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.route_policy.export'));

        $response->assertStatus(200)
            ->assertDownload();
    }
}
