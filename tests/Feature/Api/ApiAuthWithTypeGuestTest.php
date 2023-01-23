<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\DefaultData;
use Tests\TestCase;

class ApiAuthWithTypeGuestTest extends TestCase {

    use RefreshDatabase,
        DefaultData;

    public function test_post_invalid_login() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->post($this->apiURL . '/auth/login', ['email' => 'invalid@example.com', 'password' => 'demo@12345'])
            ->assertStatus(403);
    }

   public function test_post_valid_login() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->post($this->apiURL . '/auth/login',
            [
                'email' => $this->guestUser->email,
                'password' => 'demo@12345'
            ])
            ->assertStatus(200);
    }

    /*public function test_post_invalid_forgot_password() {
       dump(get_class($this) . ' ' . __FUNCTION__);
       $this->post($this->apiURL . '/auth/forgot-password', [
           'email' => 'invalid@example.com',
       ])
           ->assertStatus(403);
   }

   public function test_post_valid_forgot_password() {
       dump(get_class($this) . ' ' . __FUNCTION__);
       $this->post($this->apiURL . '/auth/forgot-password',
           [
               'email' => $this->guestUser->email,
           ])
           ->assertStatus(200);
   }*/
}
