<?php

namespace Tests\Feature\Api\Logged;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Feature\DefaultData;

class ApiLoggedNotificationsTest extends TestCase {

    use RefreshDatabase,
        DefaultData;

    public function test_get_index() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        $this->get($this->apiURL . '/notifications')
            ->assertStatus(200);
    }

    public function test_get_unseen_count() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        $this->get($this->apiURL . '/notifications/unseen-count')
            ->assertStatus(200);
    }

    public function test_get_see_all() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        $record = \App\Models\Notification::factory()->create(['user_id' => $this->guestUser->id]);
        $this->get($this->apiURL . '/notifications/see-all')
            ->assertStatus(200);
    }

    public function test_get_delete_all() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        $record = \App\Models\Notification::factory()->create(['user_id' => $this->guestUser->id]);
        $this->get($this->apiURL . '/notifications/delete-all')
            ->assertStatus(200);
    }

    public function test_get_view() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        /////////////////////////////////
        $record = \App\Models\Notification::factory()->create(['user_id' => $this->guestUser->id]);
        $this->get($this->apiURL . '/notifications/' . $record->id)
            ->assertStatus(200);
        $record->forceDelete();
    }

    public function test_delete() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        /////////////////////////////////////////
        $record = \App\Models\Notification::factory()->create(['user_id' => $this->guestUser->id]);
        $this->delete($this->apiURL . '/notifications/' . $record->id)
            ->assertStatus(200);
        $record->forceDelete();
    }
}
