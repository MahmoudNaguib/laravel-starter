<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class UsersSeeder extends Seeder {

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run() {
        if (app()->environment() != 'production') {
            \DB::table('users')->delete();
            if (app()->environment() != 'testing') {
                \DB::statement("ALTER TABLE users AUTO_INCREMENT = 1");
            }
            insertDefaultUsers();
        }
    }
}
