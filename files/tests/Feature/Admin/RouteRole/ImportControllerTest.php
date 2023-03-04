<?php

namespace Tests\Feature\Admin\RouteRole;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImportControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInvoke()
    {
        $response = $this->actingAs($this->user)
            ->post(route('admin.route_role.import'), [
                'source' => UploadedFile::fake()
                    ->create('route_roles.csv'),
            ]);

        $response->assertStatus(302)
            ->assertRedirect(route('admin.route_role.index'));
    }
}
