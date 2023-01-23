<?php

namespace Tests\Feature\Api\Logged;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\DefaultData;
use Tests\TestCase;

class ApiLoggedMyPostsTest extends TestCase {

    use RefreshDatabase,
        DefaultData;

    public function test_get_index() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        $this->get($this->apiURL . '/my-posts')
            ->assertStatus(200);
    }

    public function test_get_view() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        /////////////////////////////////
        $record = \App\Models\Post::factory()->create(['created_by' => $this->guestUser->id]);
        $this->get($this->apiURL . '/my-posts/' . $record->id)
            ->assertStatus(200);
        $record->forceDelete();
    }

    public function test_post_create() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        /////////////////////////////////////////
        $row = \App\Models\Post::factory()->make();
        $this->post($this->apiURL . '/my-posts', $row->toArray())
            ->assertStatus(201);
        $latest = \App\Models\Post::orderBy('id', 'desc')->first();
        $latest->forceDelete();
    }

    public function test_post_edit() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        /////////////////////////////////////////
        $row = \App\Models\Post::factory()->make(['created_by' => $this->guestUser->id]);
        $record = \App\Models\Post::factory()->create(['created_by' => $this->guestUser->id]);
        $this->put($this->apiURL . '/my-posts/' . $record->id, $row->toArray())
            ->assertStatus(200);
        $record->forceDelete();
    }

    public function test_delete() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        /////////////////////////////////////////
        $record = \App\Models\Post::factory()->create(['created_by' => $this->guestUser->id]);
        $this->delete($this->apiURL . '/my-posts/' . $record->id)
            ->assertStatus(200);
        $record->forceDelete();
    }
}
