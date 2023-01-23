<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PostsSeeder extends Seeder {

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run() {
        \DB::table('posts')->delete();
        if (app()->environment() != 'testing') {
            \DB::statement("ALTER TABLE posts AUTO_INCREMENT = 1");
        }
        $users = \App\Models\User::where('type', 'guest')->get();
        if ($users) {
            foreach ($users as $user) {
                \App\Models\Post::factory([
                    'created_by' => $user->id,
                ])->count(2)->create();
            }
        }
    }

}
