<?php

namespace Tests\Feature\Admin\RouteRole;

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
            ->get(route('admin.route_role.export'));

        $response->assertStatus(200)
            ->assertDownload();
    }
}
