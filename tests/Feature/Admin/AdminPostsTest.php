<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Feature\DefaultData;

class AdminPostsTest extends TestCase {

    use RefreshDatabase,
        DefaultData;

   public function test_index() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsAdmin();
        $this->get($this->adminURL . '/posts')
            ->assertStatus(200);
    }

     public function test_get_create() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsAdmin();
        $this->get($this->adminURL . '/posts/create')
            ->assertStatus(200);
    }

    public function test_post_create() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsAdmin();
        $factory = \App\Models\Post::factory()->make();
        $this->post($this->adminURL . '/posts/create', $factory->toArray())
            ->assertStatus(302)
            ->assertSessionHas('flash_notification.0.level', 'success');
        $record = \App\Models\Post::orderBy('id', 'desc')->first();
        $record->forceDelete();
    }

    public function test_get_edit() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsAdmin();
        $record = \App\Models\Post::factory()->create();
        $this->get($this->adminURL . '/posts/edit/' . $record->id)
            ->assertStatus(200);
        $record->forceDelete();
    }

    public function test_post_edit() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsAdmin();
        $record = \App\Models\Post::factory()->create();
        $factory = \App\Models\Post::factory()->make();
        $this->post($this->adminURL . '/posts/edit/' . $record->id, $factory->toArray())
            ->assertStatus(302)
            ->assertSessionHas('flash_notification.0.level', 'success');
        $record->forceDelete();
    }

    public function test_view() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsAdmin();
        $record = \App\Models\Post::factory()->create();
        $this->get($this->adminURL . '/posts/view/' . $record->id)
            ->assertStatus(200);
        $record->forceDelete();
    }

    public function test_get_delete() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsAdmin();
        $record = \App\Models\Post::factory()->create();
        $this->get($this->adminURL . '/posts/delete/' . $record->id)
            ->assertStatus(302)
            ->assertSessionHas('flash_notification.0.level', 'success');
        $record->forceDelete();
    }

    public function test_delete_all() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsAdmin();
        $record = \App\Models\Post::factory()->create();
        $this->get($this->adminURL . '/posts/delete-all?ids=' . $record->id)
            ->assertStatus(302)
            ->assertSessionHas('flash_notification.0.level', 'success');
        $record->forceDelete();
    }

    public function test_export() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsAdmin();
        $record = \App\Models\Post::factory()->create();
        $this->get($this->adminURL . '/posts/export')
            ->assertStatus(200);
        $record->forceDelete();
    }

}
