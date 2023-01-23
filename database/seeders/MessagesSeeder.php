<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use DB;

class MessagesSeeder extends Seeder {

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run() {
        if (app()->environment() != 'production') {
            \DB::table('messages')->delete();
            if (app()->environment() != 'testing') {
                \DB::statement("ALTER TABLE messages AUTO_INCREMENT = 1");
                \App\Models\Message::factory()
                    ->count(5)
                    ->create();
            }
        }
    }
}
