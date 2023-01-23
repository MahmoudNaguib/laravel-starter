<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class BasicSeeder extends Seeder {

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run() {
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        configureUploads();
        ///////////////////////////////////////////////////////////////// Default Configs
        \DB::table('configs')->delete();
        if (app()->environment() != 'testing') {
            \DB::statement("ALTER TABLE configs AUTO_INCREMENT = 1");
        }
        insertDefaultConfigs();
        //////////////////////////////////////////////////// Default users
        \DB::table('users')->delete();
        if (app()->environment() != 'testing') {
            DB::statement("ALTER TABLE users AUTO_INCREMENT = 1");
        }
        insertDefaultUsers();
    }
}
