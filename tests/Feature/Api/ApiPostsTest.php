<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\DefaultData;
use Tests\TestCase;

class ApiPostsTest extends TestCase {

    use RefreshDatabase,
        DefaultData;

    public function test_get_index() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->get($this->apiURL . '/posts')
            ->assertStatus(200);
    }
    public function test_get_view() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        /////////////////////////////////
        $record = \App\Models\Post::factory()->create();
        $this->get( $this->apiURL . '/posts/' . $record->id)
            ->assertStatus(200);
        $record->forceDelete();
    }
}
