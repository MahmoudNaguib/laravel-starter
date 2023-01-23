<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use DB;

class NotificationsSeeder extends Seeder {

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run() {
        if (app()->environment() != 'production') {
            \DB::table('notifications')->delete();
            if (app()->environment() != 'testing') {
                \DB::statement("ALTER TABLE notifications AUTO_INCREMENT = 1");
            }
            $users=\App\Models\User::get();
            if($users){
                foreach ($users as $user){
                    \App\Models\Notification::factory()
                        ->count(10)
                        ->create(['user_id'=>$user->id]);
                }
            }
        }
    }
}
