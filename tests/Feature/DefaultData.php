<?php

namespace Tests\Feature;

use Database\Seeders\BasicSeeder;

trait DefaultData {
    public $adminUser, $guestUser;

    public function setup(): void {
        parent::setup();
        $this->seed(BasicSeeder::class);
        $this->adminURL = 'en/admin';
        $this->apiURL = 'api/en';
        $this->adminUser = \App\Models\User::find(1);
        $this->guestUser = \App\Models\User::where('type', '=', 'guest')->active()->first();
    }

    public function actingAsAdmin() {
        $this->actingAs($this->adminUser)->withSession(['locale' => 'en']);
    }

    public function actingAsGuest() {
        $this->actingAs($this->guestUser)->withSession(['locale' => 'en']);
    }

    public function actingAsGuestApi() {
        $this->actingAs($this->guestUser)->withHeaders(['Authorization' => $this->guestUser->token, 'locale' => 'en']);
    }

}
