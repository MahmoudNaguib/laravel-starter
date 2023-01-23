<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase {

    use RefreshDatabase,
        DefaultData;

    public function test_get_index() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->get( 'en/posts')
            ->assertStatus(200);
    }

    public function test_get_view() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        /////////////////////////////////
        $record = \App\Models\Post::factory()->create();
        $this->get( 'en/posts/details/' . $record->id)
            ->assertStatus(200);
        $record->forceDelete();
    }

}
