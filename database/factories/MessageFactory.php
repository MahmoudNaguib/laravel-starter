<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MessageFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'name' =>$this->faker->name,
            'email' =>$this->faker->unique()->safeEmail,
            'mobile' => '0122' . rand(1000000, 9999999),
            'title' => $this->faker->sentence(rand(2,5)),
            'content' => $this->faker->paragraph(rand(10, 20)),
        ];
    }
}
