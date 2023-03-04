<?php

namespace Tests\Feature\Admin\RoutePolicy;

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
            ->post(route('admin.route_policy.import'), [
                'source' => UploadedFile::fake()
                    ->create('route_policies.csv'),
            ]);

        $response->assertStatus(302)
            ->assertRedirect(route('admin.route_policy.index'));
    }
}
