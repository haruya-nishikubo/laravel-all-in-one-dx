<?php

namespace Tests\Feature\Admin\User;

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
            ->post(route('admin.user.import'), [
                'source' => UploadedFile::fake()
                    ->create('users.csv'),
            ]);

        $response->assertStatus(302)
            ->assertRedirect(route('admin.user.index'));
    }
}
