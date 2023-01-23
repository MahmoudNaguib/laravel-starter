<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $user = \App\Models\User::inRandomOrder()->first();
        return [
            'user_id' => $user->id,
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->sentence(8),
        ];
    }
}
