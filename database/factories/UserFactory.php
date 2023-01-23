<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $email=$this->faker->unique()->safeEmail;
        return [
            'name' => $this->faker->name,
            'email' => $email,
            'mobile' => '0122' . rand(1000000, 9999999),
            'password'=>'demo@12345'
        ];
    }
}
