<?php

namespace Tests\Feature\Api\Logged;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Feature\DefaultData;

class ApiProfileTest extends TestCase {

    use RefreshDatabase,
        DefaultData;

    public function test_get_index() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        $this->get($this->apiURL . '/profile')
            ->assertStatus(200);
    }

    public function test_post_edit() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        $factory = [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'mobile' => auth()->user()->mobile,
        ];
        $this->post($this->apiURL . '/profile/edit', $factory)
            ->assertStatus(200);
    }

    public function test_post_change_password() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        $this->post($this->apiURL . '/profile/change-password', [
            'old_password' => 'demo@12345',
            'password' => 'demo@12345',
            'password_confirmation' => 'demo@12345',
        ])
            ->assertStatus(200);
    }

    public function test_get_logout() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->actingAsGuestApi();
        $this->get($this->apiURL . '/profile/logout')
            ->assertStatus(200);
    }
}
