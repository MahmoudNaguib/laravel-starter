<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase {

    use RefreshDatabase,
        DefaultData;

    public function test_get_index() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->get('en')
            ->assertStatus(200);
    }

}
