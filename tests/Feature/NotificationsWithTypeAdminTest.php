<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificationsWithTypeAdminTest extends TestCase {

    use RefreshDatabase,
        DefaultData;

    public function test_get_index() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsAdmin();
        $this->get('en/notifications')
            ->assertStatus(200);
    }

    public function test_view() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsAdmin();
        $record = \App\Models\Notification::factory()->create(['user_id' => auth()->user()->id]);
        $this->get('en/notifications/view/' . $record->id)
            ->assertStatus(200);
        $record->forceDelete();
    }

    public function test_get_delete() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsAdmin();
        $record = \App\Models\Notification::factory()->create(['user_id' => auth()->user()->id]);
        $this->get('en/notifications/delete/' . $record->id)
            ->assertStatus(302);
        $record->forceDelete();
    }

    public function test_delete_all() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsAdmin();
        $record = \App\Models\Notification::factory()->create(['user_id' => auth()->user()->id]);
        $this->get('en/notifications/delete-all?ids=' . $record->id)
            ->assertStatus(302);
        $record->forceDelete();
    }
}
