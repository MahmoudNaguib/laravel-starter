<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\DefaultData;
use Tests\TestCase;

class ApiTranslationsTest extends TestCase {

    use RefreshDatabase,
        DefaultData;

    public function test_get_pairs() {
        dump(get_class($this) . ' ' . __FUNCTION__);
        $this->get('api/translations')
            ->assertStatus(200);
    }
}
