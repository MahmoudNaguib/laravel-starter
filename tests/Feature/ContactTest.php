<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase {

    use RefreshDatabase,
        DefaultData;

    public function test_get_index() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuest();
        $this->get('en/contact')
            ->assertStatus(200);
    }

    public function test_post_index() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $row = \App\Models\Message::factory()->make();
        $this->post('en/contact', $row->toArray())
            ->assertStatus(302)
            ->assertSessionHas('flash_notification.0.level', 'success');
    }
}
