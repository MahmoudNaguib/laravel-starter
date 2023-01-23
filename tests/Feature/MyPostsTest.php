<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MyPostsTest extends TestCase {

    use RefreshDatabase,
        DefaultData;

    public function test_get_index() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuest();
        $this->get('en/my-posts')
            ->assertStatus(200);
    }

    public function test_get_view() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuest();
        /////////////////////////////////
        $record = \App\Models\Post::factory()->create(['created_by' => $this->guestUser->id]);
        $this->get('en/my-posts/view/' . $record->id)
            ->assertStatus(200);
        $record->forceDelete();
    }

    public function test_get_create() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuest();
        /////////////////////////////////
        $this->get('en/my-posts/create')
            ->assertStatus(200);
    }

    public function test_post_create() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuest();
        /////////////////////////////////////////
        $row = \App\Models\Post::factory()->make();
        $this->post('en/my-posts/create', $row->toArray())
            ->assertStatus(302)
            ->assertSessionHas('flash_notification.0.level', 'success');
    }

    public function test_get_edit() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuest();
        /////////////////////////////////
        $record = \App\Models\Post::factory()->create(['created_by' => $this->guestUser->id]);
        $this->get('en/my-posts/edit/' . $record->id)
            ->assertStatus(200);
        $record->forceDelete();
    }

    public function test_post_edit() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuest();
        /////////////////////////////////
        $row = \App\Models\Post::factory()->make(['created_by' => $this->guestUser->id]);
        $record = \App\Models\Post::factory()->create(['created_by' => $this->guestUser->id]);
        $this->post('en/my-posts/edit/' . $record->id, $row->toArray())
            ->assertStatus(302)
            ->assertSessionHas('flash_notification.0.level', 'success');
        $record->forceDelete();
    }

    public function test_get_delete_all() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuest();
        /////////////////////////////////
        $record = \App\Models\Post::factory()->create(['created_by' => $this->guestUser->id]);
        $this->get('en/my-posts/delete-all?ids=' . $record->id)
            ->assertStatus(302)
            ->assertSessionHas('flash_notification.0.level', 'success');
        $record->forceDelete();
    }

    public function test_get_delete() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuest();
        $record = \App\Models\Post::factory()->create(['created_by' => $this->guestUser->id]);
        $this->get('en/my-posts/delete/' . $record->id)
            ->assertStatus(302)
            ->assertSessionHas('flash_notification.0.level', 'success');
        $record->forceDelete();
    }

    public function test_export() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuest();
        $record = \App\Models\Post::factory()->create(['created_by' => $this->guestUser->id]);
        $this->get('en/my-posts/export')
            ->assertStatus(200);
        $record->forceDelete();
    }

}
