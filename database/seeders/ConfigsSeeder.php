<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class ConfigsSeeder extends Seeder {

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run() {
        \DB::table('configs')->delete();
        if (app()->environment() != 'testing') {
            \DB::statement("ALTER TABLE configs AUTO_INCREMENT = 1");
        }
        insertDefaultConfigs();
        \Cache::forget('configs');
    }

}
