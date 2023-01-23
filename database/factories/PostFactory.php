<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $creator=\App\Models\User::where('type','guest')->active()->inRandomOrder()->first();
        return [
            'title' => $this->faker->sentence(rand(2,5)),
            'content' => $this->faker->paragraph(rand(10, 20)),
            'is_approved'=>1,
            'created_by'=>$creator->id,
        ];
    }
}
